@push("css")
<style type="text/css">
	/*Css Pagination */
	.pagination>li>a{
		padding  : 8px 12px;
		font-size: 16px;
	}
	.pagination>.active>a{
		font-weight: bold;
	}
	.table-user input{
		width : 20px;
		height: 20px;
	}
	.jconfirm-title{
		margin-top: 10px;
	}
	#tbody tr td{
		vertical-align: middle;
	}
	table.dataTable thead .sorting{
		background: none;
	}
	table.dataTable thead .sorting_asc{
		background: none;
	}
	table.dataTable thead .sorting_desc{
		background: none;
	}
	.dataTables_paginate a.current{
		background: #172D44 !important;
		color: white !important;
	}
	.img-food{
		width: 100px;
		height: 70px;
	}
	td.details-control {
		background: url('backend/template1/img/details_open.png') no-repeat center center;
		width: 40px;
		cursor: pointer;
	}
	tr.shown td.details-control {
		background: url('backend/template1/img/details_close.png') no-repeat center center;
	}
</style>
@endpush
@extends("layouts.backend")
@section("content")
<!--Title-->
<div class="page-title">
	<div class="title_left">
		<h2 class="text-primary">Type <small>List</small></h2>
	</div>
</div>
<!--Table-->
<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
    <div class="x_panel">
        <div class="x_title">
        	<button class="btn btn-primary" id="add" title="Add New Type" data-toggle="tooltip">
        		<i class="fa fa-plus"></i>
        	</button>
            <button class="btn btn-danger" id="delete_all" title="Delete All" data-toggle="tooltip">Delete All</button>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!--Content-->

        <div class="x_content">
            <div class="">
                <table class="table table-striped jambo_table table-hover table-user" id="dataTable">
                    <thead>
                    <tr class="headings">
                        <th style="text-align: center">
                            <input type="checkbox" id="check-all" class="flat">
                        </th>
                        <th>Properties</th>
                        <th class="column-title">Name </th>
                        <th class="column-title">Image </th>
                        <th class="column-title">Price</th>
                        <th class="column-title">Menu</th>
                        <th class="column-title">Edit </th>
                        <th class="column-title">Delete </th>
                    </tr>
                    </thead>
                    <!--Tbody-->
                    <tbody id="tbody">
                    	@foreach($arrFood as $obj)
						<tr>
							<td style="text-align: center" class="check-delete">
								<input type="checkbox" value="{{$obj->id}}">
							</td>
							<td></td>
							<td>{{$obj->name}}</td>
							<td>
								<img class="img-food" src="{{$obj->image}}">
							</td>
							<td>
								{{$obj->price}}
							</td>
							<td>Menu: {{$obj->menuName}}</td>
							<td>
								<button type="button" class="btn btn-primary edit round" data-id="{{$obj->id}}">
									<i class="fa fa-pencil-square-o"></i>
								</button>
							</td>
							<td>
								<button class="btn btn-danger round delete" data-id="{{$obj->id}}">
									<i class="fa fa-trash-o"></i>
								</button>
							</td>
						</tr>
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <ul id="pagination-demo" class="pagination-lg pull-right"></ul>
    </div>
