<?php
/**
 * 后台配置文件
 */

//定义子项目目录名
define('PROJECT_PATH', 'mobile');

//定义子项目配置文件目录
define('PROJECT_CONFIG_DIR',str_replace('\\', '/', dirname(__FILE__)));

//加载前台配置文件
$config_dir = str_replace('/'.PROJECT_PATH.'/include/Config', '', PROJECT_CONFIG_DIR).'/include/Config';
require_once($config_dir.'/config.php');

$project_config = array(
    'STYLE_DEFAULT'        => PROJECT_DIR.'/themes/default', //模板样式路径

    'INCLUDE_DIR'          => PROJECT_DIR.'/include',
    'CACHE_DIR'            => PROJECT_CACHE_DIR.'cache',
    'LOG_DIR'              => ROOT_DIR.'/data/log',
    'VENDOR'               => ROOT_DIR.'/include/Vendor',

    'COMPILE_LIFE_TIME'    => 10,

    'TEMPLATE_TYPE'    => 'Smarty',   //模版引擎类型 Laugh/Smarty
    //模版选项 Smarty模版起作用
    'TEMPLATE_OPTIONS' => array(
        'debug'            => false,
        'caching'          => false,
        'cache_lifetime'   => 120,
        'template'         => PROJECT_DIR.'/themes/default', //模板样式路径
        'template_compile' => PROJECT_CACHE_DIR.'cache/compile',
        'template_cache'   => PROJECT_CACHE_DIR.'cache/cache',
        'plugin_dir'       => ROOT_DIR.'/include/Vendor/Smarty/plugins',
    ),

    //SAE静态JS/CSS/IMAGE文件服务器HOST地址
    'STATIC_FILE_HOST' => __APP__."/",
);

$config = array_merge($config,$project_config);
