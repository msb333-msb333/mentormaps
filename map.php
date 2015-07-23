<?php
//do all login operations / redirects
require "./logincheck.php";
require "./db.php";

$email = $_SESSION['email'];
$sql = "SELECT `TYPE` FROM `logins` WHERE `EMAIL` = '$email'";
$type = "UNDEFINED";
$result = $db->query($sql);
while($r=mysqli_fetch_assoc($result)){
	$type = $r['TYPE'];
}

$table = "UNDEFINED";
if($type=='MENTOR'){
	$table = 'mentors';
}else{
	$table = 'teams';
}

$sql = "SELECT `ADDRESS` FROM `$table` WHERE `EMAIL` = '$email'";
$my_address = "UNDEFINED";
$result = $db->query($sql);
while($r=mysqli_fetch_assoc($result)){
	$my_address=$r['ADDRESS'];
}

$address_array = array();
$sql = "SELECT `ADDRESS` FROM `teams`";
$result = $db->query($sql);
while($r=mysqli_fetch_assoc($result)){
	array_push($address_array, $r['ADDRESS']);
}
?>
<!DOCTYPE HTML>
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
		geocoder = new google.maps.Geocoder();
        centerMap(map, "<?php echo $my_address; ?>");
		
		<?php
			foreach($address_array as $address){
				$teamjson = "UNDEFINED";
				$sql = "SELECT * FROM `teams` WHERE `ADDRESS` = '$address';";
				$result=$db->query($sql);
				while($r=mysqli_fetch_assoc($result)){
					$a = array( 'name' => $r['NAME'],
								'searching_skills_json' => $r['SEARCHING_SKILLS_JSON'],
								'team_number' => $r['TEAM_NUMBER'],
								'comments' => $r['COMMENTS'],
								'phone' => $r['PHONE'],
								'email' => $r['EMAIL'],
								'address' => $r['ADDRESS'],
								'type' => $r['TYPE'],
								'other_detail' => $r['OTHER_DETAIL']
								);
					$teamjson = json_encode($a);
				}
				echo 'var teamdata = ' . $teamjson . ';' . PHP_EOL;
				echo 'codeAddress(map, "'.$address.'", teamdata);'. PHP_EOL;
			}
		?>
      	}
      	


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

  	function codeAddress(map, address, teamdata) {
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location
        });
        var infowindow=new google.maps.InfoWindow({
        content: "" + teamdata['name'] + ", " + teamdata['team_number']
      });
	  
		google.maps.event.addListener(marker, 'click', function(){
			document.getElementById("img-container").innerHTML = "<img id=\"ross\" src=\"" + teamdata['type'] + ".png\" width=\"160px\" height=\"160px\" />";
			document.getElementById("phone-container").innerHTML = "<b><u>Phone:<br /></u></b>" + teamdata['phone'];
			document.getElementById("email-container").innerHTML = "<b><u>Email:<br /></u></b>" + teamdata['email'];
			document.getElementById("address-container").innerHTML = "<b><u>Location:<br /></u></b>" + teamdata['address'];
			document.getElementById("comments-container").innerHTML = "<b><u>Comments:<br /></u></b>" + teamdata['comments'];
			
			var searchingFor = "";
			var ssjson = $.parseJSON(teamdata['searching_skills_json']);
			$.each(ssjson, function(key, value){
				if(key == 'skill-other'){
						searchingFor = searchingFor + "other ("+teamdata['other_detail']+")";
				}else{
					if(value=='true'){
						console.log(value + " is true");
						searchingFor = searchingFor + key + "<br />";
					}
				}
			});
			
			document.getElementById("searching-skills-container").innerHTML = "<b><u>Searching For:<br /></u></b>" + searchingFor;
			document.getElementById("name-container").innerHTML = "<b><u>Team:<br /></u></b>" + teamdata['name'] + ", " + teamdata['team_number'];
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
								document.getElementById('map-section').setAttribute("style","padding-bottom:0px;padding-left:"+(window.innerWidth / 6)+"px;padding-right:"+(window.innerWidth / 6)+"px;");
								document.getElementById("map-section").style.width= "100%";
								document.getElementById("map-section").style.height= window.innerHeight - (window.innerHeight / 4) + "px";
							</script>
							<div id="map-canvas"></div>
						</div>
						</section>
						
						<section class="wrapper style5">
						<div class="inner" id="team-info">
							<section id="team-info-section">
							<div class="6u 6u$(small)"><b><u>Team Info</u></b></div>
								<div class="row uniform">
									<div class="12u 12u$(small)" id="img-container"></div>
									<div class="6u 3u$(small)" id="name-container"></div>
									<div class="6u 3u$(small)" id="address-container"></div>
									<div class="6u 3u$(small)" id="searching-skills-container"></div>
									<div class="6u 3u$(small)" id="comments-container"></div>
									<div class="6u 3u$(small)" id="phone-container"></div>
									<div class="6u 3u$(small)" id="email-container"></div>
								</div>
							</section>
						</div>
					</section>
						
					</article>

				<!-- Footer -->
					<footer id="footer">
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