<?php /* Smarty version Smarty-3.1.12, created on 2014-03-07 15:36:21
         compiled from "G:\soehi\LaughPHP\admin\themes\blue\login.html" */ ?>
<?php /*%%SmartyHeaderCode:4582531976f5030187-79386270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7755d0c02e906a1be22cd16f803e9ac684deaad' => 
    array (
      0 => 'G:\\soehi\\LaughPHP\\admin\\themes\\blue\\login.html',
      1 => 1389870686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4582531976f5030187-79386270',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ecode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_531976f516d2f4_26247831',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_531976f516d2f4_26247831')) {function content_531976f516d2f4_26247831($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("include/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<link type="text/css" rel="stylesheet" href="themes/blue/style/login.css" media="screen">
<div id="loginPanel">
    <div class="logTop">LaughPHP管理系统</div>
    <div id="logError"><?php echo $_smarty_tpl->tpl_vars['ecode']->value;?>
</div>
    <div class="logForm">
        <div class="Loglogo"><a href="__APPM__" target="_blank"><img src="themes/blue/images/logo_white.png" width="180" height="60" /></a></div>
        <form name="loginform" method="post" action="__APP__/index.php?s=Login/loginCheck">
            <ul>
                <li><span>用户名:</span><input type="text" name="adminname" value="" class="input" /></li>
                <li><span>密&nbsp;&nbsp;&nbsp;码:</span><input type="password" name="password" value="" class="input" /></li>
                <li><span>验证码:</span><input type="text" name="vcode" value="" class="input" style="width:80px;" />&nbsp;<img src="__APP__/index.php?s=Org/Vcode" class="vcode" /></li>
                <li><input type="submit" name="subut" class="button btngreen2" value="登录" /></li>
            </ul>
        </form>
    </div>
</div>
<script language="javascript">
$(document).ready(function(){
    $("form[name=loginform]").submit(function() {
        var adminname = $(this).find("input[name=adminname]").val();
        var password = $(this).find("input[name=password]").val();
        var vcode = $(this).find("input[name=vcode]").val();
        
        if (!adminname || !password || !vcode) {
            alert('请填写完整登录信息!');
            return false;
        }

        var d = {
            adminname: adminname,
            password: password,
            vcode: vcode
        }
        $.post($(this).attr("action"), d, function(data){
            if (!data.status) {
                location.href = JS_APP+"/index.php?s=index";
                return true;
            } else {
                $("#logError").html(data.info);
                location.href = location.href;
                return false;
            }
        },'json')
        return false;
    });

    //点击刷新验证码
    $("img.vcode").click(function (){
        $(this).attr("src", "__APP__/index.php?s=Org/Vcode&"+Math.random()*100);
    });
});
</script>
<?php echo $_smarty_tpl->getSubTemplate ("include/foot.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>