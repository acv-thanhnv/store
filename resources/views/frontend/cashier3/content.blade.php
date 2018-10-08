<table id="cart" class="table table-hover">
	<thead>
		<tr>
			<th style="width:4%"></th>
			<th style="width:14%">Mã đơn</th>
			<th style="width:14%">Bàn</th>
			<th style="width:14%">Thành tiền (VNĐ)</th>
			<th style="width:10%">Chiết khấu (%)</th>
			<th style="width:12%">Thuế suất (%)</th>
			<th style="width:14%">Tổng cộng (VNĐ)</th>
			<th style="width:18%"></th>
		</tr>
	</thead>
	<tbody>
		<!-- <tr>
			<td data-th="">
				<input type="checkbox" value="1">
			</td>
			<td data-th="invoice">
		
				<div class="col-sm-12">
					DH 1
						<br>
						<span class="note-order fa fa-edit"> Ghi chú</span>
					</div>
				</td>
				<td data-th="table">001</td>
				<td data-th="before_vat">69000</td>
				<td data-th="discount">
					<input type="number" class="form-control text-center" value="5">
				</td>
				<td data-th="tax">
					<input type="number" class="form-control text-center" value="44">
				</td>
				<td data-th="total">96000</td>
				<td class="actions" data-th="">
					<button class="btn btn-danger btn-sm"><i class="fa fa-angle-right"></i> In hóa đơn</button>
					<button class="btn btn-success btn-sm"><i class="fa fa-angle-double-right"></i> Hoàn thành</button>
				</td>
			</tr> -->
			<script>
				var i=1;
				while (i<=30) {
					var money = (Math.floor(Math.random() * 69+10)*1000);
					document.write('<tr> <td data-th=""> <input type="checkbox" value="'+i+'"> </td> <td data-th="invoice"> <div class="col-sm-12"> #DH 00'+i+' <br> <span class="note-order fa fa-edit"> Ghi chú</span> </div> </td> <td data-th="table">'+(Math.floor(Math.random() * 32)+1)+'</td> <td data-th="before_vat">'+money+'</td> <td data-th="discount"> <input type="number" class="form-control text-center" value="'+(Math.floor(Math.random() * 5))+'"> </td> <td data-th="tax"> <input type="number" class="form-control text-center" value="'+(Math.floor(Math.random() * 5)+10)+'"> </td> <td data-th="total">'+(money + (Math.floor(Math.random() * 10+10)*1000))+'</td> <td class="actions" data-th=""> <button class="btn btn-danger btn-sm"><i class="fa fa-angle-right"></i> In hóa đơn</button> <button class="btn btn-success btn-sm"><i class="fa fa-angle-double-right"></i> Hoàn thành</button> </td> </tr>');
					i++;
				}
			</script>
		</tbody>
		<tfoot>
			<!-- <tr>
				<td><strong class="total-order">Total:</strong></td>
				<td colspan="4"><strong class="total-order"> $1.99</strong></td>
			</tr> -->
		</tfoot>
	</table>