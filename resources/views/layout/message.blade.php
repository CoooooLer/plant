{{--消息提示框--}}

@foreach (['danger','success','warning','info'] as $msg)
    @if(session()->has($msg))
        <div class="flash-message">
            <p class="alert alert-{{ $msg }}" style="text-align: center">
                {{ session()->get($msg) }}
            </p>
        </div>
    @endif
@endforeach

@if(count($errors) > 0)
    <div class="flash-message">
        <p class="alert alert-warning" style="text-align: center">
            {{ $errors->first() }}
        </p>
    </div>
@endif
