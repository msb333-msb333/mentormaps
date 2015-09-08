<?php
require "./db.php";
require "./logincheck.php";

if(isset($_GET['p'])){
    $user = $_GET['p'];
    checkIfUserLoggedIn($user);

    $sql = "SELECT * FROM `assoc` WHERE email = '$user';";
    $result = $db->query($sql);
    $interested_in      = '[]';
    $interested_in_me   = '[]';
    if($result){
        while($r=mysqli_fetch_assoc($result)){
            $interested_in      = $r['interested-in'];
            $interested_in_me   = $r['interested-in-me'];
        }
    }else{
        //invalid query
    }
}else{
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=./dashboard.php?p=".$_SESSION['email']."\">";
}
?>
<html>
    <head>
        <link rel="shortcut icon" href="http://mentormaps.net/favicon.ico"/>
        <title>Mentor Maps</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-e-RpEFPKNX-hDqBs--zoYYCk2vmXdZg"></script>
        <script src="assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="assets/js/main.js"></script>
    </head>
    <body class="landing">

        <!-- Page Wrapper -->
            <div id="page-wrapper">

                <!-- Header -->
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
                                            <li><a href="./login.php">Log In</a></li>
                                            <li><a href="./logout.php">Log Out</a></li>
                                            <li><a href="./profile.php">Profile</a></li>
                                            <li><a href="./map.php">Map</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </header>
            <script>
                var interested_in = <?php echo $interested_in; ?>;
                var interested_in_me = <?php echo $interested_in_me; ?>;
            </script>
            <article id="main">
                <header>
                    <h2>
                        Your Dashboard
                    </h2>
                </header>
                <section class="wrapper style5">
                    <div class="inner">
                        <section id="main-section" style="color:black;display:inline-block;width:100%;">
                            <table style="color:black;width:40%;float:left;">
                                <tr>
                                    <th>Who's Interested In Me:</th>
                                </tr>
                                <script>
                                    $.each(interested_in_me, function(key, value){
                                        document.write("<tr><td>"+value+"<a href='./profile.php?p="+value+"'>&nbsp;<img src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'></img></a></td></tr>");
                                    });
                                </script>
                            </table>

                            <table style="color:black;width:40%;float:right;">
                                <tr>
                                    <th>Who I'm Interested In:</th>
                                </tr>
                                <script>
                                    $.each(interested_in, function(key, value){
                                        document.write("<tr><td>"+value+"<a href='./profile.php?p="+value+"'>&nbsp;<img src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'></img></a></td></tr>");
                                    });
                                </script>
                            </table>

                            
                        </section>
                    </div>
                </section>
            </article>
            <footer id="footer">
                <ul class="copyright">
                    <li>
                        &copy; FRC Team 3309, 2015
                    </li>
                </ul>
            </footer>
        </div>
    </body>
</html>