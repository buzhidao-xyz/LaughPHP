<?php
/**
 * MongoDB数据库操作类 执行add delete update select等操作
 * MongoDB 支持Array和Json数据作为查询参数 支持正则表达式查询
 * baoqing wang
 * 2014-1-3
 */
// db.collection.findAndModify( {
//    query: <document>,
//    sort: <document>,
//    remove: <boolean>,
//    update: <document>,
//    new: <boolean>,
//    fields: <document>,
//    upsert: <boolean>
// } );
class DBmongo extends DBDriver
{
    //DB配置 key值=mongo
    private $dbckey = 'mongo';

    //模型用到的私有属性
    private $_field = array();
    private $_query;
    private $_skip;
    private $_limit;
    private $_sort;

    /**
     * MongoDB连接对象
     * _dbmd MongoDB对象
     * _dbmc MongoClient对象
     * _dbmn MongoCollection对象
     * _dbmi MongoId对象
     */
    public $_dbm = array(
        '_dbmd' => null,
        '_dbmc' => null,
        '_dbmn' => null,
        '_dbmi' => null
    );

    //command命令
    public $_command = null;

    //集合名
    static public $_collection;

    //调用父类初始化数据库连接
    public function __construct()
    {
        $this->_dbm = (object)$this->_dbm;

        parent::__construct($this->dbckey);
    }

    //连接数据库
    public function _initConnect($host,$port,$username,$password,$database,$option)
    {
        //检测MongoDB类、MongoClient类和MongoCollection类是否存在
        if (!class_exists("MongoDB") || !class_exists("MongoClient") || !class_exists("MongoCollection")) {
            echo "Mongo Driver is not exists!";
            exit;
        }

        $hosts = explode(",",$host);
        $ports = explode(",",$port);

        //构造连接字符串dsn 支持副本集模式
        $dsn = null;
        if ($option['replicaSet'] == 1) {
            foreach ($hosts as $k=>$host) {
                $dsn .= $dsn ? ",".$host.":".$ports[$k] : $host.":".$ports[$k];
            }
        } else {
            $dsn .= $hosts[0].":".$ports[0];
        }
        $dsn = "mongodb://".$dsn;

        //格式化连接选项
        $options = array(
        	'connect' => $option['connect']
        );
        //副本集模式 设置副本集名称
        ($option['replicaSet'] == 1) ? $options["replicaSet"] = $option["replicaSetFlag"] : null;
        //mongo用户密码验证
        if ($option['authentication']) {
            $options["username"] = $username;
            $options["password"] = $password;
        }

        //mongo connect
        if (!(@$this->_dbm->_dbmc = new MongoClient($dsn, $options))) {
            throw new PDOException("The connect is unvaliable", 1);
            exit;
        };

        //初始化MongoDB对象
        $this->_initMongoDB($database);

        return $this;
    }

    //MongoDB对象初始化
    private function _initMongoDB($database=null)
    {
        if (!$database) return false;
        $this->_dbm->_dbmd = $this->_dbm->_dbmc->selectDB($database);
    }

    //MongoCollection对象初始化
    private function _initMongoCollection($collection=null)
    {
        if (!$collection) return false;

        $this->_dbm->_dbmn = $this->_dbm->_dbmd->selectCollection($collection);
    }

    //MongoCode对象初始化 文档_command
    private function _initMongoCode($command=null,$args=array())
    {
        if (!$command || !is_array($args)) return null;

        $this->_command = is_string($command) ? new MongoCode($command,$args) : $command;
    }

    //MongoId对象初始化 返回_id
    public function initMongoId($id=null)
    {
        $this->_dbm->_dbmi = new MongoId($id);

        return $this->_dbm->_dbmi->__toString();
    }

