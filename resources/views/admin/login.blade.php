<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta name="description" content="">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="/assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="/assets/css/amazeui.min.css" />
  <link rel="stylesheet" href="/assets/css/admin.css">
  <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body data-type="login">

  <div class="am-g myapp-login">
	<div class="myapp-login-logo-block  tpl-login-max">
		<div class="myapp-login-logo-text">
			<div class="myapp-login-logo-text">
				Admin <span> Login</span> <i class="am-icon-skyatlas"></i>
				
			</div>
		</div>
		<div class="am-u-sm-10 login-am-center">
			@include('layouts.errors')
			<form class="am-form" method="POST" action="{{ route('checklogin') }}">
				{{ csrf_field() }}
				<fieldset>
					<div class="am-form-group">
						<input type="text" class="" id="doc-ipt-email-1" name="name" value="{{ old('name') }}"  autofocus required>
					</div>
					<div class="am-form-group">
						<input id="password" type="password"  name="password" required>
					</div>
					<br>
					<div class="am-form-group">
      				{!! Geetest::render() !!}
      				</div>
					<p><button type="submit" class="am-btn am-btn-default">登录</button></p>
				</fieldset>
			</form>
		</div>
	</div>
</div>

  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/amazeui.min.js"></script>
  <script src="/assets/js/app.js"></script>
</body>

</html>