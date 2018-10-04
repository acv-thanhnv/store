@extends("layouts.layout3")
@section('content')
<div class="wraper">
	{{--================================= Quang begin ===========================--}}
	<div class="wraper-left col-sm-6">
		
	</div>
	{{--================================= Son begin ===========================--}}
	<div class="wraper-right col-sm-6">
		<div class="header-right">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#">Bàn/Tầng</a>
				</li>
				<li><a href="#">Hello</a></li>
				<li><a href="#">ABC</a></li>
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
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Separated link</a>
								</div>
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