@extends('layout.basic')

@section('title','主页')

@section('header')
    @parent
@endsection

@section('content')
    <div class="banner">
        <div class="banner-background"></div>
        <div class="yesbanner">
            <div class="yesbanner-right">
                <div class="yesbanner-right-top">
                    <div class="banner-imgdiv">
                        <a href="" class="right-banner"
                             data-image="http://p0.meituan.net/mmc/6086e8b28d29830d8335822dccd06081150546.jpg">
                            <img src="http://p0.meituan.net/mmc/6086e8b28d29830d8335822dccd06081150546.jpg"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                             data-image="http://p0.meituan.net/mmc/d6deb13159f8f938018477a7abc5f913148228.jpg">
                            <img src="http://p0.meituan.net/mmc/d6deb13159f8f938018477a7abc5f913148228.jpg"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                             data-image="http://p0.meituan.net/mmc/18d50346798a6064b31b00948b1b1016116325.jpg">
                            <img src="http://p0.meituan.net/mmc/18d50346798a6064b31b00948b1b1016116325.jpg"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                             data-image="http://www.viroyal.cn/campus/images/banner1.png">
                            <img src="http://www.viroyal.cn/campus/images/banner1.png"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                             data-image="http://www.viroyal.cn/campus/images/banner3.png">
                            <img src="http://www.viroyal.cn/campus/images/banner3.png"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                             data-image="http://www.viroyal.cn/campus/images/banner3.png">
                            <img src="http://www.viroyal.cn/campus/images/banner3.png"
                                 alt="">
                        </a>
                    </div>
                    <div class="dian">
                        <div class="dian-o" data-index="0"></div>
                        <div class="dian-o" data-index="1"></div>
                        <div class="dian-o" data-index="2"></div>
                        <div class="dian-o" data-index="3"></div>
                        <div class="dian-o" data-index="4"></div>
                        <div class="dian-o" data-index="5"></div>
                    </div>
                    <div class="leftt">
                        <div class="leftt-l"><</div>
                    </div>
                    <div class="rightt">
                        <div class="rightt-r">></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content-home-hot-box">
            <div class="content-home-hot">
                <div class="hot-title-box">
                    <span class="hot-title">正在热映（24部）</span>
                    <a class="hot-all" href="">全部></a>
                </div>
                <div class="hot-content">
                    <div class="hot-movie-list">
                        @foreach($movies as $movie1)
                            @foreach($movie1 as $movie2)
                                <div class="hot-movie-unit">
                                    <div class="hot-img-box">
                                        <a href="" target="_blank"><img src="{{ $movie2['cover'] }}"></a>
                                        <div class="hot-movie-title">
                                            {{ $movie2['title'] }}
                                        </div>
                                    </div>
                                    <a href="" class="hot-ticket">选座购票</a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="content-home-today">
                <div class="hot-title">今日票房</div>
                <div class="today-list">
                    <div class="today-unit today-first">
                        <a href="" class="today-first-box">
                            <img src="http://p0.meituan.net/mmdb/8cec4c4c306fff261dc97e22df285c891437682.jpg" alt="http://p0.meituan.net/mmdb/8cec4c4c306fff261dc97e22df285c891437682.jpg">
                            <div class="today-first-info">
                                <p>厉害了，我的国</p>
                                <p>1487.45万</p>
                            </div>
                        </a>
                    </div>
                    <div class="today-unit">
                        <a href="" class="today-unit-a">
                            <div class="today-unit-left">
                                <span class="addColor-today">2</span>
                                <span>黑豹</span>
                            </div>
                            <span class="addColor-today">485.5万</span>
                        </a>
                    </div>
                    <div class="today-unit">
                        <a href="" class="today-unit-a">
                            <div class="today-unit-left">
                                <span class="addColor-today">2</span>
                                <span>黑豹</span>
                            </div>
                            <span class="addColor-today">485.5万</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/banner.js"></script>
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
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