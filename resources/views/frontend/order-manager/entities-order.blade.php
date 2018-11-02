<style>
#order_null {
    width: 100%;
    margin: 15px 45%;
}

#add_new_order {
    font-size: 60px;
    opacity: 0.5;
}

.add_order_text {
    text-align: center;
    width: 200px;
    opacity: 0.5;
}

</style>
<div style="display:  none">
    <div id="entities-order-template">
        <div class="entities-row-order row">
            <div class="col-md-1 entities_order_id"></div>
            <div class="col-md-5 entities_order_time"></div>
            <div class="col-md-3 entities_order_status"></div>
            <div class="col-md-3 entities_order_action">
                <button class="btn btn-info btn-sm show_detail"><span class="glyphicon glyphicon-eye-open"
                  aria-hidden="true"></span></button>
                  <button class="btn btn-secondary btn-sm delete_order"><span class="glyphicon glyphicon-trash"
                    aria-hidden="true"></span></button>
                    <button class="btn btn-danger btn-sm send_order"><span class="glyphicon glyphicon-share-alt"
                       aria-hidden="true"></span></button>
            </div>
        </div>
        <div class="entities-row-detail" style="display: none">
        </div>
    </div>
    </div>