@extends('layouts.layout3')
@section('css')
<link href="{{ asset('frontend/css/style_cashier.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="header-cashier col-md-12">
	@include('frontend.cashier3.header')
</div>
<div class="content-cashier col-md-12">
	@include('frontend.cashier3.content')
</div>
<div class="footer-cashier col-md-12">
	<div class="group-input">
		<table class="payment-detail">
			<tbody>
				<tr>
					<td valign="middle" class="colume1">
						<input type="text" ng-model="order.Code" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Tự động tạo mã (Đơn hàng)">
					</td>
					<td></td>
					<td class="colume3 text-left">Thành tiền</td>
					<td class="colume4 text-right">685,000</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td class="text-left">Chiết khấu</td>
					<td class="text-right">685,000</td>
				</tr>
				
				<tr>
					<td></td>
					<td></td>
					<td class="text-left">VAT(10%)</td>
					<td class="text-right">685,000</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td class="text-left">Tổng Tiền</td>
					<td class="text-right">685,000</td>
				</tr>

			</tbody>
		</table>
	</div>
	<div class="action-cashier">
		
	</div>
</div>
@endsection