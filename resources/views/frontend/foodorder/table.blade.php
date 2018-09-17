<!DOCTYPE html>
<html>
<head>
	<title>Table</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/lib/dataTables.bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/lib/jquery-confirm.css')}}">
	<style type="text/css">
	.table-item{
		width:90px;
		height: 60px;
		padding: 5px 2px;
		float: left;
		text-align: center;
	}
	.table-image{
		width:60px;
		height: 36px;
	}
	.table-name{
		height: 20px;
		font-size: 14px;
	}
</style>
</head>
<body>
	<table id="tbl-table">
		<thead style="display: none;">
			<th>id</th>
			<th>name</th>
		</thead>

		<tbody>
			<div class="wrap-list-table">
				@foreach ($location as $table) 
				<tr class="table-item" table-id="{{$table->id}}">
					<td></td>
					<td>
						<img class="table-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKbR777dK73iOtIZ1-7adBIYgAM-H-rJWMybIWb_xIM-B5u9s5" alt="Image" >
						<span class="table-name">{{$table->name}}</span>
					</td>
				</tr>
				@endforeach
			</div>
		</tbody>
	</table>

	<script src="{{ asset('js/lib/jquery-3.3.1.min.js')}}"></script>
	<script src="{{ asset('js/lib/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('js/lib/jquery-confirm.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tbl-table').DataTable({
				lengthChange: false,
				info: false,   
				paging: false,
			});

		} );

		$(document).on('click', '.table-item', function(){
			var name= $(this).find('.table-name').text();
			var id= $(this).attr('table-id');
			$.confirm({
				title: 'Bạn muốn chọn <b>'+name +'</b>?',
				content: 'Nhấn OK để tiếp tục...',
				type: 'blue',
				boxWidth: "50%",
				useBootstrap: false,
				typeAnimated: true,
				buttons: {
					ok: {
						text: 'OK',
						btnClass: 'btn-green',
						keys: ['enter'],
						action: function(){
							parent.$('.order-location').attr('location-id',id);
							parent.$('.order-location').attr('location-name',name);
							parent.$('.order-location').text(name);
							parent.$('#modal-iFrame').iziModal('close');
						}
					},
					close: function () {
					}
				}
			});
			
		});

	</script>
</body>
</html>	
