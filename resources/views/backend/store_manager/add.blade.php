@extends("layouts.backend")
@push("css")
    <style type="text/css">
    	/* Optional: Makes the sample page fill the window. */
	    html, body {
	        height : 100%;
	        margin : 0;
	        padding: 0;
	    }
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
		.remove,.remove_by_type{
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
		#map {
			height: 678px;
			width: 100%;
		}
		.controls {
			border: 1px solid transparent;
			border-radius: 2px 0 0 2px;
			box-sizing: border-box;
			height: 32px;
			outline: none;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
		}
		#search {
			background-color: #fff;
			font-family: Roboto;
			font-size: 15px;
			font-weight: 300;
			text-overflow: ellipsis;
			width: 100%;
		}
		#search:focus {
			border-color: #4d90fe;
		}
		#preview{
			/*width : 300px;
            min-height: 100px;
            height: 200px;
            margin: 0.2em -0.7em 0 0;
            border-radius: 20px;
            box-shadow: 5px 5px 2px 5px #D7C7C7;
			/*background-image: url("common_images/no-store.png");*/*/
		}
    </style>
@endpush
@section("content")
<div class="add_map">
	<div class="col-md-6 col-xs-12">
		<div class="x_panel">
			<label>Choose Coordinate For Store</label>
			<div class="col-md-12 col-sm-10 col-xs-12 form-group has-feedback">
				<input type="text" autofocus="" name="name" class="form-control controls has-feedback-left" id="search"
				placeholder="Search location for store...">
				<span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
			</div>
			<div id="map"></div>
		</div>
	</div>
	<div class="col-md-6 col-xs-12">
		<div class="x_panel">
			<div class="x_content">
			<br>
			<form id="form_add" class="form-horizontal input_mask" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token('')}}">
				<!--Should use session here to get idStore-->
				<div class="form-group">
					<div class="col-md-10 col-sm-10 col-xs-12 form-group has-feedback">
						<input id="file" name="image" type="file" class="form-control" />
						<div id="preview">
							<img src="common_images/no-store.png" class="thumb" id="OpenImgUpload">
							<div id="block" style="margin-bottom: 17px"></div>
						</div>
						<label for="file" class="custom-file-upload btn btn-outline-secondary camera">
							<i class="fa fa-camera"></i> Choose Image
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-sm-10 col-xs-12 form-group has-feedback">
						<label>Store's Name </label>
						<input type="text" autofocus="" name="name" class="form-control has-feedback-left" id="name"
						placeholder="Input Store's Name...">
						<span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-sm-10 col-xs-12 form-group has-feedback">
						<label>Address </label>
						<input type="text" autofocus="" class="form-control has-feedback-left" id="address" name="address" 
						placeholder="Input Address of Store...">
						<span class="fa fa-road form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Latitude  </label>
						<input type="number" readonly="" id="lat" class="form-control has-feedback-left" name="lat" 
						placeholder="Latitude...">
						<span class="fa fa-compass form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Longtitude   </label>
						<input type="number" readonly="" id="lng" class="form-control has-feedback-left" name="lng" 
						placeholder="Longitude...">
						<span class="fa fa-compass form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Priority</label>
						<input type="number" id="priority" class="form-control has-feedback-left" name="priority" 
						placeholder="Priority...">
						<span class="fa fa-star-half-empty form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-sm-10 col-xs-12 form-group has-feedback">
						<label>Description</label>
						<textarea class="form-control" id="description" rows="2" placeholder="Description for store..."></textarea>
					</div>
				</div>
				<div class="form-group footer">
					<div>
						<button type="button" class="btn btn-success add pull-right">Save</button>
						<button class="btn btn-primary pull-right" type="reset">Reset</button>
					</div>
				</div>

			</form>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<button class="btn btn-danger" id="addUser" title="Add New User" data-toggle="tooltip">
			<i class="fa fa-plus"></i> Add User
		</button>
		<div id="listUser" class="dis-none">
			<table class="table table-striped jambo_table table-hover table-user">
				<thead>
					<tr class="headings">
						<th style="text-align: center">
							<input type="checkbox" id="check-all" class="flat">
						</th>
						<th class="column-title">Image </th>
						<th class="column-title">Name </th>
						<th class="column-title">Email </th>
						<th class="column-title">Store </th>
						<th class="column-title">Role </th>
						<th class="column-title">Active </th>
						<th class="column-title">Edit </th>
						<th class="column-title">Delete </th>
					</tr>
				</thead>
				<!--Tbody-->
				<tbody id="tbody">
				</tbody>
			</table>
		</div>
	</div>
