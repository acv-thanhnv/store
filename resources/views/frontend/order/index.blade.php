@extends('layouts.order')

@section('content')

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

    </div>
</div>
</kv-cashier-header>
<div _ngcontent-c4="" class="wrap-content">
    <div _ngcontent-c4="" class="col-right">
        <div _ngcontent-c4="" class="col-right-content has-alert">

            <kv-cashier-cart-list-item _ngcontent-c4="" _nghost-c7="">
                <div _ngcontent-c7="" class="col-right-container">
                    @include('frontend.order.list-order')

                </div>

            </kv-cashier-cart-list-item>

            <kv-cashier-payment-info-bottom _ngcontent-c4="" _nghost-c8=""><div _ngcontent-c8="" class="form-actions form-payment">
                <div _ngcontent-c8="" class="form-actions-left">

                 <div _ngcontent-c8="" class="form-group pull-right">

                 </div>

                 <div _ngcontent-c8="">

                 </div>
             </div>

         </div>


     </kv-cashier-payment-info-bottom>
 </div>

 <!----><div _ngcontent-c4="" class="wrap-button three-buttons">
    <!---->
    <button _ngcontent-c4="" class="btn btn-success" skip-disable="" type="button">
        Chuyển Nhà Bếp
    </button>
    
</div>

<!---->

<!---->
<div _ngcontent-c4="" class="support">
    <ul _ngcontent-c4="">
        <li _ngcontent-c4=""><i _ngcontent-c4="" class="fa fa-phone"></i> Hỗ trợ khách hàng 1800 6162</li>
        <li _ngcontent-c4=""><i _ngcontent-c4="" class="fa fa-map-marker"></i> Chi nhánh trung tâm</li>
    </ul>
</div>
</div>


<div _ngcontent-c4="" class="col-left">
    <!-- categories product list -->
    <!----><kv-cashier-menu-container _ngcontent-c4="" _nghost-c10="">
        <div _ngcontent-c10="" class="list-filter">
            <div _ngcontent-c10="" class="wrap-show-buttons">
                <div _ngcontent-c10="" class="show-buttons" id="menu-item">
                    <!-- content list menu-type -->
                    <!---->        
                </div>
                <!---->
            </div>
        </div>
        <!-- product list -->
        <div _ngcontent-c10="" class="product-list product-list-menu">
            <kv-cashier-product-list _ngcontent-c10="" _nghost-c28="">
                <ks-swiper-container _ngcontent-c28="">
                    <div class="swiper-container swiper-container-horizontal">
                        <div class="swiper-wrapper" style="transition-duration: 0ms;">

                            <!----><ks-swiper-slide _ngcontent-c28="" class="swiper-slide swiper-slide-active" style="width: 744px;"><div>
                                <ul id='list-item'>
                                    <!-- content list menu -->
                                </ul>
                            </div></ks-swiper-slide>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </ks-swiper-container>
                <div _ngcontent-c28="" class="hidden-item"></div>
                <div _ngcontent-c28="" class="swiper-paging"><strong _ngcontent-c28="">1</strong>/2</div>
                <!----><button _ngcontent-c28="" class="move-prev" disabled=""><i _ngcontent-c28="" class="fa fa-chevron-circle-left"></i></button>
                <!----><button _ngcontent-c28="" class="move-next"><i _ngcontent-c28="" class="fa fa-chevron-circle-right"></i></button>
            </kv-cashier-product-list>
        </div>
    </kv-cashier-menu-container>

    <!---->
    @include('frontend.order.item-list')
    @include('frontend.order.menu-item')
    
</div>
</div>

<!-- @include('frontend.order.payment') -->
</div>

</kv-cashier-page>
</kv-root>
@endsection

@section('javascript')
<script type="text/javascript">
    $( document ).ready(function(event) {
        $.ajax({
            url         : '{{route("food/list-by-store")}}'+"/1",
            dataType    : 'JSON',
            type        : 'GET', 
            success: function(data){
                genFoodByStoreId(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error '+xhr.status+' | '+thrownError);
            },
        });


        $.ajax({
            url         : '{{route("food/list-menu-by-store")}}'+'/1',
            dataType    : 'JSON',
            type        : 'GET',
            success: function(data){
                genFoodByMenuId(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error '+xhr.status+' | '+thrownError);
            },
        });
    });


    function genFoodByStoreId(data)
    {
        var ul = $("#list-item");
        $(ul).empty();
        data.data.forEach(function(obj) {
            var item = $("#list-item-temp").contents().clone();
            $(item).find('.product-title').attr('title', obj.name);
            $(item).find('.image-item').attr('src', obj.image);
            $(item).find('.product-name').html(obj.name);
            $(item).find('.product-price').html(obj.price);            

            $(ul).append($(item));
        });
    }

    function genFoodByMenuId(data) {
        var div = $("#menu-item");
        $(div).empty();
        data.data.forEach(function(obj) {
            var item = $(".menu-item-temp").contents().clone();
            $(item).text(obj.name);        
            $(div).append($(item));
        });
    }
    $(document).on("click","li.item-temp1",function(){
        var i;
        var image = $(this).find('.image-item').attr('src');
        var name = $(this).find("span.product-name").text();
        var price = $(this).find("span.product-price").text();
//////////////
var order = $('#order');
$(order).empty();
{
    var item= $('#list-order').contents().clone();
    $(item).find('.image-item2').attr('src',image);
    $(item).find('.name-item2').html(name);
    $(order).append($(item));
}

});

    // var order= $('#list-order').contents().clone();
    // $(order).find('.image-item2').attr('src');
    // console.log($(order).find('.image-item2'));
</script>

@endsection