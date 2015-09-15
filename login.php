<?php
//user must have the php session started
require "./sessioncheck.php";

//enable referral url to redirect to the previous page once logged in
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($refurl)){
        $refurl="./map.php";//default referral url
    }else{
        $refurl = $_GET['refurl'];
    }
?>
<html>
    <head>
        <link rel="shortcut icon" href="http://mentormaps.net/favicon.ico"/>
        <title>Mentor Maps</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-e-RpEFPKNX-hDqBs--zoYYCk2vmXdZg"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="./customjquery.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    </head>
    <body class="landing">
            <div id="page-wrapper">
                    <header id="header">
                        <h1><a href="./index.php">Mentor Maps</a></h1>
                        <nav id="nav">
                            <ul>
                                <li class="special">
                                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                                    <div id="menu">
                                        <ul>
                                            <li><a href="./index.php">Home</a></li>
                                            <li><a href="./register.php">Sign Up</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </header>
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
                    <footer id="footer">
                        <ul class="copyright">
                            <li>&copy; FRC Team 3309, 2015</li>
                        </ul>
                    </footer>
            </div>
            <?php
                if(isset($_GET['error'])){
                    echo '<script>document.getElementById("wrong-password").innerHTML = "Wrong password <a href=\"./resetpassword.php\">reset?</a><br /><br />";document.getElementById("wrong-password").setAttribute("style", "color:red;");</script>';
                }
            ?>
            
    </body>
</html>
<?php
}else{//handle login request
    require "./security/salt.php";
    require "./db.php";

    $username = santiize($_POST['username']);
    $password = sanitize($_POST['password']);
    $refurl = sanitize($_POST['refurl']);

    $salt = createSalt($username);//yum
    $concatPass = $password . $salt;
    $pass_hash = md5($concatPass);//if the login is correct, this value should match up with the email provided in the database
    
    $resultset = $db->query("SELECT * FROM `logins` WHERE `EMAIL` = '$username' AND `PASSWORD` = '$pass_hash'");
    
    if($resultset->num_rows > 0){//if at least 1 value matches, the user's session cookies are modified to store their email
        $_SESSION['auth'] = true;
        $_SESSION['email'] = $username;
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=$refurl\">";
    }else{//if no values are found, refresh the page and display an error
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=./login.php?error=true\">";
    }
}
?>