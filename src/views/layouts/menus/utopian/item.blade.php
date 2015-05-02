@if (isset($item->items) && $item->count() > 0)
    <li class="dropdown {{ $item->active ? 'active' : '' }}">
        {{ HTML::link($item->url, $item->name, $item->options) }}
        <ul>
            @each('layouts.menus.utopian.item', $item->items, 'item')
        </ul>
    </li>
@else
    <li class="{{ $item->active ? 'active' : '' }}">
        {{ HTML::link($item->url, $item->name, $item->options) }}
    </li>
@endif
