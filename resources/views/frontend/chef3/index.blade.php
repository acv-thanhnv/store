@extends('layouts.layout3')
@section('css')
<link href="{{ asset('frontend/css/style_chef.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="wraper">
	<div class="wraper-left col-sm-6">
		<div class="header-left">
			<ul class="nav nav-tabs location-order">
				<li class="active"><a data-toggle="tab" href="#cho-che-bien"><strong>Chờ chế biến</strong></a></li>
			</ul>
		</div>
		<div class="tab-content content-left">
			<div id="cho-che-bien" class="tab-pane fade in active">
				@include('frontend.chef3.left-content')
			</div>
		</div>
		
	</div>


	<div class="wraper-right col-sm-6 nopad">
		<div class="header-right">
			<ul class="nav nav-tabs location-order">
				<li class="active"><a data-toggle="tab" href="#uu-tien"><strong>Đã xong/Chờ cung ứng</strong></a></li>
				<li><a data-toggle="tab" href="#hoan-tac">Lịch sử / Hoàn tác</a></li>
				<li>
					<!-- Search form -->
					<div class="md-form">
						<input id="search" class="form-control" type="text" onkeyup="searchFor()" placeholder="Tìm bàn/phòng/tầng" aria-label="Search">
					</div>
				</li>
			</ul>
		</div>
		<div class="tab-content content-right">
			<div id="uu-tien" class="right-kitchen tab-pane fade in active">
				@include('frontend.chef3.right-content-default')
			</div>
			<div id="hoan-tac" class="right-kitchen tab-pane fade">
				@include('frontend.chef3.right-content-rollback')
			</div>
		</div>
		
	</div>

</div>

</div>
@endsection
@section('javascript')
<script type="text/javascript">
	//js here
	$(document).ready(function(){
		$("#header-left a").click(function(){
			$(this).tab('show');
		});
	});

	function searchFor() {
		var input, filter, table, tr, td, i, cl=false;
		input = document.getElementById("search");
		filter = input.value.toUpperCase();
		cl = filter?true:false;
		table = document.getElementById("cho-cung-ung");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[1];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}   
		}
		if (!cl) {
			$('.t-header-child').nextUntil('.t-header').slideToggle(0, function(){});
		}
	}

	$('tr.t-header').nextUntil('tr.t-header').slideToggle(0, function(){

	});
	$('.t-header-collapse').click(function(){
		$(this).find('span:first-child').text(function(_, value){return value=='-'?'+':'-'});
		$(this).parents('tr').nextUntil('tr.t-header').slideToggle(100, function(){

		});
	});

	$('tr.t-header2').nextUntil('tr.t-header2').slideToggle(0, function(){

	});
	$('.t-header2-collapse').click(function(){
		$(this).find('span:first-child').text(function(_, value){return value=='-'?'+':'-'});
		$(this).parents('tr').nextUntil('tr.t-header2').slideToggle(100, function(){

		});
	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
@endsection