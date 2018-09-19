{{-- <style type="text/css">
#item-order-template{
    display:none;
}
.row-item-order{
    box-sizing: border-box;
    float: left;
    border-bottom: 1px solid #ebebeb;
    padding: 10px 0px 0px;
    
}
.cell-arrange{
    width: 30px;
    font-family: Arial,Helvetica,sans-serif;
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
    font-family: Arial,Helvetica,sans-serif;
    padding:0px 10px;
}
.item-order-name{
    color: #111;
    width:280px;
    overflow: hidden;
}
.cell-quantity{
    float: left;
    width: 80px;
    padding: 10px 7px;
}
.quantity-down{
    float: left;
    width: 15px;
}
.quantity-up{
    widows: 15px;
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
    width:88px;
    padding: 10px 7px;
    text-align: right;

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
    width: 35px;
    padding: 10px 7px 0;
    
}
.delete-item-order{
    width:14px;
    height: 14px;
    color: red;
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
            <span class="quantity-down fa fa-sort-desc"></span>
            <input class="item-order-quantity" type="text" value="" >
            <span class="quantity-up fa fa-sort-asc"></span>
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
 --}}
<style type="text/css">
    .table>tbody>tr>td, .table>tfoot>tr>td{
    vertical-align: middle;
}
@media screen and (max-width: 600px) {
    table#cart tbody td .form-control{
        width:20%;
        display: inline !important;
    }
    .actions .btn{
        width:36%;
        margin:1.5em 0;
    }
    
    .actions .btn-info{
        float:left;
    }
    .actions .btn-danger{
        float:right;
    }
    
    table#cart thead { display: none; }
    table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
    table#cart tbody tr td:first-child { background: #333; color: #fff; }
    table#cart tbody td:before {
        content: attr(data-th); font-weight: bold;
        display: inline-block; width: 8rem;
    }
    
    
    
    table#cart tfoot td{display:block; }
    table#cart tfoot td .btn{display:block;}
    
}
</style>
<div class="container">
    <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:2%">Order</th>
                            <th style="width:50%">Product</th>
                            <th style="width:10%">Price</th>
                            <th style="width:8%">Quantity</th>
                            <th style="width:20%" class="text-center">Subtotal</th>
                            <th style="width:10%"></th>
                        </tr>
                    </thead>
                    <tbody id="item-order-template">
                        <tr class="row-item-order" item-order-id="" item-order-name="" item-order-price="">
                            <td>
                                <span class="item-order-arrange"></span>
                            </td>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-2 hidden-xs"><img src="" alt="Item food" class="img-responsive item-order-image"/></div>
                                    <div class="col-sm-10">
                                        <h4 class="nomargin item-order-name">Product 1</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price" class="item-order-price">$1.99</td>
                            <td data-th="Quantity">
                                <input type="number" class="form-control text-center item-order-quantity" value="">
                            </td>
                            <td data-th="Subtotal" class="text-center">1.99</td>
                            <td class="actions" data-th="">
                                <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>                                
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="visible-xs">
                            <td class="text-center"><strong>Total 1.99</strong></td>
                        </tr>
                        <tr>
                            <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
                            <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                        </tr>
                    </tfoot>
                </table>
</div>
