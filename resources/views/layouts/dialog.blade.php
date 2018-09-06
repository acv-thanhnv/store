<!DOCTYPE html>
<html>
<head>
	<title>Dialog</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{ asset('backend/template1/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('backend/template1/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/template1/css/daterangepicker.css')}}" rel="stylesheet">
	<link href="{{ asset('backend/template1/css/prettify.min.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('backend/template1/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/common.css')}}" rel="stylesheet">
    <style type="text/css">
    	input,select{
    		font-weight: bold;
    	}
    	input::placeholder{
    		font-weight: normal;
    		font-size: 12px;
    	}
    </style>
    @stack("css")
</head>
<body>
	@yield("content")
</body>
</html>
<!-- jQuery -->
<script src="{{ asset('backend/template1/js/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('backend/template1/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/template1/js/jquery.autocomplete.min.js')}}"></script>
<script src="{{ asset('backend/template1/js/moment-with-locales.js')}}"></script>
<!-- bootstrap-datetimepicker -->
<script src="{{ asset('backend/template1/js/daterangepicker.js')}}"></script>
<script src="{{ asset('backend/template1/js/bootstrap-datetimepicker.min.js')}}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset('backend/template1/js/custom.js')}}"></script>
<script src="{{ asset('backend/template1/js/prettify.js')}}"></script>
<script src="{{ asset('js/common.js')}}"></script>
<script src="{{ asset('js/lang/text.js')}}"></script>
@stack("js")