</div>
<!--Template User-->
<!--template table-->
<div class="#template" style="display: none;">
	<table >
		<tbody id="tr-customer">
			<tr>
				<td align="center" class="check-delete">
					<input class="check" type="checkbox" name="xoa[]">
				</td>
				<td><img class="img" src="" alt="Avatar"></td>
				<td class="name"></td>
				<td class="email"></td>
                <td class="store"></td>
				<td class="role"></td>
				<td class="active"></td>
				<td>
					<button type="button" class="btn btn-primary edit round">
					  <i class="fa fa-pencil-square-o"></i>
					</button>
				</td>
				<td>
					<a class="btn btn-danger round delete">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>

@endsection
@push("js")
<!--Mapp-->
<script type="text/javascript">
	var infowindow = null,map,marker,geocoder;
	var address = "";
   // Try HTML5 geolocation. get current user position
   	function CurrentPosition(callback)
   	{
	   	if (navigator.geolocation) {
	   		navigator.geolocation.getCurrentPosition(function(position){
	   			var pos = { lat: position.coords.latitude,
	   				lng: position.coords.longitude
	   			};
	   			if(callback){
	   				callback(pos);
	   			}
	   		});
	   	}
   	}
    function initMap(){
    	CurrentPosition(function(current){//get current position
    		//create icon marker
    		var image = {
				url: 'common_images/redStore.png',
		         // This marker is 20 pixels wide by 32 pixels high.
		         size: new google.maps.Size(40,40 ),
		         // The origin for this image is (0, 0).
		         origin: new google.maps.Point(0, 0),
		         // The anchor for this image is the base of the flagpole at (0, 32).
		         anchor: new google.maps.Point(0, 40),
		         //scale size image
		         scaledSize: new google.maps.Size(40, 40),
		         labelOrigin: new google.maps.Point(25,50)
     		};
    		//Khoi tao map
    		map = new google.maps.Map(document.getElementById('map'), {
    			center: current,
    			zoom: 14
    		});
			//khoi tao marker
			marker = new google.maps.Marker({
				map: map,
				draggable: true,
				labelAnchor: new google.maps.Point(25, 0),
	            animation: google.maps.Animation.DROP,
				position : current,
			});
    		//Lay input ve
    		var input = document.getElementById('search');
    		//auto complete input
    		var autocomplete = new google.maps.places.Autocomplete(input);
    		autocomplete.bindTo('bounds', map);
    		//Create info window
    		infowindow = new google.maps.InfoWindow();
    		//Tao su kien khi thay doi dia diem cua input
    		autocomplete.addListener('place_changed', function(){
				var place = autocomplete.getPlace();
				if (!place.geometry) {
					$.alert("Sr we could find your address, pleas try again baby!");
					return;
				}
				// If the place has a geometry, then present it on a map.
				if (place.geometry.viewport) {//if have view, present it
					map.fitBounds(place.geometry.viewport);
				} else {//if not present view with lat and long
					map.setCenter(place.geometry.location);
					map.setZoom(14);
				}
    		});
    		//Tao su kien khi click vao map lay toa do
    		map.addListener('click', function(e) {
				//set position for marker
				marker.setPosition(e.latLng);
        		marker.setVisible(true);
        		marker.setIcon(image);
        		//Location details
        		$("#lat").val(e.latLng.lat());
        		$("#lng").val(e.latLng.lng());
    		});
    		//Tao su kien khi drag marker
    		google.maps.event.addListener(marker, "dragend", function () {
    			$("#lat").val(marker.getPosition().lat());
        		$("#lng").val(marker.getPosition().lng());
    		});
	    })
    }
