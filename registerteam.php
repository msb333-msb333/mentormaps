<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header('Content-Type: application/json');
    require "./db.php";
    require "./security/salt.php";
    
    //prevent sql injection
    $team_age = mysql_escape_mimic($_POST['team-age']); 
    $team_name = mysql_escape_mimic($_POST['team-name']);   
    $team_email = mysql_escape_mimic($_POST['team-email']);
    $team_address = mysql_escape_mimic($_POST['team-address']);
    $team_phone = mysql_escape_mimic($_POST['team-phone']);
    $comments = mysql_escape_mimic($_POST['comments']);
    $team_number = mysql_escape_mimic($_POST['team-number']);
    
    //doesn't matter, it's going to be hashed anyway
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    
    //prevent xss
    $team_age=str_replace("<script", "im a dirty little hacker: ", $team_age);
    $team_name=str_replace("<script", "im a dirty little hacker: ", $team_name);
    $team_email=str_replace("<script", "im a dirty little hacker: ", $team_email);
    $team_address=str_replace("<script", "im a dirty little hacker: ", $team_address);
    $team_phone=str_replace("<script", "im a dirty little hacker: ", $team_phone);
    $comments=str_replace("<script", "im a dirty little hacker: ", $comments);
    $team_number=str_replace("<script", "im a dirty little hacker: ", $team_number);
    
    $json_encoded_skills = json_encode(
                                    array(
                                        'skill-engineering' => $_POST['skill-engineering'],
                                        'engineering-desc'  => json_encode(
                                                                        array(
                                                                            'engineering-mechanical' => $_POST['engineering-mechanical'],
                                                                            'engineering-electrical' => $_POST['engineering-electrical'])),
                                                    
                                        'skill-programming' => $_POST['skill-programming'],
                                        'skill-cad' => $_POST['skill-cad'],
                                        'programming-desc' => json_encode(
                                                                        array(
                                                                            'programming-c' => $_POST['programming-c'],
                                                                            'programming-java' => $_POST['programming-java'],
                                                                            'programming-csharp' => $_POST['programming-csharp'],
                                                                            'programming-python' => $_POST['programming-python'],
                                                                            'programming-robotc' => $_POST['programming-robotc'],
                                                                            'programming-labview' => $_POST['programming-labview'],
                                                                            'programming-easyc' => $_POST['programming-easyc'],
                                                                            'programming-nxt' => $_POST['programming-nxt'],
                                                                            'programming-ev3' => $_POST['programming-ev3'])),
                                                                            'skill-strategy' => $_POST['skill-strategy'],
                                                                            'skill-business' => $_POST['skill-business'],
                                                                            'skill-marketing' => $_POST['skill-marketing'],
                                                                            'skill-manufacturing' => $_POST['skill-manufacturing'],
                                                                            'skill-design' => $_POST['skill-design'],
                                                                            'skill-scouting' => $_POST['skill-scouting'],
                                                                            'skill-fundraising' => $_POST['skill-fundraising'],
                                                                            'skill-other' => $_POST['skill-other'],
                                                                            'skill-other-desc' => str_replace("<script", "im a dirty little hacker: ", mysql_escape_mimic($_POST['other-text-box']))
                                        ));
                    
    $type = json_encode(array(  'pref_fll' => $_POST['FLLcheck'],
                                'pref_ftc' => $_POST['FTCcheck'],
                                'pref_frc' => $_POST['FRCcheck'],
                                'pref_vex' => $_POST['VEXcheck']));
    
    $pass_hash = md5(mysql_escape_mimic($pass1) . createSalt($team_email));
    
    $db->query("INSERT INTO `logins` (`EMAIL`, `PASSWORD`, `TYPE`) VALUES ('" . $team_email . "', '" . $pass_hash . "', 'TEAM');");    
    $db->query("INSERT INTO `data` (`ACCOUNT_TYPE`, `NAME`, `SKILLS_JSON`, `TEAM_NUMBER`, `COMMENTS`, `PHONE`, `EMAIL`, `ADDRESS`, `TYPE`, `AGE`) VALUES ('TEAM', '".$team_name."', '".$json_encoded_skills."', '".$team_number."', '".$comments."', '".$team_phone."', '".$team_email."', '".$team_address."', '".$type."', '".$team_age."');");
    echo "{\"status\":\"ok\"}";
}else{
    require "./core.php";
    echoHeader();
?>
                <!-- Main -->
                    <article id="main">
                        <header>
                            <h2>Register as a Team</h2>
                            <p><!--text here :D--></p>  
                        </header>
                        <section class="wrapper style5">
                            <div class="inner">
                                <section id="register-section">
                                    <h4>Team Registration</h4>
                                    <div>
                                        <div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="team-name" id="team-name" placeholder="Team Name" />
                                            </div>
                                            <div class="6u$ 12u$(xsmall)">
                                                <input type="email" name="team-email" id="team-email" placeholder="Email" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" name="pass1" id="pass1" placeholder="Password" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" name="pass2" id="pass2" placeholder="Retype Password" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="text" name="team-number" id="team-number" placeholder="Team Number" />
                                            </div>
                                            
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="address-line-1" id="address-line-1" placeholder="Address" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="address-city" id="address-city" placeholder="City" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="address-state" id="address-state" placeholder="State" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="address-country" id="address-country" placeholder="Country" />
                                            </div>
                                            
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="team-address" id="team-age" placeholder="Team Age (Optional)" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="team-phone" id="team-phone" placeholder="Phone Number (Optional)" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <br />&nbsp;
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
                                            <?php
                                            include("./pages/skillset_form.html");
                                            ?>
                                            <div class="12u$">
                                                <textarea name="comments" id="comments" placeholder="Write something about your team" rows="6"></textarea>
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