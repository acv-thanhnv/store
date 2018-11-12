@extends('layouts.layout3')
@section('css')
<link href="{{ asset('frontend/css/chef.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css" rel="stylesheet" />
@endsection

@section('content')
<div id="config" class="hidden" storeId="{{ $storeId }}" rootPath="{{ config('app.url') }}"></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
<script src="{{ asset('frontend/js/chef/chef.js') }}"></script>
@endsection
