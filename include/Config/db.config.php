<?php
/**
 * 数据库配置文件
 * 框架暂不支持读写分离
 * 如果做读写分离 建议分开为两个配置
 * 同时在Mysql数据库服务器上做读写分离设置
 * 写操作请用TW()方法
 * 读操作请用TR()方法
 */
// $db_config = array(
// 	//MySQL写
// 	'mysqlw' => array(
// 		'dbtype'   => 'pdomysql',
// 		'host'     => '127.0.0.1',
// 		'port'     => 3306,
// 		'username' => 'root',
// 		'password' => 123456,
// 		'database' => 'laughphp',
// 		'prefix'   => 'la_',
// 		'option'   => array()
// 	),
// 	//MySQL读
// 	'mysqlr' => array(
// 		'dbtype'   => 'pdomysql',
// 		'host'     => '127.0.0.1',
// 		'port'     => 3306,
// 		'username' => 'root',
// 		'password' => 123456,
// 		'database' => 'laughphp',
// 		'prefix'   => 'la_',
// 		'option'   => array()
// 	),
// )
$db_config = array(
	//MySQL
	'mysql' => array(
		'dbtype'   => 'pdomysql',
		'host'     => '127.0.0.1',
		'port'     => 3306,
		'username' => 'root',
		'password' => 123456,
		'database' => 'laughphp',
		'prefix'   => 'la_',
		'option'   => array()
	),
	// //SQLServer
	// 'sqlserver' => array(
	// 	'dbtype'   => 'pdosqlserver',
	// 	'host'     => '127.0.0.1',
	// 	'port'     => 1433,
	// 	'username' => 'sa',
	// 	'password' => 123,
	// 	'database' => 'laughphp',
	// 	'prefix'   => 'la_',
	// 	'option'   => array()
	// ),
	/**
	 * mongo 支持副本集模式
	 * 如果采用副本集模式 副本集模式的所有服务器的IP和Port都要写入配置
	 * 不同服务器的host(IP)和端口请分别用逗号,隔开
	 * 同时option里的replicaSet值要设置为1
	 * 关于mongo验证 如果启用账户密码验证 需要为laughphp数据库添加新的系统用户 system.users集合
	 */
	'mongo' => array(
		'dbtype'   => "mongo",
		'host'     => '127.0.0.1',
		'port'     => '27017',
		'username' => 'root',
		'password' => '123456',
		'database' => 'laughphp',
		'option'   => array(
			'authentication' => false, //是否启用mongo验证 默认不启用
			'connect' => true,
			'replicaSet' => 0, //是否副本集模式 0否 1是
			'replicaSetFlag' => 'PowerHouseReplica' //如果是副本集模式 此处填写副本集名称
		)
	)
);