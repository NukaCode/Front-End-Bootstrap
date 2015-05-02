@if (isset($item->items) && $item->count() > 0)
    <li class="dropdown {{ $item->active ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $item->name }}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            @if ($item->url != '')
                <li>{{ HTML::link($item->url, $item->name, $item->options) }}</li>
            @endif
            @each('layouts.menus.twitter.item', $item->items, 'item')
        </ul>
    </li>
@else
    <li class="{{ $item->active ? 'active' : '' }}">
        {{ HTML::link($item->url, $item->name, $item->options) }}
    </li>
@endif
