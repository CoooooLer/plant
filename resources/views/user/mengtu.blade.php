@extends('layout.basic')

@section('title','萌图欣赏')

@section('header')
    @parent
@endsection

@section('content')

    <div class="conta" style="width: 1500px;margin: 81px auto;">
        <div class="mengtu">
            @foreach($posts as $post)
                <div class="img-box">
                    <a href="">
                        <img src="{{ $post->img_url }}" alt="">
                    </a>
                </div>
           @endforeach

        </div>

    </div>



@endsection

@section('footer')
    @parent

@endsection