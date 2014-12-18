<div class="row">
    <div class="col-md-4">
        <div class="widget widget-notification bg-info">
            <div class="icon icon-lg"><i class="fa fa-css3"></i></div>
            <div class="title">Theme</div>
            <div class="focus">{{ ucfirst(Config::get('theme.theme.style')) }}</div>
            <div class="bar-inverse"></div>
            <div class="desc">
                <a href="admin/style/theme" data-toggle="modal" data-target="#remoteModal">Customize</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="widget widget-notification bg-inverse">
            <div class="icon icon-lg"><i class="fa fa-code"></i></div>
            <div class="title">Laravel</div>
            <div class="focus">{{ $laravelVersion }}</div>
            <div class="bar"></div>
            <div class="desc">
                <a href="http://packagist.org/packages/laravel/framework#{{ $laravelVersion }}" target="_blank">Packagist</a>
                &nbsp;|&nbsp;
                <a href="http://laravel.com/docs" target="_blank">Documentation</a>
            </div>
        </div>
    </div>
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