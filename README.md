LaughPHP
========
一个PHP框架

<br />
本框架采用单入口模式，主入口文件index.php，index.php只执行两个逻辑，加载config文件，加载route文件
<pre><code>
//引入配置文件
require("include/Config/config.php");

//引入路由器
require("route.php");
new Route();
</code></pre>
<br />
<br />


数据库IO驱动类
-------------
数据库驱动类
基类：include/Model/DBDriver.model.php

Mysql数据库驱动子类，PDO驱动
include/Lib/Driver/DB/DBpdomysql.model.php

###驱动类使用方法：
	用T("table")->function方式来调用
	方法T：表示类对象加载哪张表
	table：加载的表名

###类方法：<br />
####基本增删改查操作方法：
<pre>
function add($data,$m=false)
说明：向数据库添加数据
$data为数组,$m默认为false，单条数据插入，如果同时插入多条数据，$data参数值为二维数组，$m参数值设为true
用例：向user表插入数据,account为user表的一个字段
单条数据插入
$data = array('account'=>'testuser');
T("user")->add($data);
多条数据插入
$data = array(
	array('account'=>'testuser1'),
	array('account'=>'testuser2'),
	array('account'=>'testuser3'),
);
T("user")->add($data,true);

function find()
说明：查询单条数据，确定查询的返回结果集只有一条数据
使用：T("user")->where(array("id"=>1))->find();
返回数据格式：
array(
	'id'=>1,
	'account'=>'testuser1'
);

function select()
说明：查询多条数据，返回一个数据结果集的二维数组
使用：T("user")->select();
返回数据格式：
array(
	array('id'=>1,'account'=>'testuser1'), 
	array('id'=>2,'account'=>'testuser2'),
	array('id'=>3,'account'=>'testuser3')
);

function update()
说明：更新数据库的数据
使用：例如将user表里的id=1的记录的account字段值改为testusername1
$data = array("account"=>"testusername1")
T("user")->where(array("id"=>1))->update($data);
支持更新快捷操作：
$data = array(
	"age"=>array("aeq",1), //年龄加1
	"score"=>array("req",1), //分数减1
);

function delete()
说明：删除某条记录
使用：删除user表里id=1的记录
T("user")->where(array("id"=>1))->delete();

function count()
说明：返回结果集数据条数 整形数值
使用：T("user")->count();
</pre>

####条件方法：
<pre>
function where($where=array())
说明：where条件方法，$where参数为数组，数组key为表字段，value为查询条件值
	$where= array(
		"account"=>"testuser" //表示查询account等于testuser的记录
	);
	可支持where条件(neq等)
	neq: 不等于 "account"=>array("neq","testuser")
	lt: 小于 "account"=>array("lt","testuser")
	gt: 大于 "account"=>array("gt","testuser")
	elt: 小于等于 "account"=>array("elt","testuser")
	egt: 大于等于 "account"=>array("egt","testuser")
	in: 在哪些值中 "account"=>array("in",array("testuser1","testuser2"…))
	like: 模糊查询 "account"=>array("like","%testuser%")
	between: 区间 "account"=>array("between",1,10)
	用例：
	查询用户表(user)中account有test的用户
	T("user")->where(array("account"=>array("like","%test%")))->select();

	function order($order=null)
	说明：数据排序，order参数为数组，array("id"=>"desc")，id为字段名，desc排序方式
	使用：T("user")->order(array("id"=>"desc"))->select();

	function limit($start,$length)
	说明：取限定的数据条数 开始行数，数据偏移量
	使用：T("user")->limit(1,10)->select();

	function join($join=null)
	说明：两个表联合查询，user表为a，user1表为b
	使用：T("user")->join(" ".TBF."user1 on b.sid=a.id ")->select();

	function union($table=null)
	说明：多个表联合
	使用：T("user")->union("user1")->select();

	function group($field=null)
	说明：数据分组
	使用：T("user")->group("class")->select();
</pre>

####可直接执行SQL语句的方法：
<pre>
function exec($sql)
说明：直接执行一条sql语句，可执行的sql语句类型为insert/delete/update
使用：T("user")->exec("insert into user(account) values('testuser')");

function GetOne($sql)
说明：获取某条数据记录 $sql即为要执行的sql语句
使用：获取id=1的用户
T("user")->GetOne("select * from user where id=1");

function GetAll($sql)
说明：获取多条数据记录
使用：获取全部用户
T("user")->GetAll("select * from user");
</pre>

####使用说明：
######系统框架初始化时已将启用的数据库驱动初始化，所以数据库驱动无需再进行实例化，可直接用T("table")调用数据库驱动类库的方法

####用例说明：
<pre>
1、查询用户表(user)里所有的用户信息
$data = T("user")->select();
2、查询user表id=1的用户信息
$data = T("user")->where(array("id"=>1))->find();
3、查询年龄10-20岁的用户数量
$data = T("user")->where(array("age"=>array("between",10,20)))->count();
4、查询年龄10-20岁的用户，按年龄降序排列，取前10条记录
T("user")->where(array("age"=>array("between",10,20)))
->order(array("age"=>"desc"))->limit(0,10)->select();
5、两个表联合查询，left join
T("user")->join(" ".TBF."userinfo on b.userid=a.id ")
		 ->field("a.account,a.age,b.birthday,b.score")
		 ->where(array("a.account"=>array("like","%test%")))
		 ->order(array("age"=>"desc"))->limit(5,10)->select();
</pre>


