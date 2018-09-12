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
		.thumb {
			width : 100px;
			height: 100px;
			margin: 0.2em -0.7em 0 0;
			border-radius: 50%;
		}
		.remove_img_preview {
			position:relative;
			left: 100px;
			top:-100px;
			width: 15px;
			background:black;
			color:white;
			border-radius:90px;
			padding: 2px;
			text-align:center;
			cursor:pointer;
		}
		.remove_img_preview:before {
			content:"\f057";
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
		.remove{
			background: none;
			border    :none;
			color     : red;
			font-size: 16px;
		}
		.remove:hover{
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
				<input type="hidden" id="idStore" name="idStore" value="1">
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<input id="file" name="image" type="file" class="form-control" />
						<div id="preview"></div>
						<label for="file" class="custom-file-upload btn btn-outline-secondary camera">
							<i class="fa fa-camera"></i> Choose Avatar
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Food's Name </label>
						<input type="text" autofocus="" name="name" class="form-control has-feedback-left" id="name"
						placeholder="Input Food's Name...">
						<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Price </label>
						<input type="number" name="description" class="form-control has-feedback-left" id="description"
						placeholder="Input Type Description...">
						<span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Menu </label>
						<select class="form-control">
							<option>--Chose Menu--</option>
							@foreach($arrMenu as $obj)
							<option value="{{$obj->id}}">
								{{$obj->name}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Type </label>
						<select class="form-control">
							<option>--Chose Type--</option>
							@foreach($arrType as $obj)
							<option value="{{$obj->id}}">
								{{$obj->name}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<button type="button" title="Add Property" class="btn btn-info btn-sm add_prop" data-toggle="tooltip" data-placement="right"><i class="fa fa-plus-square"></i>Add Property</button>
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
				</div>
				<div class="form-group footer">
					<div>
						<button class="btn btn-primary" type="reset">Reset</button>
						<button type="button" class="btn btn-success add">Add</button>
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
		<select class="form-control">
			<option>--Chose--</option>
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
	var x          = 1;
	//upload image 
	function handleFileSelect(event) {
		var input = this;
		if (input.files && input.files.length) {
			var reader = new FileReader();
			this.enabled = false
			reader.onload = (function (e) {
				$("#preview").html(['<img class="thumb" src="', e.target.result, '" title="Avatar"/><span class="fa remove_img_preview" title="remove"></span>'].join(''))
			});
			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#file').change(handleFileSelect);
	$('#preview').on('click', '.remove_img_preview', function () {
		$("#preview").empty()
		$("#file").val("");
	});
	//insert prop
	$(document).on("click",".add_prop",function(event){
		var row = $("#template").contents().clone();
		x++;
		if(x < max_fields&& x>1){
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
		if(x===1){
			$(".label_name").css("display","none");
		}
	});
	//submit add 
	$(".add").click(function(){
		var name        = $("#name").val();
		var description = $("#description").val();
		var idStore     = $("#idStore").val();
		var rows        = $(".property .rows");
		var arrProp     = [];
		for (var i = 0; i < rows.length; i++) {
			var label = $(rows[i]).find('input[name=label]').val();
			var data = $(rows[i]).find('.data').val();
			var sort = $(rows[i]).find('input[name=sort]').val();
			arrProp[i] = {label : label,data:data,sort:sort};
		}
        $.ajax({
        	type: 'POST',
        	headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	url: "{{route('postAddType')}}",
        	data:{name:name,description:description,store_id:idStore,arrProp:arrProp},
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
</script>
@endpush
