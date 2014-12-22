<div class="row">
    @include('layouts.admin.notification',
        [
            'size'        => 4,
            'color'       => 'info',
            'icon'        => 'fa-css3',
            'title'       => 'Theme',
            'focus'       => ucfirst(Config::get('theme.theme.style')),
            'bar'         => 'bar-inverse',
            'description' =>
                '<a href="'. URL::route('admin.style.theme', [], false) .'">Customize</a>'
        ]
    )
    @include('layouts.admin.notification',
        [
            'size'        => 4,
            'color'       => 'inverse',
            'icon'        => 'fa-code',
            'title'       => 'Laravel',
            'focus'       => $laravelVersion,
            'bar'         => 'bar',
            'description' =>
                '<a href="http://packagist.org/packages/laravel/framework#{{ $laravelVersion }}" target="_blank">Packagist</a>
                &nbsp;|&nbsp;
                <a href="http://laravel.com/docs" target="_blank">Documentation</a>'
        ]
    )
</div>
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-inverse">
            <div class="panel-heading">Theme Options</div>
            <table class="table table-condensed table-striped table-hover">
                <tbody>
                    <tr>
                        <td>Style</td>
                        <td>{{ Config::get('theme.theme.style') }}</td>
                    </tr>
                    <tr>
                        <td>Source</td>
                        <td>{{ Config::get('theme.theme.src') }}</td>
                    </tr>
                    <tr>
                        <td>Color: Gray</td>
                        <td>
                            <i class="fa fa-square" style="color: {{ Config::get('theme.colors.gray') }};"></i>
                            {{ Config::get('theme.colors.gray') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Color: Primary</td>
                        <td>
                            <i class="fa fa-square" style="color: {{ Config::get('theme.colors.primary') }};"></i>
                            {{ Config::get('theme.colors.primary') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Color: Info</td>
                        <td>
                            <i class="fa fa-square" style="color: {{ Config::get('theme.colors.info') }};"></i>
                            {{ Config::get('theme.colors.info') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Color: Success</td>
                        <td>
                            <i class="fa fa-square" style="color: {{ Config::get('theme.colors.success') }};"></i>
                            {{ Config::get('theme.colors.success') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Color: Warning</td>
                        <td>
                            <i class="fa fa-square" style="color: {{ Config::get('theme.colors.warning') }};"></i>
                            {{ Config::get('theme.colors.warning') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Color: Danger</td>
                        <td>
                            <i class="fa fa-square" style="color: {{ Config::get('theme.colors.danger') }};"></i>
                            {{ Config::get('theme.colors.danger') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Color: Menu</td>
                        <td>
                            <i class="fa fa-square" style="color: {{ Config::get('theme.colors.menu') }};"></i>
                            {{ Config::get('theme.colors.menu') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-inverse">
            <div class="panel-heading">Laravel Details</div>
            <table class="table table-condensed table-striped table-hover">
                <tbody>
                    <tr>
                        <td>Laravel</td>
                        <td style="width: 20%;">{{ $laravelVersion }}</td>
                        <td style="width: 20%;" class="text-right">{{ HTML::link('http://packagist.org/packages/laravel/framework#'. $laravelVersion, 'View', ['target' => '_blank']) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="panel panel-inverse">
            <div class="panel-heading">Nuka Code Package Versions</div>
            <table class="table table-condensed table-striped table-hover">
                <tbody>
                    @foreach ($packages as $package => $details)
                        <tr>
                            <td>{{ Str::title($package) }}</td>
                            <td style="width: 20%;">{{ $details['version'] }}</td>
                            <td style="width: 20%;" class="text-right">{{ HTML::link('http://packagist.org/packages/nukacode/'. $package .'#'. $details['version'], 'View', ['target' => '_blank']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>