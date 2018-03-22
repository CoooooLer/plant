<style>
    .content{
        height: 100%;
    }

</style>

@extends('layouts.basic')

@section('title','编辑用户资料')

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
                            <strong class="box-title">编辑用户</strong>
                        </div>
                    </div>
                    <div class="box-body" style="padding-right: 200px;">
                        <div class="form-left">
                            <form id="userForm">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $datas->uid }}"  name="id">
                                <div class="form-group">
                                    <label>用户名</label>
                                    <input type="text" class="form-control disabled" value="{{ $datas->username }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="password">新密码</label>
                                    <input type="password" class="form-control" id="password" name="password" max="100" placeholder="新密码,不改密码请为空">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">确认密码</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" maxlength="20" placeholder="确认密码">
                                </div>
                                <div class="form-group">
                                    <label for="user-email">邮箱<strong class="text-danger">*</strong></label>
                                    <input type="email" class="form-control" value="{{ $datas->email }}" id="userEmail" name="email" max="100" placeholder="邮箱" required>
                                </div>
                                <div class="form-group">
                                    <label>手机号</label>
                                    <input type="text" class="form-control" id="userPhone" name="phone" size="11" title="手机号码" placeholder="手机号码" value="{{ $datas->phone }}" >
                                </div>
                                <div class="form-group">
                                    <label class="description">描述</label>
                                    <textarea class="form-control" rows="3" title="描述" name="description" id="description" maxlength="500">{{ $datas->description }}</textarea>
                                    <p style="color: #999;font-size: 12px;">描述不能超过500字</p>
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-success saveUserInfo" value="保存修改" />
                                    <span id="form-error-message" class="error-message"></span>
                                </div>
                            </form>
                                {{--提示框--}}
                            <div class="msg-box"></div>
                            <div class="null" style="height: 50px;"></div>
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
            $('.saveUserInfo').on('click',function() {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url:'editUserInfo',
                    type:'post',
                    data:$('#userForm').serialize(),
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
