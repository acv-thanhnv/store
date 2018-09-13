@extends('layouts.foodorder')
@section('css')
<style type="text/css">

</style>
@endsection

{{-- Begin content --}}
@section('content')
<div class="wraper-content col-sm-12">
	{{--BEGIN HEADER CONTENT--}}
	<div id="wrap-header">
		<div class="header-col-left col-sm-6">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#menu-content">Menu</a></li>
			</ul>

		</div>
		<div class="header-col-right col-sm-6">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#order-content">Order</a></li>
			</ul>
		</div>
	</div>
	{{--END HEADER CONTENT--}}

	{{--BEGIN CONTENT--}}
	<div id="wrap-content">
		{{--content left--}}
		<div class="content-col-left col-sm-6">
			<div class="tab-content">
				<div id="menu-content" class="tab-pane fade in active">
					<div id="list-item-type">
						type activities
					</div>
					<div id="list-item">
						item activities
					</div>
				</div>
			</div>
		</div>

		{{--content right--}}
		<div class="content-col-right col-sm-6">
			<div class="tab-content">
				<div id="order-content" class="tab-pane fade in active">
					<div id="list-item-order">
						list order item
					</div>
					<div id="order">
						order now
					</div>
				</div>
			</div>
		</div>
	</div>
	{{--END CONTENT--}}
	
</div>
@endsection
{{--END CONTENT--}}