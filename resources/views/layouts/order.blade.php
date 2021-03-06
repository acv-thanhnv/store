
<!DOCTYPE html>

<html lang="en" class="k-webkit k-webkit69">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Danh mục Order</title><!--<base href="./">-->
    <base href=".">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/x-icon" href=""><!-- No Cache index -->
    <meta http-equiv="cache-control" content="max-age=0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
    <meta http-equiv="pragma" content="no-cache"><!-- BEGIN TRACKJS -->
    <!-- END TRACKJS -->
    <link href="{{asset('css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/styles_order.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css" />

    @yield('css')
    

</head>
<body>
    
    @yield('content')


    <script src="{{ asset('js/lib/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script>
    @yield('javascript')
</body>
</html>