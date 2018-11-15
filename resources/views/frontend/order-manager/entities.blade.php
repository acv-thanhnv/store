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
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 4px 15px 0 rgba(0, 0, 0, 0.19);
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
        background-color: #DE2943;
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

                </h5>
                <span>.đ</span>
            </div>
        </div>
    </div>
</div>
