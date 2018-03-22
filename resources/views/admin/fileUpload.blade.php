<style>
    .content{ height: 100%; }
    .up-file {position: relative;margin-top: 20px;}
    .up-file .up-text{position: absolute; right: 0;top: 0; color: #bbb;}
    .up-private{margin-top: 20px;}
    .up-submit {outline: none;border-radius: 4px;width: 50px;margin: 20px 0 20px 40px;}
</style>

@extends('layouts.basic')

@section('title','上传附件')

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
                            <strong class="box-title">上传附件</strong>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-left">
                            <form method="post" enctype="multipart/form-data" action="">
                                <div class="up-file">
                                    {{ csrf_field() }}
                                    <input type="file" name="file"><span class="up-text">(上传文件支持格式类型：png、jpg、jpeg、html、docx)</span>
                                </div>
                                <div class="up-private">
                                    <input type="radio" name="type" value="public" checked>公开
                                    <input type="radio" name="type" value="private" style="margin-left: 40px;">私有
                                </div>
                                <button type="submit" class="up-submit">上传</button>
                                {{--提示框--}}
                                @include('layouts.message')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
