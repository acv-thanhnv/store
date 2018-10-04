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
     <!--Select2 CSS-->
    <link href="{{ asset('backend/template1/css/select2.min.css')}}" rel="stylesheet">
    <!--Jquery Confirm CSS-->
    <link href="{{ asset('css/lib/jquery-confirm.css') }}" rel="stylesheet">
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
        label.camera i{
            font-size: 20px;
            font-weight: bold;
        }
        label.camera{
            font-weight: bold;
        }
        #preview .thumb {
            width : 300px;
            min-height: 100px;
            height: 200px;
            margin: 0.2em -0.7em 0 0;
            border-radius: 20px;
            box-shadow: 5px 5px 2px 5px #D7C7C7;
        }
        #preview .remove_img_preview {
            position:relative;
            left: 300px;
            top:-200px;
            width: 15px;
            background:black;
            color:white;
            border-radius:90px;
            padding: 2px;
            text-align:center;
            cursor:pointer;
        }
        #preview .remove_img_preview:before {
            content:"\f057";
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
<!--Select 2-->
<script src="{{ asset('backend/template1/js/select2.full.min.js')}}"></script>
<!--Jquery Confirm-->
<script src="{{ asset('js/lib/jquery-confirm.js')}}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset('backend/template1/js/custom.js')}}"></script>
<script src="{{ asset('backend/template1/js/prettify.js')}}"></script>
<script src="{{ asset('js/common.js')}}"></script>
<script src="{{ asset('js/lang/text.js')}}"></script>
@stack("js")