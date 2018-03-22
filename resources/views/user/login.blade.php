@extends('layouts.basic')

@section('title', '登录')

@include('layouts.loginHeader')

@section('content')
    <div class="content">
    <div class="container">
        <div class="login">
            <form action="" method="POST">
                {{ csrf_field() }}
                <h3 class="system">用户登录</h3>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input class="form-control" placeholder="用户名" type="text" name="username">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </div>
                        <input class="form-control" placeholder="密码" type="password" name="password">
                    </div>
                </div>
                <div class="form-group volidate">
                    <div class="input-group col-xs-7 col-sm-7 col-md-7">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-check"></span>
                        </div>
                        <input class="form-control volidate-input validlogin " placeholder="请输入验证码" type="text" name="vericode">
                        <input type="hidden" value="" class="vericodes" name="vericode_confirmation">
                    </div>
                    <canvas id="canvas" class="canvas" width="140" height="50"></canvas>
                    <p class="errlogin errall"></p>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember">
                        记住我
                    </label>
                    <a class="forget-pwd" href="{{ Route('forget') }}">忘记密码?</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn">登录</button>
                </div>
                {{--提示框--}}
                @include('layouts.message')
            </form>
        </div>
    </div>
    </div>
@endsection

@section('footer')
    <script src="js/canvas.js"></script>
@endsection

