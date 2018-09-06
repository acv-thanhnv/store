<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts/font-face.css') }}">
    <!-- Latest compiled and minified CSS & JS -->
    <link href="{{ asset('css/lib/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/lib/jquery-confirm.css') }}" rel="stylesheet">

    <link href="{{ asset('css/lib/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <style>
        .navbar-laravel{
            position: fixed;
            /* margin-bottom: 40px; */
            z-index: 10;
            width: 100%;
        }
        main .container{
            margin-top: 60px;
        }
        .display-none{
            display: none;
        }
        .card-header{
            padding: 10px;
            background: #eeeeee;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .container{
            min-width: 1200px !important;
        }
        .font-weight-bold{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="{{ route('index') }}">Initialization Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="{{ route('translationManagement') }}">Translation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="{{ route('aclManangement') }}">Acl - Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="{{ route('userRole') }}">User - Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="{{ route('menu') }}">Categories</a>
                        </li>
                        {{--<li class="nav-item">
                            <a class="nav-link font-weight-bold" href="{{ route('entityManagement') }}">Entity Class</a>
                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="{{ route('doc') }}">Document</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <main class="py-4">
            <div class="container">
            @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/lib/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery-confirm.js')}}"></script>
    <script src="{{ asset('js/lib/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/lang/text.js')}}"></script>
    <script src="{{ asset('js/common.js')}}"></script>
    <!-- Scripts -->

    @yield('scripts')
</body>
</html>
