@extends("layouts.layout3")
@section('content')
<div class="wraper">
	{{--================================= Quang begin ===========================--}}
	<script src="/js/lib/jquery-3.3.1.min.js"></script>
	<div class="wraper-left col-sm-6">

		<ul id="left-nav-tabs" class="nav nav-tabs">
			<li><a href="#room">#Room</a></li>
			<li><a href="#menu">#Menu</a></li>

		</ul>

		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<br>
				<div class="room">
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
					<button class="btn btn-cat btn-danger">#Room</button>
				</div>
				<br>
				<div class="d-flex flex-row flex-wrap my-flex-container">
					<div class="p-2 my-flex-item">
						<script>
							var i=1;
							while (i<=30) {
								document.write('<button class="btn btn-room btn-success">'+i+'</button>');
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
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
					<button class="btn btn-cat btn-danger">#Category</button>
				</div>
				<br>
				<div class="d-flex flex-row flex-wrap my-flex-container food">
					<div class="p-2 my-flex-item">
						<script>
							var i=1;
							while (i<=30) {
								document.write('<img class="img-food" src="http://placehold.it/160x160" alt="">');
								i++;
							}
						</script>
					</div>
				</div>
			</div>
		</div>

	</div>

	<script>
		$(document).ready(function(){
			$("#left-nav-tabs a").click(function(){
				$(this).tab('show');
			});
		});
	</script>

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