</div>
@endsection
@push("js")
<script type="text/javascript">
	$(document).ready(function(){
		dataTable();
		//drag modal
		$( "#modal-add" ).draggable();
		$( "#modal-edit" ).draggable(); 
	    if(localStorage.getItem("Message"))
	    {
	    	if(localStorage.getItem("page")){
	    		var page = parseInt(localStorage.getItem("page"));
	    		$("#dataTable").DataTable().page(page).draw('page');
	    	}
	    	Alert(localStorage.getItem("Message"));
	    	localStorage.clear();
	    }
	});
	//function add
	$(document).on('click', '#add', function(event) {
		$('#modal-add').iziModal('open',event);
	});
	$('#modal-add').iziModal(
	{
		onClosed: function(modal){
			$(".iziModal-iframe").attr("src","");
		},
		focusInput	   : true,
		title          : 'Type',
		subtitle       :'Add',
		width          : 850,
		iframeHeight   : 500,
		headerColor    :"#405467",
		icon           :"fa fa-user",
		iconColor      :"#ECF0F1",
		fullscreen     :true,
		arrowKeys      :true,
		pauseOnHover   :true,
		overlayColor   : 'rgba(0, 0, 0, 0.2)',
		navigateCaption:true,
		bodyOverflow   : true,
		radius         :15,
		transitionIn   :"bounceInDown",
		transitionOut  :"bounceOutUp",
		arrowKeys      :true,
		iframe         : true,
		iframeWidth    :400,
		iframeURL      :"{{route('addFood')}}"
	});
	//function edit
	$(document).on('click', '.edit', function(event) {
	  	$('#modal-edit').iziModal('open',event);
	});
	$('#modal-edit').iziModal(
	{
		onOpening: function(modal){
			var id =$(event.target).closest("button").data("id");//get Id, get button then get id
			$(".iziModal-iframe").attr("src","{{route('editFood')}}?id="+id);
			//set url iframe
		},
		onClosed: function(modal){
			if (localStorage.getItem("Message")) {
				var page = $("#dataTable").DataTable().page();
				localStorage.setItem("page",page);
				location.reload();
			}
			$(".iziModal-iframe").attr("src","");
		},
		title          : 'Food',
		subtitle       :'Edit',
		width          : 850,
		iframeHeight   : 500,
		headerColor    :"#405467",
		icon           :"fa fa-user",
		iconColor      :"#ECF0F1",
		fullscreen     :true,
		arrowKeys      :true,
		overlayColor   : 'rgba(0, 0, 0, 0.2)',
		navigateCaption:true,
		bodyOverflow   : true,
		radius         :15,
		transitionIn   :"bounceInDown",
		transitionOut  :"bounceOutUp",
		arrowKeys      :true,
		iframe         : true,
		iframeWidth    :500,
		iframeURL      :""
	});
	//Delete User
	$("body").on("click",".delete",function(e){
		var id = $(this).data("id");
		var tr = $(this).parents('tr');
		$.confirm({
			title         : '<p class="text-warning">Warning</p>',
			icon          : 'fa fa-exclamation-circle',
			boxWidth      : '30%',
			useBootstrap  : false,
			type          :"orange",
			closeIcon     : true,
			closeIconClass: 'fa fa-close',
			content       : "Are You Sure? This Type and Related Data Will Be Deleted!",
			buttons       : {
				Save: {
					text    : 'OK',
					btnClass: 'btn btn-primary',
					action  : function (){
						$("#dataTable").DataTable().row(tr).remove().draw(false);
						$.get("{{route('deleteType')}}",{id:id},function(data){
							Alert("Type Have Been Deleted Successful!");
						});
					}
				},
				cancel: {
					text    : ' Cancel',
					btnClass: 'btn btn-default',
					action  : function () {
					}
				}
			}
		});
	});
	//delete-all
	$("body").on("click","#delete_all",function(e){
		var checked = $("input:checked").length;
		if(checked===0){
			$.alert({
				title: '<p class="text-warning">Notice!</p>',
				icon          : 'fa fa-exclamation-circle',
				type          :"orange",
				boxWidth: '20%',
				content: '<span style="font-size: 16px">Nothing To Delete</span>'
			});
		}else{
			$.confirm({
			title         : '<p class="text-warning">Warning</p>',
			icon          : 'fa fa-exclamation-circle',
			boxWidth      : '30%',
			useBootstrap  : false,
			type          :"orange",
			closeIcon     : true,
			closeIconClass: 'fa fa-close',
			content       : "Are You Sure? All of these types and related data will be deleted!",
			buttons       : {
				Save: {
					text    : 'OK',
					btnClass: 'btn btn-primary',
					action  : function (){
						var arrId = [];
						$(".check-delete input:checked").each(function(){
							var tr = $(this).parents("tr");
							$("#dataTable").DataTable().row(tr).remove().draw(false);
							arrId.push($(this).val());
						});
						$.get("{{route('deleteAllType')}}",{arrId:arrId},function(data){
								Alert("Types have been deleted!");
						});
					}
				},
				cancel: {
					text    : ' Cancel',
					btnClass: 'btn btn-default',
					action  : function () {
					}
				}
			}
			});
		}
	});
	//check all
	$('body').on("change","#check-all",function(e){
	    var checkboxes = $(this).closest('table').find(':checkbox');
	    checkboxes.prop('checked', $(this).is(':checked'));
	});
	//function alert 
	function Alert(content)
	{
		$.toast({
		    text: content,
		    heading: 'Successful',
		    icon: "success",
		    showHideTransition: 'slide',
		    allowToastClose: true,
		    hideAfter: 1500,
		    stack: 5,
		    position: 'top-right',
		    textAlign: 'left', 
		    loader : true,
		    loaderBg: '#9EC600'
		});
	}
	//function dataTable
	function dataTable()
	{
		//hiển thị bảng infor nhỏ
        function format ( d ) {
            // `d` is the original data object for the row
            return '<table class="table table-hover" cellspacing="5px" border="0" style="padding-left:50px; width:50%">'+
                '<tr>'+
                    '<td><b>Property 1:</b></td>'+
                    '<td>'+d.date+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td><b>Property 2:</b></td>'+
                    '<td>'+d.gt+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td><b>Property 3:</b></td>'+
                    '<td>'+d.dc+'</td>'+
                '</tr>'+
            '</table>';
        }
		var groupColumn = 5;
		var table = $('#dataTable').DataTable({
			"columnDefs": [
				{ 
					"visible": false, 
					"targets": groupColumn 
				},
				{ 
                    "orderable": false ,
                    "targets": [0,1,5,6,7]
                }
			],
			order: [],
			"columns": [
				{ "data": "check" },
				{
					"className":      'details-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},
				{ "data": "name" },
				{ "data": "image" },
				{ "data": "price" },
				{ "data": "menu" },
				{ "data": "edit" },
				{ "data": "delete" }
			],
			"drawCallback": function ( settings ) {
				var api = this.api();
				var rows = api.rows( {page:'current'} ).nodes();
				var last=null;

				api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
					if ( last !== group ) {
						$(rows).eq( i ).before(
							'<tr class="group"><td colspan="5">'+group+'</td></tr>'
							);

						last = group;
					}
				} );
			}
		} );
		// Add event listener for opening and closing details
		$('#dataTable tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );

			if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
        } );
	}
</script>
@endpush
