<!doctype html>
<html>
<head>
	@include('layouts.partials.header')
</head>
<body class="app">
	<div id="container">
		@include('layouts.partials.menu')
		<hr />
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