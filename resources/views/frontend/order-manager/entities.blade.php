{{--/**--}}
{{--* Created by PhpStorm--}}
{{--* User: SonMT--}}
{{--* Date: 10/19/2018--}}
{{--* Time: 11:57 AM--}}
{{--*/--}}
<style>
    .wrap-entities {
        padding: 5px 5px;
    }
    .product_image {
        width: 100%;
        height: 105px;
        background-color: rgba(115, 110, 37, 0.56);
    }
    .product_image img{
        width: 100%;
        height: 100%;
    }
    .product_name {
        color: white;
        width: 100%;
        height: 32px;
        padding: 0px 2px;
        display: -webkit-box;
        background-color: #a71313eb;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product_name h6{
        height: 38px;
        font-weight: bold;
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product_price {
        width: 100%;
        padding: 4px 4px;
    }
    .product_price h5{
        height: 20px;
        float: left;
        font-weight: bold;
        margin-top: 0px;
        margin-bottom: 0px;
        color: #281141;
    }
    .product_price span{
        font-style: italic;
        height: 20px;
        float: left;
        font-size: 12px;
    }
</style>
<div id="list-entities-template" style="display: none;">
    <div class="col-lg-4 col-xl-3 col-md-4 food-item" title="Food's Name Title">
        <!-- Block2 -->
        <div class="block2 entities_item">
            <div class="block2-pic hov-img0">
                <img src="" alt="" class="food-image">
            </div>

            <div class="block2-txt flex-w flex-t p-t-14 food-content">
                <div class="block2-txt-child1 flex-col-l p-b-5">
                    <a class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-5 food-items-name">
                    </a>
                    <span class="stext-105 cl3 food-items-price">
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
