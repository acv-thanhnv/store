<!DOCTYPE html>
<html>
<head>
	<title>Vị trí</title>
    <link href="{{ asset('backend/template1/css/bootstrap.min.css') }}" rel="stylesheet">
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
        font-weight: bold;
	}
        #tbl-table td:hover{
            background: #d9edf7;
        }
    #tbl-table .table-image{
        cursor: pointer;
    }
        .dataTables_wrapper{
            padding: 10px;
        }
        #tbl-table_filter{
            text-align: right;
        }
        input[type="search"]{
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
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
                        <span class="table-name">{{$table->name}}</span>
						<img class="table-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKbR777dK73iOtIZ1-7adBIYgAM-H-rJWMybIWb_xIM-B5u9s5" alt="Image" >
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
                language:{
                    "emptyTable": "Không có vị trí nào",
                    "search": "<i class='glyphicon glyphicon-search'></i>",
                    "zeroRecords": "Không có vị trí nào phù hợp",
                }
			});
		} );

		$(document).on('click', '.table-item', function(){
			var name= $(this).find('.table-name').text();
			var id= $(this).attr('table-id');
			parent.$('.order-location-label').attr('location-id',id);
            parent.$('.order-location-label').attr('location-name',name);
            parent.$('.order-location-label').text(name);
            parent.$('#modal-iFrame').iziModal('close');
		});

	</script>
</body>
</html>
