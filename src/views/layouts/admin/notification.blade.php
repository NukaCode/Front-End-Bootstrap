<div class="col-lg-{{ $size }}">
    <div class="widget widget-notification bg-{{ $color }}">
        <div class="icon icon-lg"><i class="fa {{ $icon }}"></i></div>
        <div class="title">
            @if (is_object($title))
                {{ ucfirst(call_user_func($title->method, $title->argument)) }}
            @else
                {{ $title }}
            @endif
        </div>
        <div class="focus">
            @if (is_object($focus))
                {{ ucfirst(call_user_func($focus->method, $focus->argument)) }}
            @else
                {{ $focus }}
            @endif
        </div>
        <div class="{{ $bar }}"></div>
    </div>
</div>