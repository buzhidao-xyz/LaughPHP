<?php
/**
 * 通用控制器基类
 * by wbq 2012-3-27
 */
class CommonControl extends BaseControl
{
	//控制器名
    protected $_control = null;
    //方法名
    protected $_action = null;

    //分页每页记录数
    protected $_pagesize = 15;

    //query请求数据对象
    protected $_query;

    //初始化构造函数
    public function __construct()
    {
        parent::__construct();

        $this->assign("control", CONTROL);
        $this->assign("action", ACTION);

        //缓存配置信息
        $this->getConfig();
    }

    //获取分页页码
    protected function getPage()
    {
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        return $page;
    }

    /**
     * 获取分页开始和条数
     * @param int $pagesize 每页显示记录数
     */
    protected function getPages($pagesize=null)
    {
        $pagesize = $pagesize ? $pagesize : $this->_pagesize;

        $page = $this->getPage();
        $start = ($page-1)*$pagesize;

        $this->assign('start',$start);
        $this->assign('length',$pagesize);

        return array($start, $pagesize);
    }

    //跳转到主页
    protected function _host()
    {
        header("location:".__APP__."/");
        exit;
    }

    //获取配置信息并打印输出 - SEO优化
    public function getConfig()
    {
        $Config = array(
            'host' => C('CACHE.host'),
            'sitename' => C('CACHE.sitename'),
            'keywords' => C('CACHE.keywords'),
            'description' => C('CACHE.description'),
            'HomeSiteTitle' => C('CACHE.HomeSiteTitle'),
            'AboutUs' => C('CACHE.AboutUs'),
        );
        // dump($Config);exit;
        $this->assign('Config', $Config);
    }

    //生成页面SEO信息
    protected function GCSEOInfo($title=null,$keywords=null,$description=null)
    {
        $SEOInfo = array(
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description,
        );
        $this->assign("SEOInfo",$SEOInfo);
    }
}
