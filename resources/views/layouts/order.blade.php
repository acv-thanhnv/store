
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

    <link href="{{ asset('frontend/css/styles_order.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/fontawesome/css/all.min.css') }}" rel="stylesheet"> 

    @yield('css')
    
</style>
</head>
<body>
    <kv-root _nghost-c0="" ng-version="4.4.7" class=""><!---->
        <!---->
        <!---->
        <router-outlet _ngcontent-c0=""></router-outlet>
        <kv-cashier-page _nghost-c4=""><!---->
            <div _ngcontent-c4="" class="introduce-app">
                <button _ngcontent-c4="" class="btn-del"><i _ngcontent-c4="" class="fal fa-trash-alt"></i></button>
                <div _ngcontent-c4="" class="banner-introduce-app">
                    <!---->
                    <!---->
                </div>
            </div>
            <!---->
            <div _ngcontent-c4="" class="wrapper has-download-app">
                <kv-cashier-header _ngcontent-c4="" _nghost-c5=""><div _ngcontent-c5="" class="header">
                    <div _ngcontent-c5="" class="header-left">
                        <div _ngcontent-c5="" class="kv-tabs">
                            <ul _ngcontent-c5="">                            
                                <li _ngcontent-c5="">
                                    <a _ngcontent-c5="" href="#" class="active">
                                        Thực đơn
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div _ngcontent-c5="" class="search-wrapper">
                            <div _ngcontent-c5="" class="search-content">
                                <kv-product-search _ngcontent-c5="" class="kv-product-search" _nghost-c13=""><div _ngcontent-c13="" class="wrap-auto-complete">
                                    <kv-auto-complete _ngcontent-c13="" _nghost-c19=""><div _ngcontent-c19="" class="autocomplete">
                                        <i _ngcontent-c19="" class="fa fa-search"></i>
                                        <input _ngcontent-c19="" class="form-control" kvselecttext="" type="text" id="productSearchInput" placeholder="Tìm sản phẩm (F3)">
                                        <div _ngcontent-c19="" class="output-complete" hidden="">
                                            <ul _ngcontent-c19="">
                                                <!---->
                                            </ul>
                                            <!----><kv-up-down-scroll _ngcontent-c19="" _nghost-c22=""><!---->
                                            </kv-up-down-scroll>
                                            <!---->
                                        </div>
                                    </div>
                                </kv-auto-complete>
                                <!---->
                            </div>
                            <!---->

                            <a _ngcontent-c13="" class="quick-sale" id="saleMode_productSearchInput" title="Chế độ nhập">
                                <i _ngcontent-c13="" class="far fa-calendar-alt"></i></a>
                            </kv-product-search>
                        </div>
                    </div> 
                </div>
                <div _ngcontent-c5="" class="header-right">
                    <kv-cashier-cart-tabs _ngcontent-c5="" _nghost-c14=""><kv-group-tabs _ngcontent-c14="" _nghost-c20=""><div _ngcontent-c20="" class="header-tab-wrap">
                        <ul _ngcontent-c20="">
                            <!----><li _ngcontent-c20="" class="active">
                                <a _ngcontent-c20="" class="active" title="ĐÃ CHỌN">
                                    <!---->
                                    <!---->
                                    <!---->

                                    <span _ngcontent-c20="">
                                        ĐÃ CHỌN
                                    </span>
                                </a>

                            </li>
                            <!---->

                        </ul>
                    </div>

                    <!---->
                </kv-group-tabs>
            </kv-cashier-cart-tabs>
            <kv-cashier-menu _ngcontent-c5="" _nghost-c15=""><ul _ngcontent-c15="" class="header-right-ul pull-right">
                <!----><li _ngcontent-c15="" class="bell-button">
                    <a _ngcontent-c15="" id="volumeControlCashier" title="Tắt chuông" class="belloff"><i _ngcontent-c15="" class="fa fa-bell-slash"></i></a>
                </li>
                <!---->
                <!----><li _ngcontent-c15="">
                    <a _ngcontent-c15="" href="#" outsideclick="true" placement="bottom" skip-disable="">
                        <!---->
                        <i _ngcontent-c15="" aria-hidden="true" class="fa fa-globe"></i>
                    </a>
                </li>
                <li _ngcontent-c15="">
                    <a _ngcontent-c15="" href="#" skip-disable="">
                        <!---->
                        <i _ngcontent-c15="" aria-hidden="true" class="fa fa-refresh"></i>
                    </a>
                </li>
                <li _ngcontent-c15="" class="bell-button print-button">
                    <a _ngcontent-c15="" href="#" outsideclick="true" placement="bottom" skip-disable="">
                        <i _ngcontent-c15="" aria-hidden="true" class="fa fa-print"></i>        
                    </a>
                    <span _ngcontent-c15="" class="badge"></span>
                </li>
                <li _ngcontent-c15="" class="user-name">
                    <a _ngcontent-c15="" skip-disable="">
                     <span _ngcontent-c15="">

                     </span>
                 </a>
             </li>
             <li _ngcontent-c15="" class="menu-bar">
                <a _ngcontent-c15="" class="list-bar" skip-disable=""><i _ngcontent-c15="" class="fa fa-navicon"></i></a>
                <ul _ngcontent-c15="">
                    <!----><li _ngcontent-c15="">
                        <a _ngcontent-c15="" skip-disable="" href="https://fnb.kiotviet.vn/acvtest/pos/#/kitchen">
                            <i _ngcontent-c15="" class="fa fa-bell"></i> <span _ngcontent-c15="" translate="">Nhà bếp</span>
                        </a>
                    </li>
                    <!----><li _ngcontent-c15="">
                        <a _ngcontent-c15="" skip-disable="">
                            <i _ngcontent-c15="" class="fa fa-align-left"></i> <span _ngcontent-c15="" translate="">Xem báo cáo cuối ngày</span>
                        </a>
                    </li>
                    <!----><li _ngcontent-c15="">
                        <a _ngcontent-c15="" href="#" skip-disable="">
                            <i _ngcontent-c15="" class="fa fa-mail-reply-all"></i> <span _ngcontent-c15="">Chọn hóa đơn trả hàng</span>
                        </a>
                    </li>
                    <!----><li _ngcontent-c15="">
                        <a _ngcontent-c15="" skip-disable="">
                            <i _ngcontent-c15="" class="fa fa-file-text-o"></i> <span _ngcontent-c15="" translate="">Lập phiếu thu</span>
                        </a>
                    </li>
                    <li _ngcontent-c15="">
                        <a _ngcontent-c15="" skip-disable="" href="https://fnb.kiotviet.vn/acvtest/#/Invoices">
                            <i _ngcontent-c15="" class="fa fa-list-alt"></i> <span _ngcontent-c15="" translate="">Quản lý</span>
                        </a>
                    </li>
                    <li _ngcontent-c15="">
                        <a _ngcontent-c15="" href="#" skip-disable="">
                            <i _ngcontent-c15="" class="fa fa-external-link"></i> <span _ngcontent-c15="" translate="">Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!---->

        <!---->

        <!---->
    </kv-cashier-menu>          
</div>
</div>
</kv-cashier-header>
<div _ngcontent-c4="" class="wrap-content">
    <div _ngcontent-c4="" class="col-right">
        @include('frontend.order.list-order')
    </div>
    <div _ngcontent-c4="" class="col-left">
        <!---->
        @include('frontend.order.menu')
    </div>
</div>

@include('frontend.order.payment')
</div>
<div _ngcontent-c4="" class="download-app">
    <img _ngcontent-c4="" class="app-logo" src="./frontend/img/order/app-logo.png">
    <h1 _ngcontent-c4="" class="title">Sử dụng<span _ngcontent-c4=""> màn hình ngang hoặc<br _ngcontent-c4=""></span> App Bán hàng</h1>
    <p _ngcontent-c4="">Để thực hiện thao tác bán hàng linh hoạt<br _ngcontent-c4="">
        và dễ dàng hơn trên thiết bị này
    </p>
    <!---->
    <!---->
</div>
</kv-cashier-page>
</kv-root>

@yield('javascript')
</body>
</html>