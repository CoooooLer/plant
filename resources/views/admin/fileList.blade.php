<style>
    .content{
        height: 100%;
    }
    .active{
        background: #dddddd;
    }
</style>

@extends('layouts.basic')

@section('title','文件管理')

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
                            <strong class="box-title">附件管理</strong>
                            <a href="uploadFile" type="button" class="btn btn-success btn-sm pull-right">
                                <span class="glyphicon glyphicon-plus"></span>
                                上传附件
                            </a>
                        </div>
                    </div>
                    <div class="box-body manager">
                        <div id="userList" class="users-list">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="id">ID</th>
                                    <th>附件名称</th>
                                    <th>项目名称</th>
                                    <th>文件大小</th>
                                    <th>是否公开</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($datas as $data)
                                    <form action="deleteFile={{ $data->pid }}" method="post" >
                                        {{ csrf_field() }}
                                        <tr>
                                            <td> {{ $data->pid }} </td>
                                            <td> {{ $data->file_name }} </td>
                                            <td> {{ $data->project_name }} </td>
                                            <td> {{ $data->file_size }} </td>
                                            <td>
                                                @if($data->file_type == 1 )
                                                    私有
                                                @elseif($data->file_type == 0)
                                                    公开
                                                @endif
                                            </td>
                                            <td>
                                                <button  type="button" class="btn btn-danger btn-sm drop" data="{{ $data->pid }}">删除</button>
                                                <a href="fileId={{ $data->pid }}" class="btn btn-success btn-sm">详情</a>
                                            </td>
                                        </tr>
                                    </form>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--删除的模态框  start--}}
    <div class="modal fade" id="drop" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">删除用户（慎重）</h4>
                </div>
                <div class="modal-body">
                    <p>此操作会删除用户的相关信息</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger " id="btn-drop-confirm" data-dismiss="modal">确认</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{--删除的模态框  end--}}
@endsection


@section('footer')
    @parent
    <script>
        $('.keyword').on('keypress', function (e) {
            if (e.keyCode == 13) {
                $keyword = $('.keyword').val();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: 'fileSearch',
                    type: 'post',
                    data: {'keyword': $keyword},
                    success: function (data) {
                        $html = '';
                        $('tbody').html($html);
                        $.each(data, function (k,v) {
                            $sign = v.file_type  ?  '私有' : '公有' ;
                            $html += `
                             <form>
                                <tr>
                                    <td> ${v.pid} </td>
                                    <td> ${v.file_name} </td>
                                    <td> ${v.project_name} </td>
                                    <td> ${v.file_size} </td>
                                    <td> ${$sign} </td>
                                    <td>
                                        <button  type="button" class="btn btn-danger btn-sm drop" data="${v.pid}">删除</button>
                                        <a href="fileId=${v.pid}" class="btn btn-success btn-sm">详情</a>
                                    </td>
                                </tr>
                            </form>
                            `
                        });
                        if($html != ''){
                            $('tbody').html($html);
                            drop();
                        }
                        else{
                            $('tbody').html("<h1 style='color: #000000;margin: 0 auto;'>无相关附件,请重新输入。。。</h1>");
                        }

                    }

                });
            }
        });
        //调用模态框
        function drop() {
            $('.drop').on('click',function () {
                $('#drop').modal('show');//调用模态框
                var $_this = $(this);
                var $id = ($('.drop').attr('data'));
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $('#btn-drop-confirm').on('click',function () {
                    $.ajax({
                        url:'deleteFile',
                        data:{'id':$id},
                        type:'post',
                        success:function (data) {
                            $_this.parents('tr').remove();
                        }
                    });
                });
            });
        }
        drop();
    </script>
@endsection





