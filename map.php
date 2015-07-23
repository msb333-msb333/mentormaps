<?php
//do all login operations / redirects
require "./logincheck.php";
?>

<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<style>
			html, body, #map-canvas {
				height:100%;
				margin: 0;
        		padding: 0;
			}
		</style>
		<title>Mentor Maps</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
				   <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-e-RpEFPKNX-hDqBs--zoYYCk2vmXdZg">
    </script>
    <script type="text/javascript">
      function initialize() {
        var map = new google.maps.Map(document.getElementById('map-canvas'),{zoom: 11});

        centerMap(map, "934 N Keystone St, Anaheim, CA");
        codeAddress(map, "1021 N Hensel Dr, La Habra, CA");
      	}
      	geocoder = new google.maps.Geocoder();


	function centerMap(map, address){
		geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location,
            icon: './mentorflag.png'
        });

        var infowindow=new google.maps.InfoWindow({
        content: 'Your location'
      });

        google.maps.event.addListener(marker, 'mouseover', function() {
            infowindow.open(map, this);
        });

        google.maps.event.addListener(marker, 'mouseout', function() {
            infowindow.close();
        });
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
}

  	function codeAddress(map, address) {
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location
        });
        var infowindow=new google.maps.InfoWindow({
        content: address
      });

        google.maps.event.addListener(marker, 'mouseover', function() {
            infowindow.open(map, this);
        });

        google.maps.event.addListener(marker, 'mouseout', function() {
            infowindow.close();
        });
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
	</head>
	<body>

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">Mentor Maps</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.html">Home</a></li>
											<li><a href="./register.html">Sign Up</a></li>
											<li><a href="./login.php">Log In</a></li>
											<li><a href="./logout.php">Log Out</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<article id="main">
						<section class="wrapper style5">
							<div id="map-section" width="100%">
							<script>
								document.getElementById('map-section').setAttribute("style","padding-left:"+(window.innerWidth / 6)+"px;padding-right:"+(window.innerWidth / 6)+"px;");
								document.getElementById("map-section").style.width= "100%";
								document.getElementById("map-section").style.height= window.innerHeight - (window.innerHeight / 4) + "px";
							</script>
							<div id="map-canvas"></div>
						</div>
						</section>
					</article>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Joseph Sirna 2015</li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
	</body>
</html>