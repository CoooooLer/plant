<style>
    .content{
        height: 100%;
    }
    .active{
        background: #dddddd;
    }
</style>

@extends('layouts.basic')

@section('title','仪表盘')


    {{--header  通用头部--}}
    <div class="header">
        @section('header')
            <header class="navbar-static-top navbar-fixed-top manual-header" role="banner">
                <nav class="container">
                    <a href="{{ Route('home') }}" class="nav-system" title="MinDoc文档管理系统">
                        文档管理系统
                    </a>
                    <div class="nav-list-c">
                        <ul class="nav-ul">
                            <li>
                                <a href="{{ Route('home') }}" title="首页">首页</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-login" role="navigation">

                        @if(Cookie::has('username'))
                            <ul class="nav-login-lo">
                                <li class="dropdown ">
                                    <a href="#" class="" data-toggle="dropdown" role="button"  aria-expanded="true">&nbsp;&nbsp;{{ Cookie::get('username') }}&nbsp;&nbsp;<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ Route('user.show') }}"><span class="glyphicon glyphicon-user"></span>个人中心</a></li>
                                        <li><a href="{{ Route('user.project') }}"><span class="glyphicon glyphicon-list"></span>我的项目</a></li>
                                        <li><a href="{{ Route('dashboard') }}"><span class="glyphicon glyphicon-home"></span>后台管理</a></li>
                                        <li><a href="{{ Route('user.logOut') }}"><span class="glyphicon glyphicon-log-out"></span>退出登录</a></li>
                                    </ul>
                                </li>
                            </ul>
                        @else
                            <ul class="nav-login-lo">
                                <li><a href="{{route('login')}}">登录</a></li>
                            </ul>
                        @endif
                    </div>
                </nav>
            </header>
        @show
    </div>


@section('content')

    <div class="content">
        <div class="container manual-body">
            <div class="row">

                @include('layouts.left')

                <div class="page-right">
                    <div class="m-box">
                        <div class="box-head">
                            <strong class="box-title">仪表盘</strong>
                        </div>
                    </div>
                    <div class="box-body manager" style="padding-right: 200px;">
                        <a href="{{ route('projectList') }}" class="dashboard-item">
                            <span class="bo glyphicon glyphicon-book"></span>
                            <span class="bo-class">项目数量</span>
                            <span class="bo-class">{{ $data['projectNum'] }}</span>
                        </a>
                        <div class="dashboard-item">
                            <span class="bo glyphicon glyphicon-file"></span>
                            <span class="bo-class">文章数量</span>
                            <span class="bo-class">{{ $data['docNum'] }}</span>
                        </div>
                        <a href="{{ route('userList') }}" class="dashboard-item">
                            <span class="bo glyphicon glyphicon-user"></span>
                            <span class="bo-class">会员数量</span>
                            <span class="bo-class">{{ $data['userNum'] }}</span>
                        </a>
                        <a href="{{ route('fileList') }}" class="dashboard-item">
                            <span class="bo glyphicon glyphicon-cloud-download"></span>
                            <span class="bo-class">附件数量</span>
                            <span class="bo-class">{{ $data['photoNum'] }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    @parent
    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('ul li').on('click',function () {--}}
                {{--$(this).addClass('active').siblings().removeClass('active');--}}
            {{--});--}}
        {{--});--}}

    {{--</script>--}}
@endsection