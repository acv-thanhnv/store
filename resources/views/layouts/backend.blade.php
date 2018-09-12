<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <base href="{{asset('')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="{{ asset('backend/template1/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('backend/template1/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/template1/css/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{ asset('backend/template1/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/template1/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/lib/jquery-confirm.css') }}" rel="stylesheet">
    @yield('lib_style')
    <!-- Custom Theme Style -->
    <link href="{{ asset('backend/template1/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/template1/css/backend_common.css')}}" rel="stylesheet">
    <link href="{{ asset('css/common.css')}}" rel="stylesheet">
    <!--Modal CSS-->
    <link href="{{ asset('backend/template1/modal/css/modal.css')}}" rel="stylesheet">
    <!--Toast CSS-->
    <link href="{{ asset('css/toast.css')}}" rel="stylesheet">
    <!--dataTable CSS-->
    <link href="{{ asset('css/lib/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/jquery.dataTables.min.css') }}" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @stack("css")

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>{{ config('app.name', 'Laravel') }}</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{ asset('backend/template1/images/avatar.jpg') }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>John Doe</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('backend_template')}}">Dashboard</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-book"></i> Menu   <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('getMenu')}}">List</a></li>
                                    <li><a href="{{route('getType')}}">Type</a></li>
                                    <li><a href="{{route('getFood')}}">Foods</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('form_template')}}">General Form</a></li>
                                    <li><a href="{{route('component_template')}}">Advanced Components</a></li>
                                    <li><a href="{{route('button_template')}}">Form Buttons</a></li>
                                    <li><a href="{{route('upload_template')}}">Form Upload</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('generalElement_template')}}">General Elements</a></li>
                                    <li><a href="{{route('icons_template')}}">Icons</a></li>
                                    <li><a href="{{route('glyphicons_template')}}">Glyphicons</a></li>
                                    <li><a href="{{route('calendar_template')}}">Calendar</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-download"></i> Export/Import <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('export_template')}}">Export Excel/Csv</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('table_template')}}">Tables</a></li>
                                </ul>
                            </li>
                            <!--User-->
                            <li><a><i class="fa fa-user"></i> User <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('list')}}">List</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('backend/template1/images/avatar.jpg') }}" alt="">John Doe
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;"> Profile</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">Help</a></li>
                                <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <?php for ($i=0;$i<4;$i++){ ?>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{ asset('backend/template1/images/avatar.jpg') }}" alt="Profile Image" /></span>
                                        <span>
                                            <span>John Smith</span>
                                            <span class="time">{{$i+1}} mins ago</span>
                                        </span>
                                        <span class="message">Film festivals used to be do-or-die moments for movie makers. They were where...</span>
                                    </a>
                                </li>
                                <?php } ?>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col contents" role="main">
            <div id="content">
                @yield('content')
            </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

</body>
<!-- jQuery -->
<script src="{{ asset('backend/template1/js/jquery.min.js')}}"></script>
<script src="{{ asset('js/lib/jquery-ui-1.9.2.custom.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('backend/template1/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/template1/js/jquery.autocomplete.min.js')}}"></script>
<script src="{{ asset('js/lib/jquery-confirm.js')}}"></script>
<script src="{{ asset('backend/template1/js/moment-with-locales.js')}}"></script>

<!-- bootstrap-datetimepicker -->
<script src="{{ asset('backend/template1/js/daterangepicker.js')}}"></script>
<script src="{{ asset('backend/template1/js/bootstrap-datetimepicker.min.js')}}"></script>

<script src="{{ asset('backend/template1/js/bootstrap-colorpicker.min.js')}}"></script>
<!--Paginate JS-->
<script src="{{ asset('backend/template1/paginate/jquery.twbsPagination.js')}}"></script>
<!--Modal JS-->
<script src="{{ asset('backend/template1/modal/js/modal.js')}}"></script>
<!--Toast JS-->
<script src="{{ asset('js/toast.js')}}"></script>
<!--dataTable-->
<script src="{{ asset('js/lib/jquery.dataTables.min.js')}}"></script>
<!-- Custom Theme Scripts -->
@yield('lib_scripts')
<script src="{{ asset('backend/template1/js/custom.js')}}"></script>
<script src="{{ asset('js/common.js')}}"></script>
@yield('form_scripts')
@stack("js")
</html>

