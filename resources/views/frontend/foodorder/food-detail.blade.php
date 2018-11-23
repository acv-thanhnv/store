<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!--===============================================================================================-->	
	<base href="{{asset('')}}">
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/fonts/linearicons-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/animate.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/slick.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/util.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/main.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/iziModal.min.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/customer-food-detail.css">
	<style type="text/css">
	.disabled{
		cursor: not-allowed;
		filter: alpha(opacity=65);
		-webkit-box-shadow: none;
		box-shadow: none;
		opacity: .65;
	}
	.item_price,.js-name-detail,.js-addcart-detail,.item_description{
		font-family: "Times New Roman", Times, serif;
	}
	</style>
</head>
<body>
<!-- Modal1 -->
<div class="wrap-modal1 js-modal1">
	<div class="container">
		<div class="bg0 p-t-30 p-lr-15-lg how-pos3-parent">
			<button class="hide-modal">
				<img src="frontend/FoodOrder/images/icon-close2.png" alt="CLOSE">
			</button>
			<div class="row">
				<div class="col-md-6 col-lg-7 p-t-9">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
						
							<div class="slick3 gallery-lb">
							<!--Image Detail-->
								<div class="item-slick3" data-thumb="{{$foodDetail->src}}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{$foodDetail->src}}" alt="IMG-PRODUCT" class="slide-image">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{$foodDetail->src}}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							</div>
							<!--Neu muon co nhieu anh thi trong entities them thuoc tinh anh detail-->
						</div>
					</div>
				</div>
				
				<div class="col-md-6 col-lg-5 items-info" data-id ='{{$foodDetail->id}}' data-src='{{$foodDetail->src}}'>
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<!--Food's Name-->
						<h4 class="mtext-105 cl2 js-name-detail p-b-14 item_name">{{$foodDetail->name}}</h4>
						<!--Price-->
						<span class="mtext-106 cl2 item_price" data-price='{{$foodDetail->price}}'>
							{{$foodDetail->price}} Đồng
						</span>
						<!--Detail-->
						<p class="mtext-106 cl3 p-t-15 item_description">
							{{$foodDetail->description}}
						</p>
						
						<!--  -->
						<div class="p-t-33 modal-cart-payment">
							<div class="flex-w flex-r-m p-b-10">
							<div class="flex-w flex-r-m p-b-10 div1">
								<div class="size-204 flex-w flex-m respon6-next div2">
									<div class="wrap-num-product flex-w m-r-20 m-tb-10 div3">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m disabled">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button class="flex-c-m stext-101 cl0 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
										Chọn món
									</button>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
</body>
</html>
<!--===============================================================================================-->	
<script src="frontend/FoodOrder/js/jquery-3.2.1.min.js"></script>
<!--Thay doi so luong mon an-->
<script src="frontend/FoodOrder/js/animsition.min.js"></script>
<script src="frontend/FoodOrder/js/popper.min.js"></script>
<script src="frontend/FoodOrder/js/bootstrap.min.js"></script>
<!--Slideshow food-->
<script src="frontend/FoodOrder/js/slick.min.js"></script>
<script src="frontend/FoodOrder/js/slick-custom.js"></script>
<!--Show large popup-->
<script src="frontend/FoodOrder/js/jquery.magnific-popup.min.js"></script>
<script>
	$('.gallery-lb').each(function() { // the containers for all your galleries
		$(this).magnificPopup({
	        delegate: 'a', // the selector for gallery item
	        type: 'image',
	        gallery: {
	        	enabled:true
	        },
	        mainClass: 'mfp-fade'
	    });
	});
	$(document).on("click",".hide-modal",function(e){
		parent.$("#food-detail").iziModal("close");
	});
	//function add to cart
	$(document).on("click",'.js-addcart-detail',function(){
		var items_info  = $(this).parents('.items-info');
		var entities_id = $(items_info).data("id");
		var name        = $(items_info).find(".item_name").text();
		var src         = $(items_info).data("src");
		var price       = $(items_info).find(".item_price").data('price');
		var description = $(items_info).find(".item_description").text();
		var quantity    = Number($(this).siblings(".wrap-num-product").find("input.num-product").val());
		var obj = {
    		entities_id:entities_id,src:src,name:name,price:price,
    		quantity:quantity,status:0,status_name:'Ready to order',
    		cooked:0
    	};
    	//show alert change
		parent.showAlert();
    	if (localStorage.cart_items) {//check if isset local storage
    		parent.cart_items = JSON.parse(localStorage.cart_items);
    		var cart_index = parent.cart_items.findIndex(item => item.entities_id === obj.entities_id);
    		if (cart_index<0) {//neu ko ton tai id va status
    			parent.cart_total++;
    			parent.cart_items.push(obj);
			}else{
				if(parent.cart_items[cart_index].status===1){//check if food have been orderd
					parent.cart_items[cart_index].status = 0.5;
					parent.cart_items[cart_index].status_name = 'Processing';
				}
				parent.cart_items[cart_index].quantity = parseInt(parent.cart_items[cart_index].quantity)+parseInt(obj.quantity);
			}
			parent.sendItem(parent.cart_items);
            localStorage.cart_items = JSON.stringify(parent.cart_items);
        }else {
        	var cart_index = parent.cart_items.findIndex(item => item.entities_id === obj.entities_id);
        	if (cart_index<0) {
        		parent.cart_total++;
    			parent.cart_items.push(obj);
			}else{
				parent.cart_items[cart_index].quantity++;
			}
			parent.sendItem(parent.cart_items);
            localStorage.cart_items = JSON.stringify(parent.cart_items);
        }
        //change total items of cart
        parent.$(".js-show-cart").attr("data-notify",parent.cart_total);
        //Close modal
        parent.$('#food-detail').iziModal('close');
	});
	//[ +/- num product ]*/
    $(document).on('click','.btn-num-product-down', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct >1){//if num product ==1 not allow to down
			numProduct = numProduct-1;
			$(this).next().val(numProduct);
			if(numProduct===1){
				$(this).addClass('disabled');
			}
		}
    });
    $(document).on('click','.btn-num-product-up', function(){
        var numProduct = Number($(this).prev().val());
        numProduct = numProduct+1;
        $(this).prev().val(numProduct);
        if(numProduct>1){
			$(this).siblings('.btn-num-product-down').removeClass('disabled');
		}
    });
    $(document).on('keyup','input.num-product', function(){
        var numProduct = Number($(this).val());
        if(numProduct===1){
        	$(this).siblings('.btn-num-product-down').addClass('disabled');
        }else{
        	$(this).siblings('.btn-num-product-down').removeClass('disabled');
        }
    });
</script>
<script src="frontend/FoodOrder/js/main.js"></script>
<script src="frontend/FoodOrder/js/iziModal.min.js"></script>