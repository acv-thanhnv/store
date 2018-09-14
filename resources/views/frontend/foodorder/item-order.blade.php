<style type="text/css">
#item-order-template{
    display: ;
}
.row-item-order *{
    height: 61px;
    float: left;
}
.row-item-order.active{
        background-color: #edf6e4;
}
.cell-arrange{
    width:30px;
    padding: 12px 7px 0;
}
.cell-delete{
    width: 35px;
    padding: 12px 7px 0;
    
}
.delete-row{
    width:14px;
    height: 14px;
}
.cell-image{
    padding: 7px 7px;
}
div a{
    color: red;
}
.item-image{
    width:45px;
    height: 45px;
}
.cell-name{
    width: calc(100%-300px);
    padding: 6px 7px;
}
.item-name{
    color: #111;
}
.cell-quantity{
    width: 50px;
    padding: 12px 7px !important;
}
.item-quantity{
    width:40px;
    height: 20px;
    color:#111;
    border-width:0 0 1px;
    border-style:solid;
    border-color: #a0a0a0;
    text-align: right;
}
.cell-price{
    width:88px;
    padding: 12px 7px;

}
.item-price{
    width:74px;
    height: 20px;
    font-size: 14px;
    font-family: Arial,Helvetica,sans-serif;
    text-align: right;
}
.cell-amount{
    width:110px;
    padding: 12px 7px;
}
.item-amount{
    width:110px;
    height: 20px;
    font-size: 14px;
    font-weight: 700;
    text-align: right;
}
</style>


<div id="item-order-template">
    <div class="wrap-item-order">
        <div class="col-sm-6 row-item-order" item-id="" item-name="" item-price="">
            <div class="cell-arrange">
                <span class="item-arrange">1</span>
            </div>
            <div class="cell-delete">
                <a title="delete item order">
                    <span class="glyphicon glyphicon-remove delete-row"></span>
                </a>
            </div>
            <div class="cell-image">
                <img class="item-image" src="">
            </div>
            <div class="cell-name">
                <h4 class="item-name">Truong Son</h4>
            </div>
            <div class="cell-quantity">
                <input class="item-quantity" type="number" value="">
            </div>
            <div class="cell-price">
                <span class="item-price" type="number" value="">aaa</span>
            </div>
            <div class="cell-amount">
                <span class="item-amount" type="number" value="">|aaa</span>
            </div>
        </div>
    </div>
</div>


