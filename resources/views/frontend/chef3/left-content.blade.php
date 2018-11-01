<div class="row">
	<div class="col-md-7">
		<table id="order-list" class="table table-hover red-blue-table" data-search="true" data-toggle="table" data-url="{{ url('/api/v1/store/'.$storeId.'/chef.json') }}">
			<thead>
				<tr>
					<th style="width: 75%" data-field="name">Tên món</th>
					<th style="width: 10%" data-field="id" data-sortable="true">Hóa đơn</th>
					<th style="width: 5%" data-field="priority" data-sortable="true">VIP</th>
					<th style="width: 10%" data-field="quantity">SL</th>
				</tr>
			</thead>
			<tbody>
		{{-- <tr>
			<td class="food food-left"><span>Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing</span></td>
			<td>#HĐ 001</td>
			<td>1</td>
			<td>4</td>
			<td>18</td>
		</tr> --}}
	</tbody>
	<tfoot></tfoot>
</table>
</div>
<div class="col-md-5">
	<table id="order-trend" class="table table-hover red-blue-table" data-search="true" data-toggle="table" data-url="{{ url('/api/v1/store/'.$storeId.'/chef_queue.json') }}">
		<thead>
			<tr>
				<th style="width: 90%" data-field="name">Tên món</th>
				<th style="width: 10%" data-field="quantity">Hàng chờ</th>
			</tr>
		</thead>
		<tbody>
		{{-- <tr>
			<td class="food food-left"><span>Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing</span></td>
			<td>#HĐ 001</td>
			<td>1</td>
			<td>4</td>
			<td>18</td>
		</tr> --}}
	</tbody>
	<tfoot></tfoot>
</table>
</div>
</div>