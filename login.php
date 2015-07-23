<?php
require "./sessioncheck.php";
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(!isset($refurl)){
		$refurl="./map.php";
	}else{
		$refurl = $_GET['refurl'];
	}
?>

<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Mentor Maps</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		
		<!--for recaptcha-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
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
							<div class="inner">
								<section>
									<h4>Login</h4>
									<form method="post">
										<div class="row uniform">
											<div class="6u 12u$(small)">
												<input type="text" name="username" id="username-field" placeholder="email" />
											</div>
											<div class="6u 12u$(small)">
												&nbsp;
												<br />
												<br />
											</div>
											<div class="6u 12u$(small)">
												<input type="password" name="password" id="password-field" placeholder="password" />
											</div>
											<div id="wrong-password" class="6u 12u$(small)">
												&nbsp;
												<br />
												<br />
											</div>
											<div class="6u 12u$(small)">
												<input type="hidden" value="<?php echo $refurl; ?>" name="refurl" />
												<input type="submit" value="login" class="button special" id="submit-button"/>
											</div>
										</div>
									</form>
								</section>
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
			<script src="./customjquery.js"></script>
			
			<?php
			if(isset($_GET['error'])){
				echo '<script>document.getElementById("wrong-password").innerHTML = "Wrong password<br /><br />";document.getElementById("wrong-password").setAttribute("style", "color:red;");</script>';
			}
			?>
			
	</body>
</html>
<?php
}else{
	require "./security/salt.php";
	require "./db.php";
	//handle login request
	$username = mysql_escape_mimic($_POST['username']);
	$password = mysql_escape_mimic($_POST['password']);
	$refurl = mysql_escape_mimic($_POST['refurl']);
	
	
	$salt = createSalt($username);
	$concatPass = $password . $salt;
	$pass_hash = md5($concatPass);
	
	$resultset = $db->query("SELECT * FROM `logins` WHERE `EMAIL` = '$username' AND `PASSWORD` = '$pass_hash'");
	
	if($resultset->num_rows > 0){
		$_SESSION['auth'] = true;
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=$refurl\">";
	}else{
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=./login.php?error=true\">";
	}
}
?>