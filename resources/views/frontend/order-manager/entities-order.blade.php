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
    background: #a9dffa;
    color: white;
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
                <span class="label entities_order_status_content"></span>
            </div>
            <div class="col-md-4 entities_order_action">
                <button class="btn btn-warning btn-sm show_description">
                    <span class="fa fa-comments-o" aria-hidden="true"></span>
                </button>
                <button class="btn btn-info btn-sm add_food">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </button>
                <button class="btn btn-danger btn-sm delete_order">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>
                <button class="btn btn-primary btn-sm send_order">
                    <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                </button>
            </div>
        </div>
        <div class="entities-row-detail" style="display: none">
        </div>
    </div>
    </div>