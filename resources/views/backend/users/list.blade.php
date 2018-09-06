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
	.img{
		width: 50px; 
		height: 50px;
	}
	.img{
		cursor: pointer;
	}
</style>
@endpush
@extends("layouts.backend")
@section("content")
<!--Title-->
<div class="page-title">
	<div class="title_left">
		<h2 class="text-primary">User <small>List</small></h2>
	</div>
</div>
<!--Table-->
<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
    <div class="x_panel">
        <div class="x_title">
        	<button class="btn btn-primary" id="add">
        		<i class="fa fa-plus"></i>
        	</button>
            <button class="btn btn-danger" id="delete_all">Delete All</button>
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
            <div class="table-responsive">
                <table class="table table-striped jambo_table table-hover table-user">
                    <thead>
                    <tr class="headings">
                        <th style="text-align: center">
                            <input type="checkbox" id="check-all" class="flat">
                        </th>
                        <th class="column-title">Image </th>
                        <th class="column-title">Name </th>
                        <th class="column-title">Email </th>
                        <th class="column-title">Role </th>
                        <th class="column-title">Active </th>
                        <th class="column-title">Edit </th>
                        <th class="column-title">Delete </th>
                    </tr>
                    </thead>
                    <!--Tbody-->
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
        <ul id="pagination-demo" class="pagination-lg pull-right"></ul>
    </div>
</div>
@include("backend.users.templateUser")
@endsection
@push("js")
<script type="text/javascript">
	//get list
	getList();
	//show profile user
	$(document).on('click','.img',function(event){
		$('#modal-profile').iziModal('open',event);
	});
	$('#modal-profile').iziModal(
	{
		onOpening: function(modal){
			var id =$(event.target).data("id");//get Id
			$(".iziModal-iframe").attr("src","{{route('profile')}}?id="+id);
		},
		onClosed: function(modal){
			$(".iziModal-iframe").attr("src","");
		},
		focusInput	   : true,
		title          : 'User',
		subtitle       :'Profile',
		width          : 800,
		timeoutProgressbarColor:"red",
		iframeHeight   : 300,
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
		iframe         : true,
		iframeURL      :"",
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
		title          : 'User',
		subtitle       :'Add',
		width          : 700,
		iframeHeight   : 600,
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
		iframeURL      :"{{route('add')}}"
	});
	//function edit
	$(document).on('click', '.edit', function(event) {
	  	$('#modal-edit').iziModal('open',event);
	  	$('#modal-profile').iziModal('resetProgress');
	});
	$('#modal-edit').iziModal(
	{
		onOpening: function(modal){
			var id =$(event.target).closest("button").data("id");//get Id, get button then get id
			$(".iziModal-iframe").attr("src","{{route('edit')}}?id="+id);
			//set url iframe
		},
		onClosed: function(modal){
			$(".iziModal-iframe").attr("src","");
		},
		title          : 'User',
		subtitle       :'Edit',
		width          : 700,
		iframeHeight   : 600,
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
		iframeWidth    :400,
		iframeURL      :""
	});
	//Delete User
	$("body").on("click",".delete",function(e){
		var id = $(this).data("id");
		var tr = $(this).parent().parent();
		$.confirm({
			title         : '<p class="text-warning">Warning</p>',
			icon          : 'fa fa-exclamation-circle',
			boxWidth      : '30%',
			useBootstrap  : false,
			type          :"orange",
			closeIcon     : true,
			closeIconClass: 'fa fa-close',
			content       : "Are You Sure? This User Will Be Deleted!",
			buttons       : {
				Save: {
					text    : 'OK',
					btnClass: 'btn btn-primary',
					action  : function (){
						$.get("{{route('delete')}}",{id:id},function(data){
							alert("Delete");
							$('#pagination-demo').twbsPagination('destroy');
							getList();
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
	//check all
	$('body').on("change","#check-all",function(e){
	    var checkboxes = $(this).closest('table').find(':checkbox');
	    checkboxes.prop('checked', $(this).is(':checked'));
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
			content       : "Are You Sure? Users Will Be Deleted!",
			buttons       : {
				Save: {
					text    : 'OK',
					btnClass: 'btn btn-primary',
					action  : function (){
						var arrUser = [];
						$(".check-delete input:checked").each(function(){
							arrUser.push($(this).val());
						});
						$.get("{{route('deleteAll')}}",{arrUser:arrUser},function(data){
								$("#check-all").prop('checked',false);//set check-all = false
								alert("Delete");
						$('#pagination-demo').twbsPagination('destroy');
						getList();
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
	//function alert 
	function alert(type)
	{
		$.toast({
		    text: "User Have Been "+type+" Successful!",
		    heading: 'Successful',
		    icon: 'success',
		    showHideTransition: 'plain',
		    allowToastClose: true,
		    hideAfter: 2000,
		    stack: 5,
		    position: 'top-right',
		    textAlign: 'left', 
		    loader: true,
		    loaderBg: '#9EC600',
		});
	}
	//function getList
	function getList(page){
		$(document).ready(function(){
			$.get("{{route('paginate')}}",{page:page},function(data){
				buildList(data.data);
				paginate(data.data.last_page);
			});
		});
	}
	//function builList
	function buildList(data)
	{
		var tbody = $("#tbody");
		$(tbody).empty();
		data.data.forEach(function(obj) {
			var row = $("#tr-customer").contents().clone();
			$(row).find('.check').val(obj.id);
			$(row).find('.img').attr('src', obj.avatar);
			$(row).find('.img').data("id",obj.id);
		 	$(row).find('.name').html(obj.name);
		 	$(row).find('.email').html(obj.email);
		 	$(row).find('.role').html(obj.role);
		 	if(obj.is_active===1){
		 		$(row).find('.active').html("Có");
		 	}else{
		 		$(row).find('.active').html("Không");
		 	}
		 	//profile
		 	$(row).find('.profile').data("id",obj.id);
		 	//edit
		 	$(row).find('.edit').data("id",obj.id);
		 	//delete
		 	$(row).find('.delete').data("id",obj.id);
		 	$(tbody).append($(row));
		});
	}
	//function paginate-Phan trang
	function paginate(totalPages){
		$('#pagination-demo').twbsPagination({
			totalPages            : totalPages,
			visiblePages          : 5,
			hideOnlyOnePage       :true,	
			initiateStartPageClick:false,
			onPageClick:function(event,page){
				$("#check-all").prop('checked',false);//set check-all = false
				$.get("{{route('paginate')}}",{page:page},function(data){
				buildList(data.data);
				});
			}
		});
	}
</script>
@endpush
