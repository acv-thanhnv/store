@extends("layouts.layout3")
@section('css')
<link href="{{ asset('frontend/css/style_order.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="wraper">
	{{--================================= Quang begin ===========================--}}
	<div class="wraper-left col-sm-6 nopad">

		<div id="left-nav-tabs" class="header-left">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#home" data-toggle="tab">Table/Floor</a>
				</li>
				<li><a href="#menu" data-toggle="tab">Menu</a></li>

				<li class="col-md-6">
					<form action="#" method="#" role="search">
						<div class="input-group">
							<input class="form-control" placeholder="Search . . ." name="srch-term" id="ed-srch-term" type="text">
							<div class="input-group-btn">
								<button type="submit" id="searchbtn">
								search</button>
							</div>
						</div>
					</form>
				</li>

				
			</ul>
		</div>
		<div class="tab-content content-left">
			<div id="home" class="tab-pane fade in active">
				<div class="room">
					<nav class="navbar navbar-light">
						<div class="container-fluid">
							<div class="navbar-header">
								<a class="navbar-brand" href="#"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span></a>
							</div>
							<ul class="nav navbar-nav">
								<li class="active"><a href="#">Tầng 1</a></li>
								@for($i=2;$i<5;$i++)
								<li><a href="#">Tầng {{$i}}</a></li>
								@endfor
								<li><a href="#">More...</a></li> 
							</ul>
						</div>
					</nav>
				</div>

				<div id="table-list">
					@for($i=1;$i<30;$i++)
					<div class="wrap-table col-sm-2 img-thumbnail" >
						<span class="table-name">Bàn {{$i}}</span>
					</div>
					@endfor
				</div>
			</div>
			<div id="menu" class="tab-pane fade">
				<div class="category">
					<nav class="navbar navbar-light">
						<div class="container-fluid">
							<ul class="nav navbar-nav">
								<li class="active"><a href="#">Khai vị</a></li>
								@for($i=0; $i<3; $i++)
								<li><a href="#">Đồ uống</a></li>
								@endfor
								<li><a href="#">More...</a></li> 
							</ul>
						</div>
					</nav>
					
				</div>


				<div class="list-item">
					@for($i=0; $i<15; $i++)
					<div class="col-md-3 item-food">
						<img src="http://2sao.vietnamnetjsc.vn/images/2018/01/09/13/14/cua-rang-me.jpg" alt="" />
						<h6 class="produc_name">Italian Source Mushroom Italian Source Mushroom Italian Source Mushroom</h6>
						<h5><strong class="product_price">12.000 đ</strong></h5>
					</div>	
					@endfor
				</div>
			</div>
		</div>

	</div>

</div>

</div>
{{--================================= Son begin ===========================--}}
<div class="wraper-right col-sm-6">
	<div class="header-right">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#">Bàn/Tầng</a>
			</li>

		</ul>
		{{-- <div class="btn-group dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" ><span class="caret"></span><br><span class="glyphicon glyphicon-th" aria-hidden="true"></span></button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#"><span class="fa fa-retweet"></span> Chuyển Bàn</a></li>
					<li class="line"></li>
					<li><a class="dropdown-item" href="#"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Ghép Bàn</a></li>
					<li class="line"></li>
					<li><a class="dropdown-item" href="#"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Liên Hệ Thu Ngân</a></li>
				</ul>
			</div> --}}
	</div>
	<div class="content-right">
		@include('frontend.order3.entities')
	</div>
	<div class="footer-right">
		<table style="width:100%;">
			<tbody>
				<tr>
					<td class="col-md-8"></td>
					<td class=" col-md-4 "><strong>Tổng Tiền: 100.000</strong></td>
				</tr>
				<tr class="action-order">
					<td>
						<textarea class="note-order col-md-8" placeholder="Ghi chú"></textarea>
					</td>
					<td class="send-order col-md-4">
						<button type="button" class="btn btn-danger">Gửi Thực Đơn<br><i class="fa fa-bell"></i></button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
	//js here
</script>
@endsection
