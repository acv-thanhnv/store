@extends("layouts.frontend")
@push("css")
<style type="text/css">
	.breadcumb-area{
		height: 130px;
		margin-top: 20px;
	}
	.header-map{
		margin-bottom: 20px;
	}
	.breadcumb-area .bradcumb-title h2{
		color: #fc6c3f7a;
	}
	.res-images{
		min-height: 200px;
		height: 200px;
		width: 100%;
	}
	.archive-area{
		margin-top: 30px;
	}
	.post-thumb img{
		margin-bottom: 0px;
	}
	.post-meta{
		justify-content: flex-end;
	}
	.res-name,.res-address{
		width: 100%;
		white-space: nowrap; 
		overflow: hidden;
		text-overflow: ellipsis;
		padding-left: 5px;
		display: block;
		font-size: 15px;
		font-family: Poppins-Regular;
		color: #999;
	}
	.block2{
		border       : 1px solid #e1e1e1;
		border-radius: 5px;
		box-shadow   : 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 4px 15px 0 rgba(0, 0, 0, 0.19);
		margin-bottom: 10px;
	}
	.hov-img0 {
		display: block;
		overflow: hidden;
	}
	.block2-pic {
		position: relative;
	}
	.hov-img0 img {
		width: 100%;
		transition: transform 0.9s ease;
	}
	.hov-img0:hover img {
		transform: scale(1.1);
	}
	.single-post{
		margin-bottom: 0px;
	}
	.res-detail .post-comment-share-area{
		justify-content: flex-end;
		padding-right: 5px;
	}
	.res-item{
		padding-top: 10px;
	}
	.res-des a{
		font-weight: 100;
	}
	.pagination-area .page-status{
		margin-top:10px;
	}
</style>
@endpush
@section("content")
 <!-- ****** Home Area Start ****** -->
 <section class="content-map">
 	<div id="map"></div>
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
 		<div class="container">
 			<div class="row">

 				<!-- Single Post -->
 				@for($i=1;$i< 12;$i++)
 				<div class="col-12 col-sm-6 col-md-6 col-lg-4 res-item">
 					<div class="block2" data-wow-delay="0.1s">
						<div class="block2-pic hov-img0 single-post wow fadeInUp">
							<a href="template" target="blank">
							<img src="frontend/Customer/images/store/r{{$i}}.jpg" alt="IMG-PRODUCT" class="res-images">
							</a>
						</div>

						<div class="res-detail">
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
                            <div class="res-des">
                            	<a href="template" target="blank">
                            	<span class="res-name">Gem's Restaurant</span>
                            	<span class="res-address">60B Dinh Cong Ha, Hoang Mai, Ha Noi</span>
                            	</a>
                            </div>
						</div>
					</div>
 				</div>
 				@endfor
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
 		</div>
 	</section>
 </section>
 <!-- ****** Home Area End ****** -->
@endsection
@push("js")
<!-- Map JS -->
<script type="text/javascript">
    var locations =<?php echo $map?>;
    var infowindow = null;
    var map;
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
                zoom: 19,
                center: center,
                styles: [{
                    "featureType": "landscape",
                    "elementType": "labels",
                    "stylers": [
                    { "visibility": "off" }
                    ]}
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
            infowindow = new google.maps.InfoWindow({
                maxWidth: 300
            });
            for (var i = 0; i < locations.length; i++) {
                createMarker(locations[i],i*200);
            }
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
       $(content).find(".link").attr('href',"{{route('foodorder')}}/"+location["id"]);
       //set timeout 
       window.setTimeout(function(){
          //create marker
          marker = new google.maps.Marker({
            position : {lat: location["lat"]*1, lng: location["lng"]*1},
            map      : map,
            icon     : setIcon("common_images/redStore.png"),
            animation: google.maps.Animation.DROP,
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
      },timeout);
    }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcW21XZbz_N3NzUiwUSd-K_4vLCZSCM7I&callback=initMap">
</script>
@endpush