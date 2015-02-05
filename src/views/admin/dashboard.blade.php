<div class="row">
    @foreach ($config->notifications as $notification)
        @include('layouts.admin.notification', (array)$notification)
    @endforeach
</div>
<div class="row">
    <div class="col-md-6">
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
    </div>
    <div class="col-md-6">
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