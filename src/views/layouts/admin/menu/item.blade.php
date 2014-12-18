<li>
    @if (isset($details->subSections) && count($details->subSections) > 0)
        <a>
            <i class="{{ $details->icon }}"></i>
            <span class="nav-label">{{ $details->name }}</span>
            <span class="fa fa-caret-down pull-right"></span>
        </a>
    @else
        <a data-location="{{ URL::route($details->route, [], false) }}" class="ajaxLink" id="{{ Str::slug($details->name) }}">
            <i class="{{ $details->icon }}"></i>
            <span class="nav-label">{{ $details->name }}</span>
        </a>
    @endif
    @if (isset($details->subSections) && count($details->subSections) > 0)
        <ul class="nav nav-second-level">
            @foreach ($details->subSections as $subSection)
                <li>
                    @if (isset($details->subSubSections) && count($details->subSubSections) > 0)
                        <a>{{ $subSection->name }}</a>
                        <span class="fa fa-caret-down pull-right"></span>
                    @else
                        <a data-location="{{ URL::route($subSection->route, [], false) }}" class="ajaxLink" id="{{ Str::slug($subSection->name) }}">
                            {{ $subSection->name }}
                        </a>
                    @endif
                </li>
                @if (isset($details->subSubSections) && count($details->subSubSections) > 0)
                    <ul class="nav nav-third-level">
                        @foreach ($details->subSubSections as $subSubSection)
                            <li>
                                <a data-location="{{ URL::route($subSubSection->route, [], false) }}" class="ajaxLink" id="{{ Str::slug($subSubSection->name) }}">
                                    {{ $subSubSection->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </ul>
    @endif
</li>