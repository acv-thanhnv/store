
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<style type="text/css">

</style>

<table id="tbl-table">
	<thead style="display: none">
		<th>id</th>
		<th>name</th>
	</thead>
	
	<tbody>
		<ul id="list-table" >
			@foreach ($location as $table) {

			<li class="item-table" style="width:100px, height:100px; float: left;">
				<tr style="width:50px; height:50px; float: left;">
					<td style="width:50px;"><div><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKbR777dK73iOtIZ1-7adBIYgAM-H-rJWMybIWb_xIM-B5u9s5" alt="image" table-id="{{$table->id}}" style="width:40px; height: 40px;"></div></td>
					<td><div class="wrap-table-name"><span class="table-name">{{$table->name}}</span></div></td>
				</tr>	
			</li>
		}
		@endforeach
	</ul>
</tbody>
</table>

<script src="{{ asset('js/lib/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/lib/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tbl-table').DataTable({
			ordering:  false,
			lengthChage: false,
		});

	} );
</script>
