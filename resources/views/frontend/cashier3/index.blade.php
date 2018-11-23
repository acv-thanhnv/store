@extends('layouts.layout3')
@section('css')
<link href="{{ asset('frontend/css/cashier.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.0.3/css/tableexport.min.css">
@endsection

@section('title')
Thu ngân
@endsection

@section('content')

<div id="config" class="hidden"
storeId="{{ $storeId }}"
rootPath="{{ config('app.url') }}"
WaiterToWaiterChannel="{{ $WaiterToWaiterChannel }}"
Customer2Order="{{$Customer2Order}}"

Order2Kitchen="{{ $Order2Kitchen }}"
Order2Cashier="{{ $Order2Cashier }}"
Order2Other="{{ $Order2Other }}"
></div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-9 padding-0">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs left-cashier-header" role="tablist">
				<li class="active nav-item">
					<a class="nav-link active" id="cashier-tab" data-toggle="tab" href="#cashier-table" role="tab" aria-controls="cashier-table" aria-selected="true">
						<strong>Thu ngân</strong>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="undo-tab" data-toggle="tab" href="#undo-table" role="tab" aria-controls="undo-table" aria-selected="false">
						<strong>Lịch sử / Hoàn tác</strong>
					</a>
				</li>
				<li class="nav-item">
					<div class="md-form">
						<input id="search" class="form-control" type="text" placeholder="Tìm hóa đơn theo vị trí" aria-label="Search" autofocus="">
					</div>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane fade show active" id="cashier-table" role="tabpanel" aria-labelledby="cashier-tab">
					
				</div>
				<div id="invoices-details"></div>
				<div class="tab-pane fade" id="undo-table" role="tabpanel" aria-labelledby="undo-tab">
					
				</div>
			</div>

		</div>

		<div class="col-md padding-0 right-panel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs right-cashier-header" role="tablist">
				<li class="active nav-item">
					<a class="nav-link active" id="details-tab" data-toggle="tab" href="#details-table" role="tab" aria-controls="details-table" aria-selected="true">
						<strong>Chi tiết</strong>
					</a>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane fade show active" id="details-table" role="tabpanel" aria-labelledby="details-tab">
					@include('frontend.cashier3.right-content')	
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
<script src="{{ asset('frontend/js/cashier/cashier.js') }}"></script>
@endsection