<?php /** register team page & db logic **/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');
    require "./db.php";
    require "./security/salt.php";
    require "./mailsender.php";

    //sql injection doesn't matter, it's going to be hashed anyway
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    //prevent xss & sql injection
    $team_age = sanitize($_POST['team-age']);
    $team_name = sanitize($_POST['team-name']);
    $team_email = sanitize($_POST['team-email']);
    $team_address = sanitize($_POST['team-address']);
    $team_phone = sanitize($_POST['team-phone']);
    $comments = sanitize($_POST['comments']);
    $team_number = sanitize($_POST['team-number']);
    $rname = sanitize($_POST['rname']);

    $result = $db->query("SELECT * FROM `logins` WHERE EMAIL = '$team_email'");
    if ($result->num_rows > 0) {
        die("a user already has that email address");
    }

    //set skills
    require "./skills.php";
    $non_json_array = array();
    foreach ($skills_keys as $skill_key) {
        $non_json_array[$skill_key] = sanitize($_POST[$skill_key]);
    }
    $json_encoded_skills = json_encode($non_json_array);

    //set types
    $type = array();
    foreach ($type_keys as $typeKey) {
        $type[$typeKey] = sanitize($_POST[$typeKey]);
    }
    $type = json_encode($type);

    $pass_hash = md5(mysql_escape_mimic($pass1) . createSalt($team_email));

    $guid = md5($team_email) . md5($pass_hash);

    $db->query("INSERT INTO `logins` (`KEY`, `VERIFIED`, `EMAIL`, `PASSWORD`, `TYPE`) VALUES ('" . $guid . "', 'false', '" . $team_email . "', '" . $pass_hash . "', 'TEAM');");
    $db->query("INSERT INTO `data` (`RNAME`, `ACCOUNT_TYPE`, `NAME`, `SKILLS_JSON`, `TEAM_NUMBER`, `COMMENTS`, `PHONE`, `EMAIL`, `ADDRESS`, `TYPE`, `AGE`) VALUES ('" . $rname . "', 'TEAM', '" . $team_name . "', '" . $json_encoded_skills . "', '" . $team_number . "', '" . $comments . "', '" . $team_phone . "', '" . $team_email . "', '" . $team_address . "', '" . $type . "', '" . $team_age . "');");
    $db->query("INSERT INTO `assoc` (`email`, `interested-in`, `interested-in-me`) VALUES ('$team_email', '{lv1:[], lv2:[]}', '{lv1:[], lv2:[]}')");

    require "./config.php";
    require "./pages/account_verify_email.php";
    sendEmail($sendgrid_api_key, $team_email, 'MentorMaps: Complete Registration', echoEmail($guid, $SITE_ROOT));

    echo "{\"status\":\"ok\"}";
} else {
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
        <script type="text/javascript" src="https://maps-api-ssl.google.com/maps/api/js?v=3&sensor=false"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="./assets/js/jquery.scrollTo.min.js"></script>
        <!--[if lte IE 8]>
        <script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <!--[if lte IE 8]>
        <script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <!--[if lte IE 8]>
        <link rel="stylesheet" href="assets/css/ie8.css"/><![endif]-->
        <!--[if lte IE 9]>
        <link rel="stylesheet" href="assets/css/ie9.css"/><![endif]-->
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
            <header>
                <h2>
                    Register as a Team
                </h2>
            </header>
            <section class="wrapper style5">
                <div class="inner">
                    <section id="register-section">
                        <h4>Team Registration</h4>

                        <div>
                            <div class="row uniform">
                                <div class="6u 12u$(xsmall)">
                                    <input type="text" title="Team Name" name="team-name" id="team-name"
                                           placeholder="Team Name" required/>
                                </div>
                                <div class="6u$ 12u$(xsmall)">
                                    <input type="email" title="Email" name="team-email" id="team-email"
                                           placeholder="Email" required/>
                                </div>
                                <div class="6u 12u$(small)">
                                    <input type="password" title="Password" id="pass1" placeholder="Password" required/>
                                </div>
                                <div class="6u 12u$(small)">
                                    <input type="password" title="Retype Password" id="pass2"
                                           placeholder="Retype Password" required/>
                                </div>
                                <div class="6u 12u$(small)">
                                    <input type="text" title="Team Number" name="team-number" id="team-number"
                                           placeholder="Team Number" required/>
                                </div>
                                <div class="6u 12u$(small)">
                                    <input type="text" title="Contact Person" name="rname" id="rname"
                                           placeholder="Contact Person" required/>
                                </div>

                                <?php include "./pages/address_form.html"; ?>

                                <div class="6u 12u$(xsmall)">
                                    <input type="checkbox" id="team-age"/>
                                    <label for="team-age">Rookie Team?</label>
                                </div>
                                <div class="6u 12u$(xsmall)">
                                    <input type="text" name="team-phone" id="team-phone"
                                           placeholder="Phone Number (Optional)"/>
                                </div>

                                <?php include("./pages/type_form.html"); ?>

                                <div class="6u 12u$(small)">
                                    Searching for...
                                </div>
                                <div class="6u 12u$(small)">
                                    <br/>&nbsp;
                                </div>

                                <?php include("./pages/skillset_form.html"); ?>

                                <div class="12u$">
                                    <textarea maxlength="200" id="comments" title="Comments"
                                              placeholder="Write something about your team" rows="6"></textarea>
                                </div>
                                <div class="12u$">
                                    <input type="checkbox" id="EulaAgreement"/>
                                    <label for="EulaAgreement">I agree to the <a target="_blank" href="./tos.php">terms
                                            of service</a> and certify that I am 18 years of age or older</label>
                                </div>
                                <div class="12u$">
                                    <button id="submitTeamRegistrationForm" class="button special">Become a Team
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </article>
        <footer id="footer">
            <ul class="copyright">
                <li><?php require "./copy.php"; echoCopy(); ?></li>
            </ul>
        </footer>
    </div>
    </body>
    <script src="./customjquery.js"></script>
    <script>
        $(function () {
            $("#engineering-types-list").toggle();
            $("#programming-types-list").toggle();
        });
    </script>
    </html>
    <?php
}
?>