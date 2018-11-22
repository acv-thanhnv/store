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
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
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
        margin:0 5px;
        width: 28px;
        height: 28px;
        text-align: center;
        padding:0px;
        display: inline;
    }
    .row-order-detail{
        padding: 0px;  
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;

    }
    .row-order-detail:not(:last-child){
        border-bottom: 1px solid #c3dffb;
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
        display: flex;
        align-items: center;
    }
    .num-product-up:hover,.num-product-down:hover{
        cursor: pointer;
    }
    /* food status*/
    .food_status_0{
        color           : #004085;
        background-color: #bfdbf9;
        border-color    : #b8daff;
        padding         : .5rem 0.6rem;
    }
    .food_status_1{
        padding         : .5rem 0.6rem;
        color           : #856404;
        background-color: #f1e1af;
        border-color    : #ffeeba;
    }
    .food_status_2{
        color           : #155724;
        background-color: #a7e6b6;
        padding         : .5rem 0.6rem;
        border-color    : #c3e6cb;
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
    .cooked{
        font-size: 16px;
        position: absolute;
        top: -22px;
        color: green;
        font-weight: bold;
    }
    .order_detail_quantity {
        position: relative;
        display:flex;
        justify-content: center;
        align-items: center;
    }
    .order_detail_quantity  .btn{
        padding: .3rem .4rem;
        border:1px solid rgba(0,0,0,.15);
    }
    .quantity-detail{
        border-width: 0 1 0 1px;
        border-style: solid;
        border-top-color: #e1e1e1;
        padding: 0 0 1px;
        background-color: transparent;
    }
    .order_detail_id{
        text-align: center;
    }
</style>

    <div id="entities-detail-template" style="display: none">
        <div class="row-order-detail row">
            <div class="col-md-1 col-xl-1 order_detail_id">
            </div>
            <div class="col-md-3 col-xl-3 order_detail_name">
                <h5 class="name-detail"></h5>
            </div>
            <div class="col-md-2 col-xl-2 order_detail_status">
                <span class="badge badge-pill food_status"></span>
            </div>
            <div class="col-md-2 order_detail_price col-xl-2" ></div>
            <div class="col-md-2 order_detail_quantity col-xl-2">
                <span class="cooked"></span>
                <span class="num-product-down btn btn-sm"><i class="fa fa-angle-down"></i></span>
                <input type="number" class="quantity-detail form-control text-center" value="1">
                <span class="num-product-up btn btn-sm"><i class="fa fa-angle-up"></i></span>
            </div>
            <div class="col-md-2 col-xl-2 order_detail_action">
                <button class="btn btn-success btn-sm save-order-detail disabled"><i class="fa fa-save"></i>
                </button>
                <button class="btn btn-danger btn-sm delete-order-detail"><i class="fa fa-trash-o"></i>
                </button>
            </div>
        </div>
    </div>