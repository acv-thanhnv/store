var _page =1,_numberPage,quantity=1,cart_items=[];
var cart_total=0,status=0,_menu_id,_key,_sort_by,_price;
$(".infinite-scroll-request").hide();
//function lazy load food
function lazyLoad(url,urlOrder,idStore){
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
				if(_sort_by==null){
					buildFood(url,idStore,_page,_menu_id,_key,null,null);
				}else {
					buildFood(urlOrder,idStore,_page,_menu_id,_key,_sort_by,_price);
				}
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
			var row_mobile = $("#template-menu-mobile").contents().clone()[1];
			$(row_mobile).find("a").text('All');
			$(row_mobile).find("a").attr('data-filter','');
			$(row_mobile).find("a").addClass('how-active1');
			$(menu_mobile).append($(row_mobile));
		//menu for mobile
		data.data.forEach(function(obj){
			var row_mobile = $("#template-menu-mobile").contents().clone()[1];
			$(row_mobile).find("a").text(obj.name);
			$(row_mobile).find("a").attr('data-filter', obj.id);
			$(menu_mobile).append($(row_mobile));
		}); 
		},
		error: function(jqXHR){
			$(".content .container").empty();
			$("#template-errors").removeClass('dis-none');
			console.log(jqXHR);
		}
	});
}
//function buildFood
function buildFood(url,idStore,page,menu_id,key,orderKey,price){
	$.ajax({
		type: 'GET',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: url,
		data:{
			idStore:idStore,page:page,menu_id:_menu_id,
			key:_key,sortBy:_sort_by,price:_price
		},
		success: function (data) {
			_numberPage = data.data.last_page;
			if(data.data.data.length===0){
				$("#no-data").removeClass("dis-none");
			}else {
				$("#no-data").addClass("dis-none");
				var food = $(".list-food");
				data.data.data.forEach(function(obj){
					var row = $("#template-food").contents().clone();
					$(row).find(".view-detail").attr('src',obj.src);
					$(row).find(".block2").attr('data-id',obj.id);
					$(row).find(".food-items-name").text(obj.name);
					$(row).find(".food-items-price").text(obj.format_price);
					$(row).find(".food-items-price").attr('price',obj.price);
					$(food).append($(row));
				});
			}
		},
		error: function(jqXHR){
			_page= _page--;
			$(".content .container").empty();
			$("#template-errors").removeClass('dis-none');
		}
	});
}
//add item to cart
$(document).on("click",".add_to_cart",function(e){
	e.preventDefault();
	//check local storage
	if (typeof(Storage) !== "undefined") {
    	var src = $(this).siblings("img").attr("src");
    	var parent = $(this).parent("div.food-image");
    	var entities_id = $(parent).parent("div.block2").data("id");
    	var food_content = $(parent).siblings("div.food-content");
    	var name = $(food_content).find("a.food-items-name").text();
    	var price = parseInt($(food_content).find("span.food-items-price").attr('price'));
    	//set time out for cart
		var time = new Date().getTime();
		localStorage.time = time;
		//show alert change
		showAlert();
    	var obj = {
    		entities_id:entities_id,src:src,name:name,price:price,
    		quantity:quantity,status:0,status_name:'Ready to order',
    		cooked:0
    	};
    	if (localStorage.cart_items) {//check if isset local storage
    		cart_items = JSON.parse(localStorage.cart_items);
    		var cart_index = cart_items.findIndex(item => item.entities_id === obj.entities_id);
    		if (cart_index<0) {//neu ko ton tai id va status
    			cart_total++;
    			cart_items.push(obj);
			}else{
				if(cart_items[cart_index].status>=1){//check if food have been orderd
					cart_items[cart_index].status = 0;
					cart_items[cart_index].status_name = 'Processing';
				}
				cart_items[cart_index].quantity++;
			}
			sendItem(cart_items);
            localStorage.cart_items = JSON.stringify(cart_items);
        }else {
        	var cart_index = cart_items.findIndex(item => item.entities_id === obj.entities_id);
        	if (cart_index<0) {
        		cart_total++;
    			cart_items.push(obj);
			}else{
				cart_items[cart_index].quantity++;
			}
			sendItem(cart_items);
			localStorage.idStore = $("#idStore").data("id");
            localStorage.cart_items = JSON.stringify(cart_items);
        }
        //change total items of cart
        $(".js-show-cart").attr("data-notify",cart_total);
	} else {
		$.alert({
			title: 'Error!',
			content: 'Sorry, your brower do not suppost this technology!',
		});
	}
});
//function send icon to cart
function sendItem(obj){
	var cart = $('.header-cart-wrapitem');
	var percent_bar;
	$(cart).empty();
	obj.forEach(function(item){
		var row = $('#template-cart').contents().clone();
		$(row).find(".header-cart-item-name").text(item.name);
		$(row).find(".num-product").val(item.quantity);
		//check if num-product ==1 no allow to down num-product
		if(item.quantity===1){
			$(row).find('.btn-num-product-down').addClass('disabled');
		}
		$(row).find(".header-cart-item-img img").attr("src",item.src);
		$(row).find(".header-cart-item-info").text($.number(item.price, 0, ',' ));
		$(row).find(".wrap-num-product").attr('data-id',item.entities_id);
		$(row).find(".progress-bar").text(item.status_name);
		$(row).find(".cooked").attr('data-cooked',item.cooked);
		//check cooked
		if(item.cooked>0){
			$(row).find('.cooked').text(item.cooked);
			$(row).find('.cooked').attr('data-cooked',item.cooked);
		}
		//set progess bar
		switch(item.status){
			case 0: percent_bar = 45;
					break;
			case 0.5 : percent_bar = 50;
					break;
			case 1: percent_bar = 80;
					break;
			case 2: percent_bar = 100;
					break;
		}
		$(row).find(".progress-bar").css("width",percent_bar+"%");
		$(cart).append($(row));
	});
}
//function show cart
$(document).on("click",".js-show-cart",function(){
	//show alert if isset change
	checkAlert();
	if (localStorage.cart_items) {
		$('.no-cart-items').css('display', 'none');
		cart_items = JSON.parse(localStorage.cart_items);
		sendItem(cart_items);
		cal_total(cart_items);
	}
	if(cart_items.length==0){
		$(".total-money").text("Total: 0 đ");
		$('.header-cart-wrapitem').html("<img src='common_images/empty_cart.gif' class='no-cart-items'>");
	}
})
//function change quantity item
$(document).on('click','.btn-num-product-down', function(){
	var numProduct = Number($(this).next().val());
	var cooked = Number($(this).parents('.header-cart-item-txt').find('.cooked').data('cooked'));
	if(numProduct > 1) {//product must large than cooked
		if(numProduct>cooked){
			numProduct--;
			showAlert();
			if(numProduct===1){//if num product ==1 not allow to down
				$(this).addClass('disabled');
			}
			var index = $(this).parent('div.wrap-num-product').data('id');
			var cart_index = cart_items.findIndex(item => item.entities_id === index);
			$(this).next().val(numProduct);
			cart_items[cart_index].quantity--;
			if(cart_items[cart_index].status>=1){//check if food have been orderd
				cart_items[cart_index].status = 0;
				cart_items[cart_index].status_name = 'Processing';
			}
			cal_total(cart_items);
			localStorage.cart_items = JSON.stringify(cart_items);
		}else {
			notify('Error','error','Sorry, your food have beenn cooked, you cannot change quantity lower than cooked','#BE1E1E');
		}
	}
});

