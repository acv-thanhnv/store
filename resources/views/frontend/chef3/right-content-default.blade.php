<table id="cho-cung-ung" class="table table-hover red-blue-table">
	<thead>
		<tr>
			<th colspan="2" style="width:40%">Hóa đơn</th>
			<th colspan="2" style="width:60%">Bàn/Phòng/Tầng</th>
		</tr>
	</thead>
	
	<tbody>
		@for ($i = 1; $i < 30; $i++)
		<tr class="t-header">
			<td colspan="2">
				<button type="button" class="t-header-collapse btn btn-primary">
					<span>+</span> #HĐ 00{{ $i }}
				</button>
			</td>
			<td colspan="2">
				<button type="button" class="btn btn-primary">
					<span class="badge badge-secondary">B{{ rand(1,30) }}</span>
					@php
					$tang = rand(1,9);
					@endphp
					<span class="badge badge-secondary">P{{ $tang }}{{ rand(0,9) }}{{ rand(0,9) }}</span>
					<span class="badge badge-secondary">T{{ $tang }}</span>
				</button>
			</td>
		</tr>
		<tr class="t-header-child">
			<th style="width: 25%">Tên món</th>
			<th style="width: 15%">SL</th>
			<th style="width: 40%">Trạng thái</th>
			<th style="width: 20%"></th>
		</tr>
		@for ($j = 1; $j < 5; $j++)
		<tr>
			<td class="food food-right">Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
			@php
			$danau = rand(1,99);
			$dangnau = rand(1,99);
			$all = $danau + $dangnau;
			@endphp
			<td>{{ $danau }}/{{ ($danau + $dangnau) }}</td>
			<td>
				<button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">{{ $danau }}</span></button>
				<button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">{{ $dangnau }}</span></button>
			</td>
			<td>
				<button class="btn btn-warning"><i class="fa fa-angle-right"></i></button>
				<button class="btn-group-kitchen btn btn-danger"><i class="fa fa-angle-double-right"></i></button>
			</td>
		</tr>
		@endfor
		@endfor
		<tfoot></tfoot>
	</tbody>

</table>