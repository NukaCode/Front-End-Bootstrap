<!doctype html>
<html>
<head>
	@include('layouts.partials.header')
</head>
<body>
	<div class="container-fluid">
		@include('layouts.partials.menu')
		<div id="content">
		    @if (isset($content))
			    {{ $content }}
            @else
			    @yield('content')
            @endif
		</div>
	</div>

	@include('layouts.partials.modals')

	@include('layouts.partials.javascript')

</body>
</html>