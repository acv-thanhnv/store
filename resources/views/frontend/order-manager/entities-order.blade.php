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
    padding:0px 10px;
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
    padding-left:7px;
    padding-right: 0px;
}
.entities_order_status_color{
    width: 35px;
    height: 30px;
    border-radius: 50%;
}
.entities_order_status{
    padding: 0px;
}
</style>
<div style="display:  none">
    <div id="entities-order-template">
        <div class="entities-row-order row">
            <div class="col-lg-1 entities_order_id col-xl-1" ></div>
            <div class="col-lg-5 entities_order_time col-xl-4"></div>
            <div class="col-lg-1 col-xl-3 entities_order_status">
                <div class="entities_order_status_color"></div>
                <span class="alert entities_order_status_content"></span>
            </div>
            <div class="col-lg-5 col-xl-4 entities_order_action">
                    <button class="btn btn-warning  show_description" data-toggle="tooltip" data-placement="top" title="Description">
                        <span class="fa fa-comments-o" aria-hidden="true"></span>
                    </button>
                    <button class="btn btn-info  add_food" title="Add food">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </button>
                    <button class="btn btn-primary  send_order" title="Send">
                        <span class="fa fa-paper-plane" aria-hidden="true"></span>
                    </button>
                    <button class="btn btn-danger  delete_order" title="Delete">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </button>
            </div>
        </div>
        <div class="entities-row-detail" style="display: none">
            <span class="no-data dis-none"><i class="fa fa-minus-circle"></i> No data found!</span>
        </div>
    </div>
    </div>