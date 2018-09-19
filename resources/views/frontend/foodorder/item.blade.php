
<style type="text/css">
#items-template{
    display: none;
    list-style-type: disc;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
}

.item{
    float: left;
    list-style: none;
    padding: 0px;
    margin: 10px;
    width: 100px;
    height: 150px;
}
.wrap-item-image{
    width: 100px;
    height: 100px;
}
.item-image{
    width: 100px;
    height: 100px;
}
.item-name{
    clear: both;
    height: 20%;
    font-size: 14px;
    font-weight: bold;
    font-style: italic;
}
.item-price{
    font-size: 13px;
    clear: both;
    color: #0090da;
    height: 10%;
}
.item-detail{
    float: right;
    font-size: 13px;
}
.wrap-price-detail{
    height: 20px;
    border: solid #ebebeb;
}
.wrap-item-name{
    height: 35px;
    margin-top:5px;
}
</style>


<ul id="items-template"> 
    <li class="item">
        <a class="item-link" title="" item-id="" item-name="" item-price="">
            <div  class="wrap-item-image">
                <img  class="item-image" alt="Item food" src="">            
            </div>
        </a>       
        <div  class="wrap-item-info">
            <div class="wrap-price-detail">
            <span class="item-price fa fa-money fa-lg mt-4"></span> 
            <span class="item-detail fa fa-eye fa-lg mt-4"></span>  
            </div>
            <div class="wrap-item-name">
            <span class="item-name"></span>
                
            </div>
        </div>
        
    </li>
</ul>



