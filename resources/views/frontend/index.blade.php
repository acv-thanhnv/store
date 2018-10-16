@extends("layouts.frontend")
@push("css")
<link rel="stylesheet" type="text/css" href="frontend/Customer/css/cus-home.css">
@endpush
@section("content")
 <!-- ****** Home Area Start ****** -->
<section class="content-map">
	<div class="col-md-5 col-10 col-sm-10 search-location">
		<input type="text" autofocus="" name="name" class="form-control" id="search"
		placeholder="&#xF002; Search locations...">
		<i class="fa fa-times-circle-o clear-textbox dis-none"></i>
	</div>
 	<div id="map">
 	</div>
 	<div class="breadcumb-area" style="background-image: url(frontend/Customer/images/bg3.jpg);">
 		<div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>Closest Restaurant</h2>
                    </div>
                </div>
            </div>
        </div>
 	</div>
 	<section class="archive-area section_padding_80">
 		<div class="container-fluid">
            <!-- Filter-->
            <div class="row res-filter">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row res-filter-body">
                                <div class="col-md-4 col-sm-4 col-lg-3 col-12">
                                    <input type="text" name="" class="form-control" placeholder="Restaurant Name...">
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-3 col-12">
                                    <input type="text" name="" class="form-control" placeholder="Radius...">
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-3 col-12">
                                    <select class="form-control" >
                                        <option selected>--Unit--</option>
                                        <option>Km</option>
                                        <option>Meters</option>
                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12 filter-search col-lg-1 col-12">
                                    <button type="button" class="btn btn-dark">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    		<div class="row closest-res">

    			<!-- Single Post -->

    		</div>
            <!-- Pagination -->
            <div class="col-12">
                <div class="pagination-area d-sm-flex mt-15">
                    <nav aria-label="#">
                        <ul class="pagination">
                            <li class="page-item active">
                                <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="page-status">
                        <p>Page 1 of 60 results</p>
                    </div>
                </div>
            </div>
 		</div>
 	</section>
</section>
 <!-- ****** Home Area End ****** -->

<!-- ****** Closest Template ****** -->
<div id="closest-template" style="display: none">
	<div class="col-12 col-sm-6 col-md-6 col-lg-3 res-item">
		<div class="block2" data-wow-delay="0.1s">
        <div class="block2-pic hov-img0 single-post wow fadeInUp">
				<a href="" target="blank" class="res-link">
					<img alt="IMG-PRODUCT" class="res-images">
				</a>
			</div>

			<div class="res-detail">
                <!-- Post Distance -->
                <div class="post-meta d-flex">
                    <div class="post-author-date-area d-flex">
                        <!-- Post Author -->
                        <div class="post-distance">
                            <a href="#"></a>
                        </div>
                    </div>
                    <!-- Post Comment & Share Area -->
                    <div class="post-comment-share-area d-flex">
                        <!-- Post Favourite -->
                        <div class="post-favourite">
                            <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> 10</a>
                        </div>
                        <!-- Post Comments -->
                        <div class="post-comments">
                            <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> 12</a>
                        </div>
                        <!-- Post Share -->
                        <div class="post-share">
                            <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
				<div class="res-des">
					<a href="template" target="blank">
						<span class="res-name">Gem's Restaurant</span>
						<span class="res-address">60B Dinh Cong Ha, Hoang Mai, Ha Noi</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
 <!-- ****** Map Template ****** -->
<div style="display: none">
	<div id="info_window" class="row">
		<div class="col-md-6 col-sm-6 col-12">
			<a class="link" href="#"><img class="image"></a>
		</div>
		<div class="col-md-6 col-sm-6 col-12" style="padding-right: 0px;">
			<p class="name"></p>
			<p><b>Address:</b> <span class="address"></span></p>
			<p><a class="link" href="#">Go To Website</a></p>
		</div>
	</div>
</div>

@endsection
@push("js")
<!--Custom JS-->
<script type="text/javascript">
	$(document).ready(function(){
		//get closest res
		CurrentPosition(function(center){
			$.ajax({
				type: 'GET',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('ClosestStore')}}?lat="+center.lat+"&&lng="+center.lng,
				success: function (result) {
					buildList(result);
				}
			});
		});
	});
	//function build list
	function buildList(data)
	{
		var c_temp = $(".closest-res");
		$(c_temp).empty();
		data.arrClosest.forEach(function(obj) {
			var row = $("#closest-template").contents().clone();
			$(row).find(".res-link").attr("href","{{route('Order')}}?storeId="+obj[0].id);
            $(row).find(".post-distance a").text(obj[0].distance);
			$(row).find(".res-images").attr("src",obj[0].src);
			$(row).find(".res-name").text(obj[0].name);
			$(row).find(".res-address").text(obj[0].address);
		 	$(c_temp).append($(row));
		});
	}	
