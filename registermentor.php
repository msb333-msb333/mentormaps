<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header('Content-Type: application/json');
    require "./db.php";
    require "./security/salt.php";
    
    $mentor_name =          mysql_escape_mimic($_POST['mentor-name']   );   
    $mentor_email =         mysql_escape_mimic($_POST['mentor-email']  );
    $mentor_address =       mysql_escape_mimic($_POST['mentor-address']);
    $mentor_phone =         mysql_escape_mimic($_POST['mentor-phone']  );
    $mentor_bio =           mysql_escape_mimic($_POST['bio']           );
    $mentor_age =           mysql_escape_mimic($_POST['mentor-age']    );
    $team_number =          mysql_escape_mimic($_POST['team-number']);
    
    $pass1 =                $_POST['pass1'];
    $pass2 =                $_POST['pass2'];
    
    $mentor_name=   str_replace("<script>", "im a dirty little hacker: ", $mentor_name   );
    $mentor_email=  str_replace("<script>", "im a dirty little hacker: ", $mentor_email  );
    $mentor_address=str_replace("<script>", "im a dirty little hacker: ", $mentor_address);
    $mentor_phone=  str_replace("<script>", "im a dirty little hacker: ", $mentor_phone  );
    $mentor_bio=    str_replace("<script>", "im a dirty little hacker: ", $mentor_bio    );
    $mentor_age=    str_replace("<script>", "im a dirty little hacker: ", $mentor_age    );
    $team_number=   str_replace("<script>", "im a dirty little hacker: ", $team_number   );
                  
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

    $pref = json_encode(
                    array(
                        'pref_fll' => $_POST['FLLcheck'],
                        'pref_ftc' => $_POST['FTCcheck'],
                        'pref_frc' => $_POST['FRCcheck'],
                        'pref_vex' => $_POST['VEXcheck']));

    $mentor_pass = mysql_escape_mimic($pass1);
    
    $salt = createSalt($mentor_email);
    
    $concatPass = $mentor_pass . $salt;
    
    $pass_hash = md5($concatPass);
    
    $sql = "INSERT INTO `logins` (`EMAIL`, `PASSWORD`, `TYPE`) VALUES ('" . $mentor_email . "', '" . $pass_hash . "', 'MENTOR');";
    
    $db->query($sql);
    
    //var conversions cause im too lazy to change the js
    $email = $mentor_email;
    $address = $mentor_address;
    $age = $mentor_age;
    $comments = $mentor_bio;
    $name = $mentor_name;
    $phone = $mentor_phone;
    $type = $pref;
    $skills_json = $json_encoded_skills;
    
    $sql = "INSERT INTO `data` (`ACCOUNT_TYPE`, `NAME`, `SKILLS_JSON`, `TEAM_NUMBER`, `COMMENTS`, `PHONE`, `EMAIL`, `ADDRESS`, `TYPE`, `AGE`) VALUES ('MENTOR', '".$name."', '".$skills_json."', '".$team_number."', '".$comments."', '".$phone."', '".$email."', '".$address."', '".$type."', '".$age."');";
    $db->query($sql);
    
    echo "{\"status\":\"ok\"}";
}else{
require "./core.php";
echoHeader();
?>
                <!-- Main -->
                    <article id="main">
                        <header>
                            <h2>Register as a Mentor</h2>
                            <p><!--Mentors do stuff :D--></p>
                        </header>
                        <section class="wrapper style5">
                            <div class="inner">
                                <section id="register-section">
                                    <h4 style="font-size:32px;">Mentor Registration</h4>
                                    <div>
                                        <div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="mentor-name" id="mentor-name" placeholder="Name" />
                                            </div>
                                            <div class="6u$ 12u$(xsmall)">
                                                <input type="email" name="mentor-email" id="mentor-email" placeholder="Email" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" name="pass1" id="pass1" placeholder="Password" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" name="pass2" id="pass2" placeholder="Retype Password" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="text" name="team-number" id="team-number" placeholder="Team Number (Optional)" />
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
                                            
                                            <div class="6u 12u$(small)">
                                                <input type="text" name="mentor-age" id="mentor-age" placeholder="Age" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="mentor-phone" id="mentor-phone" placeholder="Phone Number (Optional)" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <br />&nbsp;
                                            </div>
                                            
                                            <div class="3u 12u$(small)">
                                                <input type="checkbox" id="FLLcheck" name="typeChecks">
                                                <label for="FLLcheck">FLL</label>
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="checkbox" id="FTCcheck" name="typeChecks">
                                                <label for="FTCcheck">FTC</label>
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="checkbox" id="FRCcheck" name="typeChecks">
                                                <label for="FRCcheck">FRC</label>
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="checkbox" id="VEXcheck" name="typeChecks">
                                                <label for="VEXcheck">VEX</label>
                                            </div>
                                            
                                            <div class="6u 12u$(small)">
                                                <br />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <br />
                                            </div>
                                            <h4 style="font-size:23px;">
                                                Mentor Skillset
                                            </h4>
                                            <div class="6u 12u$(small)">
                                                <br />&nbsp;
                                            </div>
                                            
                                            
                                            <div class="12u 12u$(small)">
                                                <input type="checkbox" id="skill-engineering">
                                                <label for="skill-engineering">Engineering</label>
                                            </div>
                                            
                                            <div class="6u 12u$">
                                                <ul id="engineering-types-list" style="list-style-type:none;">
                                                    <li>&nbsp;<input id="engineering-mechanical" type="checkbox"/><label for="engineering-mechanical">Mechanical</label></li>
                                                    <li>&nbsp;<input id="engineering-electrical" type="checkbox"/><label for="engineering-electrical">Electrical</label></li>
                                                </ul>
                                            </div>                  
                                            
                                            <div class="12u 12u$(small)">
                                                <input type="checkbox" id="skill-programming" name="programming">
                                                <label for="skill-programming">Programming</label>
                                            </div>
                                            
                                            <div class="6u 12u$">
                                                <ul id="programming-types-list" style="list-style-type:none;">
                                                    <li>&nbsp;<input id="programming-c" type="checkbox"/><label for="programming-c">C</label></li>
                                                    <li>&nbsp;<input id="programming-java" type="checkbox"/><label for="programming-java">Java</label></li>
                                                    <li>&nbsp;<input id="programming-csharp" type="checkbox"/><label for="programming-csharp">C#</label></li>
                                                    <li>&nbsp;<input id="programming-python" type="checkbox"/><label for="programming-python">python</label></li>
                                                    <li>&nbsp;<input id="programming-robotc" type="checkbox"/><label for="programming-robotc">RobotC</label></li>
                                                    <li>&nbsp;<input id="programming-labview" type="checkbox"/><label for="programming-labview">LabView</label></li>
                                                    <li>&nbsp;<input id="programming-easyc" type="checkbox"/><label for="programming-easyc">EasyC</label></li>
                                                    <li>&nbsp;<input id="programming-nxt" type="checkbox"/><label for="programming-nxt">NXT</label></li>
                                                    <li>&nbsp;<input id="programming-ev3" type="checkbox"/><label for="programming-ev3">EV3</label></li>
                                                </ul>
                                            </div>  
                                            
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="skill-manufacturing" name="manufacturing">
                                                <label for="skill-manufacturing">Manufacturing</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="skill-design" name="design">
                                                <label for="skill-design">Design</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="skill-strategy" name="strategy">
                                                <label for="skill-strategy">Strategy</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="skill-scouting" name="scouting">
                                                <label for="skill-scouting">Scouting</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="skill-business" name="business">
                                                <label for="skill-business">Business</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="skill-fundraising" name="fundraising">
                                                <label for="skill-fundraising">Fundraising</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="skill-marketing" name="marketing">
                                                <label for="skill-marketing">Marketing</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="skill-cad" name="cad">
                                                <label for="skill-cad">CAD</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="skill-other" name="other">
                                                <label for="skill-other">Other</label>
                                            </div>
                                            <div class="6u 12u$(small)" style="visibility: hidden;">
                                                <input type="text" id="other-text-box" name="other-text-box" placeholder="define 'other'">
                                            </div>
                                            <div class="12u$">
                                                <textarea name="bio" id="bio" placeholder="Write something about yourself" rows="6"></textarea>
                                            </div>
                                            <!--<div class="6u$ 12u$(small)">
                                                <div class="g-recaptcha" data-sitekey="6Le4JAoTAAAAAEVE_IFxMAiK2vdgoiQoo9R5SCTN"></div>
                                            </div>-->
                                            <div class="12u$">
                                                <button id="submitMentorRegistrationForm" class="button special">Become a Mentor</button>
                                            </div>
                                        </div>
                                    </div>
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
    </body>
    <script src="./customjquery.js"></script>
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