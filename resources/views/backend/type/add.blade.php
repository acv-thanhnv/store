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
		.footer{
			border-top: 1px solid #D7CBCB;
			padding-top: 5px;
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
						<label>Type Name </label>
						<input type="text" autofocus="" name="name" class="form-control has-feedback-left" id="name"
						placeholder="Input Name...">
						<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Type Description </label>
						<input type="text" autofocus="" name="description" class="form-control has-feedback-left" id="description"
						placeholder="Input Type Description...">
						<span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<button type="button" title="Add Property" class="btn btn-info btn-sm add_prop" data-toggle="tooltip" data-placement="right"><i class="fa fa-plus-square"></i></button>
					</div>
				</div>
				<div class="form-group property">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>abc</label>
						<input type="text" autofocus="" name="description" class="form-control has-feedback-left" id="description"
						placeholder="Input Type Description...">
						<span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
					</div>
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
@endsection
@push("js")
<script type="text/javascript">
	var max_fields = 10;
	$(document).on("click",".add_prop",function(event){

	});
	//submit add 
	$(".add").click(function(){
		var name        = $("#name").val();
		var description = $("#description").val();
		var idStore     = $("#idStore").val();
        $.ajax({
        	type: 'POST',
        	headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	url: "{{route('postAddType')}}",
        	data:{name:name,description:description,store_id:idStore},
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
