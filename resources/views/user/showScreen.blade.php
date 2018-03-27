@extends('layout.basic')

@section('title','放映室')

@section('header')
    @parent
@endsection

@section('content')
    @parent
    <div class="filmInfo-banner">
        <div class="wrapper">
            <div class="filmInfo-box">
                <div class="filmInfo-img">
                    {{--<img src=" {{ $results['images']['small'] }} " alt="">--}}
                </div>
                {{--@foreach($cinema['data']['cinemaDetailModel'] as $cinema2)--}}
                    {{--@foreach($cinema1['cinemaDetailModel'] as $cinema2)--}}
                        <div class="filmInfo-info" style="margin-top: -50px">
                            <h3>{{ $cinema['data']['cinemaDetailModel']['nm'] }}</h3>
                            <p>
                                {{ $cinema['data']['cinemaDetailModel']['addr'] }}
                                {{--@foreach($results['genres'] as $key=>$value)--}}
                                    {{--<span>{{ $value }}</span>--}}
                                {{--@endforeach--}}
                            </p>
                            <p>电话：{{ $cinema['data']['cinemaDetailModel']['tel'][0] }}</p>
                            <h4>影院服务————————————————————</h4>
                            @foreach($cinema['data']['cinemaDetailModel']['featureTags'] as $cinema)
                            <p><div style="">{{ $cinema['desc'] }}</div></p>
                            @endforeach
                            {{--<a href="" data-movieId="" class="filmInfo-ticket movieId">电影详情</a>--}}
                        </div>
                    {{--@endforeach--}}
                {{--@endforeach--}}
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 80px">
        <div class="movie-info-show">
            <div class="movie-title-show">
                <h3 class="title">title</h3>
                <span>7.6份</span>
            </div>
            <div class="more-info-show">
                <div><span class="key">时长：</span><span class="value">11111</span></div>
                <div><span class="key">类型：</span><span class="value">动作</span></div>
                <div><span class="key">主演：</span><span class="value">22222</span></div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
