@extends('layout.basic')

@section('title','种植日志')

@section('header')
    @parent
@endsection

@section('content')

    <div class="container" style="margin-top: 81px">

        <div class="content-box">
            <div class="content">
                <div class="add-post">
                    <form action="rizhi" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" class="text" name="type" value="rizhi"><br>
                        标题:<input type="text" class="text" name="title"  placeholder="请输人日志标题" style="width: 550px"><br>
                        内容:<br> <textarea name="content" id="" cols="" rows="2" style="width: 700px;height: 200px;" placeholder="请输入内容"> </textarea><br>
                        {{--上传图片：<input type="file" class="file" name="img">--}}
                        <div style="text-align: right;">
                                <button type="submit" class="tijiao btn btn-success">发表日志</button>
                        </div>

                        {{--<div class="msg-box">--}}

                        {{--</div>--}}
                    </form>
                </div>
                {{--提示--}}
                @include('layout.message')
                <div class="yanghu-title">
                    <div style="display: flex;justify-content: space-between">
                        <span class="fenlei-title">分类：种植日志</span>
                        @if(Cookie::has('username'))
                            <div class="add-box">
                                <span class="glyphicon glyphicon-plus add-plus" ></span>
                            </div>
                        @endif
                    </div>
                    <p>转载一些多肉植物爱好者的种植多肉的心得体验</p>
                </div>
                <div class="yanghu-content">
                    @foreach($posts as $post)
                        <div class="yanghu-unit">
                            <h2><a href="">{{ $post->title }}</a></h2>
                        </div>
                        <div class="yanghu-unit-content">
                            <div class="yanghu-unit-right">
                                <div class="right-content">{{ $post->content }}</div>
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
                            <a href="" class="today-unit-a">
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