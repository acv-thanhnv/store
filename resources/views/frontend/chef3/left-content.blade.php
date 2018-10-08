<table id="cart" class="table table-hover">
	<thead>
		<tr>
			<th style="width:45%">Thực đơn</th>
			<th style="width:20%">Số lượng</th>
			<th style="width:10%">Bàn</th>
			<th style="width:25%"></th>
		</tr>
	</thead>
	<tbody>
		<!-- <tr>
			<td data-th="Product">
		
				<div class="col-sm-12">
					<h5 class="nomargin">Món 123</h>
						<br>
						<span class="note-order fa fa-edit"> Ghi chú</span>
					</div>
				</td>
				<td data-th="quantity">123</td>
				<td data-th="id">123</td>
				<td class="actions" data-th="">
					<button class="btn btn-lg"><i class="fa fa-angle-right"></i></button>
					<button class="btn btn-danger btn-lg"><i class="fa fa-angle-double-right"></i></button>
				</td>
			</tr> -->
			<script>
				var i=1;
				while (i<=30) {
					document.write('<tr> <td data-th="Product"> <div class="col-sm-12"> <h5 class="nomargin">Món '+i+'</h> <br> <span class="note-order fa fa-edit"> Ghi chú</span> </div> </td> <td data-th="quantity">'+(Math.floor(Math.random() * 4)+1)+'</td> <td data-th="id">'+(Math.floor(Math.random() * 32))+'</td> <td class="actions" data-th=""> <button class="btn btn-lg"><i class="fa fa-angle-right"></i></button> <button class="btn btn-danger btn-lg"><i class="fa fa-angle-double-right"></i></button> </td> </tr>');
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