</script>
<!-- Map JS -->
<script type="text/javascript">
    var locations =<?php echo $map?>;
    var infowindow = null,geocoder,map,markers=[],input,autocomplete,place,form_search;
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
    function initMap() {
        CurrentPosition(function(center){
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                streetViewControl: false,
                zoomControl:true,
                mapTypeControl: false,
                center: center,
                styles: [
                	{
                    "featureType": "landscape",
                    "elementType": "labels",
                    "stylers": [
                    { "visibility": "off" }
                    ]},
                    {
                    	"featureType": "poi.attraction",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    },
                    {
                    	"featureType": "poi.business",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    },
                    {
                    	"featureType": "poi.government",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    },
                    {
                    	"featureType": "poi.medical",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    },
                    {
                    	"featureType": "poi.school",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    },
                    {
                    	"featureType": "poi.sports_complex",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    },
                    {
                    	"featureType": "road.highway.controlled_access",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    },
                    {
                    	"featureType": "transit.station.airport",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    },
                    {
                    	"featureType": "transit.station.bus",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    },
                    {
                    	"featureType": "transit.station.rail",
                    	"elementType": "labels.icon",
                    	"stylers": [
                    	{
                    		"visibility": "off"
                    	}
                    	]
                    }
                    ]
                });
            currentPosition = new google.maps.Marker({
                map: map,
                icon : setIcon("common_images/curent.png"),
                position : center,
                label    : {
                    text: "Now",
                    color: "red",
                    fontSize: "16px",
                    fontWeight: "bold",
                },
                animation: google.maps.Animation.DROP,
            });
            // Add circle overlay and bind to marker
            var circle = new google.maps.Circle({
            	map: map,
				radius: 200,    // 200 mét
				strokeColor:"#AA0000",
				strokeOpacity:0.8,
				strokeWeight:2,
				fillColor:"#AA0000",
				fillOpacity:0.4
			});
            circle.bindTo('center', currentPosition, 'position');
            infowindow = new google.maps.InfoWindow({
                maxWidth: 400,
                maxHeight:400
            });
            for (var i = 0; i < locations.length; i++) {
                createMarker(locations[i],i*200);
            }
            /* Change markers on zoom */
            google.maps.event.addListener(map, 'zoom_changed', function() {
            	var zoom = map.getZoom();
			    // iterate over markers and call setVisible
			    for (i = 0; i < locations.length; i++) {
			    	markers[i].setVisible(zoom >= 14);
			    }
			});
			//Lay input ve
    		input = document.getElementById('search');
    		form_search = $(".search-location")[0];
			//auto complete input
			autocomplete = new google.maps.places.Autocomplete(input);
			autocomplete.bindTo('bounds', map);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(form_search);
			//Tao su kien khi thay doi dia diem cua input
			autocomplete.addListener('place_changed', function(){
				place = autocomplete.getPlace();
				if (!place.geometry) {
					alert("Sr we could find your address, pleas try again baby!");
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
        })
    }
    function setIcon(url)
    {
       //custom image icon
       var image = {
        url: url,
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(40,40 ),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 40),
          //scale size image
          scaledSize: new google.maps.Size(40, 40),
          //position label
          labelOrigin: new google.maps.Point(40,-10),
          //set vị trí dấu x của icon
          labelAnchor : new google.maps.Point(10,30)
      };
      return image;
    }
    function createMarker(location,timeout)
    {
       //custom content of info
       var content = $('#info_window').clone();
       $(content).find(".name").text(location["name"]);
       $(content).find(".address").text(location["address"]);
       $(content).find(".description").text(location["description"]);
       $(content).find(".image").attr('src',location["src"]);
       $(content).find(".link").attr('href',"{{route('Order')}}/"+location["id"]);
       //set timeout 
       window.setTimeout(function(){
          //create marker
          marker = new google.maps.Marker({
            position : {lat: location["lat"]*1, lng: location["lng"]*1},
            map      : map,
            icon     : setIcon("common_images/redStore.png"),
            animation: google.maps.Animation.BOUNCE,
            title    : location["name"],
            label    : {
                text: location["name"],
                color: "#7E2323",
                fontSize: "16px",
                fontWeight: "bold",
            },
          });
          //add event click
          marker.addListener('click', function() {
            infowindow.setContent(content[0]);

            infowindow.open(map, this);
          });
          //push marker to array
          markers.push(marker);
      },timeout);
    }
    //show clear text-box content if content more than 1 word
    $("body").on("keyup","#search",function(){
    	var length = $(this).val().length;
    	if(length>0){
    		$(this).siblings("i").removeClass('dis-none');
    	}else{
    		$(this).siblings("i").addClass("dis-none");
    	}
    })
    //clear content of input search
    $("body").on("click",".clear-textbox",function(){
    	$("#search").val("");
    	$(this).addClass("dis-none");
    	$("#search").focus();
    })
</script>
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcW21XZbz_N3NzUiwUSd-K_4vLCZSCM7I&callback=initMap&libraries=places">
</script>
@endpush