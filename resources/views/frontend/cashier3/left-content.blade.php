<table id="thu-ngan" class="table table-hover red-blue-table" data-toggle="table" responsive hover>
	<thead>
		<tr>
			<th style="width: 5%"></th>
			<th style="width: 10%">Hóa đơn</th>
			<th style="width: 20%">Vị trí</th>
			<th style="width: 10%">Tổng tiền</th>
			<th style="width: 10%">Thuế suất</th>
			<th style="width: 15%">Chiết khấu</th>
			<th style="width: 15%">Thành tiền</th>
			<th style="width: 15%"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><input class="checkbox" type="checkbox" value="#HĐ 000"></td>
			<td>#HĐ 000123456789</td>
			<td>
				<button type="button" class="btn btn-primary">
					<span class="badge badge-secondary">B 16</span>
					<span class="badge badge-secondary">P 202</span>
					<span class="badge badge-secondary">T 2</span>
				</button>
			</td>
			<td class="money">999,000,000,000</td>
			<td>15</td>
			<td>5</td>
			<td class="money">999,000,000,000</td>
			<td>
				<button class="btn btn-success" data-toggle="modal" data-target="#hd000"><i class="fa fa-eye"></i></button>
			</td>
		</tr>
		@for ($i = 1; $i < 30; $i++)
		<tr>
			@php
			$tongtien = rand(10,90)*1000;
			$thuesuat = rand(10,15);
			$chietkhau = rand(1,5);
			$thanhtien = $tongtien+$tongtien*($thuesuat-$chietkhau)/100;
			$lamtron = ( ($thanhtien/1000-round($thanhtien/1000)>0)?(round($thanhtien/1000)+1):(round($thanhtien/1000)) )*1000;
			@endphp
			<td>
				<input class="checkbox" type="checkbox" value="#HĐ 00{{ $i }}">
			</td>
			<td>#HĐ 00{{ $i }}</td>
			<td>
				<button type="button" class="btn btn-primary">
					<span class="badge badge-secondary">B {{ rand(1,30) }}</span>
					@php
					$tang = rand(1,9);
					@endphp
					<span class="badge badge-secondary">P {{ $tang }}{{ rand(0,9) }}{{ rand(0,9) }}</span>
					<span class="badge badge-secondary">T {{ $tang }}</span>
				</button>
			</td>
			<td>{{ number_format($tongtien) }}</td>
			<td>{{ $thuesuat }}</td>
			<td>{{ $chietkhau }}</td>
			<td>{{ number_format($thanhtien) }}</td>
			<td>
				<button class="btn btn-success" data-toggle="modal" data-target="#hd00{{ $i }}"><i class="fa fa-eye"></i></button>
			</td>
		</tr>
		@endfor
	</tbody>
	<tfoot></tfoot>
</table>

<!-- Modal -->
<div class="modal fade" id="hd000" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			@include('frontend.cashier3.modal')
		</div>

	</div>
</div>

@for ($i = 1; $i < 30; $i++)
<!-- Modal -->
<div class="modal fade" id="hd00{{ $i }}" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			@include('frontend.cashier3.modal')
		</div>

	</div>
</div>
@endfor