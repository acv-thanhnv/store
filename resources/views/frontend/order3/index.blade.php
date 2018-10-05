@extends("layouts.layout3")
@section('content')
<div class="wraper">
	{{--================================= Quang begin ===========================--}}
	<div class="wraper-left col-sm-6 nopad">

		<div id="left-nav-tabs" class="header-left">
			<ul class="nav nav-tabs location-order">
				<li class="active"><a data-toggle="tab" href="/layout3/#room">#Room</a></li>
				<li><a data-toggle="tab" href="/layout3/#menu">#Menu</a></li>
			</ul>
		</div>
		<div class="tab-content content-left">
			<div id="home" class="tab-pane fade in active">
				<br>
				<div class="room">
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#More</button>
				</div>
				<br>
				<div class="d-flex flex-row flex-wrap my-flex-container">
					<div class="p-2 my-flex-item">
						<script>
							var i=1;
							while (i<=30) {
								document.write('<button class="btn btn-room btn-success">Bàn '+i+'</button>');
								i++;
							}
						</script>
					</div>
				</div>
			</div>
			<div id="menu" class="tab-pane fade">
				<br>
				<div class="category">
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#More</button>
					
				</div>
				<br>
				<div class="">
					<div class="row">

						<script>
							var i=1;
							while (i<=30) {
								document.write('<center><div class="col-md-4 col-md-offset-1"><img class="img-food" src="http://placehold.it/160x160" alt=""><br>Món '+i+'<br>Giá '+i*1000+' VND</div></center>');
								i++;
							}
						</script>

					</div>
				</div>
			</div>

		</div>
		<!-- <div class="footer-left">
			
		</div> -->

		

	</div>

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


	//==============================Quang=========
	//==============================Quang=========

	$(document).ready(function(){
		$("#left-nav-tabs a").click(function(){
			$(this).tab('show');
		});
	});


	//==============================Son=========
	//==============================Son=========
	
</script>
@endsection
