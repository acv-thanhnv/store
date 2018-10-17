<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<base href="{{asset('')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/FoodOrder/css/customer.css">
<!--===============================================================================================-->
	<script src="frontend/FoodOrder/js/modernizr.custom.js"></script>
</head>
<body class="animsition">
	
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
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
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
				<a href="index.html">
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
				<ul class="header-cart-wrapitem w-full">
					@for($i=1;$i< 10;$i++)
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="frontend/FoodOrder/images/food{{$i}}.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt">
							<span  class="header-cart-item-name hov-cl1 trans-04">
								White Shirt Pleat aaaaaaaaaaaaaaaaaaaaaaaaa
							</span>
							<div class="wrap-num-product">
								<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
									<i class="fs-16 zmdi zmdi-minus"></i>
								</div>

								<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

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
								<div class="progress-bar" style="width:50%;height: 10px"></div>
							</div>
						</div>
					</li>
					@endfor
				</ul>
				
				<div class="w-full cart-total p-t-5">
					<div class="left">
						<span class="note fa fa-pencil-square-o">Note</span>
						<textarea cols="20" class="form-control"></textarea>
					</div>
					<div class="right">
						<span class="total-money">Total: 100k</span>
						<div style="text-align: right" class="p-b-10 m-t-10">
							<button class="btn btn-primary btn-order">
								Order
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Product -->
	<section class="bg0 p-b-140 content">
		<div class="container">
			<!--============== -->
			<div class="flex-w flex-sb-m menu-type row" style="margin: 0px">
				<!-- Filter For Mobile -->
				<div class="filter-food" style="position: relative;width:100%">
					<div class="dis-none panel-filter p-t-10">
						<div class="wrap-filter bg6 row p-lr-10 form-group">
							<div class="col-md-4 col-lg-4 col-sm-4 col-6 p-lr-5">
								<label>Sort By</label>
								<select class="form-control">
									<option>Option 1</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								</select>
							</div>
							<div class="col-md-4 col-lg-4 col-sm-4 col-6 p-lr-5">
								<label>Price</label>
								<select class="form-control">
									<option>Option 1</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								</select>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-4 filter-search">
								<button class="btn btn-danger form-control">Filter</button>
							</div>
						</div>
					</div>
				</div>
				<!--Desktop catogery-->
				<div class="flex-w flex-l-m filter-tope-group m-tb-10 menu-group-desktop">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-20 m-tb-5 how-active1" data-filter="*">
						All Foods
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-20 m-tb-5" data-filter=".women">
						Morning Menu
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-20 m-tb-5" data-filter=".men">
						Afternoon Menu
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-20 m-tb-5" data-filter=".bag">
						Dinner Menu
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-20 m-tb-5" data-filter=".shoes">
						Special Menu
					</button>

					<div class="dropdown more stext-106 cl6 hov1 bor3 trans-04 m-r-20 m-tb-5">
						<a class="dropdown-toggle"  data-toggle="dropdown">More
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#" class="dropdown-item">Type 1</a></li>
								<li><a href="#" class="dropdown-item">Type 2</a></li>
								<li><a href="#" class="dropdown-item">Type 3</a></li>
							</ul>
					</div>
				</div>
				<!--Mobile catogery-->
				<div class="flex-c-m p-lr-0 catogery col-md-2 col-sm-2 col-1">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="btn-show-catogery dl-trigger	">
							<i class="fa fa-tasks"></i>
						</button>
						<ul class="dl-menu">
							<li>
								<a href="#">Morning</a>
							</li>
							<li>
								<a href="#">Dinner</a>
							</li>
							<li>
								<a href="#">Special</a>
							</li>
							<li>
								<a href="#">Custom</a>
							</li>
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

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search...">
					</div>	
				</div>
			</div>

			<div class="row isotope-grid">
				@for($i=1;$i< 15; $i++)
				<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2 col-xl-2 food-item isotope-item watches" title="Food's Name Title">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0 food-image">
							<img src="frontend/FoodOrder/images/food{{$i}}.jpg" alt="IMG-PRODUCT" class="js-show-modal1 view-detail">

							<a href="#" class="block2-btn flex-c-m stext-103 cl2 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
								<i class="zmdi zmdi-shopping-cart cart-desktop">
								</i> Add To Cart
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14 food-content">
							<div class="block2-txt-child1 flex-col-l">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									Esprit Ruffle Shirt
								</a>

								<span class="stext-105 cl3">
									$16.64
								</span>
							</div>
						</div>
					</div>
				</div>
				@endfor
			</div>
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
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
	
	<script src="frontend/FoodOrder/js/jquery-3.2.1.min.js"></script>
	<script src="frontend/FoodOrder/js/animsition.min.js"></script>
	<script src="frontend/FoodOrder/js/popper.min.js"></script>
	<script src="frontend/FoodOrder/js/bootstrap.min.js"></script>
	<script src="frontend/FoodOrder/js/iziModal.min.js"></script>
	<script src="frontend/FoodOrder/js/jquery.dlmenu.js"></script>
	<!--Filter Food-->
	<script src="frontend/FoodOrder/js/isotope.pkgd.min.js"></script>
	<script src="frontend/FoodOrder/js/main.js"></script>
	<script type="text/javascript">
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
			iframeURL      :"FoodDetail"
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
</body>
</html>