$(document).on('click','.btn-num-product-up', function(){
	var numProduct = Number($(this).prev().val());
	numProduct++;
	if(numProduct>1){//allow num product >1 to down 
			$(this).siblings(".btn-num-product-down").removeClass('disabled');
	}
	showAlert();//show alert change
	$(this).prev().val(numProduct);
	var index = $(this).parent('div.wrap-num-product').data('id');
	var cart_index = cart_items.findIndex(item => item.entities_id === index);
	cart_items[cart_index].quantity++;
	if(cart_items[cart_index].status>=1){//check if food have been orderd
		cart_items[cart_index].status = 0;
		cart_items[cart_index].status_name = 'Processing';
	}
	cal_total(cart_items);
	localStorage.cart_items = JSON.stringify(cart_items);
});
$(document).on("change","input.num-product",function(){
	var numProduct = $(this).val();
	var cooked = Number($(this).parents('.header-cart-item-txt').find('.cooked').data('cooked'));
	var index                       = $(this).parent('div.wrap-num-product').data('id');
	var cart_index                  = cart_items.findIndex(item => item.entities_id === index);
	if(numProduct>1){//allow num product >1 to down 
		$(this).siblings(".btn-num-product-down").removeClass('disabled');
	}else{
		$(this).siblings(".btn-num-product-down").addClass('disabled');
	}
	if(numProduct<cooked){//check how food have been cooked, if product less than cooked, not allow
		var message = 'Sorry but we have cooked '+cooked+' foods, so you can\'t reduct less than cooked';
		notify('Error','error',message,'#C42D2D');
		$(this).val(cart_items[cart_index].quantity);
	}else{
		cart_items[cart_index].quantity = numProduct;
		if(cart_items[cart_index].status>=1){//check if food have been orderd
			cart_items[cart_index].status = 0;
			cart_items[cart_index].status_name = 'Processing';
		}
		cal_total(cart_items);
		localStorage.cart_items = JSON.stringify(cart_items);
		showAlert();
	}
})
//clear cart item
function deleteCartItem(url){
	$(document).on("click","span.delete-food-cart",function(){
		var row = $(this).parents("li.header-cart-item");
		var index = $(row).find(".wrap-num-product").data("id");
		var orderId = localStorage.orderId;
		var cart_index = cart_items.findIndex(item => item.entities_id === index);
		var foodId = cart_items[cart_index].id;
		var cooked = cart_items[cart_index].cooked;
		$.confirm({
			title         : '<p class="text-danger">Warning</p>',
			icon          : 'fa fa-exclamation-circle',
			columnClass   : 'col-lg-5 col-md-8 col-12',
			type          : "red",
			closeIcon     : true,
			closeIconClass: 'fa fa-close',
			content       : "Are You Sure? This Food Item Will Be Deleted!",
			buttons       : {
				Save: {
					text    : 'OK',
					btnClass: 'btn btn-primary',
					action  : function (){
						if(typeof (foodId) !== 'undefined'){//nếu món đó đã có trong DB rồi thì mới ajax đi
							if(cooked===0){//neu mon do chua nau xong thi moi cho xoa
								$(row).remove();
								cart_items.splice(cart_index,1);
								cal_total(cart_items);
								localStorage.cart_items = JSON.stringify(cart_items);
								cart_total--;
								$(".js-show-cart").attr("data-notify",cart_total);
								notify('Success','success',"You food item have been deleted successfull!",'#437F2C');
								if(cart_total==0){
									$('.header-cart-wrapitem').html("<img src='common_images/empty_cart.gif' class='no-cart-items'>");
									localStorage.removeItem('hasAlert');
									hideAlert();
								}
								$.ajax({
									type: 'POST',
									headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									},
									url: url,
									data:{
										id:foodId,
										orderId:orderId
									},
									success: function (data) {
									},
									error:function(){
										notify('Error','error','Oh maybe something went wrong, please order againt!','#F4A950');
									}
								})
							}else{
								notify('Error','error','Sorry your food have been cooked, you cannot delete it','#DA3C3C');
							}
						}else{//nguoc lai thi xoa o local storage
							$(row).remove();
							cart_items.splice(cart_index,1);
							cal_total(cart_items);
							localStorage.cart_items = JSON.stringify(cart_items);
							cart_total--;
							if(cart_total==0){
								$('.header-cart-wrapitem').html("<img src='common_images/empty_cart.gif' class='no-cart-items'>");
								localStorage.removeItem('hasAlert');
								hideAlert();
							}
							$(".js-show-cart").attr("data-notify",cart_total);
							notify('Success','success',"You food item have been deleted successfull!",'#437F2C');
						}
				}
			},
			cancel: {
				text    : ' Cancel',
				btnClass: 'btn btn-default'
			}
		}
	});
})
}
//count cart item
function countCart(){
	if(localStorage.cart_items){
		var show_total = JSON.parse(localStorage.cart_items);
		cart_total = show_total.length;
	}
	$(".js-show-cart").attr("data-notify",cart_total);
}
//function calculate total
function cal_total(data){
	var total_money = 0;
	data.forEach(function(obj){
		var price = parseInt(obj.price);
		var quantity = parseInt(obj.quantity);
		var total = price*quantity;
		total_money += total;
	});
	$(".total-money").text("Total: "+$.number(total_money, 0, ',' )+' đ');
}
//function order
function Order(url,idStore,access_token){
	$(document).on("click",".btn-order",function(){
		var table       = $("#table").val();
		var orderId     =null;
		var discription = null;
		var cart_update = [];
		if(localStorage.cart_items){
			cart_items = JSON.parse(localStorage.cart_items);
		}
		cart_items.forEach(function(obj){
			if(obj.status == 0){
				cart_update.push(obj);
			}
		});
		if(localStorage.orderId){
			orderId = localStorage.getItem('orderId');
		}
		if(cart_update.length===0){
			$.alert({
				title         : '<p class="text-danger">Warning</p>',
				icon          : 'fa fa-exclamation-circle',
				columnClass   : 'col-lg-5 col-md-8 col-12',
				type          : "red",
				closeIcon     : true,
				closeIconClass: 'fa fa-close',
				content       : "Nothing to order!",
			});
		}else{
			$.ajax({
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			data:{
				cart_items:cart_update,
				idStore:idStore,
				table:table,
				discription:discription,
				orderId:orderId,
				access_token:access_token
			},
			success: function (data) {
				$('.js-panel-cart').removeClass('show-header-cart');//close cart
				notify('Success','success','Order của bạn đã được gửi đi chế biến thành công!','#2AB143');
				//set table fixed
				var table = $('#table').val();
				$("#table").prop("disabled",true);//disable if user have order
				localStorage.table = table;//set table for local
				localStorage.orderId = data;//set orderId for local
				$(".btn-pay").removeClass("disabled");
				//clear local alert change
				localStorage.removeItem('hasAlert');
				hideAlert();
			},
			error: function(jqXHR){
				notify('Error','error','Oh maybe something went wrong, please order againt!','#F4A950');
			}
		});
		}
	})
}
//function pay
function Pay(){
	$(document).on("click",".btn-pay",function(){
		if(localStorage.orderId){
			var orderId = localStorage.orderId;
			$.ajax({
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			data:{orderId},
			success: function (data) {
				notify('Success','success','Your bill is being paid!','#2AB143');
			},
			error: function(jqXHR){
				notify('Error','error','Oh maybe something went wrong, please try againt!','#F4A950');
			}
			});
		}
	});
}
//function set table
function setTable(){
	if(localStorage.table){
		$("#table").val(localStorage.table).trigger('change');
	}
}
//function show alert when food have change
function showAlert(){
	localStorage.hasAlert = 1;
	$(".cart-items").addClass("has-alert");
	$('.alert-change').removeClass('dis-none');
}
function hideAlert(){
	$(".cart-items").removeClass("has-alert");
	$('.alert-change').addClass('dis-none');
}
function checkAlert(){
	if(localStorage.hasAlert){
		$(".cart-items").addClass("has-alert");
		$('.alert-change').removeClass('dis-none');
	}
}
//show food by menu
function getFoodByMenu(idStore,url){
	$(document).on("click",'.menu-items',function(e){
		window.scrollTo(0,0);
		e.preventDefault();
		_menu_id = $(this).data("filter");
		_page    =1;
		_sort_by = null;
		_key     = null;
		_price   = null;
		$(".list-food").empty();
		//remove other menu items active and add active in this menu
		$('.menu-items').removeClass('how-active1');
		$(this).addClass('how-active1');
		buildFood(url,idStore,_page,_menu_id,null,null,null);
	});
}
//function search
function search(idStore,url){
	$(document).on('change','input[name="search-product"]',function(){
		$(".list-food").empty();
		_key     = $(this).val();
		_page    = 1;
		_menu_id = null;
		_sort_by = null;
		_price   =  null;
		buildFood(url,idStore,_page,null,_key,null,null);

	});
	//search for mobile
	$(document).on('change','#search',function(){
		$(".list-food").empty();
		_key     = $(this).val();
		_page    = 1;
		_menu_id = null;
		_sort_by = null;
		_price   =  null;
		buildFood(url,idStore,_page,null,_key,null,null);

	});
}
//event when change sort by filter
$(document).on("change","#sort-by",function(){
	var value = $(this).val();
	if(value=='other'){
		$("#price").prop("disabled",false);
	}else {
		$("#price").prop("disabled",true);
		$("#price").val("");
	}
});
//function filter
function filter(idStore,url){
	$(document).on("click",'.btn-filter',function(){
		window.scrollTo(0,0);
		$(".list-food").empty();
		_sort_by = $("#sort-by").val();
		_price   = $("#price").val();
		_page    = 1;
		_key     = null;
		_menu_id = null;
		buildFood(url,idStore,_page,null,null,_sort_by,_price);
	})
}
//function buid status food
function FoodStatus(idDetail,cooked,status,status_name){
	cart_items = JSON.parse(localStorage.cart_items);
	var cart_index = cart_items.findIndex(item => item.id === idDetail);
	cart_items[cart_index].cooked = cooked;
	cart_items[cart_index].status = status;
	cart_items[cart_index].status_name = status_name;
	sendItem(cart_items);
    localStorage.cart_items = JSON.stringify(cart_items);
    notify('Success','success','Món '+cart_items[cart_index].name+' đã nấu xong '+cooked,'#437F2C');
}
//function alert notify
function notify(headingContent,icon,content,bgColor){
	$.toast({
	    text: content,
	    heading: headingContent,
	    icon: icon,
	    showHideTransition: 'plain',
	    allowToastClose: true,
	    hideAfter: 5000,
	    bgColor:bgColor,
	    stack: 5,
	    position: 'top-right',
	    textAlign: 'left',
	    loader : true,
	    loaderBg: '#279056'
	});
}