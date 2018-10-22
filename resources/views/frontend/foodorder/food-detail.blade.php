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
</head>
<body>
<!-- Modal1 -->
<div class="wrap-modal1 js-modal1">
	<div class="container">
		<div class="bg0 p-t-50 p-b-30 p-lr-15-lg how-pos3-parent">
			<button class="hide-modal">
				<img src="frontend/FoodOrder/images/icon-close2.png" alt="CLOSE">
			</button>
			<div class="row">
				<div class="col-md-6 col-lg-7">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
						
							<div class="slick3 gallery-lb">
							<!--Image Detail-->
								<div class="item-slick3" data-thumb="frontend/FoodOrder/images/food1.jpg">
									<div class="wrap-pic-w pos-relative">
										<img src="frontend/FoodOrder/images/food1.jpg" alt="IMG-PRODUCT" class="slide-image">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="frontend/FoodOrder/images/food1.jpg">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="frontend/FoodOrder/images/food5.jpg">
									<div class="wrap-pic-w pos-relative">
										<img src="frontend/FoodOrder/images/food5.jpg" class="slide-image" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="frontend/FoodOrder/images/food5.jpg">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="frontend/FoodOrder/images/food3.jpg">
									<div class="wrap-pic-w pos-relative">
										<img class="slide-image" src="frontend/FoodOrder/images/food3.jpg" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="frontend/FoodOrder/images/food3.jpg">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-6 col-lg-5">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<!--Food's Name-->
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							Kim Bắp Chiên
						</h4>
						<!--Price-->
						<span class="mtext-106 cl2">
							$58.79
						</span>
						<!--Detail-->
						<p class="stext-102 cl3 p-t-23">
							Món ăn phổ biến của hầu hết sinh viên, được làm từ những nguyên liệu tự nhiên chứa đầy dinh dưỡng
						</p>
						
						<!--  -->
						<div class="p-t-33 modal-cart-payment">
							<div class="flex-w flex-r-m p-b-10">
							<div class="flex-w flex-r-m p-b-10 div1">
								<div class="size-204 flex-w flex-m respon6-next div2">
									<div class="wrap-num-product flex-w m-r-20 m-tb-10 div3">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button class="flex-c-m stext-101 cl0 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
										Add to cart
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
</script>
<script src="frontend/FoodOrder/js/main.js"></script>
<script src="frontend/FoodOrder/js/iziModal.min.js"></script>
<script type="text/javascript">
	$(document).on("click",".hide-modal",function(e){
		parent.$("#food-detail").iziModal("close");
	});
</script>