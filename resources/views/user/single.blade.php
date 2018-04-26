<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
                    <br><textarea name="content" id="" cols="" rows="2" style="width: 700px;height: 200px;" placeholder="请输入内容"></textarea><br>
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
                    &nbsp;&nbsp;{{ $comment->created_at }} &nbsp;&nbsp; {{ $comment->username }}&nbsp;&nbsp;
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>