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
						<label>Type </label>
						<select class="form-control type" name="type">
							<option value="">--Select Type--</option>
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
						<label>Data Property </label>
						<select class="form-control data" name="dataProp">
							<option value="">--Select Data Property--</option>
							@foreach($arrData as $obj)
							<option value="{{$obj->code_value}}">
								{{$obj->name}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Property Label </label>
						<input type="text" autofocus="" name="label" class="form-control has-feedback-left" id="label"
						placeholder="Add Property Label...">
						<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div>
						<button class="btn btn-primary" type="reset">Reset</button>
						<button type="button" class="btn btn-success add">Save</button>
						<button type="button" class="btn btn-success">Save and Add New</button>
					</div>
				</div>

			</form>
			</div>
		</div>
	</div>
@endsection
@push("js")
<script type="text/javascript">
	//select
	$(document).ready(function() {
		$('.type').select2();
		$('.data').select2();
	});
	//submit add 
	$(".add").click(function(){
		var label    = $("#label").val();
		var type     = $(".type").val();
		var dataProp = $(".data").val();
        $.ajax({
        	type: 'POST',
        	headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	url: "",
        	data:{label:label,type:type,dataProp:dataProp},
        	success: function (result) {
        		if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}'){
        			//call parent and close modal
        			parent.$('#modal-add').iziModal('close');
        			localStorage.setItem("Message","Add new property successful!");
        			parent.location.reload();
        		}else{
        			_commonShowError(result.data);
        		}
			}
		});
	})
</script>
@endpush
