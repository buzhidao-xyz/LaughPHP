<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="">
<link type="image/ico" rel="shortcut icon" href="favicon.ico">
<link type="text/css" rel="stylesheet" href="/admin/themes/blue/style/common.css" media="screen">
<link type="text/css" rel="stylesheet" href="/admin/themes/blue/style/global.css" media="screen">
<script type="text/javascript" src="/admin/public/js/jquery.js"></script>
<link type="text/css" rel="stylesheet" href="/admin/public/plugin/colorbox/colorbox.css" media="screen">
<script type="text/javascript" src="/admin/public/plugin/colorbox/jquery.colorbox.js"></script>
<title>LaughPHP</title>
<script type="text/javascript">
var JS_APP = '/admin';
var JS_APPM = 'http://localhost:85';
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

<body>
<link type="text/css" rel="stylesheet" href="themes/blue/style/login.css" media="screen">
<div id="loginPanel">
    <div class="logTop">LaughPHP管理系统</div>
    <div id="logError"></div>
    <div class="logForm">
        <div class="Loglogo"><a href="http://localhost:85" target="_blank"><img src="themes/blue/images/logo_white.png" width="180" height="60" /></a></div>
        <form name="loginform" method="post" action="/admin/index.php?s=Login/loginCheck">
            <ul>
                <li><span>用户名:</span><input type="text" name="adminname" value="" class="input" /></li>
                <li><span>密&nbsp;&nbsp;&nbsp;码:</span><input type="password" name="password" value="" class="input" /></li>
                <li><span>验证码:</span><input type="text" name="vcode" value="" class="input" style="width:80px;" />&nbsp;<img src="/admin/index.php?s=Org/Vcode" class="vcode" /></li>
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
        $(this).attr("src", "/admin/index.php?s=Org/Vcode&"+Math.random()*100);
    });
});
</script>
</body>
<script type="text/javascript" src="/admin/themes/blue/js/jquery.corner.js"></script>
<script type="text/javascript" src="/admin/themes/blue/js/public.js"></script>
<script type="text/javascript" src="/admin/themes/blue/js/common.js"></script>
<script type="text/javascript" src="/admin/themes/blue/js/ajax.js"></script>
<script type="text/javascript" src="/admin/public/js/jquery.idTabs.min.js"></script>
</html>