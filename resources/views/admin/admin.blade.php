<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
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
    <script src="/assets/js/echarts.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
</head>

<body data-type="@yield('dataType')">
    @include('admin.head')
    <div class="tpl-page-container tpl-page-header-fixed">
        @include('admin.leftbar')
        <div class="tpl-content-wrapper">
           @yield('content')
        </div>

    </div>

    <script src="/assets/js/amazeui.min.js"></script>
    <script src="/assets/js/iscroll.js"></script>
    <script src="/assets/js/app.js"></script>
</body>

</html>