@extends('layouts.layout3')
@section('css')
<link href="{{ asset('frontend/css/chef.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css" rel="stylesheet" />
@endsection

@section('title')
Nhà bếp
@endsection

@section('content')

<div id="config" class="hidden"
storeId="{{ $storeId }}"
rootPath="{{ config('app.url') }}"
OtherToWaiterChannel="{{ $OtherToWaiterChannel }}"
Customer2Order="{{$Customer2Order}}"

Order2Kitchen="{{ $Order2Kitchen }}"
Order2Cashier="{{ $Order2Cashier }}"
Order2Other="{{ $Order2Other }}"
></div>
<div class="container-fluid">
	<div class="row">
		<div class="col-6 padding-0">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs left-chef-header" role="tablist">
				<li class="active nav-item">
					<a class="nav-link active" id="chef-tab" data-toggle="tab" href="#chef-table" role="tab" aria-controls="chef-table" aria-selected="true">
						<strong>Chờ chế biến</strong>
					</a>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane fade show active" id="chef-table" role="tabpanel" aria-labelledby="chef-tab">
					@include('frontend.chef3.left-content')
				</div>
			</div>
		</div>

		<div class="col padding-0 right-panel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs right-chef-header" role="tablist">
				<li class="active nav-item">
					<a class="nav-link active" id="waiter-tab" data-toggle="tab" href="#waiter-table" role="tab" aria-controls="waiter-table" aria-selected="true">
						<strong>Đã xong/Chờ cung ứng</strong>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="undo-tab" data-toggle="tab" href="#undo-table" role="tab" aria-controls="undo-table" aria-selected="false">
						<strong>Lịch sử / Hoàn tác</strong>
					</a>
				</li>
				<li class="nav-item">
					<div class="md-form">
						<input id="search" class="form-control" type="text" onkeyup="searchFor()" placeholder="Tìm vị trí bàn" aria-label="Search">
					</div>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane fade show active" id="waiter-table" role="tabpanel" aria-labelledby="waiter-tab">
					waiter
					@include('frontend.chef3.right-content-default')
				</div>
				<div class="tab-pane fade" id="undo-table" role="tabpanel" aria-labelledby="undo-tab">
					undo
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