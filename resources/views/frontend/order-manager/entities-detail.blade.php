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
    .order_detail_name{
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis;
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
        width: 28px;
        height: 28px;
        text-align: center;
        padding:0px;
        display: inline;
    }
    .row-order-detail{
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;

    }
    .order_detail_quantity{
        padding: 0px;
        display: flex;
        align-items: center;
    }
    .has_change{
        font-size: 18px;
        font-weight: bold;
        padding-left: 5px;
        display: none;
        color: #df9537;
    }
    /*hide up and down*/
    input[type='number'] {
        -moz-appearance:textfield;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    .num-product-up{
        padding-left: 5px;
    }
    .num-product-up,.num-product-down{
        width: 20px;
        height: 20px;
    }
    .num-product-up:hover,.num-product-down:hover{
        cursor: pointer;
    }
    /* food status*/
    .food_status_1{
        background-color: #f0ad4e;
    }
    .food_status_2{
        background-color: #337ab7;
    }
    .food_status_3{
        background-color: #5cb85c;
    }
    /* image css*/
    .order_detail_image{
        padding : 0px;
    }
    .img-detail{
        height: 70px;
        min-height: 70px;
        width: 100px;
        border-radius: 5px;
    }
</style>

    <div id="entities-detail-template" style="display: none">
        <div class="row-order-detail row">
            <div class="col-md-2 order_detail_image">
                 <img src="" alt="Image" class="img-detail"/>
            </div>
            <div class="col-md-3 order_detail_name">
                <h5 class="name-detail"></h5>
            </div>
            <div class="col-md-2">
                <span class="label food_status"></span>
            </div>
            <div class="col-md-2 order_detail_price"></div>
            <div class="col-md-2 order_detail_quantity">
                <span class="num-product-down"><i class="fa fa-minus"></i></span>
                <input type="number" class="quantity-detail form-control text-center" value="1">
                <span class="num-product-up"><i class="fa fa-plus"></i></span>
                <span class="fa fa-star-o has_change"></span>
            </div>
            <div class="col-md-1 order_detail_action">
                <button class="btn btn-danger btn-sm delete-order-detail"><i class="glyphicon glyphicon-trash"></i>
                </button>
            </div>
        </div>
    </div>