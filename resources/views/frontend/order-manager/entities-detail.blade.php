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

<table style="display: none" >
    <tbody id="entities-detail-template">
    <tr class="entities-row-detail">
        <td class="order_detail_image text-center">
            <img src="" alt="Image" class="img-detail"/></div>
        </td>
        <td class="order_detail_name">
            <h5 class="name-detail">Thịt bò mỹ hun khói kèm sốt gia vị đặc biệt(HOT)</h5>
        </td>
        <td class="order_detail_price text-center">5.000.000</td>
        <td class="order_detail_quantity text-center">
            <input type="number" class="quantity-detail form-control text-center" value="1">
            <div class="updown-quantity">
                <span class="glyphicon glyphicon-plus up-quantity" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-minus down-quantity" aria-hidden="true"></span>
            </div>
        </td>
        <td class="order_detail_subtotal text-center">500.000.000</td>
        <td class="order_detail_action text-cent20er">
            <button class="btn btn-danger btn-sm delete-order-detail"><i class="glyphicon glyphicon-trash"></i></button>
        </td>
    </tr>
    </tbody>
</table>
