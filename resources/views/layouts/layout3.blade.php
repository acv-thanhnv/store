<!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Danh mục Order</title><!--<base href="./">-->
    <base href=".">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/x-icon" href=""><!-- No Cache index -->

    <link href="{{asset('css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/template1/modal/css/iziModal.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/toast.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    @yield('css')
    

</head>
<body>
    
    @yield('content')

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/lib/jquery-3.3.1.min.js')}}"></script>
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
    <script src="{{asset('js/lib/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/template1/modal/js/iziModal.min.js')}}"></script>
    <!--Pusher-->
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    @yield('javascript')
</body>
</html>