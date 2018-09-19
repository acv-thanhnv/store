<style type="text/css">
#item-order-template{
    display:none;
}
.row-item-order{
    box-sizing: border-box;
    float: left;
    padding: 0px 0px 10px;
    width: 100%;
    display: inline-flex;

}
.cell-arrange{
    width: 50px;
    font-size: 13px;
    color: #666;
    padding: 10px 7px;
    float: left;
}
.cell-image{
    float: left;
    padding: 0px 7px;

}
.item-order-image{
    width:100px;
    height: 100px;
}
.cell-name{
    float: left;
    padding:0px 10px;
    width: 100%;
}
.item-order-name{
    color: #111;
    overflow: hidden;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    font-weight: bold;
}
.cell-quantity{
    float: left;
    width: 150px;
    padding: 10px 7px;
}
.quantity-down{
    float: left;
    width: 15px;
}
.quantity-up{
    float: left
}
.item-order-quantity{
    width:40px;
    float: left;
    height: 20px;
    color:#111;
    border-width:0 0 1px;
    border-style:solid;
    border-color: #a0a0a0;
    text-align: center;
}
.cell-price{
    float: left;
    width:200px;
    padding: 10px 7px;
    text-align: right;
    color: green;

}
.item-order-price{
    font-size: 14px;
    font-family: Arial,Helvetica,sans-serif;
}
.cell-amount{
    float: left;
    width:110px;
    padding: 10px 7px;
}
.item-order-amount{
    width:110px;
    height: 20px;
    font-size: 14px;
    font-weight: 700;
    text-align: right;
}
.cell-delete{
    float: left;
    width: 70px;
    padding: 10px 7px 0;

}
.delete-item-order{
    width:14px;
    height: 14px;
    color: red;
}
@media only screen and (max-width: 1024px) {
    .cell-quantity {
        width: 256px !important;
    }
}
@media only screen and (max-width: 1920px) {
    .cell-quantity {
        float: left;
        width: 165px;
        padding: 10px 7px;
    }
    .cell-price {
        float: left;
        width: 277px;
        padding: 10px 7px;
        text-align: right;
        color: green;
    }
}
</style>
<div id="item-order-template">
    <div class="row-item-order" item-order-id="" item-order-name="" item-order-price="">
        <div class="cell-arrange">
            <span class="item-order-arrange"></span>
        </div>
        <div class="cell-image">
            <img class="item-order-image" src="">
        </div>
        <div class="cell-name">
            <h4 class="item-order-name"></h4>
        </div>
        <div class="cell-quantity">
            <span class="quantity-down glyphicon glyphicon-minus"></span>
            <input class="item-order-quantity" type="text" value="" >
            <span class="quantity-up glyphicon glyphicon-plus"></span>
        </div>
        <div class="cell-price">
            <span class="item-order-price" type="number" value=""></span>
            <span class="vnd">(VNĐ)</span>
        </div>
        <div class="cell-delete">
            <a title="delete item order">
                <span class="glyphicon glyphicon-remove delete-item-order"></span>
            </a>
        </div>
    </div>
</div>

