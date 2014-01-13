<?php
/**
 * 主控制类
 * by wbq 2011-12-01
 * 处理逻辑数据 执行具体的功能操作
 */
class IndexControl extends CommonControl
{
    //控制器名
    protected $_control = 'Index';
    
    //定义缓存有效时间(秒)
    static public $_life_time = 10;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    //主页
    public function index()
    {
        $this->display('index.html');
    }
}