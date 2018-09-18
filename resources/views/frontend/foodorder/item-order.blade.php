<style type="text/css">
#item-order-template{
    display:none;

}
.row-item-order{

    height: 61px;
    clear: both;
    
}
.row-item-order.active{
    background-color: #edf6e4;
}
.cell-arrange{
    float: left;
    width:30px;
    padding: 12px 7px 0;
}
.cell-delete{
    float: left;
    width: 35px;
    padding: 12px 7px 0;
    
}
.delete-row{
    width:14px;
    height: 14px;
}
.cell-image{
    float: left;
    padding: 7px 7px;
}
div a{
    color: red;
}
.item-order-image{
    width:45px;
    height: 45px;
}
.cell-name{
    float: left;
    width: calc(100%-300px);
    padding: 6px 7px;
}
.item-order-name{
    color: #111;
}
.cell-quantity{
    float: left;
    width: 50px;
    padding: 12px 7px !important;
}
.item-order-quantity{
    width:40px;
    height: 20px;
    color:#111;
    border-width:0 0 1px;
    border-style:solid;
    border-color: #a0a0a0;
    text-align: right;
}
.cell-price{
    float: left;
    width:88px;
    padding: 12px 7px;

}
.item-order-price{
    width:74px;
    height: 20px;
    font-size: 14px;
    font-family: Arial,Helvetica,sans-serif;
    text-align: right;
}
.cell-amount{
    float: left;
    width:110px;
    padding: 12px 7px;
}
.item-order-amount{
    width:110px;
    height: 20px;
    font-size: 14px;
    font-weight: 700;
    text-align: right;
}
</style>



<div id="item-order-template">
    <div class="row-item-order" item-order-id="" item-order-name="" item-order-price="">
        <div class="cell-arrange">
            <span class="item-order-arrange">1</span>
        </div>
        <div class="cell-image">
            <img class="item-order-image" src="">
        </div>
        <div class="cell-name">
            <h4 class="item-order-name">Truong Son</h4>
        </div>
        <div class="cell-quantity">
            <input class="item-order-quantity" type="number" value="">
        </div>
        <div class="cell-price">
            <span class="item-order-price" type="number" value="">aaa</span>
        </div>
        <div class="cell-amount">
            <span class="item-order-amount" type="number" value="">|aaa</span>
        </div>
        <div class="cell-delete">
            <a title="delete item order">
                <span class="glyphicon glyphicon-remove delete-item-order"></span>
            </a>
        </div>
    </div>
</div>


