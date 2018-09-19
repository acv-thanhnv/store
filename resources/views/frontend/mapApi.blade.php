@extends("layouts.frontend")
@push("css")
<style>
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
         height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
         height : 100%;
         margin : 0;
         padding: 0;
      }
      .image{
         height: 100px;
         width: 150px;
      }
      .name{
         color: red;
         font-weight: bold;
      }
      .link{
         font-weight: bold;
      }
      .link a:hover{
         text-decoration: none;
      }
</style>
@endpush
@section("content")
   <div id="map"></div>
   <div style="display: none">
      <div id="info_window">
         <p>
            <a href="{{route('foodorder')}}/1"><img src="https://medicuspedia.files.wordpress.com/2016/09/insta-image-1.jpg" class="image"></a>
            <p class="name"></p>
            <p><b>Address:</b> <span class="address"></span></p>
            <p><b>Description:</b> <span class="address"></span></p>
            <p class="link"><a href="{{route('foodorder')}}/1">Go To Website</a></p>
         </div>
   </div>
@endsection
@push("js")
<script type="text/javascript">
   var locations =<?php echo $arrCoor?>;
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
            zoom: 16,
            center: center,
            styles: [{
               "featureType": "landscape",
               "elementType": "labels",
               "stylers": [
                  { "visibility": "off" }
               ]}
            ]
         });
         infowindow = new google.maps.InfoWindow();
         for (var i = 0; i < locations.length; i++) {
            createMarker(locations[i],i*200);
         }
      })
   }
   function createMarker(location,timeout)
   {
      //custom image icon
      var image = {
         url: 'common_images/r3.png',
         // This marker is 20 pixels wide by 32 pixels high.
         size: new google.maps.Size(40,40 ),
         // The origin for this image is (0, 0).
         origin: new google.maps.Point(0, 0),
         // The anchor for this image is the base of the flagpole at (0, 32).
         anchor: new google.maps.Point(0, 32),
         //scale size image
         scaledSize: new google.maps.Size(30, 30)
      };
      //custom content of info
      var content = $('#info_window').clone();
      $(content).find(".name").text(location["name"]);
      $(content).find(".address").text(location["address"]);
      //set timeout 
      window.setTimeout(function(){
         //create marker
         marker = new google.maps.Marker({
            position: {lat: location["lat"]*1, lng: location["lng"]*1},
            map: map,
            icon: image,
            animation: google.maps.Animation.DROP,
            title: location["name"]
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