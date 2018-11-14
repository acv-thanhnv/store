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
							<label>Type Name</label>
							<input type="text"  name="name" class="form-control has-feedback-left" id="name" placeholder="Add Type Name..." value="{{$type->name}}">
							<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
							<label>Price</label>
							<input type="number" name="price" class="form-control has-feedback-left" id="price" placeholder="Add Price..." value="{{$type->subprice}}">
							<span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					<div class="form-group">
						<div style="text-align: right">
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
        //submit add
        $(".edit").click(function(){
			var name  = $("#name").val();
			var price = $("#price").val();
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "",
                data:{name:name,price:price},
                success: function (result) {
                    if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}'){
                        //call parent and close modal
                        parent.$('#modal-edit').iziModal('close');
                        localStorage.setItem("Message","Table type was edit successful!");
                        parent.location.reload();
                    }else{
                        _commonShowError(result.data);
                    }
                }
            });
        })
	</script>
@endpush
