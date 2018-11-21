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
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Menu Name </label>
						<input type="text" name="name" class="form-control has-feedback-left" id="name"
						placeholder="Add Menu Name...">
						<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Priority </label>
						<input type="number" name="priority" class="form-control has-feedback-left" id="priority"
						placeholder="Priority...">
						<span class="fa fa-level-up form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Menu Description </label>
						<input type="text" autofocus="" name="description" class="form-control has-feedback-left" id="description"
						placeholder="Add Menu Description...">
						<span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group" style="text-align: right">
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
	//submit add 
	$(".add").click(function(){
		var name        = $("#name").val();
		var description = $("#description").val();
		var priority    = $("#priority").val();
        $.ajax({
        	type: 'POST',
        	headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	url: "{{route('postAddMenu')}}",
        	data:{name:name,description:description,priority:priority},
        	success: function (result) {
        		if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}'){
        			//call parent and close modal
        			parent.$('#modal-add').iziModal('close');
        			localStorage.setItem("Message","Add new menu successful!");
        			parent.location.reload();
        		}else{
        			_commonShowError(result.data);
        		}
			}
		});
	})
</script>
@endpush
