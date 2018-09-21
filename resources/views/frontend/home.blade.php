<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Touché</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Bootstrap -->
<link href="{{ asset('backend/template1/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ asset('backend/template1/css/font-awesome.min.css')}}" rel="stylesheet">
<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="{{ asset('frontend/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/nivo-lightbox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/default.css')}}">
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
<style type="text/css">
  .store{
    margin: 0px !important;
  }
  /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
         height: 450px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
         height : 100%;
         margin : 0;
         padding: 0;
      }
      .image{
         height       : 100px;
         width        : 200px;
         border-radius: 10px;
         box-shadow   : 5px 10px 18px #D7C7C7;
      }
      .name{
         padding-top: 15px;
         color      : red;
         font-weight: bold;
         font-size  : 16px;
      }
      .link{
         font-weight: bold;
      }
      .link a:hover{
         text-decoration: none;
      }
      #portfolio{
         padding: 0 0 50px 0;
      }
      .imgStore{
         width: 60px !important;
         height: 50px;
         border-radius: 10px;
         box-shadow: 5px 10px 18px #CDC8C8 !important;
      }
</style>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand page-scroll" href="#page-top">ACV</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about" class="page-scroll">About</a></li>
        <li><a href="#restaurant-menu" class="page-scroll">Store</a></li>
        <li><a href="#portfolio" class="page-scroll">Map</a></li>
        <li><a href="#team" class="page-scroll">Top Store</a></li>
        <li><a href="#call-reservation" class="page-scroll">Contact</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
</nav>
<!-- Header -->
<header id="header">
  <div class="intro">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="intro-text">
            <h1>ACV</h1>
            <p>Restaurant / Coffee / Store</p>
            <a href="#about" class="btn btn-custom btn-lg page-scroll">Discover Story</a> </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- About Section -->
<div id="about">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-6 ">
        <div class="about-img"><img src="frontend/img/about.jpg" class="img-responsive" alt=""></div>
      </div>
      <div class="col-xs-12 col-md-6">
        <div class="about-text">
          <h2>Our Restaurant</h2>
          <hr>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare diam commodo nibh.</p>
          <h3>Awarded Chefs</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Store Section -->
<div id="restaurant-menu">
  <div class="section-title text-center center">
    <div class="overlay">
      <h2>Store</h2>
      <hr>
      <p>We have a chain of available stores that are always ready to serve</p>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="menu-section store">
        <h2 class="menu-section-title">ACV's Store</h2>
        <hr>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="menu-section">
         <!--Count-->
         @for($i=0;$i< (count($store)/2);$i++)
          <div class="menu-item">
            <div class="menu-item-name">
               <img class="imgStore" src="{{$store[$i]->src}}"> {{$store[$i]->name}}
            </div>
            <div class="menu-item-description">
               {{$store[$i]->address}}
            </div>
          </div>
         @endfor
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="menu-section">
         @for($i=(count($store)/2)+1;$i< count($store);$i++)
          <div class="menu-item">
            <div class="menu-item-name">
               <img class="imgStore" src="{{$store[$i]->src}}"> {{$store[$i]->name}} 
            </div>
            <div class="menu-item-description">
               {{$store[$i]->address}}  
            </div>
          </div>
         @endfor
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Map Section -->
<div id="portfolio">
   <div class="section-title text-center center">
      <div class="overlay">
         <h2>Map</h2>
         <hr>
         <p>You can find us on map and order food online whenever</p>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="input-group col-md-6">
            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
            <input id="searchStore" type="text" class="form-control" name="password" placeholder="Search by store's name...">
         </div>
         <div id="map"></div>
      </div>
   </div>
