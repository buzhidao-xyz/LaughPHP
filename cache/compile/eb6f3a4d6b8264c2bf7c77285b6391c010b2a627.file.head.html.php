<?php /* Smarty version Smarty-3.1.12, created on 2014-03-07 15:36:12
         compiled from "G:\soehi\LaughPHP\themes\default\include\head.html" */ ?>
<?php /*%%SmartyHeaderCode:31912531976ec2bdae1-43567845%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb6f3a4d6b8264c2bf7c77285b6391c010b2a627' => 
    array (
      0 => 'G:\\soehi\\LaughPHP\\themes\\default\\include\\head.html',
      1 => 1389870686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31912531976ec2bdae1-43567845',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Config' => 0,
    'SEOInfo' => 0,
    'STATIC_FILE_HOST' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_531976ec328b55_36255521',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_531976ec328b55_36255521')) {function content_531976ec328b55_36255521($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['Config']->value['keywords'];?>
<?php if (isset($_smarty_tpl->tpl_vars['SEOInfo']->value)&&is_array($_smarty_tpl->tpl_vars['SEOInfo']->value)&&isset($_smarty_tpl->tpl_vars['SEOInfo']->value['keywords'])){?><?php echo $_smarty_tpl->tpl_vars['SEOInfo']->value['keywords'];?>
<?php }?>">
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['Config']->value['description'];?>
<?php if (isset($_smarty_tpl->tpl_vars['SEOInfo']->value)&&is_array($_smarty_tpl->tpl_vars['SEOInfo']->value)&&isset($_smarty_tpl->tpl_vars['SEOInfo']->value['description'])){?><?php echo $_smarty_tpl->tpl_vars['SEOInfo']->value['description'];?>
<?php }?>">
<link type="image/ico" rel="shortcut icon" href="favicon.ico">
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
themes/default/style/common.css" media="screen">
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
themes/default/style/frame.css" media="screen">
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
themes/default/style/global.css" media="screen">
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
themes/default/style/style.css" media="screen">
<link type="text/css" rel="stylesheet" href="themes/default/style/font.css" media="screen">
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
public/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
public/js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
public/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
themes/default/js/common.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
themes/default/js/frame.js"></script>
<title>
	<?php if (isset($_smarty_tpl->tpl_vars['SEOInfo']->value)&&is_array($_smarty_tpl->tpl_vars['SEOInfo']->value)&&isset($_smarty_tpl->tpl_vars['SEOInfo']->value['title'])){?>
	<?php echo $_smarty_tpl->tpl_vars['SEOInfo']->value['title'];?>
 --- <?php echo $_smarty_tpl->tpl_vars['Config']->value['sitename'];?>

	<?php }else{ ?>
	<?php echo $_smarty_tpl->tpl_vars['Config']->value['sitename'];?>

	<?php }?>
</title>
<script type="text/javascript">
var JS_APP = '__APP__';
var JS_STATIC_FILE_HOST = '<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
';

//百度统计异步代码
// var _hmt = _hmt || [];
// (function() {
//   var hm = document.createElement("script");
//   hm.src = "//hm.baidu.com/hm.js?a2d471a2a983dd6c883aa9cf6ca1d8af";
//   var s = document.getElementsByTagName("script")[0]; 
//   s.parentNode.insertBefore(hm, s);
// })();
</script>
</head>

<body><?php }} ?>