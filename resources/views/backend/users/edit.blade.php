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
			<form class="form-horizontal input_mask" method="POST">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" id="id" value="{{$user->id}}">
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">	
						<input id="file" name="image" type="file" class="form-control" />
						<div id="preview">
							<img data-src="{{$user->src}}" data-path="{{$user->avatar}}" class="thumb" title="avatar" src="{{$user->src}}">
						</div>
						<label for="file" class="custom-file-upload btn btn-outline-secondary camera">
							<i class="fa fa-picture-o"></i> Change Avatar
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Name </label>
						<input type="text" class="form-control has-feedback-left" value="{{$user->name}}" name="name" id="name"
						placeholder="Name">
						<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-4 col-xs-4 form-group has-feedback">
						<label>Date Of Birth </label>
						<input type="text" class="form-control has-feedback-left" id="date" value="{{$user->birth_date}}" name="date" aria-describedby="inputSuccess2Status">
						<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true">
						</span>
						<span id="inputSuccess2Status" class="sr-only">(success)</span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8">
						<label>Gender</label>
						<br>
						<div id="gender" class="btn-group" data-toggle="buttons">
							<label class="btn btn-default">
								<input class="radio-gender" type="radio" name="gender" value="1"@if( $user->gender=== 1) {{"checked"}} @endif> &nbsp; Male &nbsp;
							</label>
							<label class="btn btn-default">
								<input type="radio" name="gender" value="0" @if($user->gender===0) {{"checked"}} @endif> Female
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Email </label>
						<input type="text" class="form-control has-feedback-left" id="email" value="{{$user->email}}" placeholder="Email" name="email">
						<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
					<input type="checkbox" name="changPass" id="changePass"> <label>Change Password</label>
					</div>
				</div>
				<div class="form-group password">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Password </label>
						<input type="password" class="form-control has-feedback-left password" id="password" name="pass" placeholder="Password">
						<span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group password">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Re Password </label>
						<input type="password" class="form-control has-feedback-left" id="password_confirmation" name="password_confirmation" placeholder="Re Password">
						<span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group" style="margin-top: 15px">
					<div class="col-md-8 col-sm-8 col-xs-8">
						<label>Role </label>
						<select class="form-control" id="role" name="role">
							<option value="">Choose Role</option>
							@foreach($arrRole as $role)
							<option value="{{$role->role_value}}" 
								@if($role->role_value==$user->role_value) {{"selected"}} 
								@endif>
								{{$role->name}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="ln_solid"></div>
				<div class="form-group">
					<div class=>
						<button id="reset" class="btn btn-primary" type="reset">Reset</button>
						<button type="button" class="btn btn-success edit">Submit</button>
					</div>
				</div>

			</form>
			</div>
		</div>
	</div>
@endsection
@push("js")
	<script type="text/javascript">
		//set gender
		$(document).ready(function(){
			var label =$('input[name=gender]:checked').parent("label");
			label.removeClass('btn-default');
			label.addClass('btn-primary active');
			//formart date
			$('#date').daterangepicker({
				singleClasses: "picker_1",
				"singleDatePicker": true,
				"locale": {
					"format": "YYYY-MM-DD",
				}
			}, function(start, end, label) {
			});
		});
		$("body").on("change","input[name=gender]",function(e){
			//add class checked
			$(this).parent("label").addClass("btn btn-primary active");
			//remove class unckecked
			$('input[name=gender]:not(:checked)').parent("label").removeClass('btn-primary').addClass("btn-default");
		});
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
		//reset image
		$("#reset").click(function(){
			var src = $("img").data("src");
			$("img").attr('src', src);
		});
		//change Password
		$("#changePass").click(function(){
			if($(this).is(":checked")){
				$(".password").css('display',"block");
			}else{
				$(".password").css("display","none");
			}
		});
		//submit edit 
		$("body").on("click",".edit",function(e){

			var formData = new FormData();
			formData.append("name", $("#name").val());
			formData.append("id", $("#id").val());
			formData.append("image", $('input[type=file]')[0].files[0]);
			formData.append("oldImgSrc", $("img").data("path"));
			formData.append("date", $("#date").val());
			formData.append("gender", $('input[name=gender]:checked').val());
			formData.append("email", $("#email").val());
			formData.append("role", $("#role").val());
			formData.append("changePass",0);
			if($("input[type=checkbox]").is(":checked")){
				formData.append("pass", $("#password").val());
				formData.append("password_confirmation", $("#password_confirmation").val());
				formData.append("changePass",1);
			}
			$.ajax({
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				contentType: false,
	    		processData: false,
				url: "{{route('editPost')}}",
				data:formData,
				success: function (result) {
					if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}') {
						parent.$('#modal-edit').iziModal('close');
						var page = parent.$("#pagination-demo").find("li.active").find("a").text();
						parent.getList(page);
						parent.alert("Edit");
						//call parent and close modal
					}else{
						_commonShowError(result.data[0]);
					}
				}
			});
		});	
	</script>
@endpush