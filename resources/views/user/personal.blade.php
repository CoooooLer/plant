@extends('layout.basic')

@section('title','个人中心')

@section('header')
    @parent
@endsection

@section('content')
    <div class="container" style="padding: 0 40px 0 40px">
        <div class="row">
            <div class="page-right">
                <div class="box-body manager">
                    <div id="userList" class="users-list">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>标题</th>
                                <th>分类</th>
                                <th>发表时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts  as $post)
                                <form action="" method="" class="ticket">
                                    {{ csrf_field() }}
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->type }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            <input type="button"class="btn btn-danger btn-sm drop" data-id={{ $post->id }} value="删除" />
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--提示--}}
        @include('layout.message')
    </div>
{{--退票确认模态框 .drop start--}}
    <div class="modal fade dropTicket" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="color: #d9534f;">删除对话框</h4>
                </div>
                <div class="modal-body">
                    <p style="text-align: center">此操作将删除发布的文章</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger btn-confirm" data-dismiss="modal">确认</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
{{--退票确认模态框 .drop end--}}

@endsection

@section('footer')
    @parent
    <script>
        $(document).ready(function () {
            $('.drop').map(function (i) {
                $(this).on('click',function () {
                    $_this = $(this);
                    $id = $(this).attr('data-id');
//                    console.log($ticketId);
                    $('.dropTicket').modal('show');
                    $('.btn-confirm').on('click',function () {
                        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                        $.ajax({
                            url:'dropPost',
                            type:'post',
                            data:{'id':$id},
                            success:function (data) {
//                                console.log(data);
                                if(data === 'success')
                                {
//                                    console.log($_this.parents());
                                    $_this.parents('tr').remove();
                                    alert('删除成功');
                                }
                                else
                                {
                                    alert('删除失败');
                                }
                            },

                        });

                    });
                });
            });
        });
    </script>
@endsection