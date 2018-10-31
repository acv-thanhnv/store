<style>
    #order_null{
        width: 100%;
        margin: 15px 45%;
    }
    #add_new_order{
        font-size: 60px;
        opacity: 0.5;
    }
    .add_order_text{
        text-align: center;
        width: 200px;
        opacity: 0.5;
    }

</style>
<table style="display:  none">
    <tbody id="entities-order-template">
    <tr class="entities-row-order">
        <td class="entities_order_id text-center">
            Mã12345
        </td>
        <td class="entities_order_time text-center">20/10/2018 16:40PM</td>
        <td class="entities_order_status text-center">Chưa xác nhận</td>
        <td class="entities_order_action text-center">
            <button class="btn btn-info btn-sm show_detail"><span class="glyphicon glyphicon-eye-open"
                                                                  aria-hidden="true"></span></button>
            <button class="btn btn-secondary btn-sm delete_order"><span class="glyphicon glyphicon-trash"
                                                                        aria-hidden="true"></span></button>
            <button class="btn btn-danger btn-sm send_order"><span class="glyphicon glyphicon-share-alt"
                                                                   aria-hidden="true"></span></button>
        </td>
    </tr>

    {{--<div id="order_null">--}}
        {{--<span class="glyphicon glyphicon-plus-sign" id="add_new_order" aria-hidden="true"></span>--}}
        {{--<br>--}}
        {{--<span class="add_order_text">Thêm Order</span>--}}
    {{--</div>--}}
    </tbody>
</table>