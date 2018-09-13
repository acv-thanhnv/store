<!DOCTYPE html>
<html lang="en">
<head>
	<title>FOOD ORDER</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="{{asset('css/lib/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/foodorder_style.css')}}">
	@yield('css')
</head>
<body>
	<div id="content">
		@yield('content')
	</div>
<script type="text/javascript" src="{{asset('js/lib/bootstrap.min.js')}}"></script>
@yield('javascript')
</body>
</html>