</div>
<!--Template info window-->
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
</div>
<!-- Team Section -->
<div id="team" class="text-center">
  <div class="overlay">
    <div class="container">
      <div class="col-md-10 col-md-offset-1 section-title">
        <h2>Top Store</h2>
        <hr>
        <p>Bellow is top 10 store that are rated by customers</p>
      </div>
      <div id="row">
        <div class="col-md-4 team">
          <div class="thumbnail">
            <div class="team-img"><img src="frontend/img/team/01.jpg" alt="..."></div>
            <div class="caption">
              <h3>Mike Doe</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 team">
          <div class="thumbnail">
            <div class="team-img"><img src="frontend/img/team/02.jpg" alt="..."></div>
            <div class="caption">
              <h3>Chris Doe</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 team">
          <div class="thumbnail">
            <div class="team-img"><img src="frontend/img/team/03.jpg" alt="..."></div>
            <div class="caption">
              <h3>Ethan Doe</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Call Reservation Section -->
<div id="call-reservation" class="text-center">
  <div class="container">
    <h2>Want to make a reservation? Call <strong>1-887-654-3210</strong></h2>
  </div>
</div>
<!-- Contact Section -->
<div id="contact" class="text-center">
  <div class="container">
    <div class="section-title text-center">
      <h2>Contact Form</h2>
      <hr>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed.</p>
    </div>
    <div class="col-md-10 col-md-offset-1">
      <form name="sentMessage" id="contactForm" novalidate>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="name" class="form-control" placeholder="Name" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" class="form-control" placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <div id="success"></div>
        <button type="submit" class="btn btn-custom btn-lg">Send Message</button>
      </form>
    </div>
  </div>
</div>
<div id="footer">
  <div class="container text-center">
    <div class="col-md-4">
      <h3>Address</h3>
      <div class="contact-item">
        <p>4321 California St,</p>
        <p>San Francisco, CA 12345</p>
      </div>
    </div>
    <div class="col-md-4">
      <h3>Opening Hours</h3>
      <div class="contact-item">
        <p>Mon-Thurs: 10:00 AM - 11:00 PM</p>
        <p>Fri-Sun: 11:00 AM - 02:00 AM</p>
      </div>
    </div>
    <div class="col-md-4">
      <h3>Contact Info</h3>
      <div class="contact-item">
        <p>Phone: +1 123 456 1234</p>
        <p>Email: info@company.com</p>
      </div>
    </div>
  </div>
  <div class="container-fluid text-center copyrights">
    <div class="col-md-8 col-md-offset-2">
      <div class="social">
        <ul>
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        </ul>
      </div>
      <p>&copy; 2016 Touché. All rights reserved. Designed by <a href="http://www.templatewire.com" rel="nofollow">TemplateWire</a></p>
    </div>
  </div>
</div>
<script src="{{ asset('backend/template1/js/jquery.min.js')}}"></script>
<script src="{{ asset('backend/template1/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{('frontend/js/SmoothScroll.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/nivo-lightbox.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/jquery.isotope.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/jqBootstrapValidation.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/contact_me.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/main.js')}}"></script>
<script type="text/javascript">
   var locations =<?php echo $map?>;
   var infowindow = null;
   var map;
   var markers = Array();
   var bounds;
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
         //add marker to array markers
         markers.push(marker);
         //add event click
         marker.addListener('click', function() {
            infowindow.setContent(content[0]);

            infowindow.open(map, this);
        });
      },timeout);
   }
   function clearMarker()
   {
      for (var i = 0; i < markers.length; i++) {
         markers[i].setMap(null);//Ẩn marker đi 
      }
      markers = [];
   }
   //search by store name 
   $(document).on("change","#searchStore",function(){
      var key = $(this).val();
      $.ajax({
         type: 'get',
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: "Search",
         data:{key:key},
         success: function (result) {
            clearMarker();
            var bounds = new google.maps.LatLngBounds();
            for(var i=0;i<result.store.length;i++){
               createMarker(result.store[i],i*200);
            }
            for (var i = 0; i < result.store.length; i++) {
               var myLatLng = new google.maps.LatLng(result.store[i].lat, result.store[i].lng);
               bounds.extend(myLatLng);
            }
            map.fitBounds(bounds);
         }
      });
   })
</script>
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcW21XZbz_N3NzUiwUSd-K_4vLCZSCM7I&callback=initMap">
</script>
</body>
</html>
