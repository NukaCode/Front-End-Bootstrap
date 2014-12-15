<!doctype html>
<html>
<head>
	@include('partials.header')
</head>
<body class="app">
	<div id="container">
		@include('partials.menu')
		<hr />
		<div id="content">
		    @if (isset($content))
			    {{ $content }}
            @else
			    @yield('content')
            @endif
		</div>
	</div>

	@include('partials.modals')

	@include('partials.javascript')

</body>
</html>