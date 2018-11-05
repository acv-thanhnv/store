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
							<label>Table Name</label>
							<input type="text" autofocus="" name="name" class="form-control has-feedback-left" id="name"
								   placeholder="Add Location Name...">
							<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					<div class="form-group" style="margin-top: 15px">
						<div class="col-md-8 col-sm-8 col-xs-8">
							<label>Table Type</label>
							<select class="form-control" id="type" name="type">
								<option value="">Choose Type of Table</option>
								{{--@foreach($table as $floor)--}}
									{{--<option value="{{$floor->id}}">--}}
										{{--{{$floor->name}}--}}
									{{--</option>--}}
								{{--@endforeach--}}
							</select>
						</div>
					</div>
					<div class="form-group" style="margin-top: 15px">
						<div class="col-md-8 col-sm-8 col-xs-8">
							<label>Floor</label>
							<select class="form-control" id="floor" name="floor">
								<option value="">Choose Floor</option>
								{{--@foreach($arrRole as $role)--}}
								{{--<option value="{{$role->role_value}}">--}}
								{{--{{$role->name}}--}}
								{{--</option>--}}
								{{--@endforeach--}}
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
							<label>Price</label>
							<input type="text" autofocus="" name="price" class="form-control has-feedback-left" id="price"
								   placeholder="Add Price...">
							<span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					<div class="form-group">
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
            var type        = $("#type").val();
            var floor        = $("#floor").val();
            var price        = $("#price").val();
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('postAddTable')}}",
                data:{name:name,type:1,floor:1,price:0},
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
