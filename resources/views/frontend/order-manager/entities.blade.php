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

    .entities_item {
        width: 100%;
        height: 170px;
        background-color: #00DAC4;
    }

    .product_image {
        width: 100%;
        height: 80px;
        background-color: #00aeef;
    }

    .product_name {
        width: 100%;
        height: 56px;
        background-color: #9CC2CB;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product_name h6{
        height: 36px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        background-color: #c0a16b;
    }

    .product_price {
        width: 100%;
        height: 34px;
    }
    .product_price h5{
        height: 14px;
        background-color: #c0a16b;
    }
</style>
<div id="list-entities-template" style="display: none;">
    <div class="col-sm-3 wrap-entities">
        <div class="entities_item">
            <div class="product_image">
                <img src="" alt="image..."/>
            </div>
            <div class="product_name">
                <h6> name product</h6>
            </div>
            <div class="product_price">
                <h5>
                    12.000 đ</h5>
            </div>
        </div>
    </div>
</div>
