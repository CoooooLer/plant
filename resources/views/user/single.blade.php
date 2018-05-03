<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <title>详情</title>
</head>
<body>
    <div class="single-box">
        <div class="single-title">
            {{ $post->title }}
        </div>
        <div class="single-info">
            发布时间：<span>{{ $post->created_at }}</span>
            分类：<span>
               @if($post->type == 'jianjie')
                    多肉简介
                    @else
                    种植养护
                @endif
            </span>
            作者：<span>{{ $post->username }}</span>
        </div>
        <div class="img-box">
            <img src="{{ $post->img_url }}" alt="">
        </div>
        <div class="single-content">
            {{ $post->content }}
        </div>
        <div class="add-comment-box">
            <form action="liuyan" method="post">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $post->id }}" name="pId">
                <div class="add-comment">
                    <br><textarea name="content" id="" cols="" rows="2" style="width: 90%;height: 200px;" placeholder="请输入内容"></textarea><br>
                </div>
                <div class="add-btn-box">
                    <button type="submit" class="btn btn-info">留言</button>
                </div>
            </form>
            @include('layout.message')
        </div>
        @foreach($comments as $comment)
            <div class="comment-content-box">
                {{ $comment->content }}
                <div class="comment-info">
                    @if(Cookie::get('username') === $comment->username)
                        <a href="dropComment?id={{ $comment->id }}"><button class="btn btn-default btn-xs">删除</button></a>
                    @endif
                    &nbsp;&nbsp;{{ $comment->created_at }} &nbsp;&nbsp; <span class="username">{{ $comment->username }}</span>&nbsp;&nbsp;<button class="btn btn-default btn-xs btn-reply">回复</button>
                    <form action="reply" method="post">
                        {{ csrf_field() }}
                        <div class="reply-box">
                            <input type="hidden" name="pId" value="{{ $post->id }}">
                            <input type="hidden" name="cId" value="{{ $comment->id }}">
                            <input type="hidden" name="toUsername" value="{{ $comment->username }}">
                            <textarea name="content" id=""></textarea>
                            <div class="reply-fabiao">
                                <button type="submit" class="btn btn-default btn-xs">发表</button>
                            </div>
                        </div>
                    </form>
                </div>
                @foreach($replys as $reply)
                    @if($reply->cId === $comment->id)
                        <div class="reply-content-unit">
                            <span class="username">{{ $reply->username }}</span>:@<span class="username">{{ $reply->toUsername }}</span></sp><div>{{ $reply->content }}</div>
                            <div class="create">{{ $reply->created_at }}</div><button class="btn btn-default btn-xs btn-reply" style="text-align: right;position: relative;top: -20px;right: -95%;">回复</button>
                            <form action="reply" method="post">
                                {{ csrf_field() }}
                                <div class="reply-box">
                                    <input type="hidden" name="pId" value="{{ $post->id }}">
                                    <input type="hidden" name="cId" value="{{ $comment->id }}">
                                    <input type="hidden" name="toUsername" value="{{ $reply->username }}">
                                    <textarea name="content" id=""></textarea>
                                    <div class="reply-fabiao" style="text-align: right;">
                                        <button type="submit" class="btn btn-default btn-xs">发表</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</body>
<script>
    $(document).ready(function () {
        $('.btn-reply').map(function (k,v) {
            $(this).on('click',function () {
//                console.log($(this).next());
                $username = $(this).parent().find('.username').text();
                console.log($username);
                $(this).parent().find('.reply-box').toggleClass('addReply');
            });
        });
    });
</script>
</html>