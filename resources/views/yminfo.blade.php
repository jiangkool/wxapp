<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>听，妈妈的话 朗读胎教音乐会</title>
<script src="https://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
</head>
<style>
*{ margin:0; padding:0;}
body{min-width:320px; max-width:640px; margin:0 auto; background:#ffffff;font:24px Microsoft Yahei;color:#464646;}
.fm1{ position:relative; width:100%; float:left;}
.fm1 input{ border:0; background:none; width:79%; top:16%; left:10%; position:absolute; text-indent:20%; padding:2.8% 0;font-size: 14px;font-weight: 700}
.fm1 button{ border:0; background:none; width:79%; top:76%; left:10%; position:absolute; color:#FFF; font-size:16px;}
</style>
<body>
<img src="/assets/images/bbd_01.jpg" style="width:100%; float:left;" />
<div class="fm1">
<img src="/assets/images/bbd_02.jpg" style="width:100%; float:left;" />
<form  action="{{ route('storeYm') }}" method="POST" data-am-validator>
	{{csrf_field()}}
	<input type="text" class="am-form-field" name="name" placeholder="姓名" minlength="2" required>
	<input type="text" class="am-form-field js-pattern-mobile" style="top:33%;" name="phone" placeholder="手机号" minlength="11" maxlength="11" required  >
	<input type="number" class="am-form-field" placeholder="孕周" style="top:51%;" name="yz" min="1" max="40">
	<button type="submit" class="am-btn am-btn-default">提交</button>
</form>

</div>
<img src="/assets/images/bbd_03.jpg" style="width:100%; float:left;" />

<script src="/assets/js/amazeui.min.js"></script>
	<script>
		if ($.AMUI && $.AMUI.validator) {
   			 $.AMUI.validator.patterns.mobile = /^1((3|5|8){1}\d{1}|70)\d{8}$/;
 		 }
	</script>

</body>
</html>


