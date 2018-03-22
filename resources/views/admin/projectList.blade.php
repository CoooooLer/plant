<style>
    .content{
        height: 100%;
    }
    .table-project{
        /*table-layout: fixed;*/
    }
    .td{
        padding: 5px !important;
        /*overflow: hidden;*/
        /*white-space: nowrap;*/
        /*text-align: left*/
    }
    .active{
        overflow: hidden;
        text-overflow:ellipsis;
        white-space: nowrap;
        background: #dddddd;
    }
</style>

@extends('layouts.basic')

@section('title','项目管理')

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
                            <strong class="box-title">项目管理</strong>
                            <a href="createProject" type="button" class="btn btn-success btn-sm pull-right">
                                <span class="glyphicon glyphicon-plus"></span>
                                添加项目
                            </a>
                        </div>
                    </div>
                    <div class="box-body manager">
                        <div id="userList" class="users-list">
                            <table class="table table-condensed table-responsive">
                                <thead>
                                <tr>
                                    <th class="id">ID</th>
                                    <th>项目名</th>
                                    <th>文档数量</th>
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                    <th>是否公开</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($datas as $data)
                                    <form action="deleteProject={{ $data->id }}" method="post" >
                                        {{ csrf_field() }}
                                    <tr>
                                        <td class="td">{{ $data->id }}</td>
                                        <td class=""><p class="active col-md-2 td" style="width: 150px;">{{ $data->project_name }}</p></td>
                                        <td class="td">{{ $data->doc_num }}</td>
                                        <td class="td"> {{ $data->created_at }} </td>
                                        <td class="td"> {{ $data->updated_at }} </td>
                                        <td class="td">
                                            @if($data->sign == 1 )
                                                私有
                                            @elseif($data->sign == 0)
                                                公开
                                            @endif
                                        </td>
                                        <td class="td" style="min-width: 220px">
                                            <a href="projectId={{ $data->id }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span>编辑</a>
                                            <a href="projectName={{$data->project_name}}" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open"></span>查看</a>
                                            <button type="button" class="btn btn-danger btn-sm drop"><i class="glyphicon glyphicon-trash" data="{{ $data->id }}"></i>删除</button>
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
        $(document).ready(function () {
            //搜索
            $('.keyword').on('keypress', function (e) {
                if (e.keyCode == 13) {
                    $keyword = $('.keyword').val();
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                    $.ajax({
                        url: 'homeSearch',
                        type: 'post',
                        data: {'keyword': $keyword},
                        success: function (data) {
                            $html = '';
                            $('tbody').html($html);
                            $.each(data, function (k, v) {
                                $sign = v.sign  ?  '私有' : '公有' ;
                                $html += `
                                <tr>
                                    <td class="td">${v.id}</td>
                                    <td class=""><p class="active col-md-2 td" style="width: 150px;">${v.project_name}</p></td>
                                    <td class="td">${v.doc_num}</td>
                                    <td class="td">${v.created_at}</td>
                                    <td class="td">${v.updated_at}</td>
                                    <td class="td">${$sign}</td>
                                    <td class="td" style="min-width: 220px">
                                         <form action="deleteProject=${v.id}" method="post" >
                                            <a href="projectId=${v.id}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span>编辑</a>
                                            <a href="projectName=${v.project_name}" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open"></span>查看</a>
                                            <button type="button" class="btn btn-danger btn-sm drop"><i class="glyphicon glyphicon-trash id" data="${v.id}"></i>删除</button>
                                        </form>
                                    </td>
                                </tr>
                                `
                            });
                            if($html != ''){
                                $('tbody').html($html);
                                drop();
                            }
                            else{
                                $('tbody').html("<h1 style='color: #000000;margin: 0 auto;'>无相关项目,请重新输入。。。</h1>");
                            }

                        }

                    });
                }
            });

            //删除模态框
           function drop() {
               $('.drop').on('click',function () {
                   $('#drop').modal('show');//调用模态框
                   var _this = $(this);
                   var $id = ($(this).find('i').attr('data'));
                   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                   $('#btn-drop-confirm').on('click',function () {
                       $.ajax({
                           url:'dropProject',
                           data:{'id':$id},
                           type:'post',
                           success:function (data) {
                               _this.parents('tr').remove();
                           }
                       });
                   });

               });
           }
           drop();

        });
    </script>
@endsection


