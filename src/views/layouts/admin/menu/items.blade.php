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
                <li {{ routeActive($subSection->route, $subSection->children) }}>
                    @include('layouts.admin.menu.item', ['details' => $subSection])
                    @if (isset($subSection->subSections) && count($subSection->subSections) > 0)
                        <ul class="nav nav-third-level">
                            @foreach ($subSection->subSections as $subSubSection)
                                <li {{ routeActive($subSubSection->route, $subSubSection->children) }}>
                                    @include('layouts.admin.menu.item', ['details' => $subSubSection])
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</li>