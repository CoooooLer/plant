<style>
    .content{
        height: 100%;
    }

</style>

@extends('layouts.basic')

@section('title','附件详情')

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
                            <strong class="box-title">编辑附件</strong>
                        </div>
                    </div>
                    <div class="box-body" style="padding-right: 200px;">
                        <div class="form-left">
                            <form id="editAppendix">
                                {{ csrf_field() }}
                                <input type="hidden" name="pid" value="{{ $datas->pid }}">
                                <div class="form-group">
                                    <label>附件名</label>
                                    <input type="text" class="form-control disabled" value="{{ $datas->file_name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>项目名</label>
                                    <input type="text" class="form-control" value="{{ $datas->project_name }}" name="projectName" max="100" disabled>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<label>文件路径<strong class="text-danger">*</strong></label>--}}
                                    {{--<input type="text" class="form-control" value="{{ $datas->local_path }}" name="companyName" max="100" disabled>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label>下载路径</label>
                                    <input type="text" class="form-control" name="companyPhone" value="{{ $datas->file_url }}" placeholder="私有文件，不提供对外下载地址" disabled>
                                </div>
                                <div class="form-group">
                                    <label>文件大小</label>
                                    <input type="email" class="form-control" value="{{ $datas->file_size }}"  name="companyEmail" max="100" disabled>
                                </div>
                                <div class="form-group">
                                    <label>上传时间</label>
                                    <input type="email" class="form-control" value="{{ $datas->created_at }}"  name="companyEmail" max="100" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="description">描述</label>
                                    <textarea class="form-control" rows="3" title="描述" name="description" id="description" maxlength="500">{{ $datas->description }}</textarea>
                                    <p style="color: #999;font-size: 12px;">描述不能超过500字</p>
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-success btn-edit-appendix" value="保存修改" />
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
            $('.btn-edit-appendix').on('click',function() {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url:'editAppendix',
                    type:'post',
                    data:$('#editAppendix').serialize(),
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
