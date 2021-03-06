@extends('layout.basic')

@section('title','主页')

@section('header')
    @parent
@endsection

@section('content')
    <div class="container" style="margin-top: 81px">
        <div class="content-box">
            <div class="content">
                <div class="add-post">
                    <form action="yanghu" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" class="text" name="type" value="yanghu"><br>
                        标题:<input type="text" class="text" name="title"  placeholder="请输人文章标题" style="width: 550px"><br>
                        内容:<br> <textarea name="content" id="" cols="" rows="2" style="width: 700px;height: 200px;" placeholder="请输入内容"> </textarea><br>
                        上传图片：<input type="file" class="file" name="img">
                        <div style="text-align: right;">
                            <button type="submit" class="tijiao btn btn-success">发表文章</button>
                        </div>

                    </form>
                </div>
                {{--提示--}}
                @include('layout.message')
                <div class="yanghu-title">
                    <div style="display: flex;justify-content: space-between">
                        <span class="fenlei-title">分类：多肉植物首页</span>
                        {{--<div class="add-box">--}}
                            {{--<span class="glyphicon glyphicon-plus add-plus" ></span>--}}
                        {{--</div>--}}
                    </div>
                    <p>介绍多肉植物的一些基本信息。</p>
                </div>
                <div class="yanghu-content">
                    @foreach($posts as $post)
                        <div class="yanghu-unit">
                            <h2><a href="single?id={{ $post->id }}" target="_blank">{{ $post->title }}</a></h2>
                        </div>
                        <div class="yanghu-unit-content">
                            <div class="img">
                                <a href="single?id={{ $post->id }}" target="_blank">
                                    <img src="{{ $post->img_url }}" alt="">
                                </a>
                            </div>
                            <div class="yanghu-unit-right">
                                <div class="right-content">{{ $post->content }}</div>
                                <div style="text-align: right;margin: 10px 0;">
                                    <a  href="single?id={{ $post->id }}" target="_blank"><input type="button" class="btn btn-success" value="阅读全文"></a>
                                </div>
                                <div class="tips">
                                    @if($post->type == 'jianjie')
                                        <span class="glyphicon glyphicon-asterisk icon-color" style=""></span>多肉简介
                                    @else
                                        <span class="glyphicon glyphicon-tint icon-color" style=""></span>种植养护
                                    @endif
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="glyphicon glyphicon-star icon-color" style=""></span>多肉小知识&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="glyphicon glyphicon-heart icon-color"></span>多肉养成
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="content-home-today">
                <div class="hot-title">最近更新</div>
                <div class="today-list">
                    @foreach($posts as $post)
                        <div class="today-unit">
                            <a href="single?id={{ $post->id }}" target="_blank"class="today-unit-a">
                                <div class="today-unit-left">
                                    <span class="addColor-today"></span>
                                    <span>{{ $post->title }}</span>
                                </div>
                                <span class="addColor-today">{{ $post->created_at }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{--分页--}}
        <div class="container">
            @foreach ($posts as $post)
                {{ $post->name }}
            @endforeach
        </div>

        {{ $posts->links() }}
    </div>




@endsection

@section('footer')
    @parent
    {{--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>--}}
    {{--<script src="js/banner.js"></script>--}}
    <script>
        $(document).ready(function () {
            $('.add-box').on('click',function () {
//                $('.add-post').css({'display':'block','transition':'all ease .5s'});
                $('.add-post').toggleClass('active');
            });



        });
    </script>

@endsection