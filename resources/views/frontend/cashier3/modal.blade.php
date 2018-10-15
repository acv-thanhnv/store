<table class="table table-hover red-blue-table" data-toggle="table" style="margin-top: 10px;">
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
			<td class="food">Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
			<td>999,000,000</td>
			<td>15</td>
			<td>999,000,000</td>
		</tr>
		@php
		$phuphi = rand(10,50)*1000;
		$tongtien = $phuphi;
		@endphp
		@for ($i = 1; $i < 7; $i++)
		@php
			$dongia = rand(10,90)*1000;
			$soluong = rand(1,6);
			$thanhtien = $dongia * $soluong;
			$tongtien += $thanhtien;
			$thuesuat = rand(10,15);
			$chietkhau = rand(1,5);
		@endphp
		<tr>
			<td>Món {{ $i }}</td>
			<td>{{ number_format($dongia) }}</td>
			<td>{{ $soluong }}</td>
			<td>{{ number_format($thanhtien) }}</td>
		</tr>
		@endfor
		@php
			$thanhtien = $tongtien+$tongtien*($thuesuat-$chietkhau)/100;
		@endphp
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2"></td>
			<td class="ta-right">
				Phụ phí:
			</td>
			<td>
				{{ number_format($phuphi) }}
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="ta-right">
				Tổng tiền:
			</td>
			<td>
				{{ number_format($tongtien) }}
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="ta-right">
				Thuế:
			</td>
			<td>
				{{ number_format($thuesuat) }}
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="ta-right">
				Chiết khấu:
			</td>
			<td>
				{{ number_format($chietkhau) }}
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="ta-right">
				Thành tiền:
			</td>
			<td>
				{{ number_format($thanhtien) }}
			</td>
		</tr>
		
		<tr>
			<td colspan="4">
				<div class="col-xs-12">
					<div class="panel-group">
						<div class="">
							<!-- <div class="panel-heading">Click 'Run' to complete the report.</div> -->
							<div>
								<div class="btn-group pull-left">
									<button class="btn btn-primary btn-lg">In hóa đơn</button>
								</div>
								<div class="btn-group pull-center">
									<button class="btn btn-primary btn-lg">Thanh toán: {{ number_format($thanhtien) }}</button>
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