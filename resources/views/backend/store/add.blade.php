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
		.thumb {
			width : 100px;
			min-height: 100px;
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
			height: 520px;
			width: 100%;
		}
		.controls {
			margin-top: 10px;
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
			padding: 0 11px 0 13px;
			text-overflow: ellipsis;
			width: 100%;
		}
		#search:focus {
			border-color: #4d90fe;
		}
    </style>
@endpush
@section("content")
<div class="add_map">
	<div class="col-md-6 col-xs-12">
		<div class="x_panel">
			<input id="search" class="controls" type="text" placeholder="Enter a location...">
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
						<div id="preview"></div>
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
						<input type="text" autofocus="" class="form-control has-feedback-left" id="address"
						placeholder="Input Address of Store...">
						<span class="fa fa-road form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Latitude  </label>
						<input type="number" id="lat" class="form-control has-feedback-left"
						placeholder="Latitude...">
						<span class="fa fa-compass form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
						<label>Longitude   </label>
						<input type="number" id="lng" class="form-control has-feedback-left"
						placeholder="Longitude...">
						<span class="fa fa-compass form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-sm-10 col-xs-12 form-group has-feedback">
						<label>Description</label>
						<textarea class="form-control" rows="2" placeholder="Description for store..."></textarea>
					</div>
				</div>
				<div class="form-group footer">
					<div>
						<button class="btn btn-primary pull-right" type="reset">Reset</button>
						<button type="button" class="btn btn-success add pull-right">Add</button>
					</div>
				</div>

			</form>
			</div>
		</div>
	</div>
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
    		//Khoi tao map
    		map = new google.maps.Map(document.getElementById('map'), {
    			center: current,
    			zoom: 14
    		});
    		//Lay input ve
    		var input = document.getElementById('search');
    		//auto complete input
    		var autocomplete = new google.maps.places.Autocomplete(input);
    		autocomplete.bindTo('bounds', map);
    		//Create info window
    		infowindow = new google.maps.InfoWindow();
    		//khoi tao marker
    		marker = new google.maps.Marker({
    			map: map,
    			draggable: true,
    			anchorPoint: new google.maps.Point(0, -20)
    		});
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
	var max_fields = "{{\App\Core\Common\EntityProperty::maxField}}";
	var wrapper    = $(".property"); //Fields wrapper
	var x          = 0;
	var y          = 0;
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
		$("#preview").empty()
		$("#file").val("");
	});
	//Open dialog box for upload when click on image
	$(document).on("click",'#OpenImgUpload',function(e){
		$('#file').trigger('click');
	});
	//show property
	$(document).on("change","#type",function(event){
		var idType = $(this).val();
		var prop_by_type = $(".property_by_type");
		var row = $("#template").contents().clone();
		$(prop_by_type).empty();
		$.get("{{route('getProp')}}",{idType:idType},function(data){
			y = data.length;
			label(x+y);
			if(data.length>0){
				data.forEach(function(obj){
					var row = $("#template").contents().clone();
					$(row).find("input[name='label']").val(obj.property_label);
					$(row).find("select[name='data']").val(obj.data_type_code);
					$(row).find("input[name='sort']").val(obj.sort);
					$(row).find("button").removeClass('remove').addClass('remove_by_type');
					$(prop_by_type).append(row); 
				});
			}else{
				var errors = $("#error").contents().clone();
				$(errors).find("span.content-errors").html("Sorry but this type doen't have property, pleas add property in type option or bellow!");
				$(errors).find("div.show-errors").css("display","block");
				$(prop_by_type).append(errors); 
			}
		});
	});
	//insert prop
	$(document).on("click",".add_prop",function(event){
		var row = $("#template").contents().clone();
		x++;
		if(x < max_fields&& x>=1){
			label(x+y);
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
		label(x+y);
	});
	$(document).on("click",".remove_by_type",function(event){
		$(this).parents("span").remove();
		y--;
		label(x+y);
	});
	//submit add 
	$(".add").click(function(){
		var formData = new FormData();
		var rows     = $("div.prop .rows");
		var arrProp  = [];
		for (var i = 0; i < rows.length; i++) {
			var label  = $(rows[i]).find('input[name=label]').val();
			var data   = $(rows[i]).find('.data').val();
			var sort   = $(rows[i]).find('input[name=sort]').val();
			var value  = $(rows[i]).find('input[name=value]').val();
			arrProp[i] = {label : label,data:data,sort:sort,value:value};
		}
		formData.append("name", $("#name").val());
        formData.append("image", $('input[type=file]')[0].files[0]);
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
        			localStorage.setItem("Message","Add new type successful!");
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
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcW21XZbz_N3NzUiwUSd-K_4vLCZSCM7I&callback=initMap&libraries=places">
</script>
@endpush
