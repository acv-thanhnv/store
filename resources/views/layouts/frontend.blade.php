<html>
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Bootstrap-->
    <!-- Bootstrap -->
    <link href="{{ asset('backend/template1/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('backend/template1/css/font-awesome.min.css')}}" rel="stylesheet">
</head>
@stack("css")
<body>
<div id="content">
    @yield('content')
</div>
</body>
</html>
<!--JS-->
<script src="{{ asset('backend/template1/js/jquery.min.js')}}"></script>
<script src="{{ asset('backend/template1/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/common.js')}}"></script>
@stack("js")


