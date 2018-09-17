@extends('layouts.foodorder')
@section('css')
<style type="text/css">
#wrap-content{
	height: 100%;;
	background-color: #ebebeb;
    position: fixed;
	clear: both;
}
.content-col-left{

	position: relative;
	height: 100%;
	overflow: hidden;
}
.content-col-right{

	background-color: #fff;
	height: 100%;
	float: left;
	position: relative;
}
#item-order{
	clear: both;
}
.wrap-order{
    position: fixed;
    bottom: 0px;
    margin: 0 12px;
    padding-top: 5px;
}
.wrap-order-info{
    border-top: 1px solid #0090da;
    padding-top: 15px;
    height: 60px;
}
.wrap-order-submit{
    height: 97px;
}
#list-item-order{
    height: calc(100% - 147px);
    margin: 0 4px 0 12px;
    overflow-x: hidden;
    overflow-y: scroll;
    background-color: #fff;
}
</style>
@endsection


@section('content')
{{--content--}}
<div class="wraper-content col-sm-12">
    {{--content left--}}
    <div class="wraper-content-left col-sm-6">
        <div class="content-col-left col-sm-12">
            <div class="wrap-header">
                <div class="header-col-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#menu-content">Menu</a></li>
                    </ul>

                </div>
            </div>
            <div class="tab-content">
                <div id="menu-content" class="tab-pane fade in active">
                 <div class="wrap-list-item-type col-sm-12">
                     <div id="list-item-type">
                      type activities
                  </div>
              </div>
              <div class="wrap-list-item col-sm-12">
                  <div id="list-item">
                      item activities
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
{{--content right--}}
<div class="wraper-content-right col-sm-6">
    <div class="content-col-right col-sm-12">
        <div class ="wrap-header col-sm-12">
            <div class="header-col-right">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#order-content">Order</a></li>
                </ul>
            </div>
        </div>

        <div class="tab-content col-sm-12">
            <div id="order-content" class="tab-pane fade in active">
             <div class="wrap-item-order col-sm-12">
                 <div id="list-item-order">
                  list order item
              </div>
          </div>
          <div class="wrap-order">
           <div id="order">
              <div class="wrap-order-info col-sm-12">
                <div class="order-action">
                    <span class="order-location fa fa-th col-sm-4"> Vị Trí</span>
                    <span class="fa fa-pencil col-sm-4">Mô tả: <textarea class="order-description"></textarea></span>
                </div>
                <div class="order-total">
                  <span>Tổng Tiền: </span>
                  <span class="total-price-order"></span>
              </div>
          </div>
          <div class="wrap-order-submit col-sm-12" >
                <span id="idStore" store-id="{{$idStore}}" style="display: none"></span>
              <button class="order-submit btn btn-success">Chuyển Nhà Bếp</button>
          </div>
      </div>
  </div>

</div>
</div>
</div>
</div>
{{--END CONTENT--}}

{{--INCLUDE TEMPLATE CONTENT--}}
@include('frontend.foodorder.item-type')
@include('frontend.foodorder.item')
@include('frontend.foodorder.item-order')

{{--INCLUDE TEMPLATE iframe location--}}
<div id="modal-iFrame" class="iziModal" display="none"></div>

</div>
@endsection


