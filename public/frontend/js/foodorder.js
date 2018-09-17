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
//delete row item order
$(document).on("click",".delete-item-order",function(event){
    $(this).parents(".row-item-order").remove();
    updateArange();
});