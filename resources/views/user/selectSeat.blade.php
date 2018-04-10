@extends('layout.basic')

@section('title','选座')

@section('header')
    @parent
@endsection

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="line-box-seat">
            <div class="movie-line-box">
                <div class="number">1</div>
                <div class="title">选择场次</div>
                <div class="movie-line"></div>
            </div>
            <div class="seat-line-box">
                <div class="number">2</div>
                <div class="title">选择座位</div>
                <div class="movie-line"></div>
            </div>
            <div class="seat-line-box">
                <div class="number">3</div>
                <div class="title">付款</div>
                <div class="movie-line"></div>
            </div>
            <div class="ticket-line-box">
                <div class="number">4</div>
                <div class="title">取票观影</div>
                <div class="movie-line"></div>
            </div>
        </div>
        <div class="content-selectSeat">
            <div class="hall">
                <div class="seat-example">
                    <div class="white seat">
                        <span>可选座位</span>
                    </div>
                    <div class="red seat">已售座位</div>
                    <div class="green seat">已选座位</div>
                    <div class="double seat" style="padding-left: 77px;">情侣座位</div>
                </div>
                <div class="seat-block">
                    <div class="row-id-container">

                            <span class="row-id">{{ $row }}</span>

                    </div>
                    <div class="seat-container">
                        <div class="screen">银幕中央</div>
                        <div class="seats-wrapper">
                            <div class="row">
                                <span class="seat selectable" data-column-id="1" data-row-id="1" data-no="03010101" data-st="N" data-act="seat-click" data-bid="b_s7eiiijf"></span>
                                <span class="seat selectable" data-column-id="2" data-row-id="1" data-no="03010102" data-st="N" data-act="seat-click" data-bid="b_s7eiiijf"></span>
                            </div>
                            <div class="row">
                                <span class="seat selectable" data-column-id="1" data-row-id="1" data-no="03010101" data-st="N" data-act="seat-click" data-bid="b_s7eiiijf"></span>
                                <span class="seat selectable" data-column-id="2" data-row-id="1" data-no="03010102" data-st="N" data-act="seat-click" data-bid="b_s7eiiijf"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="side">
                <div class="movie-info">
                    <div class="poster">
                        {{--<img src="http://p0.meituan.net/movie/a547dd7f6851d7ced67ec1b6c8b7f3b2447754.jpg@115w_158h_1e_1c">--}}
                        <img src="{{ $movie['images']['small'] }}">
                    </div>
                    <div class="content">
                        {{--<p class="name text-ellipsis">头号玩家</p>--}}
                        <p class="name text-ellipsis">{{ $movie['title'] }}</p>
                        <div class="info-item">
                            <span>类型 :</span>
                            {{--<span class="value">动作,冒险,科幻</span>--}}
                            @foreach($movie['genres'] as $genres)
                                <span class="value">{{ $genres }}</span>
                            @endforeach
                        </div>
                        <div class="info-item">
                            <span>时长 :</span>
                            <span class="value">140分钟</span>
                        </div>
                    </div>
                </div>
                <div class="show-info">

                        <div class="info-item">
                            <span>影院 :</span>
                            {{--<span class="value text-ellipsis"> {{ (array_values(array_values($cinema['data'])[0])[0])['nm']  }}</span>--}}
                        </div>
                        <div class="info-item">
                            <span>影厅 :</span>
                            <span class="value text-ellipsis">3号激光厅</span>
                        </div>
                        <div class="info-item">
                            <span>版本 :</span>
                            <span class="value text-ellipsis">英语3D</span>
                        </div>
                        <div class="info-item">
                            <span>场次 :</span>
                            <span class="value text-ellipsis screen" style="color: #ff0000;">今天 4月4 19:05</span>
                        </div>
                        <div class="info-item">
                            <span>票价 :</span>
                            {{--<span class="value text-ellipsis">￥{{ (array_values(array_values($cinema['data'])[0])[0])['sellPrice']  }}/张</span>--}}
                        </div>

                </div>
                <div class="ticket-info">
                    <div class="no-ticket" style="display: block;">
                        <p class="buy-limit">座位：一次最多选4个座位</p>
                        <p class="no-selected">请<span>点击左侧</span>座位图选择座位</p>
                    </div>
                    <div class="has-ticket" style="display: none;">
                        <span class="text">座位：</span>
                        <div class="ticket-container" data-limit="4">
                            <span class="ticket" data-row-id="8" data-column-id="1" data-index="8-1">8排1座</span>
                        </div>
                    </div>

                    <div class="total-price">
                        <span>总价 :</span>
                        <span class="price">0</span>
                    </div>
                </div>
                <div class="confirm-order">
                    <button class="btn btn-success">确认选座</button>
                </div>
            </div>
        </div>




    </div>
@endsection

@section('footer')
    @parent
    <script>
        $(document).ready(function () {
            $('.row').foreach()
        });
    </script>
@endsection