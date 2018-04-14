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
        <form action="yanghu" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            title:<input type="text" class="text" name="title"><br>
            content:<input type="text" class="text" name="content"><br>
            图片：<input type="file" class="file" name="img">
            <button type="submit" class="tijiao">确定</button>
            {{--提示--}}
            @include('layout.message')
            {{--<div class="msg-box">--}}

            {{--</div>--}}
        </form>

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