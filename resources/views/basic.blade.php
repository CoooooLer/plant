<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>@yield('title')</title>
</head>
<body>
    @section('header')
        <div class="header">
            <div class="header-content">
                <div class="logo"><img src="img/logo.png"></div>
                <div class="header-nav">
                    <a class="nav-unit header-nav-active primary">首页</a>
                    <a class="nav-unit">电影</a>
                    <a class="nav-unit">影院</a>
                    <a class="nav-unit">榜单</a>
                    <a class="nav-unit">热点</a>
                    <div class="nav-slider"></div>
                </div>
                <div class="search has-error">
                    <input class="form-control keyword " id="sea-keyword" placeholder="找电影...按Enter搜索" style="height: 40px">
                </div>
                <a class="login">登录</a>
            </div>
        </div>
    @show
<div class="content">
    @section('content')
        @show
</div>
    @section('footer')

        <div class="footer">
            <p>友情链接：<a href="javascript:void(0)">猫眼电影</a>|<a href="">百度糯米</a></p>
            <p>@2018 时光电影 </p>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $.each($('.nav-unit') , function (k,v) {
                    $(v).on('mouseover',function () {
                        $('.nav-slider').css({'transition':'all ease 0.5s','left':v.offsetLeft + 'px'});
                    });
                    $(v).on('mouseleave',function () {
                        $('.nav-slider').css({'transition':'all ease 0.5s','left': 0 + 'px'});
                    });
                    $(v).on('click',function () {
                        $(this).css({'color':'red'}).siblings().css({'color':'#000'});
                    })
                })
            })

        </script>
        @show
</body>
</html>
