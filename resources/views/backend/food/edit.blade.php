@extends("layouts.dialog")
@push("css")
    <style type="text/css">
    	.form{
			margin-left : auto;
			margin-right: auto;
			margin-top: 5%;
			float       : none;
    	}
    	input[type="file"] {
    		display: none;
    	}
		.custom-file-upload { 
			display: inline; 
			padding: 8px 12px;
		}
		#success_message{
			display:none;
		}
		.help-block{
			font-size: 14px;
		}
		#success_message{
			display:none;
		}
		.footer{
			border-top : 1px solid #D7CBCB;
			padding-top: 5px;
		}
		.remove,.remove_prop{
			background: none;
			border    :none;
			color     : red;
			font-size: 16px;
		}
		.fa.fa-plus-square{
			margin-right: 5px;
		}
		.show-errors{
			float       : none;
			margin-left : 10px;
		}
		.close{
			right:2px !important;
			color: white;
			opacity: 0.7;
			top: -10px !important;
		}
		.data,.sort{
			padding-right: 0px !important;
		}
		#OpenImgUpload:hover{
			cursor: pointer;
		}
    </style>
@endpush
@section("content")
	<div class="col-md-10 col-xs-12 form">
		<div class="x_panel">
			<div class="x_content">
			<br>
			<form id="form_add" class="form-horizontal input_mask" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token('')}}">
				<!--Should use session here to get idStore-->
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<input id="file" name="image" type="file" class="form-control" />
						<div id="preview">
							<img id="OpenImgUpload" data-src="{{$food->src}}" data-path="{{$food->image}}" class="thumb" title="avatar" src="{{$food->src}}">
							<span class="fa remove_img_preview" title="remove"></span>
						</div>
						<label for="file" class="custom-file-upload btn btn-outline-secondary camera">
							<i class="fa fa-camera"></i> Choose Image
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Food's Name </label>
						<input type="text"  name="name" class="form-control has-feedback-left" id="name" value="{{$food->name}}" 
						placeholder="Input Food's Name...">
						<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-4 col-xs-4 form-group has-feedback">
						<label>Price </label>
						<input type="number" name="price" class="form-control has-feedback-left" id="price" value="{{$food->price}}" 
						placeholder="Input Price...">
						<span class="fa fa-usd form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Menu </label>
						<select class="form-control" id="menu" name="menu">
							<option value="">--Choose Menu--</option>
							@foreach($arrMenu as $obj)
							<option value="{{$obj->id}}"
								@if($food->menu_id==$obj->id)
								{{"selected"}}
								@endif
							>
								{{$obj->name}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<button type="button" title="Add Property" class="btn btn-info btn-sm add_prop"><i class="fa fa-plus-square"></i>Add Property</button>
					</div>
				</div>
				<div class="form-group label_name" style="display:none">
					<div class="col-md-4 col-sm-4 col-xs-4">
						<label>Label</label></div>
					<div class="col-md-2 col-sm-2 col-xs-2">
						<label>Data Type</label>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-2">
						<label>Sort by</label>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<label>Value</label>
					</div>
				</div>
				<div class="prop">
					<div class="form-group property">
						@foreach($food->arrProp as $prop)
						<span class="rows">
							<div class="col-md-4 col-sm-4 col-xs-4 form-group has-feedback">
								<input type="text" class="form-control has-feedback-left" name="label" placeholder="Property Label..." value="{{$prop->property_label}}">
								<input type="hidden" name="idProp" value="{{$prop->property_id}}">
								<input type="hidden" name="idValue" value="{{$prop->id}}">
								<span class="fa fa-paper-plane form-control-feedback left" aria-hidden="true"></span>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-2 form-group has-feedback">
								<select class="form-control data" name="data">
									@foreach($arrData as $obj)
									<option value="{{$obj->code_value}}"
										@if($obj->code_value == $prop->data_type_code)
										{{"selected"}}
										@endif
									>
									{{$obj->name}}
									</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-2 form-group has-feedback">
								<input type="text" class="form-control has-feedback-left sort" name="sort" placeholder="Sort..." value="{{$prop->sort}}">
								<span class="fa fa-sort-numeric-desc form-control-feedback left" aria-hidden="true"></span>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
								<input type="text" class="form-control has-feedback-left" name="value" placeholder="Value..." value="{{$prop->value}}">
								<span class="fa fa-sort-numeric-desc form-control-feedback left" aria-hidden="true"></span>
							</div>
							<div class="col-md-1 col-sm-1 col-xs-1 form-group">
								<button type="button" class="btn btn-danger remove_prop" data-id="{{$prop->property_id}}">
									<i class="fa fa-close"></i>
								</button>
							</div>
						</span>
						@endforeach
					</div>
				</div>
				<div class="form-group footer" style="text-align: right">
					<div>
						<button class="btn btn-primary reset" type="reset">Reset</button>
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
	<div class="col-md-4 col-sm-4 col-xs-4 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" name="label" placeholder="Property Label...">
		<span class="fa fa-paper-plane form-control-feedback left" aria-hidden="true"></span>
	</div>
	<div class="col-md-2 col-sm-2 col-xs-2 form-group has-feedback">
		<select class="form-control data" name="data">
			@foreach($arrData as $obj)
			<option value="{{$obj->code_value}}">{{$obj->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="col-md-2 col-sm-2 col-xs-2 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left sort" name="sort" placeholder="Sort...">
		<span class="fa fa-sort-numeric-desc form-control-feedback left" aria-hidden="true"></span>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" name="value" placeholder="Value...">
		<span class="fa fa-sort-numeric-desc form-control-feedback left" aria-hidden="true"></span>
	</div>
	<div class="col-md-1 col-sm-1 col-xs-1 form-group">
		<button type="button" class="btn btn-danger remove">
			<i class="fa fa-close"></i>
		</button>
	</div>
</span>
</div>
<!--Template errors-->
<div id="error" style="display:none">
	<div class="col-md-10 alert alert-warning alert-dismissible show-errors">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<span class="content-errors"></span>
	</div>
</div>
@endsection
@push("js")
<script type="text/javascript">
	var max_fields = "{{\App\Core\Common\EntityProperty::maxField}}";
	var wrapper    = $(".property"); //Fields wrapper
	var x          = $(".property .rows").length;
	label(x);
	//upload image 
	function handleFileSelect(event) {
		var input = this;
		if (input.files && input.files.length) {
			var reader = new FileReader();
			this.enabled = false
			reader.onload = (function (e) {
				$(".thumb").attr('src', e.target.result);
			});
			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#file').change(handleFileSelect);
	$('#preview').on('click', '.remove_img_preview', function () {
		var src = $("img").data("src");
		$("img").attr('src', src);
	});
	//Open dialog box for upload when click on image
	$(document).on("click",'#OpenImgUpload',function(e){
		$('#file').trigger('click');
	});
	//reset image
	$(".reset").click(function(){
		var src = $("img").data("src");
		$("img").attr('src', src);
	});
	//insert prop
	$(document).on("click",".add_prop",function(event){
		var row = $("#template").contents().clone();
		x++;
		if(x < max_fields&& x>=1){
			label(x);
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
						$.get("{{route('deleteFoodProp')}}",{id:id},function(data){
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
	//submit add 
	$(".save").click(function(){
		var formData = new FormData();
		var rows     = $("div.prop .rows");
		var arrProp  = [];
		for (var i = 0; i < rows.length; i++) {
			var idProp  = $(rows[i]).find('input[name=idProp]').val();
			var idValue = $(rows[i]).find('input[name=idValue]').val();
			var label   = $(rows[i]).find('input[name=label]').val();
			var data    = $(rows[i]).find('.data').val();
			var sort    = $(rows[i]).find('input[name=sort]').val();
			var value   = $(rows[i]).find('input[name=value]').val();
			arrProp[i] = {idValue:idValue,idProp:idProp,label : label,data:data,sort:sort,value:value};
		}
		formData.append("name", $("#name").val());
        formData.append("image", $('input[type=file]')[0].files[0]);
        formData.append("oldImage", $(".thumb").data("path"));
        formData.append("price", $("#price").val());
        formData.append("menu", $('#menu').val());
        formData.append("arrProp", JSON.stringify(arrProp));
        $.ajax({
        	type: 'POST',
        	headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	contentType: false,
        	processData: false,
        	url: "",
        	data:formData,
        	success: function (result) {
        		if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}'){
        			//call parent and close modal
        			parent.$('#modal-add').iziModal('close');
        			localStorage.setItem("Message","Food have been updated!");
        			parent.location.reload();
        		}else{
        			_commonShowError(result.data);
        		}
			}
		});
	})
	//function show label
	function label(num_rows) {
		if(num_rows<=0){
			$(".label_name").css("display","none");
		}else{
			$(".label_name").css("display","block");
		}
	}
</script>
@endpush
