<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="{{asset('')}}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Food Blog Template</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link href="frontend/Customer/css/style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="frontend/Customer/css/responsive.css" rel="stylesheet">
    <!--Custom CSS-->
    <link href="frontend/Customer/css/custom.css" rel="stylesheet">
    @stack("css")
</head>

<body>

    <!-- ****** Top Header Area Start ****** -->
    <div class="top_header_area">
        <div class="container-fluid">
            <div class="row" style="align-items: center">
                <!-- Menu Area -->
                <div class="col-2 col-sm-3 col-md-6 col-lg-5 menu-mobile">
                    <!--  Top Social bar start -->
                    <nav class="navbar navbar-expand-md">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#food-nav" aria-controls="food-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i></button>
                        <!-- Menu Area Start -->
                        <div class="collapse navbar-collapse justify-content-center" id="food-nav">
                            <ul class="navbar-nav nav" id="yummy-nav">
                                <li class="nav-item active">
                                    <a class="nav-link active" href="">Homes    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="#top">Top Store</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- End Menu Area -->
                <div class="col-3 col-sm-4 col-md-2 col-lg-2 logo">
                    <div class="logo_area text-center">
                        <a href="index.html" class="yummy-logo">Gem's Store</a>
                    </div>
                </div>
                <!--  Login Register Area -->
                <div class="col-7 col-lg-4 col-md-4 col-sm-5">
                    <div class="signup-search-area d-flex align-items-center justify-content-end">
                        <div class="login_register_area d-flex">
                            <div class="login">
                                <a href="register.html">Sing in</a>
                            </div>
                            <div class="register">
                                <a href="register.html">Sing up</a>
                            </div>
                        </div>
                        <!-- Search Button Area -->
                        <div class="search_button">
                            <a class="searchBtn" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
                        <!-- Search Form -->
                        <div class="search-hidden-form">
                            <form action="#" method="get">
                                <input type="search" name="search" id="search-anything" placeholder="Search Anything...">
                                <input type="submit" value="" class="d-none">
                                <span class="searchBtn"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Top Header Area End ****** -->
    <!-- ****** Content Start ****** -->
    <section class="tab-content">
        @yield("content")
    </section>
    <!-- ****** Content End ****** -->

    <!-- ****** Instagram Area Start ****** -->
    <div class="instargram_area owl-carousel section_padding_100_0 clearfix" id="portfolio" style="display: block">
        @foreach($store as $obj)
        <!-- Instagram Item -->
        <div class="instagram_gallery_item">
            <!-- Instagram Thumb -->
            <img src="{{$obj->src}}" alt="Restaurant Images">
            <!-- Hover -->
            <div class="hover_overlay" title="60B Dinh Cong Ha">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <span class="slide-name">{{$obj->name}}</span>
                            <span class="slide-address">{{$obj->address}}</span>
                            <a href="{{route('Order')}}?idStore={{$obj->id}}" target="blank" class="goto-res btn btn-danger btn-sm"><i class="fa fa-instagram" aria-hidden="true"></i> Go to restaurant
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- ****** Our Creative Portfolio Area End ****** -->

    <!-- ****** Footer Social Icon Area Start ****** -->
    <div class="social_icon_area clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-social-area d-flex">
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i><span>facebook</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twitter</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i><span>GOOGLE+</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i><span>linkedin</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i><span>VIMEO</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>YOUTUBE</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Footer Social Icon Area End ****** -->

    <!-- ****** Footer Menu Area Start ****** -->
    <footer class="footer_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-content">
                        <!-- Logo Area Start -->
                        <div class="footer-logo-area text-center">
                            <a href="index.html" class="yummy-logo">
                                Gem's Food
                            </a>
                        </div>
                        <div class="newsletter-form">
                            <form action="#" method="post">
                                <input type="email" name="newsletter-email" id="question" placeholder="Any question? Send us now">
                                <button type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Copywrite Text -->
                    <div class="copy_right_text text-center">
                        <p>Copyright @2018 All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://www.facebook.com/geminikids2705" target="_blank">Gemkids</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ****** Footer Menu Area End ****** -->

    <!-- Jquery-3.2.1 js -->
    <script src="frontend/Customer/js/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="frontend/Customer/js/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="frontend/Customer/js/bootstrap.min.js"></script>
    <!-- All Plugins JS -->
    <script src="frontend/Customer/js/plugins.js"></script>
    <!-- lazyload JS -->
    <script src="frontend/Customer/js/lazyload.js"></script>
    <script src="frontend/Customer/js/ias.js"></script>
    <!-- Active JS -->
    <script src="frontend/Customer/js/active.js"></script>
    <!--Queue Ajax-->
    <script src="frontend/js/AjaxQueue.js"></script>
    @stack("js")
</body>
