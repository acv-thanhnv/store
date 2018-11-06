@extends('layouts.layout3')
@section('css')
<link href="{{ asset('frontend/css/cashier.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.0.3/css/tableexport.min.css">
@endsection

@section('content')
<div id="config" class="hidden" storeId="{{ $storeId }}"></div>
<div class="wraper">
	<div class="wraper-left col-sm-9">
		<div class="header-left">
			<ul class="nav nav-tabs location-order">
				<li class="active"><a data-toggle="tab" href="#danh-sach"><strong>Thu ngân</strong></a></li>
				<!-- <li class="active"><a data-toggle="tab" href="#yeu-cau-thanh-toan"><strong>Yêu cầu thanh toán</strong></a></li> -->
				<li class="active"><a data-toggle="tab" href="#rollback-thanh-toan"><strong>Hoàn tác</strong></a></li>
				<div class="md-form">
					<input id="search" class="form-control" type="text" placeholder="Tìm hóa đơn theo vị trí" aria-label="Search" autofocus="">
				</div>
			</ul>
		</div>
		<div class="tab-content content-left">
			<div id="danh-sach" class="tab-pane in active">
				<div id="thu-ngan"></div>
				<div id="invoices-details"></div>
			</div>
			
			<!-- <div id="yeu-cau-thanh-toan" class="tab-pane">
				<div id="khach-thanh-toan"></div>
				<div id="invoices-details-2"></div>
			</div> -->
			<div id="rollback-thanh-toan" class="tab-pane">
			</div>
		</div>
	</div>


	<div class="wraper-right col-sm-3 nopad">
		<div class="header-right">
			<ul class="nav nav-tabs location-order">
				<li class="active"><a data-toggle="tab" href="#uu-tien"><strong>Chi tiết</strong></a></li>
			</li>
		</ul>
	</div>
	<div class="tab-content content-right">
		<div id="uu-tien" class="right-kitchen tab-pane fade in active">
			@include('frontend.cashier3.right-content')
		</div>
	</div>

</div>

</div>

</div>
@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.0/xlsx.core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
<script src="{{ asset('frontend/js/cashier/cashier.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.0.3/js/tableexport.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

@endsection