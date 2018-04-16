<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a href="{{ Route('home') }}" class="nav-unit header-nav-active primary">首页</a>
                    <a href="{{ Route('jianjiepage') }}" class="nav-unit">多肉简介</a>
                    <a href="{{ Route('yanghupage') }}" class="nav-unit">种植养护</a>
                    <a href="{{ Route('rizhipage') }}" class="nav-unit">种植日志</a>
                    <a href="{{ Route('mengtu') }}" class="nav-unit">萌图欣赏</a>
                    <div class="nav-slider"></div>
                </div>
                <div class="search has-error">
                    <input class="form-control keyword" id="sea-keyword" placeholder="按Enter搜索" style="height: 40px">
                </div>
                <div class="nav-login" role="navigation">
                    @if(Cookie::has('username'))
                        <ul class="nav-login-lo">
                            <li class="dropdown ">
                                <a href="#" class="" data-toggle="dropdown" role="button"  aria-expanded="true">&nbsp;&nbsp;{{ Cookie::get('username') }}&nbsp;&nbsp;<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="personal"><span class="glyphicon glyphicon-user"></span>个人中心</a></li>
                                    <li><a href="editPerson?username={{ Cookie::get('username') }}"><span class="glyphicon glyphicon-user"></span>修改资料</a></li>

                                    @if(  Cookie::get('username') === 'admin'  )
                                        <li><a href="userList"><span class="glyphicon glyphicon-user"></span>管理中心</a></li>
                                    @endif
                                    <li><a href=" {{ Route('logOut') }} "><span class="glyphicon glyphicon-user"></span>退出登录</a></li>
                                </ul>
                            </li>
                        </ul>
                    @else
                        <ul class="nav-login-lo">
                            <li><a href="{{route('log')}}">登录</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    @show
<div class="content">
    @section('content')
        @show
</div>


    @section('footer')

        <div class="footer">
            <p>友情链接：<a href="javascript:void(0)">关于我们</a>|<a href="javascript:void(0)">广告投放</a></p>
            <p>@2018 多肉联萌 </p>
        </div>
        <script src="js/jquery.min.js"></script>
        {{--<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>--}}
        <script src="js/bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                //顶部导航栏的切换
                $.each($('.nav-unit') , function (k,v) {
                    $(v).on('mouseover',function () {
                        $('.nav-slider').css({'transition':'all ease 0.5s','left':v.offsetLeft + 'px'});
                    });
                    $(v).on('mouseleave',function () {
                        $('.nav-slider').css({'transition':'all ease 0.5s','left': 0 + 'px'});
                    });
//                    $(v).on('click',function () {
//                        $(this).css({'color':'red'}).siblings().css({'color':'#000'});
//                    })
                });
                $('.header-nav a').on('click',function () {
                    $(this).css({'color':'#94b60e'}).siblings().css({'color':'#000'});
                });
                switch(window.location.href)
                {
                    case $('.header-nav a').eq(1).attr('href'):
                        $('.header-nav a').eq(1).css({'color':'#94b60e'});
//                        console.log(window.location.href);
                        break;
                    case $('.header-nav a').eq(2).attr('href'):
                        $('.header-nav a').eq(2).css({'color':'#94b60e'});
//                        console.log(window.location.href);
                        break;
                    case $('.header-nav a').eq(3).attr('href'):
                        $('.header-nav a').eq(3).css({'color':'#94b60e'});
//                        console.log(window.location.href);
                        break;
                    case $('.header-nav a').eq(4).attr('href'):
                        $('.header-nav a').eq(4).css({'color':'#94b60e'});
//                        console.log(window.location.href);
                        break;
                }

                //全局搜索
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $('.keyword').on('keypress', function (e) {
                    if (e.keyCode == 13) {
                        $keyword = $('.keyword').val();
                        $.ajax({
                            url:'homeSearch',
                            type:'post',
                            data:{'keyword':$keyword},
                            success:function (data) {
//                            console.log(data)
                                $html = '';
                                if(data !== null)
                                {
                                    $(data).each(function (k,v) {
                                        $html+= `
                                    <div class="yanghu-unit">
                                        <h2><a href="single?id=${v.id}" target="_blank">${v.title}</a></h2>
                                        </div>
                                        <div class="yanghu-unit-content">
                                            <div class="img">
                                                <a href="single?id=${v.d}" target="_blank">
                                                    <img src="${v.img_url}" alt="">
                                                </a>
                                            </div>
                                            <div class="yanghu-unit-right">
                                                <div class="right-content">${v.content}</div>
                                                <div style="text-align: right;margin: 10px 0;">
                                                    <a  href="single?id=${v.id}" target="_blank"><input type="button" class="btn btn-success" value="阅读全文"></a>
                                                </div>
                                                <div class="tips">多肉简介&nbsp;&nbsp;多肉小知识&nbsp;&nbsp;多肉养成</div>
                                            </div>
                                    </div>
                                `
                                        $('.yanghu-content').html($html);
                                    });
                                }
                                else
                                {
                                    $('.yanghu-content').html("<h1 style='color: #000000;margin: 0 auto;'>无相关项目,请重新输入。。。</h1>");
                                }
                            }
                        });
                    }
                });

                /*发表文章图标切换*/
                $('.add-box').on('click',function () {
//                $('.add-post').css({'display':'block','transition':'all ease .5s'});
                    $('.add-post').toggleClass('active');
                    $attr = $('.add-plus').attr('class');
                    if($attr.indexOf('glyphicon-plus')>0)
                    {
                        $('.add-plus').attr('class','glyphicon glyphicon-minus add-plus');
                    }
                    else
                    {
                        $('.add-plus').attr('class','glyphicon glyphicon-plus add-plus');
                    }
                });

            })

        </script>
        @show
</body>
</html>
