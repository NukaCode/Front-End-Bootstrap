<li {{ routeActive($details->route, $details->children) }}>
    @if (isset($details->subSections) && count($details->subSections) > 0)
        <a>
            <i class="{{ $details->icon }}"></i>
            <span class="nav-label">{{ $details->name }}</span>
            <span class="fa fa-caret-down pull-right"></span>
        </a>
    @else
        <a href="{{ URL::route($details->route, [], false) }}" id="{{ Str::slug($details->name) }}">
            <i class="{{ $details->icon }}"></i>
            <span class="nav-label">{{ $details->name }}</span>
        </a>
    @endif
    @if (isset($details->subSections) && count($details->subSections) > 0)
        <ul class="nav nav-second-level">
            @foreach ($details->subSections as $subSection)
                @include('layouts.admin.menu.item', ['details' => $subSection])
                @if (isset($details->subSubSections) && count($details->subSubSections) > 0)
                    <ul class="nav nav-third-level">
                        @foreach ($details->subSubSections as $subSubSection)
                            @include('layouts.admin.menu.item', ['details' => $subSubSection])
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </ul>
    @endif
</li>