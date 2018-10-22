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
        height: 160px;
        border: 1px solid #9d9d9d;
        border-radius: 5px;
        box-shadow: 2px -2px 2px #9d9d9d;
    }
    .product_image {
        width: 100%;
        height: 80px;
        background-color: rgba(115, 110, 37, 0.56);
    }
    .product_name {
        width: 100%;
        height: 56px;
        padding: 0px 2px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product_name h6{
        height: 38px;
        font-weight: bold;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product_price {
        width: 100%;
        height: 34px;
        padding: 0px 4px;
    }
    .product_price h5{
        height: 14px;
        font-weight: bold;
        margin-top: 0px;
        color: #737373;
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