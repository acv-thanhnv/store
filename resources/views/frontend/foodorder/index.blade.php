<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<base href="{{asset('')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="frontend/FoodOrder/js/jquery-3.2.1.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/animsition.min.css">
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/util.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/main.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/iziModal.min.css">
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/default.css" />
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/component.css" />
	<!--Toast css-->
	<link rel="stylesheet" type="text/css" href="css/toast.css">
	<!--Jquery confirm -->
	<link rel="stylesheet" type="text/css" href="css/lib/jquery-confirm.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/customer.css">
<!--===============================================================================================-->
	<script src="frontend/FoodOrder/js/modernizr.custom.js"></script>
</head>
<body class="animsition">
	<div id="idStore" data-id="{{$idStore}}" style="display: none"></div>
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					<!-- Logo desktop -->		
					<a href="#" class="logo">
						Gem's Store
					</a>
					<!-- Catogery desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="index.html">Home</a>
								<ul class="sub-menu">
									<li><a href="index.html">Menu 1</a></li>
									<li><a href="home-02.html">Menu 2</a></li>
									<li><a href="home-03.html">Menu 3</a></li>
								</ul>
							</li>

							<li>
								<a href="product.html">Deal</a>
							</li>

							<li class="label1" data-label1="hot">
								<a href="shoping-cart.html">Top 10 Foods</a>
							</li>

							<li>
								<a href="about.html">About</a>
							</li>

							<li>
								<a href="contact.html">Contact</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="">
					Gem's Store
				</a>
			</div>
			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href="index.html">Home</a>
					<ul class="sub-menu-m">
						<li><a href="index.html">Menu 1</a></li>
						<li><a href="home-02.html">Menu 2</a></li>
						<li><a href="home-03.html">Menu 3</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="product.html">Deal</a>
				</li>

				<li>
					<a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Top 10 Foods</a>
				</li>

				<li>
					<a href="about.html">About</a>
				</li>

				<li>
					<a href="contact.html">Contact</a>
				</li>
			</ul>
		</div>
	</header>
	<!--End Header-->
	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-15">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll p-t-10 p-r-10">
				<div class="cart-items" >
					<ul class="header-cart-wrapitem w-full">
					</ul>
					<div class="alert alert-warning alert-change dis-none" style="padding: .2rem 1.25rem">
						<strong>Warning!</strong> Bạn vừa cập nhập giỏ hàng, click <a class="btn btn-primary btn-sm btn-order">Order</a> để cập nhập món ăn 
					</div>
				</div>
				<div class="w-full cart-total p-t-5 row" style="margin-left: 0px;">
					<div class="col-lg-6 col-12 left">
						<span class="note fa fa-pencil-square-o">Note</span>
						<div class="w-full p-t-5 p-b-10 select-table">
							<label>Table:</label>
							<select class="form-control" id="table">
								<option>--Table--</option>
								@foreach($arrTable as $obj)
								<option value="{{$obj->id}}">{{$obj->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-12 right">
						<div class="total-money"></div>
						<div style="text-align: center" class="p-b-10 m-t-10">
							<button class="btn btn-danger btn-pay disabled">
								<i class="fa fa-paypal"></i> Pay
							</button>
							<button class="btn btn-primary btn-order">
								<i class="fa fa-paper-plane-o"></i> Order
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Product -->
	<section class="bg0 p-b-140 content">
		<!--Template show errors-->
		<div id="template-errors" class="dis-none">
			<div>
				<span class="fa fa-wifi"></span>
				<p>
					Cannot Connect to a Local Network
				</p>
				<div class="error-message">
					Please sure you have connect internet, check your connection and refresh page
				</div>
			</div>
		</div>
		<div class="container">
			<!--============== -->
			<div class="flex-w flex-sb-m menu-type row" style="margin: 0px">
				<!-- Filter For Mobile -->
				<div class="filter-food" style="position: relative;width:100%">
					<div class="dis-none panel-filter p-t-10">
						<div class="wrap-filter bg6 row p-lr-10 form-group">
							<div class="col-md-4 col-lg-4 col-sm-4 col-6 p-lr-5">
								<label>Sort By</label>
								<select class="form-control" id="sort-by">
									<option value="">Default</option>
									<option value="name">Name</option>
									<option value="lth">Price:Low to High</option>
									<option value="htl">Price:High to Low</option>
									<option value="other">Price:Other</option>
								</select>
							</div>
							<div class="col-md-4 col-lg-4 col-sm-4 col-6 p-lr-5">
								<label>Price</label>
								<select class="form-control" id="price" disabled="">
									<option value="">All</option>
									<option value="l50">Lower 50.000</option>
									<option value="50-100">50.000-100.000</option>
									<option value="100-300">100.000-300.000</option>
									<option value="300h">300.000 and Higher</option>
								</select>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-4 filter-search">
								<button class="btn btn-danger form-control btn-filter">Filter</button>
							</div>
						</div>
					</div>
				</div>
				<!--Desktop catogery-->
				<div class="flex-w flex-l-m filter-tope-group m-tb-10 menu-group-desktop">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-20 m-tb-5 how-active1 menu-items" data-filter="">
						All Foods
					</button>
				</div>
				<!--Mobile catogery-->
				<div class="flex-c-m p-lr-0 catogery col-md-2 col-sm-2 col-1">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="btn-show-catogery dl-trigger	">
							<i class="fa fa-tasks"></i>
						</button>
						<ul class="dl-menu">
							
						</ul>
					</div>
				</div>
				<div class="col-md-7 p-lr-0 col-7 col-sm-7 search-food">
					<input type="text" class="form-control" placeholder="&#xF002; Search..." style="font-family:Arial, FontAwesome" id="search">
					<i class="fa fa-times-circle-o clear-textbox dis-none"></i>
				</div>
				<div class="flex-w flex-m p-lr-0 filter col-md-3 col-sm-2 col-3">
					<div class="flex-c-m stext-106 cl6 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-filter">
						<button class="btn btn-default">
							<i class="fa fa-filter"></i>
							<span class="text-filter">Filter</span>
						</button>
					</div>
					<div class="flex-c-m stext-106 cl6 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<button class="btn btn-default">
							<i class="fa fa-search"></i>
							<span class="text-filter">Search</span>
						</button>
					</div>
					<div class="cart-mobile-fixed dis-none icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-7 icon-header-noti  js-show-cart" data-notify="20">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
				</div>
				
				<!-- Search product -->
				<div class="panel-search w-full p-t-10 p-b-15 dis-none">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input autofocus="" id="search-product" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search...">
					</div>	
				</div>
			</div>

			<div class="row list-food">
			</div>
			<!-- show status -->
            <div class="col-12 load-more">
                <div class="infinite-scroll-request">
                  <img src="common_images/loading.gif">
                </div>
            </div>
            <div id="no-data" class="dis-none">
            	<div class="content-no-data">
            		<img src="common_images/no-data.png" style="width: 250px">
            		<p class="no-data-message">Opp, no data found</p>
            	</div>
            </div>
		</div>
	</section>
	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>
					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Morning Menu
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Afternoon Menu
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Dinner Menu
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Special Menu
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Help
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Track Order
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Returns 
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shipping
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQs
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in store at 7th floor, 36 Hoàng Cầu St, Đống Đa, Hà Nội or call us on (+84) 973074801
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@gmail.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>
			<!--Payment-->
			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="frontend/FoodOrder/images/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="frontend/FoodOrder/images/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="frontend/FoodOrder/images/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="frontend/FoodOrder/images/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="frontend/FoodOrder/images/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
				</p>
			</div>
		</div>
	</footer>
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>
	<!--Show food detail-->
	<div id="food-detail">	
	</div>
	<!--Template Menu-->
	<div id="template-menu" style="display: none">
		<button class="stext-275 cl6 hov1 bor3 trans-04 m-r-20 m-tb-5 menu-items" data-filter="">
		</button>
		<div class="dropdown more stext-275 cl6 hov1 bor3 trans-04 m-r-20 m-tb-5">
			<a class="dropdown-toggle"  data-toggle="dropdown">More
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
			</ul>
		</div>
	</div>
	<!--Template menu mobile -->
	<div id="template-menu-mobile">
		<li>
			<a href="#" class="menu-items"></a>
		</li>
	</div>
	<!--Template menu show more-->
	<div id="template-menu-show" style="display: none">
		<li class="li-items">
			<a href="#" class="dropdown-item menu-items"></a>
		</li>
	</div>
	<!--Template food -->
	<div id="template-food" style="display: none">
		<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2 col-xl-2 food-item isotope-item watches" title="Food's Name Title">
			<!-- Block2 -->
			<div class="block2">
				<div class="block2-pic hov-img0 food-image">
					<img src="" alt="IMG-PRODUCT" class="js-show-modal1 view-detail">

					<a href="" class="block2-btn flex-c-m stext-103 cl2 bg0 bor2 hov-btn1 p-lr-15 trans-04 add_to_cart">
						<i class="zmdi zmdi-shopping-cart cart-desktop">
						</i> Chọn món
					</a>
				</div>

				<div class="block2-txt flex-w flex-t p-t-14 food-content">
					<div class="block2-txt-child1 flex-col-l">
						<a class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 food-items-name">
						</a>

						<span class="stext-105 cl3 food-items-price">
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Template Cart-->
	<div id="template-cart" style="display: none">
		<li class="header-cart-item flex-w flex-t m-b-10">
			<div class="header-cart-item-img">
				<img alt="IMG">
			</div>

			<div class="header-cart-item-txt">
				<span  class="header-cart-item-name hov-cl1 trans-04">
					White Shirt Pleat aaaaaaaaaaaaaaaaaaaaaaaaa
				</span>
				<div class="wrap-num-product">
					<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
						<i class="fs-16 zmdi zmdi-minus"></i>
					</div>

					<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" min="0">

					<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
						<i class="fs-16 zmdi zmdi-plus"></i>
					</div>
					<span class="header-cart-item-info flex-c-m">
						x 20k
					</span>
					<span class="delete-food-cart">
						<button class="btn btn-danger btn-sm">
							<i class="fa fa-times"></i>
						</button>
					</span>
				</div>
				<div class="progress">
					<div class="progress-bar" data-status='0' style="width:50%;height: 15px">
					</div>
				</div>
				<div>
					Cooked:<span data-cooked = '0' class="cooked">0</span>
				</div>
			</div>
		</li>
	</div>
	<!--template no data-->
</body>
</html>
<script src="frontend/FoodOrder/js/animsition.min.js"></script>
<script src="frontend/FoodOrder/js/popper.min.js"></script>
<script src="frontend/FoodOrder/js/bootstrap.min.js"></script>
<script src="frontend/FoodOrder/js/iziModal.min.js"></script>
<script src="frontend/FoodOrder/js/jquery.dlmenu.js"></script>
<!--Filter Food-->
<script src="frontend/FoodOrder/js/isotope.pkgd.min.js"></script>
<script src="frontend/FoodOrder/js/main.js"></script>
<script src="frontend/FoodOrder/js/lazyload.js"></script>
<!--Jquery confirm -->
<script src="js/lib/jquery-confirm.js"></script>
<!--Pusher-->
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<!--Toast JS-->
<script type="text/javascript" src="js/toast.js"></script>
<!--Number Format-->
<script src="js/jquery.number.min.js"></script>
<!--Custom JS-->
<script src="frontend/FoodOrder/js/custom.js"></script>
<script type="text/javascript">
	var numberMenu   = '{{App\Core\Common\CutomerConst::numberMenu}}';
	var access_token = '{{$access_token}}';
	var idStore      = '{{$idStore}}';
	//function buildMenu
	$(document).ready(function(){
		if(localStorage.access_token){
			access_token = localStorage.access_token;
		}else {
			localStorage.access_token = access_token;
		}
		//set timeout local storage
		var now = new Date().getTime();	
		var hour = '{{\App\Core\Common\CutomerConst::hour}}';
		if(now-localStorage.time > hour*60*60*1000){
			localStorage.clear();
			location.reload();
		}
		$("#table").select2();
		var idStore = {!! $idStore !!};
		if(localStorage.orderId){
			$("#table").prop("disabled",true);//disable if user have order
			$(".btn-pay").removeClass('disabled');//disable if user have order
		}
		if(localStorage.idStore){
			if(localStorage.idStore!=idStore){
				localStorage.clear();
				localStorage.access_token = access_token;
			}
		}
		//show alert change
		checkAlert();
		//order channel name
		var channel_name = access_token+'_'+'{{\App\Core\Common\OrderConst::OrderStatusEventName}}';
		//food channel name
		var food_channel_name = access_token+'_'+'{{\App\Core\Common\FoodStatusValue::FoodStatusEvent}}';
		setTable();
		countCart();//dem va hien thi so item trong gio hang
		getFoodByMenu(idStore,"{{route('getFood')}}");
		search(idStore,"{{route('getFood')}}");//search food
		filter(idStore,"{{route('OrderBy')}}");//filter food
		buildMenu("{{route('Menu')}}",idStore,numberMenu);
		buildFood("{{route('getFood')}}",idStore,1,null,null,null);
		lazyLoad("{{route('getFood')}}","{{route('OrderBy')}}",idStore);
		Order("{{route('sendOrder')}}",idStore,access_token);
		PusherEvent(channel_name,food_channel_name);
		deleteCartItem('{{route("deleteCartItem")}}');//delete item from cart
	})

	//pusher event
	function PusherEvent(channel_name,food_channel_name){
		var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
                cluster: '{{env('PUSHER_APP_CLUSTER')}}',
                encrypted: true
            });
		//food status event
		var food_channel = pusher.subscribe(food_channel_name);
		var food_eventName = '{{\App\Core\Common\FoodStatusValue::FoodStatusEvent}}';
		food_channel.bind(food_eventName,function(data){
			FoodStatus(data.idDetail,data.cooked,data.foodStatus,data.foodStatusName);
		});
		//order status event
	    var channel = pusher.subscribe(channel_name);
	    var eventName = "{{\App\Core\Common\OrderConst::OrderStatusEventName}}";
        channel.bind(eventName, function(data){
        	//nếu ở order xóa order thì clear all local storage
        	if(data.has_delete==1){
        		//xóa giỏ hàng, đưa về rỗng, kể cả lúc khách đang mở giỏ hàng
        		$('.header-cart-wrapitem').empty();
        		$('.header-cart-wrapitem').html("<img src='common_images/empty_cart.gif' class='no-cart-items'>");
        		$(".total-money").text("Total: 0 đ");
        		$(".btn-pay").addClass('disabled');
        		$(".js-show-cart").attr("data-notify",0);
				localStorage.removeItem('cart_items');
				localStorage.removeItem('time');
				localStorage.removeItem('orderId');
				localStorage.removeItem('table');
				cart_items = [];//set biến cart items về rỗng
				cart_total = 0;
				$("#table").prop("disabled",false);//enable user choose table
				//thông báo order đã được thanh toán thành công
				notify('Success','success','Order của bạn đã được thanh toán thành công! Hi vọng bạn hài lòng với bữa ăn','#437F2C');
        	}else{
				localStorage.removeItem(cart_items);
				cart_items = data.arrOrder;
				cart_total = data.arrOrder.length;
				//nếu có roll back thì lưu lại table và orderId
				if(data.has_rollBack=='{{\App\Core\Common\OrderConst::has_rollBack}}'){
					//set table fixed
					$('#table').val(data.order.location_id);
					$('#table').trigger('change');
					localStorage.orderId = data.order.id;//set orderId
					localStorage.table = data.order.location_id;//set table for local
					$("#table").prop("disabled",true);//disable if user have order
					$('.btn-pay').removeClass('disabled');
				}
				//change total items of cart
				$(".js-show-cart").attr("data-notify",cart_total);
				localStorage.cart_items = JSON.stringify(cart_items);
				//nếu order được xác nhận và chế biến
				if(data.orderStatus=='{{\App\Core\Common\OrderStatusValue::Process}}'){
					notify('Success','success','Món ăn của bạn đang được chế biến!','#437F2C');
				}

        	}
        });
	}
	//fixed cart for mobile
	$( window ).scroll(function() {
		var height = $(".wrap-header-mobile" ).height()+$(".menu-type" ).height();
		//screen mobile, if have menu, height += height menu;
		if ($("div.menu-mobile:visible").length===1) {
			height+= $("div.menu-mobile:visible" ).height();
		}
		var heightScroll = $(this).scrollTop();
		var contentHight = $(document).height()-$("footer").height();
		if(heightScroll>height && heightScroll< contentHight ){
			$(".menu-type").addClass("fixed-catogery");
			$(".menu-type .js-show-cart").css("display","block");
		}else{
			$(".menu-type").removeClass("fixed-catogery");
			$(".menu-type .js-show-cart").css("display","none");
		}
	});
	//show modal food detail
	$(document).on('click', '.view-detail', function(event) {
		$('#food-detail').iziModal('open');
		var win_width = $(window).width();
		if(win_width<1000){
			$('#food-detail').iziModal('setFullscreen', true);
		}else{
			$('#food-detail').iziModal('setFullscreen', false);
		}
	});
	$('#food-detail').iziModal(
	{
		onOpening: function(modal){
			var entities_id =$(event.target).parents(".block2").data("id");//get Id, get button then get id
			$(".iziModal-iframe").attr("src","{{route('FoodDetail')}}?entities_id="+entities_id);
			//set url iframe
		},
		onClosed: function(modal){
			$(".iziModal-iframe").attr("src","");
		},
		width          : 900,
		arrowKeys      :true,
		pauseOnHover   :true,
		overlayColor   : 'rgba(0, 0, 0, 0.2)',
		navigateCaption:true,
		bodyOverflow   : true,
		radius         :15,
		transitionIn   :"bounceInDown",
		transitionOut  :"bounceOutUp",
		arrowKeys      :true,
		iframe         :true,
		iframeURL      :""
	});
	//prevent scroll when cart is opened
	$(document).on("click","div.js-show-cart",function(e){
		$("body").css("overflow","hidden");
		$("body").removeAttr('id');
	});
	$(document).on("click","div.js-hide-cart",function(e){
		$("body").css("overflow","auto");
	});
	$("body").on('click','.btn-show-catogery',function(){
		$("#mySidenav").toggleClass('show');
	});
	$(function() {
		$( '#dl-menu' ).dlmenu();
	});
	//show clear text-box content if content more than 1 word
	$("body").on("keyup","#search",function(){
		var length = $(this).val().length;
		if(length>0){
			$(this).siblings("i").removeClass('dis-none');
		}else{
			$(this).siblings("i").addClass("dis-none");
		}
	})
	//clear content of input search
	$("body").on("click",".clear-textbox",function(){
		$("#search").val("");
		$(this).addClass("dis-none");
		$("#search").focus();
	})
</script>