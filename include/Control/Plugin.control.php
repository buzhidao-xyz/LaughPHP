<?php
/**
 * 插件控制器
 * by buzhidao 2013-02-04
 * 处理逻辑数据 执行具体的功能操作
 */
class PluginControl extends CommonControl
{
	//控制器名
    protected $_control = 'Plugin';

    //分页每页记录数
    protected $_pagesize = 10;

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){}
}