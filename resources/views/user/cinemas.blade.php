@extends('layout.basic')

@section('title','电影院')

@section('header')
    @parent
@endsection

@section('content')
    @parent
    <div class="container" style="margin-top: 80px">
        <div class="cinema-title">
            <div class="cinema-line">|</div>
            <h3>影院列表</h3>
        </div>
        <div class="cinema-list">
            <div class="cinema-unit">
                <div class="cinema-info">
                    <a href="">橙天影城(遵义店)</a>
                    <span>地址：红花岗区中山路好百领商场二楼</span>
                </div>
                <div class="cinema-ticket">
                    <div class="price">￥23起</div>
                    <a href="" class="">选座购票</a>
                </div>
            </div>
            <div class="cinema-unit">
                <div class="cinema-info">
                    <a href="">橙天影城(遵义店)</a>
                    <span>地址：红花岗区中山路好百领商场二楼</span>
                </div>
                <div class="cinema-ticket">
                    <div class="price">￥23起</div>
                    <a href="" class="">选座购票</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
