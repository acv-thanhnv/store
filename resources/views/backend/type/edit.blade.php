@extends("layouts.dialog")
@push("css")
	<style type="text/css">
	    .form{
	    	margin-left : auto;
	    	margin-right: auto;
	    	margin-top  : 5%;
	    	float       : none;
	    }
	    .remove,.remove_prop{
			background: none;
			border    :none;
			color     : red;
			font-size: 16px;
		}
		.remove:hover,.remove_prop:hover{
			background: #DC5555;
			border    :1px solid red;
			color     : white;
		}
		.fa.fa-plus-square{
			margin-right: 5px;
		}
	</style>
@endpush
@section("content")
	<div class="col-md-7 col-xs-12 form">
		<div class="x_panel">
			<div class="x_content">
			<br>
			<form id="form_add" class="form-horizontal input_mask" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token('')}}">
				<!--Should use session here to get idStore-->
				<input type="hidden" id="idType" value="{{$obj->id}}">
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Type Name </label>
						<input type="text" name="name" class="form-control has-feedback-left" id="name" value="{{$obj->name}}" 
						placeholder="Input Name...">
						<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Type Description </label>
						<input type="text" name="description" class="form-control has-feedback-left" id="description" value="{{$obj->description}}" placeholder="Input Type Description...">
						<span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<button type="button" title="Add Property" class="btn btn-info btn-sm add_prop"><i class="fa fa-plus-square"></i>Add Property</button>
					</div>
				</div>
				<div class="form-group label_name" style="display:none">
					<div class="col-md-5 col-sm-5 col-xs-5">
						<label>Label</label></div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<label>Data Type</label>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<label>Sort by</label>
					</div>
				</div>
				<div class="form-group property">
					@foreach($obj->arrProp as $prop)
					<span class="rows">
						<div class="col-md-5 col-sm-5 col-xs-5 form-group has-feedback">
							<input type="text" class="form-control has-feedback-left" name="label" placeholder="Property Label..." value="{{$prop->property_label}}">
							<span class="fa fa-paper-plane form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
							<select class="form-control data" name="data">
								<option value="">--Data Type--</option>
								@foreach($arrData as $obj)
								<option value="{{$obj->code_value}}" 
									@if($obj->code_value==$prop->code_value)
									{{"selected"}}
									@endif
								>
								{{$obj->name}}
								</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
							<input type="text" class="form-control has-feedback-left" name="sort" placeholder="Order..." value="{{$prop->sort}}">
							<span class="fa fa-sort-numeric-desc form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-1 col-sm-1 col-xs-1 form-group">
							<button type="button" class="btn btn-danger remove_prop" data-id="{{$prop->id}}">
								<i class="fa fa-close"></i>
							</button>
						</div>
					</span>
					@endforeach
				</div>
				<div class="form-group footer" style="text-align: right">
					<div>
						<button class="btn btn-primary" type="reset">Reset</button>
						<button type="button" class="btn btn-success save">Save</button>
					</div>
				</div>

			</form>
			</div>
		</div>
	</div>
<!--Template add-->
<div id="template" style="display:none;">
<span class="rows">
	<div class="col-md-5 col-sm-5 col-xs-5 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" name="label" placeholder="Property Label...">
		<span class="fa fa-paper-plane form-control-feedback left" aria-hidden="true"></span>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
		<select class="form-control data" name="data">
			<option value="">--Data Type--</option>
			@foreach($arrData as $obj)
			<option value="{{$obj->code_value}}">{{$obj->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" name="sort" placeholder="Order...">
		<span class="fa fa-sort-numeric-desc form-control-feedback left" aria-hidden="true"></span>
	</div>
	<div class="col-md-1 col-sm-1 col-xs-1 form-group">
		<button type="button" class="btn btn-danger remove">
			<i class="fa fa-close"></i>
		</button>
	</div>
</span>
</div>
@endsection
@push("js")
	<script type="text/javascript">
		var max_fields = "{{\App\Core\Common\EntityProperty::maxField}}";
		var wrapper    = $(".property"); //Fields wrapper
		var x          = $(".property .rows").length;
		label(x);
		//insert prop
		$(document).on("click",".add_prop",function(event){
			var row = $("#template").contents().clone();
			x++;
			if(x < max_fields && x>0){
				$(".label_name").css("display","block");
				$(wrapper).append(row);
			}else{
				$.alert({
					title         : '<p class="text-warning">Warning</p>',
					icon          : 'fa fa-exclamation-circle',
					boxWidth      : '30%',
					useBootstrap  : false,
					type          :"orange",
					closeIcon     : true,
					closeIconClass: 'fa fa-close',
					content       : "Warning! You can only add up to 10 properties",
				});
			}
		});
		//remove prop
		$(document).on("click",".remove",function(event){
			$(this).parents("span").remove();
			x--;
			label(x);
		});
		//ajax delete prop
		$(document).on("click",".remove_prop",function(event){
			var tr = $(this);
			$.confirm({
			title         : '<p class="text-warning">Warning</p>',
			icon          : 'fa fa-exclamation-circle',
			boxWidth      : '50%',
			useBootstrap  : false,
			type          :"orange",
			closeIcon     : true,
			closeIconClass: 'fa fa-close',
			content       : "Are You Sure? All data related to this property will be deleted!",
			buttons       : {
				Save: {
					text    : 'OK',
					btnClass: 'btn btn-primary',
					action  : function (){
						tr.parents("span").remove();
						x--;
						label(x);
						var id = tr.data("id");
						$.get("{{route('deleteTypeProp')}}",{id:id},function(data){
								parent.Alert("Property have been deleted!");
						});
					}
				},
				cancel: {
					text    : ' Cancel',
					btnClass: 'btn btn-default'
				}
			}
			});
		});
		//submit edit 
		$(".save").click(function(){
			var name        = $("#name").val();
			var description = $("#description").val();
			var idType      = $("#idType").val();
			var rows        = $(".property .rows");
			var arrProp     = [];
			for (var i = 0; i < rows.length; i++) {
				var id    = $(rows[i]).find('button').data("id");
				var label = $(rows[i]).find('input[name=label]').val();
				var data  = $(rows[i]).find('.data').val();
				var sort  = $(rows[i]).find('input[name=sort]').val();
				arrProp[i] = {id:id,label:label,data:data,sort:sort};
			}
			$.ajax({
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('postEditType')}}",
				data:{id:idType,name:name,description:description,arrProp:arrProp},
				success: function (result) {
					if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}'){
        			//call parent and close modal
        			parent.$('#modal-add').iziModal('close');
        			localStorage.setItem("Message","Add new type successful!");
        			parent.location.reload();
        		}else{
        			_commonShowError(result.data);
        		}
        		}
        	});
		})
		//function show label
		function label(x) {
			$(document).ready(function(){
				if(x===0){
					$(".label_name").css("display","none");
				}else{
					$(".label_name").css("display","block");
				}
			});
		}
	</script>
@endpush