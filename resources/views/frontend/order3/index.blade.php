@extends("layouts.layout3")
@section('content')
<div class="wraper">
	{{--================================= Quang begin ===========================--}}
	<div class="wraper-left col-sm-6">
		
	</div>
	{{--================================= Son begin ===========================--}}
	<div class="wraper-right col-sm-6">
		<div class="header-right">
			<ul class="nav nav-tabs location-order">
				<li class="active">
					<a href="#">Bàn/Tầng</a>
				</li>
			</ul>
		</div>
		<div class="content-right">
			@include('frontend.order3.entities')
		</div>
		<div class="footer-right">
			<table>
				<tbody>
					<tr class="action-order">
						<td>
							<div class="btn-group dropup">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" ><span class="caret"></span><br><span class="glyphicon glyphicon-th" aria-hidden="true"></span></button>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="#"><span class="fa fa-retweet"></span> Chuyển Bàn</a></li>
									<li class="line"></li>
									<li><a class="dropdown-item" href="#"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Ghép Bàn</a></li>
									<li class="line"></li>
									<li><a class="dropdown-item" href="#"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Liên Hệ Thu Ngân</a></li>
								</ul>
							</div>
						</td>
						<td class="send-order">
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