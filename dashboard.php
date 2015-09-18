<?php
require "./db.php";
require "./logincheck.php";

if (isset($_GET['p'])) {
    $user = sanitize($_GET['p']);
    checkIfUserLoggedIn($user);

    //get all information from the db about the specified user
    $sql = "SELECT * FROM `assoc` WHERE email = '$user';";
    $result = $db->query($sql);
    $interested_in = '{lv1:[], lv2:[]}';
    $interested_in_me = '{lv1:[], lv2:[]}';
    if ($result) {
        while ($r = mysqli_fetch_assoc($result)) {
            $interested_in = $r['interested-in'];
            $interested_in_me = $r['interested-in-me'];
        }
    } else {
        //TODO handle invalid query error
    }
} else {
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=./dashboard.php?p=" . $_SESSION['email'] . "\">";
}
?>
<html>
<head>
    <link rel="shortcut icon" href="http://mentormaps.net/favicon.ico"/>
    <title>Mentor Maps</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script type="text/javascript"
            src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-e-RpEFPKNX-hDqBs--zoYYCk2vmXdZg"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <!--[if lte IE 8]>
    <script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ie8.css"/><![endif]-->
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ie9.css"/><![endif]-->
    <!--[if lte IE 8]>
    <script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <style>
        .not-interested-button {
            width: 24px;
            height: 24px;
            content: url('./img/ic_not_interested_black_48dp_2x.png');
        }

        .not-interested-button:hover {
            content: url('./img/ic_not_interested_red_48dp_2x.png');
        }

        .lv2button{
            width: 24px;
            height: 24px;
            content: url('./img/ic_library_add_black_48dp_2x.png');
        }

        .lv2button:hover{
            content: url('./img/ic_library_add_red_48dp_2x.png');
        }

        .lv2notinterested{
            width: 24px;
            height: 24px;
            content: url('./img/ic_not_interested_black_48dp_2x.png');
        }

        .lv2notinterested:hover{
            content: url('./img/ic_not_interested_red_48dp_2x.png');
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
        var interested_in_me = <?php echo $interested_in_me; ?>;
        var myEmail = '<?php echo $_SESSION['email']; ?>';


        function lv2NotInterested(email){
            myInterests.lv2.splice(myInterests.lv2.indexOf(email), 1);
            myInterests.lv1.push(email);
            updateInterest(myEmail, email);

            $.ajax({
                url: './getInterestForEmail.php',
                type: 'POST',
                data: {
                    email : email
                },
                success: function(data){
                    var theirInt = $.parseJSON($.parseJSON(data).response);
                    theirInt.lv2.splice(theirInt.lv2.indexOf(myEmail), 1);
                    theirInt.lv1.push(myEmail);
                    updateTheirInterest(email, theirInt);
                }
            });
            refreshInterestedIn();
        }

        function updateTheirInterest(email, theirInt){
            $.ajax({
                type:'POST',
                url:'./setInterestForEmail.php',
                data: {
                    email: email,
                    theirInt: JSON.stringify(theirInt)
                },
                success:function(data){
                    console.log("successfully updated `interested-in-me` for " + email);
                }
            });
        }

        function updateInterestArraysForEmail(email){
            $.ajax({
                url: './getInterestForEmail.php',
                type: 'POST',
                data: {
                    email : email
                },
                success: function(data){
                    var theirInt = $.parseJSON($.parseJSON(data).response);
                    theirInt.lv1.splice(theirInt.lv1.indexOf(myEmail), 1);
                    theirInt.lv2.push(myEmail);
                    updateTheirInterest(email, theirInt);
                }
            });
        }

        function addToLv2(email){
            myInterests.lv1.splice(myInterests.lv1.indexOf(email), 1);
            myInterests.lv2.push(email);
            updateInterest(myEmail, email);
            updateInterestArraysForEmail(email);
            //send notification email
            $.ajax({
                url: './lv2Notifier.php',
                type: 'POST',
                data: {
                    theirEmail: email,
                    myEmail: myEmail
                }
            });
            refreshInterestedIn();
        }

        function updateInterest(myEmail, theirEmail) {
            $.ajax({
                url: './updateinterest.php',
                type: 'POST',
                data: {
                    'theirEmail': theirEmail,
                    'myEmail': myEmail,
                    'theirIntJSON': JSON.stringify(interested_in_me),
                    'myIntJSON': JSON.stringify(myInterests)
                }
            });
        }

        //iterate over every account that is interested in the currently logged in user
        function refreshInterestedInMe() {
            $("#interested-in-me-table").html("<tr><th>Who's Interested In Me:</th></tr>");
            $.each(interested_in_me.lv1, function (key, value) {
                $("#interested-in-me-table").append("<tr><td>" + value + "<a href='./profile.php?p=" + value + "'>&nbsp;<img src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'/></a></td></tr>");
            });
            $.each(interested_in_me.lv2, function (key, value) {
                $("#interested-in-table").append("<tr><td>(lv2) " + value + "<a href='./profile.php?p=" + value + "'>&nbsp;<img src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'/></a></td></tr>");
            });
        }

        function refreshInterestedIn() {
            $("#interested-in-table").html("<tr><th>Who I'm Interested In:</th></tr>");
            $.each(myInterests.lv1, function (key, value) {
                $("#interested-in-table").append("<tr><td><img class='not-interested-button' onclick='notinterested(\"" + value + "\");'/> | " + value + "<a href='./profile.php?p=" + value + "'>&nbsp;<img src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'/></a> | <img class=\"lv2button\" onclick=\"addToLv2('"+value+"');\" /></td></tr>");
            });
            $.each(myInterests.lv2, function (key, value) {
                $("#interested-in-table").append("<tr><td>(lv2) " + value + "<a href='./profile.php?p=" + value + "'>&nbsp;<img src='./img/ic_open_in_new_black_24dp_2x.png' width='24px'/></a> | <img class='lv2notinterested' onclick='lv2NotInterested(\""+value+"\");'></td></tr>");
            });
        }

        function notinterested(email) {
            myInterests.lv1.splice(myInterests.lv1.indexOf(email), 1);
            interested_in_me.lv1.splice(interested_in_me.lv1.indexOf(email), 1);

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
                <?php echoCopy(); ?>
            </li>
        </ul>
    </footer>
</div>
</body>
</html>