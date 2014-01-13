<?php
/**
 * 公共模块控制器 关于我们 联系我们等
 * by wbq 2011-12-01
 * 处理逻辑数据 执行具体的功能操作
 */
class PublicControl extends CommonControl
{
	//控制器名
    protected $_control = 'Public';

	public function __construct($query=null)
	{
		parent::__construct();
		$this->_query = $query;
	}

	public function index(){}
}