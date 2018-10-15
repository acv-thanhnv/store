<table class="table table-hover red-blue-table" data-toggle="table">
	<thead>
		<tr>
			<th style="width: 65%">Tên món</th>
			<th style="width: 10%" data-field="invoice_id" data-sortable="true">Hóa đơn</th>
			<th style="width: 5%" data-field="vip" data-sortable="true">VIP</th>
			<th style="width: 10%">Số lượng</th>
			<th style="width: 10%" data-field="total" data-sortable="true">Hàng chờ</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="food food-left"><span>Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing</span></td>
			<td>#HĐ 001</td>
			<td>1</td>
			<td>4</td>
			<td>18</td>
		</tr>
		@for ($i = 1; $i < 8; $i++)
		@for ($j = 1; $j < 5; $j++)
		<tr>
			<td>Món {{ $j }}</td>
			<td>#HĐ 00{{ $i }}</td>
			<td>{{ ($i%2) }}</td>
			<td>{{ rand(1,10) }}</td>
			<td>{{ rand(0,10) }}</td>
		</tr>
		@endfor
		@endfor
	</tbody>
	<tfoot></tfoot>
</table>