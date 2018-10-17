<table id="cart" class="table table-hover">
	<thead>
		<tr>
			<th style="width:55%">Product</th>
			<th style="width:10%">Price</th>
			<th style="width:10%">Quantity</th>
			<th style="width:20%" class="text-center">Subtotal</th>
			<th style="width:5%"></th>
		</tr>
	</thead>
	<tbody>
		@for($i=1;$i<15;$i++)
		<tr>
			<td data-th="Product">
				<div class="col-sm-4 nopad image-order"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMnrzprGAVUtl8Ojmn1licHEflA6dQymskF4HBbvmayeRVUfPS" alt="Image" class="img-responsive" /></div>
				<div class="col-sm-8">
					<h5 class="nomargin item-order-name">Humburger thịt bò mỹ Humburger thịt bò mỹ  Humburger thịt bò mỹ </h>
					</div>
				</td>
				<td data-th="Price">100.000đ</td>
				<td class="quantity-order" data-th="Quantity" style="">
					<input type="number" class="form-control text-center" value="1" >
					<div class="updown-quantity" style="width:15px; float: left;font-size: 12px; margin-top:2px;">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</div>
				</td>
				<td data-th="Subtotal" class="text-center">1.99</td>
				<td class="actions" data-th="">
					<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
				</td>
			</tr>
			@endfor
		</tbody>
	</table>