</script>
<script type="text/javascript">
	var idStore=1;
	//function add user
	$(document).on('click', '#addUser', function(event) {
		if(idStore==0){
			notify('Warning','warning','Sorry, your must save store to add user','#D9A357','#9EC600');
		}else{
			$('#modal-add').iziModal('open',event);
		}
	});
	$('#modal-add').iziModal(
	{
		onClosed: function(modal){
			$(".iziModal-iframe").attr("src","");
		},
		focusInput	   : true,
		title          : 'User',
		subtitle       :'Add',
		width          : 700,
		iframeHeight   : 660,
		headerColor    :"#405467",
		icon           :"fa fa-user",
		iconColor      :"#ECF0F1",
		fullscreen     :true,
		arrowKeys      :true,
		pauseOnHover   :true,
		overlayColor   : 'rgba(0, 0, 0, 0.2)',
		navigateCaption:true,
		bodyOverflow   : true,
		radius         :15,
		transitionIn   :"bounceInDown",
		transitionOut  :"bounceOutUp",
		arrowKeys      :true,
		iframe         : true,
		iframeWidth    :500,
		iframeURL      :"{{route('admin.user.add')}}?idStore="+idStore
	});
	//upload image 
	function handleFileSelect(event) {
		var input = this;
		if (input.files && input.files.length) {
			var reader = new FileReader();
			this.enabled = false
			reader.onload = (function (e) {
				$("#preview").html(['<img id="OpenImgUpload" class="thumb" src="', e.target.result, '" title="Avatar"/><span class="fa remove_img_preview" title="remove"></span>'].join(''))
			});
			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#file').change(handleFileSelect);
	$('#preview').on('click', '.remove_img_preview', function () {
		$("#OpenImgUpload").attr("src","common_images/no-store.png");
		$("#file").val("");
		$(".remove_img_preview").css("visibility","hidden");
	});
	//Open dialog box for upload when click on image
	$(document).on("click",'#OpenImgUpload',function(e){
		$('#file').trigger('click');
	});
	//submit add 
	$(document).on('click','.add',function(){
		console.log(idStore);
		var formData = new FormData();
		formData.append("name", $("#name").val());
		formData.append("address", $("#address").val());
        formData.append("image", $('input[type=file]')[0].files[0]);
        formData.append("lat", $("#lat").val());
        formData.append("lng", $('#lng').val());
        formData.append("description",$('#description').val());
        formData.append("priority",$('#priority').val());
        formData.append("idStore",idStore);
        //neu chua them store thi them moi, nguoc lai thi update
        if(idStore==0){
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
	        			$.toast({
	        				text: "Store have been added on map!",
	        				heading: 'Successful',
	        				icon: "success",
	        				showHideTransition: 'slide',
	        				allowToastClose: true,
	        				hideAfter: 1500,
	        				stack: 5,
	        				position: 'top-right',
	        				textAlign: 'left', 
	        				loader : true,
	        				loaderBg: '#9EC600'
	        			});
	        			idStore = result.idStore;
	        		}else{
	        			_commonShowError(result.data);
	        		}
				}
			});
        }else{
        	$.ajax({ 
	        	type: 'POST',
	        	headers: {
	        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        	},
	        	contentType: false,
	        	processData: false,
	        	url: "{{route('postEditStoreManager')}}",
	        	data:formData,
	        	success: function (result) {
	        		if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}'){
	        			$.toast({
	        				text: "Store have been save!",
	        				heading: 'Successful',
	        				icon: "success",
	        				showHideTransition: 'slide',
	        				allowToastClose: true,
	        				hideAfter: 1500,
	        				stack: 5,
	        				position: 'top-right',
	        				textAlign: 'left', 
	        				loader : true,
	        				loaderBg: '#9EC600'
	        			});
	        		}else{
	        			_commonShowError(result.data);
	        		}
				}
			});
        }
	})
	//build List
	function buildList(data)
	{
		var tbody = $("#tbody");
		$(tbody).empty();
		data.data.forEach(function(obj) {
			var row = $("#tr-customer").contents().clone();
			$(row).find('.check').val(obj.id);
			$(row).find('.img').attr('src', obj.avatar);
			$(row).find('.img').data("id",obj.id);
		 	$(row).find('.name').html(obj.name);
		 	$(row).find('.email').html(obj.email);
            $(row).find('.store').html(obj.store_name);
		 	$(row).find('.role').html(obj.role);
		 	if(obj.is_active===1){
		 		$(row).find('.active').html("Có");
		 	}else{
		 		$(row).find('.active').html("Không");
		 	}
		 	//profile
		 	$(row).find('.profile').data("id",obj.id);
		 	//edit
		 	$(row).find('.edit').data("id",obj.id);
		 	//delete
		 	$(row).find('.delete').data("id",obj.id);
		 	$(tbody).append($(row));
		});
	}
	//======================function notify=========================
    function notify(headingContent,icon,content,bgColor,loaderBg){
        $.toast({
            text: content,
            heading: headingContent,
            icon: icon,
            showHideTransition: 'plain',
            allowToastClose: true,
            hideAfter: 2000,
            bgColor:bgColor,
            stack: 5,
            position: 'top-right',
            textAlign: 'left',
            loader : true,
            loaderBg: loaderBg
        });
    }
</script>
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcW21XZbz_N3NzUiwUSd-K_4vLCZSCM7I&callback=initMap&libraries=places">
</script>
@endpush
