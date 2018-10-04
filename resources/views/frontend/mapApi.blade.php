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
         width: 200px;
         border-radius: 10px;
         box-shadow: 5px 10px 18px #D7C7C7;
      }
      .name{
         padding-top: 15px;
         color: red;
         font-weight: bold;
         font-size: 16px;
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
         <div>
            <a class="link" href="#"><img class="image"></a>
            <p class="name"></p>
            <p><b>Address:</b> <span class="address"></span></p>
            <p><b>Description:</b> <span class="description"></span></p>
            <p><a class="link" href="#">Go To Website</a></p>
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