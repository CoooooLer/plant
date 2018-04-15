<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
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
    </div>
</body>
</html>