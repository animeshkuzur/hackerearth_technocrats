<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	@include('partials.head')
	@yield('style')
	</head>
	<body>
		@yield('content')
		@yield('script')
	@include('partials.footer')	
	</body>
</html>