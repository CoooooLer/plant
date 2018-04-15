@extends('layout.basic')

@section('title','主页')

@section('header')
    @parent
@endsection

@section('content')
    {{--<div class="banner">--}}
        {{--<div class="banner-background"></div>--}}
        {{--<div class="yesbanner">--}}
            {{--<div class="yesbanner-right">--}}
                {{--<div class="yesbanner-right-top">--}}
                    {{--<div class="banner-imgdiv">--}}
                        {{--<a href="" class="right-banner"--}}
                             {{--data-image="img/banner1.jpg">--}}
                            {{--<img src="img/banner1.jpg"--}}
                                 {{--alt="">--}}
                        {{--</a>--}}
                        {{--<a href="" class="right-banner"--}}
                           {{--data-image="img/banner2.jpg">--}}
                            {{--<img src="img/banner2.jpg"--}}
                                 {{--alt="">--}}
                        {{--</a>--}}
                        {{--<a href="" class="right-banner"--}}
                             {{--data-image="img/banner3.jpg">--}}
                            {{--<img src="img/banner3.jpg"--}}
                                 {{--alt="">--}}
                        {{--</a>--}}
                        {{--<a href="" class="right-banner"--}}
                             {{--data-image="img/banner4.jpg">--}}
                            {{--<img src="img/banner4.jpg"--}}
                                 {{--alt="">--}}
                        {{--</a>--}}
                        {{--<a href="" class="right-banner"--}}
                             {{--data-image="img/banner5.jpg">--}}
                            {{--<img src="img/banner5.jpg"--}}
                                 {{--alt="">--}}
                        {{--</a>--}}
                        {{--<a href="" class="right-banner"--}}
                             {{--data-image="img/banner6.jpg">--}}
                            {{--<img src="img/banner6.jpg"--}}
                                 {{--alt="">--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<div class="dian">--}}
                        {{--<div class="dian-o" data-index="0"></div>--}}
                        {{--<div class="dian-o" data-index="1"></div>--}}
                        {{--<div class="dian-o" data-index="2"></div>--}}
                        {{--<div class="dian-o" data-index="3"></div>--}}
                        {{--<div class="dian-o" data-index="4"></div>--}}
                        {{--<div class="dian-o" data-index="5"></div>--}}
                    {{--</div>--}}
                    {{--<div class="leftt">--}}
                        {{--<div class="leftt-l"><</div>--}}
                    {{--</div>--}}
                    {{--<div class="rightt">--}}
                        {{--<div class="rightt-r">></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="container" style="margin-top: 100px">
        <div class="add-post">
            <form action="yanghu" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" class="text" name="type" value="多肉养护"><br>
                title:<input type="text" class="text" name="title"><br>
                content:
                图片：<input type="file" class="file" name="img">
                <textarea name="content" id="" cols="" rows="2" style="width: 200px;"> </textarea>
                <button type="submit" class="tijiao">确定</button>
                {{--提示--}}
                @include('layout.message')
                {{--<div class="msg-box">--}}

                {{--</div>--}}
            </form>
        </div>
        <div class="content">
            <div class="yanghu-title">
                <h3>分类：多肉植物首页</h3>
                <p>多肉植物的介绍</p>
            </div>
            <div class="yanghu-content">
                <div class="yanghu-unit">
                    <h2><a href="">多肉联萌精华文章索引</a></h2>
                </div>
                <div class="yanghu-unit-content">
                    <div class="img">
                        <a href="">
                            <img src="https://www.drlmeng.com/wp-content/uploads/2017/10/gushi1-330x200.jpg" alt="">
                        </a>
                    </div>
                    <div class="yanghu-unit-right">
                        <div class="right-content">多肉联萌站内其实一直有不少很是精华的文章，可以解决肉友们大多数问题，一直想弄个文 ...</>
                        <div style="text-align: right;margin: 10px 0;">
                            <a  href=""><input type="button" class="btn btn-success" value="阅读全文"></a>
                        </div>
                        <p><span class="glyphicon glyphicon-star">多肉简介 多肉小知识 多肉养成</p>
                    </div>
                </div>
            </div>
            @foreach($posts as $post)
            <div class="unit">
            <p>{{ $post->title }}</p>
            <span>{{ $post->content }}</span>
            <img src="{{ $post->img_url }}" alt="">
            </div>
            @endforeach
        </div>

    </div>



@endsection

@section('footer')
    @parent
    {{--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>--}}
    {{--<script src="js/banner.js"></script>--}}
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
//        $(document).ready(function () {
//            $('.tijiao').on('click',function () {
//               $.ajax({
//                   url:'yanghu',
//                   type:'post',
//                   data:$('form').serialize(),
//                   success:function (data) {
//                       console.log(data);
//                       $html = null;
//                       $.each(data,function (k,v) {
//                           $html = `
//                             <div class="flash-message">
//                                    <p class="alert alert-${k}" style="text-align: center">
//                                        ${v}
//                                     </p>
//                                </div>
//                       `;
//                       });
//                       $('.msg-box').html($html);
//                   }
//               });
//            });
//        });
//        $.ajax({
//           url:'https://movie.douban.com/j/search_subjects?type=tv&tag=%E7%83%AD%E9%97%A8&page_limit=50&page_start=0',
//           type:'get',
//           dataType:'jsonp',
//            jsonp:'callback',
//           success:function(data) {
//               console.log(data);
//           },
//           error:function () {
//               alert(0);
//           },
//        });
//        axios.get('https://movie.douban.com/j/search_subjects?type=tv&tag=%E7%83%AD%E9%97%A8&page_limit=50&page_start=0')
//            .then(function (response) {
//                console.log(response);
//            })
//            .catch(function (error) {
//                console.log(error);
//            });
    </script>

@endsection