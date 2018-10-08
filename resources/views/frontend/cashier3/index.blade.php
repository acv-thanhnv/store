@extends('layouts.layout3')
@section('css')
<link href="{{ asset('frontend/css/style_cashier.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
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
						<div class="row" style="padding:10px 15px;">
							<div class=''>
								<div class="form-group">
									<div class='input-group date' id='datetimepicker1'>
										<input type='text' class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>

						</div>
					</td>
					<td></td>
					<td class="colume3 text-left">Thành tiền</td>
					<td class="colume4 text-right" style="color: green; font-size:1.125em;font-weight:600;">685,000</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td class="text-left">Chiết khấu</td>
					<td class="text-right">
						<span class="input-group-addon" style="padding:5px">
							<i class="fa fa-gift"></i>
							<input type="text" id="inputDiscount" style="height: 28px;padding: 5px 5px;" class="text-right">
						</span>
					</td>
				</tr>

				<tr>
					<td>
						<textarea style="font-size:12px;padding-left:10px; width:100%;" rows="2" placeholder="Ghi chú" class=""></textarea>
					</td>
					<td></td>
					<td class="text-left"><strong>VAT(10%)</strong></td>
					<td class="text-right"><span style="font-size:12px" class="label label-primary ">0</span></td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td class="text-left"><strong>Tổng Tiền</strong></td>
					<td class="text-right">
						<span class="label label-large label-info" style="background-color: #e74c3c;font-size:1.4em;padding-top:0px !important;padding-bottom:0px !important;">0</span>
					</td>
				</tr>

			</tbody>
		</table>

		<table style="width:100%;">
			<tbody>

				<tr>
					<td valign="top">

					</td>
					<td width="30.3%" align="right" class="hidden-xs">

					</td>
					<td width="30.3%" align="right">
						<button style="margin-top:15px; padding:15px 15px 15px 15px;width:98%" class="btn btn-danger btn-lg btn-exgreen ng-binding" type="button" ng-click="save()">Thanh toán <br><span class="fa fa-shopping-cart"></span> </button>
					</td>
				</tr>
			</tbody></table>
		</div>
	</div>
	@endsection
	@section('javascript')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript">
		$(function () {
			$('#datetimepicker1').datetimepicker();
		});
	</script>
	@endsection