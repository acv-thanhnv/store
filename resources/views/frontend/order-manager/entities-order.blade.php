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
        <div class="entities-row-order">
            <div class="entities_order_id text-center" style="display: inline">
            </div>
            <div class="entities_order_time text-center" style="display: inline"></div>
            <div class="entities_order_status text-center" style="display: inline"></div>
            <div class="entities_order_action text-center" style="display: inline">
                <button class="btn btn-info btn-sm show_detail"><span class="glyphicon glyphicon-eye-open"
                  aria-hidden="true"></span></button>
                  <button class="btn btn-secondary btn-sm delete_order"><span class="glyphicon glyphicon-trash"
                    aria-hidden="true"></span></button>
                    <button class="btn btn-danger btn-sm send_order"><span class="glyphicon glyphicon-share-alt"
                     aria-hidden="true"></span></button>
                 </div>
                 <div class="entities-row-detail">
                
                </div>
            </div>


        </div>
    </div>