<?php /* Smarty version Smarty-3.1.12, created on 2014-03-07 15:36:21
         compiled from "G:\soehi\LaughPHP\admin\themes\blue\include\head.html" */ ?>
<?php /*%%SmartyHeaderCode:16105531976f517a2c3-34875915%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '240344c9d2ba154aff640c2b2c26a5fe8c330443' => 
    array (
      0 => 'G:\\soehi\\LaughPHP\\admin\\themes\\blue\\include\\head.html',
      1 => 1389870686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16105531976f517a2c3-34875915',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'STATIC_FILE_HOST' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_531976f51ab155_41841315',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_531976f51ab155_41841315')) {function content_531976f51ab155_41841315($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="">
<link type="image/ico" rel="shortcut icon" href="favicon.ico">
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
themes/blue/style/common.css" media="screen">
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
themes/blue/style/global.css" media="screen">
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
public/js/jquery.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
public/plugin/colorbox/colorbox.css" media="screen">
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['STATIC_FILE_HOST']->value;?>
public/plugin/colorbox/jquery.colorbox.js"></script>
<title>LaughPHP</title>
<script type="text/javascript">
var JS_APP = '__APP__';
var JS_APPM = '__APPM__';
function colorboxAjaxHtml(url) {
	$.post(url,{},function (data){
		$.colorbox({ html: data });
	});
}
function colorboxHtml(url) {
	$.colorbox({ href: url });
}
function colorboxImage(url) {
	$.colorbox({ href: url });
}
</script>
</head>

<body><?php }} ?>