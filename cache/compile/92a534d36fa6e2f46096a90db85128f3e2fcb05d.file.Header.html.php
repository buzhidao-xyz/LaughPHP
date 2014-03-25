<?php /* Smarty version Smarty-3.1.12, created on 2014-03-07 15:36:12
         compiled from "G:\soehi\LaughPHP\themes\default\Common\Header.html" */ ?>
<?php /*%%SmartyHeaderCode:14288531976ec32db54-14623417%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92a534d36fa6e2f46096a90db85128f3e2fcb05d' => 
    array (
      0 => 'G:\\soehi\\LaughPHP\\themes\\default\\Common\\Header.html',
      1 => 1389870686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14288531976ec32db54-14623417',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_531976ec340d05_95035417',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_531976ec340d05_95035417')) {function content_531976ec340d05_95035417($_smarty_tpl) {?><div id="Header">
	
</div>
<script type="text/javascript">
$(document).ready(function() {
var searchForm = function() {
	$("input[name=keyword]").focus(function() {
		if ($(this).val() == "搜索...") {
			$(this).val("").css("color","#666");
		}
	}).blur(function() {
		if (!$(this).val()) {
			$(this).val("搜索...").css("color","#CCCCCC");
		}
	});

	$("form[name=searchform]").submit(function() {
		var keyword = $(this).find("input[name=keyword]").val();
		if (!keyword || keyword=="搜索...") return false;

		location.href = $(this).attr("action")+keyword;

		return false;
	});
}();
});
</script><?php }} ?>