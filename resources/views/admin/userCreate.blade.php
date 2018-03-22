<style>
    .content{
        height: 100%;
    }

</style>

@extends('layouts.basic')

@section('title','添加用户')

@section('header')
    @include('layouts.header')
@endsection

@section('content')

    <div class="content">

        <div class="container manual-body">
            <div class="row">
                @include('layouts.left')

                <div class="page-right">
                    <div class="m-box">
                        <div class="box-head">
                            <strong class="box-title">创建用户</strong>
                        </div>
                    </div>
                    <div class="box-body" style="padding-right: 200px;">
                        <div class="form-left">
                            <form class="create-user-form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>用户名<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" name="username" value="" placeholder="用户名长度不得小于6字符，不得超过40个字符。">
                                </div>
                                <div class="form-group">
                                    <label for="password">密码<strong class="text-danger">*</strong></label>
                                    <input type="password" class="form-control" id="password" name="password" max="100" placeholder="密码长度不得小于6字符，不得超过40个字符，必须完全是字母、数字。">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">确认密码<strong class="text-danger">*</strong></label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" maxlength="20" >
                                </div>
                                <div class="form-group">
                                    <label for="user-email">邮箱<strong class="text-danger">*</strong></label>
                                    <input type="email" class="form-control" value="" id="userEmail" name="email" max="100"  required>
                                </div>
                                <div class="form-group">
                                    <label>手机号</label>
                                    <input type="text" class="form-control" id="userPhone" name="phone" size="11" title="手机号码" value="" >
                                </div>
                                <div class="form-group">
                                    <label class="description">描述</label>
                                    <textarea class="form-control" rows="3" title="描述" name="description" id="description" maxlength="500"></textarea>
                                    <p style="color: #999;font-size: 12px;">描述不能超过500字</p>
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-success btn-create-user" value="创建用户" />
                                    <span id="form-error-message" class="error-message"></span>
                                </div>
                                {{--提示框--}}
                                <div class="msg-box">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.btn-create-user').on('click',function() {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url:'createUser',
                    type:'post',
                    data:$('.create-user-form').serialize(),
                    success:function (data) {
                        $.each(data,function (k,v) {
                            $html =  `
                                <div class="flash-message">
                                    <p class="alert alert-${k}" style="text-align: center">
                                        ${v}
                                     </p>
                                </div>
                            `
                            $('.msg-box').html($html);
                        });
                    }
                });
            });
        });
    </script>
@endsection
