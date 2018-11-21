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
.entities-row-detail{
    margin-top: 10px;
    border-bottom: 1px solid #E9E9E9;
    padding:0px 25px;
}
.entities-row-order{
    font-size: 15px;
    font-weight: bold;
    color: rgba(0, 0, 0, 0.36);
    margin-right: 0px;
    margin-left: 0px;
    border-radius: 4px;
}
.order_detail_action{
    padding : 0px;
}
</style>
<div style="display:  none">
    <div id="entities-order-template">
        <div class="entities-row-order row">
            <div class="col-md-1 entities_order_id"></div>
            <div class="col-md-4 entities_order_time"></div>
            <div class="col-md-3 entities_order_status">
                <span class="alert entities_order_status_content"></span>
            </div>
            <div class="col-md-4 entities_order_action">
                <button class="btn btn-warning  show_description">
                    <span class="fa fa-comments-o" aria-hidden="true"></span>
                </button>
                <button class="btn btn-info  add_food">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </button>
                <button class="btn btn-danger  delete_order">
                    <span class="fa fa-trash" aria-hidden="true"></span>
                </button>
                <button class="btn btn-primary  send_order">
                    <span class="fa fa-paper-plane" aria-hidden="true"></span>
                </button>
            </div>
        </div>
        <div class="entities-row-detail" style="display: none">
            <span class="no-data dis-none"><i class="fa fa-minus-circle"></i> No data found!</span>
        </div>
    </div>
    </div>