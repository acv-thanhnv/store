<table class="table table-hover" data-toggle="table" style="margin-top: 10px;">
	<thead>
		<tr>
			<th style="width: 55%">Tên món</th>
			<th style="width: 10%">Đơn giá</th>
			<th style="width: 15%">Số lượng</th>
			<th style="width: 20%">Thành tiền</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
			<td>999,000,000</td>
			<td>15</td>
			<td>999,000,000</td>
		</tr>
		@for ($i = 1; $i < 5; $i++)
		<tr>
			<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
			<td>999,000,000</td>
			<td>15</td>
			<td>999,000,000</td>
		</tr>
		@endfor
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">
				<div class="col-xs-12">
					<div class="panel-group">
						<div class="panel panel-primary">
							<!-- <div class="panel-heading">Click 'Run' to complete the report.</div> -->
							<div class="panel-body" style="background-color: lightgray;">
								<div class="btn-group pull-left">
									<button class="btn btn-primary btn-lg">In hóa đơn</button>
								</div>
								<div class="btn-group pull-center">
									<button class="btn btn-primary btn-lg">Thanh toán: 999,000,000</button>
								</div>
								<div class="btn-group pull-right">
									<button class="btn btn-primary btn-lg">Xuất ra Excel</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
	</tfoot>
</table>