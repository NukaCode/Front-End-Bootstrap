<!doctype html>
<html>
<head>
	@include('layouts.partials.header')
</head>
<body>
	@include('layouts.partials.menu')
	@if (isset($content))
		{{ $content }}
	@else
		@yield('content')
	@endif

	@include('layouts.partials.modals')

	@include('layouts.partials.javascript')

</body>
</html>