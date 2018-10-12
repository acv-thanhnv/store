<table class="table table-hover red-blue-table">
	<thead>
		<tr>
			<th colspan="2" style="width:40%">Hóa đơn</th>
			<th colspan="2" style="width:60%">Bàn/Phòng/Tầng</th>
		</tr>
	</thead>
	
	<tbody>
		<tr class="t-header2">
			<td colspan="2">
				<button type="button" class="t-header2-collapse btn btn-primary">
					<span>+</span> #HĐ 001
				</button>
			</td>
			<td colspan="2">
				<button type="button" class="btn btn-primary">
					<span class="badge badge-secondary">B1</span>
					<span class="badge badge-secondary">P202</span>
					<span class="badge badge-secondary">T2</span>
				</button>
			</td>
		</tr>
		<tr class="t-header2-child">
			<th style="width: 25%">Tên món</th>
			<th style="width: 15%">Số lượng</th>
			<th style="width: 35%">Trạng thái</th>
			<th style="width: 25%"></th>
		</tr>
		<tr>
			<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
			<td>1/2</td>
			<td>
				<button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">1</span></button>
				<button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">1</span></button>
			</td>
			<td>
				<button class="btn-group-kitchen btn btn-success"><i class="fa fa-undo"></i></button>
			</td>
		</tr>
	</tbody>

</table>

<script>
	$('tr.t-header2').nextUntil('tr.t-header2').slideToggle(0, function(){

	});
	$('.t-header2-collapse').click(function(){
		$(this).find('span:first-child').text(function(_, value){return value=='-'?'+':'-'});
		$(this).parents('tr').nextUntil('tr.t-header2').slideToggle(100, function(){

		});
	});
</script>