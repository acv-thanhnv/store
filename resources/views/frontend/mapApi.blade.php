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
</style>
@endpush
@section("content")
   <div id="map"></div>
@endsection
@push("js")
<script type="text/javascript">
   var locations =<?php echo $arrCoor?>;
   function initMap() {
     var map = new google.maps.Map(document.getElementById('map'), {
       zoom: 12,
       center: {lat: -33.863276, lng: 151.207977}
    });
     setMarkers(map);
  }
  function setMarkers(map)
  {
   var image = {
     url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(20, 32),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 32)
         };
         for (var i = 0; i < locations.length; i++) {
            var location = locations[i];
            var contentString =`
            <div id="info_window">
               <p>
               <a href="#"><img src="https://medicuspedia.files.wordpress.com/2016/09/insta-image-1.jpg" class="image"></a>
               <p class="name">`+location["name"]+`</p>
               <p class="address">`+location["address"]+`</p>
               <p class="description">Description</p>
            </div>
            `;
            var infowindow = new google.maps.InfoWindow({
               content: contentString
            });
            var marker = new google.maps.Marker({
              position: {lat: location["lat"], lng: location["lng"]},
              map: map,
              icon: image,
              animation: google.maps.Animation.DROP,
              title: location["name"],
              label:'R'
           });
            marker.addListener('click', function() {
              infowindow.open(map, this);
           });
         }
      }
</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcW21XZbz_N3NzUiwUSd-K_4vLCZSCM7I&callback=initMap">
</script>
@endpush