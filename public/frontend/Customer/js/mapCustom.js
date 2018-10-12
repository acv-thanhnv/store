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