    /**
     * 执行一条command命令 insert/update/remove/findOne/AddUser、removeUser、version、shutdownServer等其他命令
     * @param $command 命令数组或js-code 
     * function() { return 'Hello, world!'; }
     * return db.collection.find({'name':'Joe'}).sort({'age':1}).skip(1).limit(3)
     * @param $args js-code命令的参数数组
     * @return 成功返回true 失败返回false
     */
    public function command($command=null,$args=array())
    {
        if (!$command || empty($command) || !is_array($args)) return false;

        is_string($command) ? $commandObj = array('$eval'=>$command,'args'=>$args) : $commandObj = $command;
        $result = $this->_dbm->_dbmd->command($commandObj);

        //文档command
        $this->_initMongoCode($command,$args);

        if ($result['ok']) {
            if (isset($result['retval']) && $result['retval']) {
                return $result['retval'];
            } else if (isset($result['values']) && $result['values']) {
                return $result['values'];
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * 向集合中插入文档
     * @param $data 数据内容 array("name"=>"admin","age"=>10)
     * @param $flag 是否是批量插入 true批量插入 false单条插入 默认false
     */
    public function insert($data=array(),$flag=false)
    {
        $this->_initMongoCollection(self::$_collection);

        //单条文档和多条文档
        $return = array();
        if ($flag) {
            $result = $this->_dbm->_dbmn->batchInsert($data);
            foreach ($data as $d) {
                //返回每条文档的_id
                $return[] = $d['_id']->{'$id'};
            }
        } else {
            $result = $this->_dbm->_dbmn->insert($data);
            //返回文档的_id
            $return = $data['_id']->{'$id'};
        }
        return $result['ok'] ? $return : false;
    }

    /**
     * 更新集合中的文档内容
     * @param $data array 要更新的数据 内容数组
     * @param $options array 参数数组
     * upsert 如果设置为true query查询的文档不存在则将data文档插入集合
     * multiple 如果设置为true 删除所有匹配的文档
     */
    public function update($data=array(),$options=array())
    {
        if (!is_array($data) || empty($data)) return false;
        $this->_initMongoCollection(self::$_collection);

        //如果没有匹配到文档 data禁止插入集合
        !isset($options['upsert']) ? $options['upsert'] = false : null;
        //默认删除所有匹配的文档
        !isset($options['multiple']) ? $options['multiple'] = true : null;

        $result = $this->_dbm->_dbmn->update($this->_query,$data,$options);

        return isset($result['ok'])&&$result['ok'] ? true : false;
    }

    /**
     * 查询集合
     * @param $query 查询条件[数组] array("name"=>"admin")
     * @param $flag 是否返回单条文档 true返回全部 1返回单条文档 默认true
     */
    public function find($flag=true,$options=array())
    {
        if (!is_array($options)) return false;
        $this->_initMongoCollection(self::$_collection);

        //查询集合 返回MongoCursor
        $this->_dbmCursor = $flag===1 ? $this->_dbm->_dbmn->findOne($this->_query,$this->_field) : $this->_dbm->_dbmn->find($this->_query,$this->_field);

        //MongoCurosr对象执行sort
        $this->_sort ? $this->_dbmCursor->sort($this->_sort) : null;

        //MongoCursor对象执行skip+limit
        $this->_skip ? $this->_dbmCursor->skip($this->_skip) : null;
        $this->_limit ? $this->_dbmCursor->limit($this->_limit) : null;

        //遍历结果集对象并将每条文档push入返回数组
        $return = array();
        if (is_object($this->_dbmCursor) || is_array($this->_dbmCursor)) {
            foreach ($this->_dbmCursor as $res) {
                $return[] = $res;
            }
        }
        return $return;
    }

    /**
     * 删除集合文档
     * @param $options 参数数组
     * $options选项
     * justOne 删除匹配的文档标记 如果=true 只删除一条文档 array('justOne'=>true)
     */
    public function remove($options=array())
    {
        if (!is_array($options)) return false;
        $this->_initMongoCollection(self::$_collection);

        //删除文档
        $result = $this->_dbm->_dbmn->remove($this->_query,$options);

        return $result;
    }

    /**
     * 统计文档数量
     * @param $options 参数数组
     */
    public function count($options=array())
    {
        if (!is_array($options)) return false;
        $this->_initMongoCollection(self::$_collection);

        //统计文档数
        $result = $this->_dbm->_dbmn->remove($this->_query,$this->_limit,$this->_skip);

        return $result;
    }

    /**
     * 获取集合里指定键的不同值的列表
     * @param $key 要使用的键
     */
    public function distinct($key=null)
    {
        if (!$key || !is_string($key)) return false;
        $this->_initMongoCollection(self::$_collection);

        $result = $this->_dbm->_dbmn->distinct($key,$this->_query);

        return is_array($result)&&!empty($result) ? $result : false;
    }

    /**
     * 更新并返回集合中的某一条文档
     * @param $data array 要更新的数据
     * $options 参数
     * sort 同sort方法参数 如果设置了该参数array('age'=>1) 则修改文档列表排序之后的第一条文档
     * new 如果设置为true 则返回更新之后的文档内容
     * upsert 如果设置为true query查询的文档不存在则将data文档插入集合
     * @return 文档内容 默认返回更新之后的文档内容
     */
    public function findAndModify($data=array(),$options=array())
    {
        if (!is_array($data) || empty($data)) return false;
        $this->_initMongoCollection(self::$_collection);

        //返回更新之后的文档内容
        !isset($options['new']) ? $options['new'] = true : null;
        //如果没有匹配到文档 data禁止插入集合
        !isset($options['upsert']) ? $options['upsert'] = false : null;

        $result = $this->_dbm->_dbmn->findAndModify($this->_query,$data,$this->_field,$options);

        return $result;
    }

    /**
     * 获取的集合字段
     * 例array('field1'=>true,'field2'=>true,'field3'=>true...)
     */
    public function field($field='*')
    {
        if ($field == "*") return $this;

        is_array($field) ? $this->_field = $field : null;

        return $this;
    }

    /**
     * 构造条件 query
     */
    public function query($query=array())
    {
        if (!is_array($query)) return false;

        $this->_query = $query;

        return $this;
    }

    /**
     * 跳过多少条文档
     * @param $skip int 文档数 默认0
     */
    public function skip($skip=0)
    {
        if (!is_numeric($skip)) return false;

        $this->_skip = $skip;

        return $this;
    }

    /**
     * 获取多少文档 数量
     * @param $limit int 文档数 默认0
     * @param $param1 无实际意义 兼容父类方法参数
     * @param $param2 无实际意义 兼容父类方法参数
     */
    public function limit($limit=0,$param1=null,$param2=null)
    {
        if (!is_numeric($limit)) return false;

        $this->_limit = $limit;

        return $this;
    }

    /**
     * 设置文档集的排序方式
     * @param array 排序数组 array('field'=>orderway)
     * orderway 1升序 -1降序 例array('age'=>1)
     */
    public function sort($sort=array())
    {
        if (!is_array($sort)) return false;

        $this->_sort = $sort;

        return $this;
    }

    /**
     * 获取查询语句
     */
    public function _command()
    {
        return $this->_command;
    }

    /**
     * 获取最近语句执行错误
     */
    public function _error()
    {
        return $this->_dbm->_dbmd->lastError();
    }

    /**
     * 关闭连接 强制关闭连接 正常情况下 你绝不需要这么做
     * @param $connection 标示符 默认true
     * 如果没有指定connection或者是FALSE 将会选择关闭写作操作的连接
     * 如果 connection 是 TRUE，连接管理器将会关闭所有由它管理的连接
     * 如果 connection 是一个字符串参数，它将仅仅关闭由该 hash 标识的连接
     * hash 是调用 MongoClient::getConnections() 所返回，能够表示一个连接
     */
    public function close($connection=null)
    {
        if (!$connection) return false;

        $this->_dbm->_dbmc->close($connection);
    }
}