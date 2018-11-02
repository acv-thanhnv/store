{{--/**--}}
{{--* Created by PhpStorm--}}
{{--* User: SonMT--}}
{{--* Date: 10/26/2018--}}
{{--* Time: 1:52 PM--}}
{{--*/--}}
<style>
    #entities-detail-template {
        width: 100%;
    }

    .order_detail_image {
        width: 25%;
    }

    .order_detail_name {
        width: 25%;
    }

    .order_detail_name h5 {
        height: 46px;
        width: 100%;
        margin-bottom: 0px !important;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .order_detail_price {
        width: 15%;
    }

    .order_detail_quantity {
        width: 10%;
    }

    .order_detail_subtotal {
        width: 20%;
    }

    .order_detail_action {
        width: 5%;
    }

    .name-detail {
        margin-top: 0px;
    }

    .updown-quantity {
        width: 15px;
        float: left;
        font-size: 12px;
        margin-top: 2px;
    }

    .down-quantity {

    }

    .up-quantity {

    }

    .quantity-detail {
        width: 35px;
        float: left;
        padding: 6px 0px;
    }

    .delete-order-detail {
    }
</style>

    <div id="entities-detail-template" style="display: none">
        <div class="row-order-detail row">
            <div class="col-md-2 order_detail_image">
                 <img src="" alt="Image" class="img-detail"/>
            </div>
            <div class="col-md-4 order_detail_name">
                <h5 class="name-detail"></h5>
            </div>
            <div class="col-md-2 order_detail_price"></div>
            <div class="col-md-3 order_detail_quantity">
                 <input type="number" class="quantity-detail form-control text-center" value="1">
            </div>
            <div class="col-md-1 order_detail_action">
                <button class="btn btn-danger btn-sm delete-order-detail"><i class="glyphicon glyphicon-trash"></i>
                </button>
            </div>
        </div>
    </div>