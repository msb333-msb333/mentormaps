<?php /** register team page & db logic **/
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header('Content-Type: application/json');
    require "./db.php";
    require "./security/salt.php";
    require "./mailsender.php";

    //prevent sql injection
    $team_age           = mysql_escape_mimic($_POST['team-age']     );
    $team_name          = mysql_escape_mimic($_POST['team-name']    );
    $team_email         = mysql_escape_mimic($_POST['team-email']   );
    $team_address       = mysql_escape_mimic($_POST['team-address'] );
    $team_phone         = mysql_escape_mimic($_POST['team-phone']   );
    $comments           = mysql_escape_mimic($_POST['comments']     );
    $team_number        = mysql_escape_mimic($_POST['team-number']  );
    $rname              = mysql_escape_mimic($_POST['rname']        );
    
    //sql injection doesn't matter, it's going to be hashed anyway
    $pass1              = $_POST['pass1'];
    $pass2              = $_POST['pass2'];
    
    //prevent xss
    $team_age           = htmlspecialchars($team_age,       ENT_QUOTES, 'UTF-8');
    $team_name          = htmlspecialchars($team_name,      ENT_QUOTES, 'UTF-8');
    $team_email         = htmlspecialchars($team_email,     ENT_QUOTES, 'UTF-8');
    $team_address       = htmlspecialchars($team_address,   ENT_QUOTES, 'UTF-8');
    $team_phone         = htmlspecialchars($team_phone,     ENT_QUOTES, 'UTF-8');
    $comments           = htmlspecialchars($comments,       ENT_QUOTES, 'UTF-8');
    $TEAM_NUMBER        = htmlspecialchars($team_number,    ENT_QUOTES, 'UTF-8');
    $rname              = htmlspecialchars($rname,          ENT_QUOTES, 'UTF-8');
    
    $result=$db->query("SELECT * FROM `logins` WHERE EMAIL = '$team_email'");
    if($result->num_rows > 0){
        die("a user already has that email address");
    }

    $json_encoded_skills = json_encode(
                                    array(
                                        'skill-engineering'     => $_POST['skill-engineering'],
                                        'engineering-desc'      => array(
                                                                    'engineering-mechanical'    => $_POST['engineering-mechanical'],
                                                                    'engineering-electrical'    => $_POST['engineering-electrical']
                                                                    ),
                                        'skill-programming'     => $_POST['skill-programming'],
                                        'programming-desc'      => array(
                                                                        'programming-c'         => $_POST['programming-c'         ],
                                                                        'programming-java'      => $_POST['programming-java'      ],
                                                                        'programming-csharp'    => $_POST['programming-csharp'    ],
                                                                        'programming-python'    => $_POST['programming-python'    ],
                                                                        'programming-robotc'    => $_POST['programming-robotc'    ],
                                                                        'programming-labview'   => $_POST['programming-labview'   ],
                                                                        'programming-easyc'     => $_POST['programming-easyc'     ],
                                                                        'programming-nxt'       => $_POST['programming-nxt'       ],
                                                                        'programming-ev3'       => $_POST['programming-ev3'       ]
                                                                        ),
                                        'skill-cad'             => $_POST['skill-cad'],
                                        'skill-strategy'        => $_POST['skill-strategy'],
                                        'skill-business'        => $_POST['skill-business'],
                                        'skill-marketing'       => $_POST['skill-marketing'],
                                        'skill-manufacturing'   => $_POST['skill-manufacturing'],
                                        'skill-design'          => $_POST['skill-design'],
                                        'skill-scouting'        => $_POST['skill-scouting'],
                                        'skill-fundraising'     => $_POST['skill-fundraising'],
                                        'skill-other'           => $_POST['skill-other'],
                                        'skill-other-desc'      => htmlspecialchars(mysql_escape_mimic($_POST['other-text-box']))
                                        ));
                    
    $type = json_encode(array('pref_fll' => $_POST['FLLcheck'],
                              'pref_ftc' => $_POST['FTCcheck'],
                              'pref_frc' => $_POST['FRCcheck'],
                              'pref_vex' => $_POST['VEXcheck']));
    
    $pass_hash = md5(mysql_escape_mimic($pass1) . createSalt($team_email));
    
    $guid = md5($team_email) . md5($pass_hash);

    $db->query("INSERT INTO `logins` (`KEY`, `VERIFIED`, `EMAIL`, `PASSWORD`, `TYPE`) VALUES ('".$guid."', 'false', '" . $team_email . "', '" . $pass_hash . "', 'TEAM');");
    $db->query("INSERT INTO `data` (`RNAME`, `ACCOUNT_TYPE`, `NAME`, `SKILLS_JSON`, `TEAM_NUMBER`, `COMMENTS`, `PHONE`, `EMAIL`, `ADDRESS`, `TYPE`, `AGE`) VALUES ('".$rname."', 'TEAM', '".$team_name."', '".$json_encoded_skills."', '".$team_number."', '".$comments."', '".$team_phone."', '".$team_email."', '".$team_address."', '".$type."', '".$team_age."');");
    $db->query("INSERT INTO `assoc` (`email`, `interested-in`, `interested-in-me`) VALUES ('$team_email', '[]', '[]')");

    require "./config.php";
    require "./pages/account_verify_email.php";
    sendEmail($sendgrid_api_key, $team_email, 'MentorMaps: Complete Registration', echoEmail($guid, $SITE_ROOT));

    echo "{\"status\":\"ok\"}";
}else{
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
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
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
                                                <input type="text" title="Team Name" name="team-name" id="team-name" placeholder="Team Name" required/>
                                            </div>
                                            <div class="6u$ 12u$(xsmall)">
                                                <input type="email" title="Email" name="team-email" id="team-email" placeholder="Email" required/>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" title="Password" id="pass1" placeholder="Password" required/>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" title="Retype Password" id="pass2" placeholder="Retype Password" required/>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="text" title="Team Number" name="team-number" id="team-number" placeholder="Team Number" required/>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="text" title="Contact Person" name="rname" id="rname" placeholder="Contact Person" required/>
                                            </div>

                                            <?php include "./pages/address_form.html"; ?>

                                            <div class="6u 12u$(xsmall)">
                                                <input type="checkbox" id="team-age"/>
                                                <label for="team-age">Rookie Team?</label>
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="team-phone" id="team-phone" placeholder="Phone Number (Optional)" />
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="radio" id="FLLcheck" name="typeChecks" checked>
                                                <label for="FLLcheck">FLL</label>
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="radio" id="FTCcheck" name="typeChecks">
                                                <label for="FTCcheck">FTC</label>
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="radio" id="FRCcheck" name="typeChecks">
                                                <label for="FRCcheck">FRC</label>
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="radio" id="VEXcheck" name="typeChecks">
                                                <label for="VEXcheck">VEX</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                Searching for...
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <br />&nbsp;
                                            </div>

                                            <?php include("./pages/skillset_form.html"); ?>
                                            
                                            <div class="12u$">
                                                <textarea name="comments" maxlength="200" id="comments" title="Comments" placeholder="Write something about your team" rows="6"></textarea>
                                            </div>
                                            <div class="12u$">
                                                <input type="checkbox" id="EulaAgreement"></input>
                                                <label for="EulaAgreement">I agree to the <a target="_blank" href="./tos.php">terms of service</a> and certify that I am 18 years of age or older</label>
                                            </div>
                                            <div class="12u$">
                                                <button id="submitTeamRegistrationForm" class="button special">Become a Team</button>
                                            </div>
                                        </div>
                                    </div>
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

            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.scrollex.min.js"></script>
            <script src="assets/js/jquery.scrolly.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/main.js"></script>
            <script src="./customjquery.js"></script>
    </body>
    <script>
        $(function(){
            $("#engineering-types-list").toggle();
            $("#programming-types-list").toggle();
        });
    </script>
</html>
<?php
}
?>