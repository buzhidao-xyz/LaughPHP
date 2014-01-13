<?php
/**
 * 标签控制器
 * baoqing wang
 * 2013-12-08 
 */
class TagControl extends CommonControl
{
    //标签
    protected $_tag = null;

	public function __construct($query=null)
	{
        parent::__construct();
		$this->_query = $query;

        $this->_getTag();
    }

    public function index(){}
    public function i(){}

    //获取搜索标签
    private function _getTag()
    {
        $tag = q("tag");
        $tag = $tag ? $tag : $this->_query["params"][0];
        $tag ? $this->_tag = $tag : null;

        $this->assign("tag", $this->_tag);
        return $this->_tag;
    }

    //标签搜索
    public function search()
    {
        $this->display("Tag/index.html");
    }
    //短名称
    public function s()
    {
        $this->search();
    }
}