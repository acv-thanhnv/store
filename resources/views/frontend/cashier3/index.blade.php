@extends('layouts.layout3')
@section('css')
<link href="{{ asset('frontend/css/style_cashier.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="wraper">
	<div class="wraper-left col-sm-9">
		<div class="header-left">
			<ul class="nav nav-tabs location-order">
				<li class="active"><a data-toggle="tab" href="#cho-che-bien"><strong>Thu ngân</strong></a></li>
				<div class="md-form">
					<input id="search" class="form-control" type="text" onkeyup="searchFor()" placeholder="Tìm hóa đơn theo vị trí" aria-label="Search" autofocus="">
				</div>
			</ul>
		</div>
		<div class="tab-content content-left">
			<div id="cho-che-bien" class="tab-pane fade in active">
				@include('frontend.cashier3.left-content')
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
		table = document.getElementById("thu-ngan");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[2];
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

</script>

<script>
	$(document).ready(function(){

    // code to read selected table row cell data (values).
    $("#thu-ngan").on('click','.checkbox',function(){

    	var isChecked = $(this).prop('checked');

    	var currentTotal = $("#payment-right").text();
    	var currentInvoices = $("#invoice-id").text();
    	var currentRow=$(this).closest("tr");

    	if (currentInvoices) var invoices = currentInvoices.split(",");
    	else var invoices = [];

    	var col1=currentRow.find("td:eq(1)").text();
    	var col2=currentRow.find("td:eq(6)").text();
    	var data=col1+"\n"+col2+"\n";

    	if (isChecked) {
    		invoices.push(col1);
    		if (!currentTotal) currentTotal=parseInt(col2.replace(/,/g, ''));
    		else currentTotal = parseInt(currentTotal.replace(/,/g, '')) +
            parseInt(col2.replace(/,/g, ''));

    	} else {
    		var index = invoices.indexOf(col1);
    		if (index > -1) {
    			invoices.splice( index, 1 );
    		}
    		currentTotal = parseInt(currentTotal.split(',').join('')) -
            parseInt(col2.split(',').join(''));
    	}
    	$("#invoice-id").text(invoices.toString());
    	$("#payment-right").text(currentTotal.toLocaleString('us'));
    });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
@endsection