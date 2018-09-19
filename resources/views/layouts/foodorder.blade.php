<!DOCTYPE html>
<html lang="en">
<head>
	<title>FOOD ORDER</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/foodorder_style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/lib/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/lib/jquery-confirm.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/
	font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('backend/template1/modal/css/iziModal.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/toast.css')}}">
	@yield('css')
</head>
<body>
	<div id="content">
		@yield('content')
	</div>


	{{--include javascript --}}
<script src="{{ asset('js/lib/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/lib/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/lib/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/lib/jquery-confirm.js')}}"></script>
<script src="{{asset('backend/template1/modal/js/iziModal.min.js')}}"></script>
<script src="{{ asset('js/common.js')}}"></script>
<script src="{{ asset('js/toast.js')}}"></script>
@yield('javascript')
</body>
</html>