{{-- include javascript --}}
@section('javascript')
<script type="text/javascript">
        //load data page
        $( document ).ready(function(event) {

        //load item type by store
        $.ajax({
            url         : '{{route("food/list-menu-by-store")}}'+'/1',
            dataType    : 'JSON',
            type        : 'GET',
            success: function(data){
                //console.log(data);
                genListItemType(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error '+xhr.status+' | '+thrownError);
            },
        });
        //load item by store
        $.ajax({
            url         : '{{route("food/list-by-store")}}'+"/1",
            dataType    : 'JSON',
            type        : 'GET', 
            success: function(data){
                genFoodByStoreId(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error '+xhr.status+' | '+thrownError);
            },
        });
    });
    //gen list item type to template
    function genListItemType(data) {
        var itemtype = $("#list-item-type");
        $(itemtype).empty();
        data.data.forEach(function(obj) {
            var item = $("#item-type-template").contents().clone();
            $(item).attr('id', obj.id);
            $(item).html(obj.name);        
            $(itemtype).append($(item));
        });
    }
        //gen item to template
        function genFoodByStoreId(data){
            var listitem = $("#list-item");
            $(listitem).empty();
            data.data.forEach(function(obj) {
                var item = $("#items-template").contents().clone();

                $(item).find('.item-title').attr('title', obj.name);
                $(item).find('.item-image').attr('src', obj.image);
                $(item).find('.item-name').html(obj.name);
                $(item).find('.item-price').html(obj.price);        
            //set attr
            $(item).attr('item-id', obj.id);
            $(item).attr('item-name', obj.name);
            $(item).attr('item-price', obj.price);    

            $(listitem).append($(item));
        });
        }

//choose item to order
var item    = $("#list-item-order");
$(item).empty();

$(document).on("click",".item",function(event){
    var id = $(this).attr('item-id');
    var image = $(this).find('.item-image').attr('src');
    var name = $(this).attr('item-name');
    var price = $(this).attr('item-price');

    var row = $("#item-order-template").contents().clone();
    //$(row).find('.item-order-arrange').html(i);
    $(row).attr('item-order-id', id);
    $(row).find('.item-order-image').attr('src',image);
    $(row).find('.item-order-name').html(name);
    $(row).find('.item-order-quantity').val('1');
    $(row).find('.item-order-price').text(price);
    //set attr
    $(row).attr('item-order-name', name);
    $(row).attr('item-order-price', price);

    $(item).append(row);
    updatePrice();
    updateArange();
});

//update arrange row
function updateArange(){
    var row = $("#list-item-order").find('.row-item-order');
    for(var i = 0; i<=row.length; i++){
        $(row[i]).find('.item-order-arrange').html([i+1]);
    }
}
//update price amount and total pay
function updatePrice(){
    var total = 0;
    $('.row-item-order').each(function() {
        //get amount
        var quantity = $(this).find('.item-order-quantity').val();
        var price = $(this).attr('item-order-price');
        var amount=(quantity*price);
        $(this).find('.item-order-amount').html(amount);
        total+=amount;
    });
    //set total
    $('.total-price-order').text(total);
}  
//change quantity
$(document).on("change",".item-order-quantity",function() {
    updatePrice();
});

//delete row item order
$(document).on("click",".delete-item-order",function(event){
    $(this).parents(".row-item-order").remove();
    updateArange();
});

//set location
$(document).on('click', '.order-location', function(event) {
  event.preventDefault();
                  $('#modal-iFrame').iziModal('open', this); // Do not forget the "this"
              });
$("#modal-iFrame").iziModal({
          title: 'Select Location', //Modal title
          headerColor: 'rgb(51, 76, 123)', //Color of modal header. Hexa colors allowed.
          overlayColor: 'rgba(0, 0, 0, 0.4)', //Color of overlay behind the modal
          iconColor: '',
          iconClass: 'icon-chat',
          iframe: true, //In this example, this flag is mandatory. Izimodal needs to understand you will call an iFrame from here
          iframeURL: "{{route('location')}}" //Link will be opened inside modal
      });

//submit to chef
$(document).on("click",".order-submit",function(){

    var storeId = $('#idStore').attr('store-id');
    var orderId = 0;
    var locationId = $('.order-location').attr('location-id');
    var locationName = $('.order-location').attr('location-name');
    var description = $('.order-description').val();
    var totalPrice = $('.total-price-order').text();

    var rows= $('.row-item-order');
    var entity =[];
    for(var i=0; i<rows.length-1; i++){
        var id = $(rows[i]).attr('item-order-id');
        var name = $(rows[i]).attr('item-order-name');
        var avatar = $(rows[i]).find('.item-order-image').attr('src');
        var price = $(rows[i]).attr('item-order-price');
        var quantity = $(rows[i]).find('.item-order-quantity').val();

        var a = {id:id, name:name, avatar:avatar, price:price, quantity:quantity};
        entity.push( a);


    }
    entity = JSON.stringify(entity);

    $.ajax({

        url         : '{{route("food/order")}}',
        dataType    : 'JSON',
        type        : 'GET', 
        data: {storeId:storeId, orderId:orderId, locationId:locationId, locationName:locationName, description:description, entity:entity, totalPrice:totalPrice},
        success: function(data){

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('Error '+xhr.status+' | '+thrownError);
        },
    });
});
</script>
@endsection