<style type="text/css">
    #items-template {
        display: none;
        list-style-type: disc;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 40px;
    }

    .item {
        float: left;
        list-style: none;
        margin: 0;
        width: 150px;
        height: 210px;
        padding-right: 20px;
    }

    .wrap-item-image {
        width: 130px;
        height: 130px;
    }

    .item-image {
        width: 130px;
        height: 130px;
    }

    .item-title {
        cursor: pointer;
    }

    .div-price {
        color: green;
    }
    .item-name{
        font-weight: bold;
    }
</style>


<div id="items-template">
    <div class="item" item-id="" item-name="" item-price="">
        <a class="item-title">
            <div class="wrap-item-image">
                <img class="item-image" alt="Item" src="">
            </div>
        </a>
        <div class="wrap-item-info">
            <div class="item-name"></div>
            <div class="div-price"><span class="item-price"></span> <span>VNĐ</span></div>
        </div>
        </a>
    </div>
</div>



