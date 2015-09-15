<?php
require "./db.php";
require "./logincheck.php";

if(isset($_GET['p'])){
    $user = sanitize($_GET['p']);
    checkIfUserLoggedIn($user);

    //get all information from the db about the specified user
    $sql = "SELECT * FROM `assoc` WHERE email = '$user';";
    $result = $db->query($sql);
    $interested_in      = '{lv1:[], lv2:[]}';
    $interested_in_me   = '{lv1:[], lv2:[]}';
    if($result){
        while($r=mysqli_fetch_assoc($result)){
            $interested_in      = $r['interested-in'];
            $interested_in_me   = $r['interested-in-me'];
        }
    }else{
        //TODO handle invalid query error
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
        <link rel="stylesheet" href="assets/css/main.css" />
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-e-RpEFPKNX-hDqBs--zoYYCk2vmXdZg"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <style>
            .not-interested-button{
                width:24px;
                height:24px;
                content:url('./img/ic_not_interested_black_48dp_2x.png');
            }
            .not-interested-button:hover{
                content:url('./img/ic_not_interested_red_48dp_2x.png');
            }
        </style>
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
                var myInterests = <?php echo $interested_in; ?>;
                var theirInterests = <?php echo $interested_in_me; ?>;

                function updateInterest(myEmail, theirEmail){
                    $.ajax({
                        url: './updateinterest.php',
                        type: 'POST',
                        data: {
                            'theirEmail': theirEmail,
                            'myEmail': myEmail,
                            'theirIntJSON': JSON.stringify(theirInterests),
                            'myIntJSON': JSON.stringify(myInterests)
                        }
                    });
                }

                //iterate over every account that is interested in the currently logged in user
                function refreshInterestedInMe(){
                    $("#interested-in-me-table").html("<tr><th>Who's Interested In Me:</th></tr>");
                    $.each(theirInterests.lv1, function(key, value){
                        $("#interested-in-me-table").append("<tr><td><img class='not-interested-button' onclick='notinterested(\""+value+"\");'/>"+value+"<a href='./profile.php?p="+value+"'>&nbsp;<img src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'/></a></td></tr>");
                    });
                    $.each(theirInterests.lv2, function(key, value){
                        $("#interested-in-table").append("<tr><td>(lv2) "+value+"<a href='./profile.php?p="+value+"'>&nbsp;<img src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'/></a></td></tr>");
                    });
                }

                function refreshInterestedIn(){
                    $("#interested-in-table").html("<tr><th>Who I'm Interested In:</th></tr>");
                    $.each(myInterests.lv1, function(key, value){
                        $("#interested-in-table").append("<tr><td><img class='not-interested-button' onclick='notinterested(\""+value+"\");'/> | "+value+"<a href='./profile.php?p="+value+"'>&nbsp;<img src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'/></a></td></tr>");
                    });
                    $.each(myInterests.lv2, function(key, value){
                        $("#interested-in-table").append("<tr><td>(lv2) "+value+"<a href='./profile.php?p="+value+"'>&nbsp;< src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'/></a></td></tr>");
                    });
                }

                var myEmail = '<?php echo $_SESSION['email']; ?>';

                function notinterested(email){
                    myInterests.lv1.splice(myInterests.lv1.indexOf(email), 1);
                    theirInterests.lv1.splice(theirInterests.lv1.indexOf(email), 1);

                    updateInterest(myEmail, email);
                    refreshInterestedIn();
                    refreshInterestedInMe();
                }
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
                            <table style="color:black;width:40%;float:left;" id="interested-in-me-table"></table>
                            <script>
                                refreshInterestedInMe();
                            </script>
                            <table style="color:black;width:40%;float:right;" id="interested-in-table"></table>
                            <script>
                                refreshInterestedIn();
                            </script>
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