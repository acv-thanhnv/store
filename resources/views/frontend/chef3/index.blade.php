@extends('layouts.layout3')
@section('css')
<link href="{{ asset('frontend/css/style_chef.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="wraper">


	<div class="wraper-left col-sm-6">
		<div class="header-left">
			<ul class="nav nav-tabs location-order">
				<li><a><strong>Chờ chế biến</strong></a></li>
				<li class="active"><a data-toggle="tab" href="#uu-tien">Ưu tiên</a></li>
				<li><a data-toggle="tab" href="#tat-ca">Tất cả</a></li>
			</ul>
		</div>
		<div class="tab-content content-left">
			<div id="uu-tien" class="tab-pane fade in active">
				<br>
				@include('frontend.chef3.left-content')
			</div>
			<div id="tat-ca" class="tab-pane fade">
				<br>
				@include('frontend.chef3.left-content-all')
			</div>
		</div>
		<!-- <div class="footer-left">
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
		</div> -->
	</div>


	<div class="wraper-right col-sm-6 nopad">
		<div class="header-right">
			<ul class="nav nav-tabs location-order">
				<li class="active"><a data-toggle="tab" href="#cung-ung"><strong>Đã xong/Chờ cung ứng</strong></a></li>
				<li><a data-toggle="tab" href="#hoan-tac">Hoàn tác</a></li>
			</ul>
		</div>
		<div class="tab-content content-right">
			<div id="cung-ung" class="tab-pane fade in active">
				<br>
				@include('frontend.chef3.right-content')
			</div>
			<div id="hoan-tac" class="tab-pane fade">
				<br>
				@include('frontend.chef3.right-content-rollback')
			</div>
		</div>
		<!-- <div class="footer-right">
			
		</div> -->

		

	</div>

	<script>
		$(document).ready(function(){
			$("#header-left a").click(function(){
				$(this).tab('show');
			});
		});
	</script>

</div>

</div>
@endsection
@section('javascript')
<script type="text/javascript">
	//js here
</script>
@endsection