@extends("layouts.dialog")
@push("css")
	<style type="text/css">
	    .form{
	    	margin-left : auto;
	    	margin-right: auto;
	    	margin-top  : 5%;
	    	float       : none;
	    }
	    .thumb {
	    	width        : 100px;
	    	height       : 100px;
	    	margin       : 0.2em -0.7em 0 0;
	    	border-radius: 50%;
	    }
	    input[type="file"] {
	    	display: none;
	    }
	    input[type="checkbox"] {
	    	padding-top: 5px;
	    	height: 20px;
	    	width: 20px;
	    }
	    .remove_img_preview {
	    	position:relative;
	    	left: 100px;
	    	top:-100px;
	    	width: 15px;
	    	background:black;
	    	color:white;
	    	border-radius:90px;
	    	text-align:center;
	    	cursor:pointer;
	    }
	    .remove_img_preview:before {
	    	content:"\f057";
	    }
	    .password{
	    	display: none;
	    }
	</style>
@endpush
@section("content")
	<div class="col-md-8 col-xs-12 form">
		<div class="x_panel">
			<div class="x_content">
			<br>
			<form id="form_edit" class="form-horizontal input_mask" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token('')}}">
				<!--Should use session here to get idStore-->
				<input type="hidden" id="idStore" name="idStore" value="{{$obj->store_id}}">
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Name </label>
						<input type="text" value="{{$obj->name}}" name="name" class="form-control has-feedback-left" id="name"
						placeholder="Name">
						<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Description </label>
						<input type="text" name="description" class="form-control has-feedback-left" value="{{$obj->description}}" id="description"
						placeholder="Description">
						<span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div>
						<button class="btn btn-primary" type="reset">Reset</button>
						<button type="button" class="btn btn-success edit">Edit</button>
					</div>
				</div>

			</form>
			</div>
		</div>
	</div>
@endsection
@push("js")
	<script type="text/javascript">
		//submit edit 
		$(".edit").click(function(){
		var name        = $("#name").val();
		var description = $("#description").val();
        $.ajax({
        	type: 'POST',
        	headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	url: "",
        	data:{name:name,description:description},
        	success: function (result) {
        		if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}'){
        			//call parent and close modal
        			parent.$('#modal-edit').iziModal('close');
        			localStorage.setItem("Message","Menu have been edit successful!");
        		}else{
        			_commonShowError(result.data);
        		}
			}
		});
	})
	</script>
@endpush