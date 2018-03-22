<style>
    .content{
        height: 100%;
    }

</style>

@extends('layouts.basic')

@section('title','编辑项目')

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
                            <strong class="box-title">编辑项目</strong>
                        </div>
                    </div>
                    <div class="box-body" style="padding-right: 200px;">
                        <div class="form-left">
                            <form class="edit-project-form">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $datas->id }}">
                                <div class="form-group">
                                    <label>作者</label>
                                    <input type="text" class="form-control disabled" value="{{ $datas->username }}" disabled />
                                </div>
                                <div class="form-group">
                                    <label>项目名<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" value="{{ $datas->project_name }}" name="projectName" max="100" placeholder="项目名称，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>公司名称<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" value="{{ $datas->company_name }}" name="companyName" max="100" placeholder="公司名称，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>公司电话<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" name="companyPhone" value="{{ $datas->company_phone }}" placeholder="公司联系方式，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>邮箱<strong class="text-danger">*</strong></label>
                                    <input type="email" class="form-control" value="{{ $datas->company_email }}"  name="companyEmail" max="100" placeholder="公司邮箱，必填" required>
                                </div>
                                <div class="form-group">
                                    <label>版权<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" value="{{ $datas->copyright }}"  name="copyright" max="100" placeholder="公司版权，必填" required>
                                </div>
                                <div class="form-group">
                                    <label class="description">描述</label>
                                    <textarea class="form-control" rows="3" title="描述" name="description" id="description" maxlength="500">{{ $datas->description }}</textarea>
                                    <p style="color: #999;font-size: 12px;">描述不能超过500字</p>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<div class="col-lg-6">--}}
                                        {{--<label>--}}
                                            {{--<input type="radio"  name="sign" value="0" checked=""> 公开<span class="text">(任何人都可以访问)</span>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-6">--}}
                                        {{--<label>--}}
                                            {{--<input type="radio"  name="sign" value="1"> 私有<span class="text">(只要参与者或使用令牌才能访问)</span>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <input type="button" class="btn btn-success btn-edit-project" value="保存修改" />
                                    <span id="form-error-message" class="error-message"></span>
                                </div>

                                {{--提示框--}}
                                <div class="msg-box"></div>
                                <div class="null" style="height: 50px;"></div>

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
            $('.btn-edit-project').on('click',function() {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url:'editPro',
                    type:'post',
                    data:$('.edit-project-form').serialize(),
                    success:function (data) {
//                        alert()
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
