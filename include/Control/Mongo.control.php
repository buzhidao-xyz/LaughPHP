<?php
/**
 * Mongo控制器 测试用
 * baoqing wang
 * 2014-1-7
 */
class MongoControl extends CommonControl
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index(){}

	//MongoDB Test
	public function MongoTest()
	{
		// $this->MongoFind();
		$this->MongoJSCode();
		// $this->MongoInsert();
		// $this->MongoRemove();
		// $this->MongoDistinct();
		// $this->MongoDistinct1();
		// $this->MongoUpdate();
		// $this->MongoFindAndModify();
		// $this->MongoId();
	}

	//Mongo Insert
	public function MongoInsert()
	{
		$data = array(
			array(
	        	"name" => "Joe",
	        	"age"  => 4
        	),
        	array(
	        	"name" => "Joe",
	        	"age"  => 4
        	),
        	array(
	        	"name" => "Joe",
	        	"age"  => 4
        	)
		);
        $_id = Mongo("people")->insert($data,true);
        dump($_id);
	}

	//Mongo Update
	public function MongoUpdate()
	{
		$query = array(
			'name' => 'Joe',
			'age'  => 7
		);
		$data = array(
			'$set' => array('age'=>8)
		);
		$result = Mongo('people')->query($query)->update($data);
		dump($result);
	}

	//Mongo JS-Code
	public function MongoJSCode()
	{
		//方法执行
		// $command = "
		// 	function() {
		// 		return {'Hello World!'};
		// 	}
		// ";

		//集合记录数
		// $command = 'db.people.count();';

		//insert
		// $command = 'db.people.insert(
		// 	{"name":"wbq","age":10}
		// )';

		//update
		// $command = 'db.people.update(
		// 	{"name":"Joe"},
		// 	{
		// 		$inc:{
		// 			"age":3
		// 		}
		// 	}
		// )';

		//remove
		// $command = 'db.people.remove(
		// 	{"name":"wbq"}
		// )';

		//findAndModify
		// $command = 'db.people.findAndModify({
		// 	query:{
		// 		"name":"Joe"
		// 	},
		// 	update:{
		// 		$inc:{
		// 			"age":3
		// 		}
		// 	}
		// })';

		//findOne
		// $command = "return db.people.findOne(
		// 	{'name':'Joe'}
		// )";

		//find toArray
		$command = "return db.people.find(
			{'name':'Joe'}
		).sort(
			{'age':1}
		).limit(5).skip(1).toArray()";

		//runCommand
		// $command = 'return db.runCommand(
		// 	{
		// 		$eval: \'db.people.find().toArray()\',
		// 		nolock: true
		// 	}
		// )';

        $result = Mongo()->command($command);
        dump(Mongo()->_command());
        dump(Mongo()->_error());
        dump($result);
	}

	//Mongo Find
	public function MongoFind()
	{
		$query = array(
			'name' => 'Joe'
		);
        $result = Mongo("people")->field(array('age'=>true))->query($query)->skip(0)->limit(5)->sort(array('age'=>-1))->find();
        dump(Mongo()->_command());
        dump(Mongo()->_error());
        dump($result);
	}

	//Mongo Distinct
	public function MongoDistinct1()
	{
		$command = array(
	        "distinct1" => "people",
	        "key"      => "age", 
	        "query"    => array(
	        	"age" => array('$gte' => 18)
	        )
	    );
        $result = Mongo()->command($command);
        dump(Mongo()->_error());
        dump($result);
	}

	//remove
	public function MongoRemove()
	{
		$query = array(
			'name' => 'Joe'
		);
		$result = Mongo("people")->query($query)->remove(array('justOne'=>true));
		dump($result);
	}

	//distinct
	public function MongoDistinct()
	{
		$query = array(
			'name' => 'Joe'
		);
		$result = Mongo("people")->query($query)->distinct('age');
		dump($result);
	}

	//Mongo findAndModify
	public function MongoFindAndModify()
	{
		$query = array(
			'name' => 'Joe'
		);
		$data = array(
			'name' => 'Joes',
			'age'  => 19
		);
		$field = array(
			'name' => true,
			'age'  => true
		);
		$result = Mongo("people")->field($field)->query($query)->findAndModify($data);
		dump($result);


		$a = new MongoPool();
		dump($a->info());
	}

	//Mongo Id
	public function MongoId()
	{
		$dbmObj = Mongo()->initMongoId();
		dump(Mongo()->_dbm->_dbmi->__toString());
	}
}