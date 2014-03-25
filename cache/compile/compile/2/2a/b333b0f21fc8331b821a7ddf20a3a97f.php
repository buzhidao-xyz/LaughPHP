<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="LaughPHP">
<meta name="description" content="LaughPHP">
<link type="image/ico" rel="shortcut icon" href="favicon.ico">
<link type="text/css" rel="stylesheet" href="/themes/default/style/common.css" media="screen">
<link type="text/css" rel="stylesheet" href="/themes/default/style/frame.css" media="screen">
<link type="text/css" rel="stylesheet" href="/themes/default/style/global.css" media="screen">
<link type="text/css" rel="stylesheet" href="/themes/default/style/style.css" media="screen">
<link type="text/css" rel="stylesheet" href="themes/default/style/font.css" media="screen">
<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript" src="/public/js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="/public/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/themes/default/js/common.js"></script>
<script type="text/javascript" src="/themes/default/js/frame.js"></script>
<title>
		LaughPHP
	</title>
<script type="text/javascript">
var JS_APP = '';
var JS_STATIC_FILE_HOST = '/';

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

<body>
<div id="Header">
	
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
</script>
<div id="WrapContainer" class="wrap">
	This is Index Page!
</div>
<div id="Footer">
	<div class="whiteline"></div>
	<div id="copyright">
	</div>
</div>
<script type="text/javascript" src="/public/js/scrollToTop.js"></script>
</body>
</html>