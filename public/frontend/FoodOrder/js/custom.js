var _page =1,_numberPage,quantity=1,cart_items=[];
$(".infinite-scroll-request").hide();
//function lazy load food
function lazyLoad(url,idStore){
	$(window).scroll(function() {
		var hT = $('.list-food').offset().top,
		hH = $('.list-food').outerHeight(),
		wH = $(window).height(),
		wS = $(this).scrollTop();
		if (wS > (hT+hH-wH)){
			_page++;
			if(_page<=_numberPage){
				$(document).ajaxStart(function(){
					$(".infinite-scroll-request").show();
				});
				$(document).ajaxStop(function(){
					$(".infinite-scroll-request").hide();
				});
				buildFood(url,idStore,_page);
			}
		}
	});
}
//function build Menu
function buildMenu(url,idStore,numberMenu){
	$.ajax({
		type: 'GET',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: url,
		data:{idStore:idStore},
		success: function (data) {
			var menu = $(".menu-group-desktop");
			var menu_mobile = $(".dl-menu");
			var length = data.data.length;
			for(var i=0;i<numberMenu;i++){
				var row = $("#template-menu").contents().clone()[1];
				$(row).attr('data-filter',data.data[i].id);
				$(row).text(data.data[i].name);
				$(menu).append($(row));
			}
			if(length>numberMenu){
				var dropdown_ul = $("#template-menu .dropdown-menu");
				dropdown_ul.empty();
				for(var i=numberMenu;i<length;i++){
					var li = $("#template-menu-show").contents().clone()[1];
					$(li).find("a").text(data.data[i].name);
					$(li).find("a").attr('data-filter',data.data[i].id);
					$(dropdown_ul).append($(li));
				}
				var row = $("#template-menu").contents().clone()[3];
				$(menu).append($(row));
			}
		//menu for mobile
		data.data.forEach(function(obj){
			var row_mobile = $("#template-menu-mobile").contents().clone()[1];
			$(row_mobile).find("a").text(obj.name);
			$(row_mobile).find("a").attr('data-filter', obj.id);
			$(menu_mobile).append($(row_mobile));
		}); 
		}
	});
}
//function buildFood
function buildFood(url,idStore,page){
	$.ajax({
		type: 'GET',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: url,
		data:{idStore:idStore,page:page},
		success: function (data) {
			console.log(data);
			var food = $(".list-food");
			_numberPage = data.data.last_page;
			data.data.data.forEach(function(obj){
				var row = $("#template-food").contents().clone();
				$(row).find(".view-detail").attr('src',obj.src);
				$(row).find(".block2").attr('data-id',obj.id);
				$(row).find(".food-items-name").text(obj.name);
				$(row).find(".food-items-price").text(obj.price);
				$(food).append($(row));
			});
		}
	});
}
//add item to cart
$("body").on("click",".add_to_cart",function(e){
	e.preventDefault();
	// localStorage.removeItem("cart_items");
	//check local storage
	if (typeof(Storage) !== "undefined") {
    	var image = $(this).siblings("img").attr("src");
    	var parent = $(this).parent("div.food-image");
    	var id = $(parent).parent("div.block2").data("id");
    	var food_content = $(parent).siblings("div.food-content");
    	var name = $(food_content).find("a.food-items-name").text();
    	var price = parseInt($(food_content).find("span.food-items-price").text());
    	var obj = {id:id,image:image,name:name,price:price,quantity:quantity};
    	if (localStorage.cart_items) {
    		cart_items = JSON.parse(localStorage.cart_items);
    		var cart_index = cart_items.findIndex(item => item.id === obj.id);
    		if (cart_index<0) {
    			cart_items.push(obj);
			}else{
				cart_items[cart_index].quantity++;
			}
			sendItem(cart_items);
			localStorage.cart_items = JSON.stringify(cart_items);
        } else {
        	var cart_index = cart_items.findIndex(item => item.id === obj.id);
        	if (cart_index<0) {
    			cart_items.push(obj);
			}else{
				cart_items[cart_index].quantity++;
			}
			sendItem(cart_items);
            localStorage.cart_items = JSON.stringify(cart_items);
        }
	} else {
		alert('Sr we have some errors, please try againt!');
	}
});
//function send icon to cart
function sendItem(obj){
	var cart = $('.header-cart-wrapitem');
	$(cart).empty();
	obj.forEach(function(item){
		var row = $('#template-cart').contents().clone();
		$(row).find(".header-cart-item-name").text(item.name);
		$(row).find(".num-product").val(item.quantity);
		$(row).find(".header-cart-item-img img").attr("src",item.name);
		$(row).find(".header-cart-item-info").text(item.price);
		$(row).find(".wrap-num-product").attr('data-id',item.id);
		$(cart).append($(row));
	});
}
//function show cart
$(document).on("click",".js-show-cart",function(){
	if (localStorage.cart_items) {
		cart_items = JSON.parse(localStorage.cart_items);
		sendItem(cart_items);
	} else {
		$('.header-cart-wrapitem').text("Your cart is empty");
	}
})
//function change quantity item
$(document).on('click','.btn-num-product-down', function(){
	var numProduct = Number($(this).next().val());
	if(numProduct > 0) {
		numProduct--;
		$(this).next().val(numProduct);
		var index = $(this).parent('div.wrap-num-product').data('id');
		var cart_index = cart_items.findIndex(item => item.id === index);
		cart_items[cart_index].quantity--;
		localStorage.cart_items = JSON.stringify(cart_items);
	}
});

$(document).on('click','.btn-num-product-up', function(){
	var numProduct = Number($(this).prev().val());
	numProduct++;
	$(this).prev().val(numProduct);
	var index = $(this).parent('div.wrap-num-product').data('id');
	var cart_index = cart_items.findIndex(item => item.id === index);
	cart_items[cart_index].quantity++;
	localStorage.cart_items = JSON.stringify(cart_items);
});
$(document).on("change","input.num-product",function(){
	var numProduct = $(this).val();
	var index = $(this).parent('div.wrap-num-product').data('id');
	var cart_index = cart_items.findIndex(item => item.id === index);
	cart_items[cart_index].quantity= numProduct;
	localStorage.cart_items = JSON.stringify(cart_items);
})
//clear cart item
$(document).on("click","span.delete-food-cart",function(){
	$.confirm({
		title         : '<p class="text-warning">Warning</p>',
		icon          : 'fa fa-exclamation-circle',
		boxWidth      : '30%',
		useBootstrap  : false,
		type          :"orange",
		closeIcon     : true,
		closeIconClass: 'fa fa-close',
		content       : "Are You Sure? This Food Item Will Be Deleted!",
		buttons       : {
			Save: {
				text    : 'OK',
				btnClass: 'btn btn-primary',
				action  : function (){
					$(this).parents("li.header-cart-item").remove();
				}
			}
		}
	});
})