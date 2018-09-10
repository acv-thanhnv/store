<!----><kv-cashier-menu-container _ngcontent-c4="" _nghost-c10=""><div _ngcontent-c10="" class="list-filter">
    <div _ngcontent-c10="" class="wrap-show-buttons">
        <div _ngcontent-c10="" class="show-buttons" id="scrollArea">
            <button _ngcontent-c10="" class="btn active" skip-disable="" type="button">
                Tất cả
            </button>
            <!----><button _ngcontent-c10="" class="btn" skip-disable="" type="button">
                BIA &amp; THUỐC LÁ
            </button>
            <button _ngcontent-c10="" class="btn" skip-disable="" type="button">
                CLASSIC COCKTAILS
            </button>
            <button _ngcontent-c10="" class="btn" skip-disable="" type="button">
                MÓN KHAI VỊ
            </button>
            <button _ngcontent-c10="" class="btn" skip-disable="" type="button">
                SÚP
            </button>
            <button _ngcontent-c10="" class="btn" skip-disable="" type="button">
                TEA
            </button>
            <!---->        
        </div>
        <!---->
    </div>
</div>
<!-- product list -->
<div _ngcontent-c10="" class="product-list product-list-menu">
    <kv-cashier-product-list _ngcontent-c10="" _nghost-c28=""><ks-swiper-container _ngcontent-c28=""><div class="swiper-container swiper-container-horizontal">
        <div class="swiper-wrapper" style="transition-duration: 0ms;">

            <!----><ks-swiper-slide _ngcontent-c28="" class="swiper-slide swiper-slide-active" style="width: 744px;"><div>
                <ul _ngcontent-c28="">
                    {{-- @foreach($items as $item) --}}

                    <li _ngcontent-c28="">
                        <a _ngcontent-c28="" title="APEROL SPRITZ   Tồn: 1009 Đặt: 0">
                            <div _ngcontent-c28="" class="product-img">
                                <img _ngcontent-c28="" kvfallbackimg="" src="./frontend/img/order/2.jpg">
                            </div>
                            <div _ngcontent-c28="" class="product-info">
                                <span _ngcontent-c28="" class="product-name">
                                    APEROL SPRITZ
                                    <!---->
                                    <!---->
                                </span>
                                <span _ngcontent-c28="" class="product-price">30,000</span>
                            </div>
                        </a>
                    </li>
                    
                   {{--  @endforeach --}}

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

<script type="text/javascript">
    $( document ).ready(function(event) {
    event.preventDefault();
    $.ajax({
        url         : {{route('food/list-by-menu')}},
        data        : {storeId:storeId},
        dataType    : 'JSON',
        type        : 'GET',
        success: function(response){
            console.log(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('Error '+xhr.status+' | '+thrownError);
        },
    });
});
</script>