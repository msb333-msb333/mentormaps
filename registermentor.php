<?php /** mentor registration page & db logic **/
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header('Content-Type: application/json');
    require "./db.php";
    require "./security/salt.php";
    
    $mentor_name     =      mysql_escape_mimic($_POST['mentor-name']   );   
    $mentor_email    =      mysql_escape_mimic($_POST['mentor-email']  );
    $mentor_address  =      mysql_escape_mimic($_POST['mentor-address']);
    $mentor_phone    =      mysql_escape_mimic($_POST['mentor-phone']  );
    $mentor_bio      =      mysql_escape_mimic($_POST['bio']           );
    $team_number     =      mysql_escape_mimic($_POST['team-number']   );
    $age             =      mysql_escape_mimic($_POST['age']           );

    $pass1           =      $_POST['pass1'];
    $pass2           =      $_POST['pass2'];

    //not this time, vinnie
    $mentor_name     =      str_replace("<script", "im a dirty little hacker: ", $mentor_name   );
    $mentor_email    =      str_replace("<script", "im a dirty little hacker: ", $mentor_email  );
    $mentor_address  =      str_replace("<script", "im a dirty little hacker: ", $mentor_address);
    $mentor_phone    =      str_replace("<script", "im a dirty little hacker: ", $mentor_phone  );
    $mentor_bio      =      str_replace("<script", "im a dirty little hacker: ", $mentor_bio    );
    $team_number     =      str_replace("<script", "im a dirty little hacker: ", $team_number   );
    $age             =      str_replace("<script", "im a dirty little hacker: ", $age           );
    
    $result=$db->query("SELECT * FROM `logins` WHERE EMAIL = '$mentor_email'");
    if($result->num_rows > 0){
        die("a user already has that email address");
    }

    $json_encoded_skills = json_encode(
                                    array(
                                        'skill-engineering' => $_POST['skill-engineering'],
                                        'engineering-desc'  => array(
                                                                    'engineering-mechanical' => $_POST['engineering-mechanical'],
                                                                    'engineering-electrical' => $_POST['engineering-electrical']
                                                                    ),
                                                    
                                        'skill-programming' => $_POST['skill-programming'],
                                        'programming-desc'  => array(
                                                                    'programming-c'         => $_POST['programming-c'          ],
                                                                    'programming-java'      => $_POST['programming-java'       ],
                                                                    'programming-csharp'    => $_POST['programming-csharp'     ],
                                                                    'programming-python'    => $_POST['programming-python'     ],
                                                                    'programming-robotc'    => $_POST['programming-robotc'     ],
                                                                    'programming-labview'   => $_POST['programming-labview'    ],
                                                                    'programming-easyc'     => $_POST['programming-easyc'      ],
                                                                    'programming-nxt'       => $_POST['programming-nxt'        ],
                                                                    'programming-ev3'       => $_POST['programming-ev3'        ]
                                                                    ),

                                        'skill-cad'           => $_POST['skill-cad'           ],
                                        'skill-strategy'      => $_POST['skill-strategy'      ],
                                        'skill-business'      => $_POST['skill-business'      ],
                                        'skill-marketing'     => $_POST['skill-marketing'     ],
                                        'skill-manufacturing' => $_POST['skill-manufacturing' ],
                                        'skill-design'        => $_POST['skill-design'        ],
                                        'skill-scouting'      => $_POST['skill-scouting'      ],
                                        'skill-fundraising'   => $_POST['skill-fundraising'   ],
                                        'skill-other'         => $_POST['skill-other'         ],
                                        'skill-other-desc'    => str_replace("<script", "im a dirty little hacker: ", mysql_escape_mimic($_POST['other-text-box']))
                                        )
                                    );

    $type = json_encode(
                    array(
                        'pref_fll' => $_POST['FLLcheck'],
                        'pref_ftc' => $_POST['FTCcheck'],
                        'pref_frc' => $_POST['FRCcheck'],
                        'pref_vex' => $_POST['VEXcheck']
                        )
                    );
    
    $pass_hash = md5(mysql_escape_mimic($pass1) . createSalt($mentor_email));
    
    $db->query("INSERT INTO `logins` (`EMAIL`,             `PASSWORD`,       `TYPE`)".
        "VALUES".
                                    "('".$mentor_email."', '".$pass_hash."', 'MENTOR');");



    $db->query("INSERT INTO `data` (`ACCOUNT_TYPE`, `NAME`,             `SKILLS_JSON`,              `TEAM_NUMBER`,      `COMMENTS`,         `PHONE`,             `EMAIL`,            `ADDRESS`,             `TYPE`,      `AGE`)"
            . "VALUES" .
                                  "('MENTOR',       '".$mentor_name."', '".$json_encoded_skills."', '".$team_number."', '".$mentor_bio."', '".$mentor_phone."', '".$mentor_email."', '".$mentor_address."', '".$type."', '".$age."');");
    
    echo "{\"status\":\"ok\"}";
}else{
require "./core.php";
echoHeader();
?>
                    <article id="main">
                        <header>
                            <h2>Register as a Mentor</h2>
                        </header>
                        <section class="wrapper style5">
                            <div class="inner">
                                <section id="register-section">
                                    <h4 style="font-size:32px;">Mentor Registration</h4>
                                    <div>
                                        <div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" title="Full Name" name="mentor-name" id="mentor-name" placeholder="Full Name" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="email" title="Email" name="mentor-email" id="mentor-email" placeholder="Email" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" title="Password" name="pass1" id="pass1" placeholder="Password" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" title="Retype Password" name="pass2" id="pass2" placeholder="Retype Password" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="text" title="Team Number" name="team-number" id="team-number" placeholder="Team Number (Optional)" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="text" title="Years Mentored" name="age" id="age" placeholder="Years Mentored" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text"  title="Address" name="address-line-1" id="address-line-1" placeholder="Address" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" title="City" name="address-city" id="address-city" placeholder="City" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" title="State" name="address-state" id="address-state" placeholder="State" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" title="Country" name="address-country" id="address-country" placeholder="Country" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" title="Phone Number" name="mentor-phone" id="mentor-phone" placeholder="Phone Number (Optional)" />
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

                                            <?php
                                                include("./pages/skillset_form.html");
                                            ?>

                                            <div class="12u$">
                                                <textarea name="bio" title="Write something about yourself" id="bio" placeholder="Write something about yourself" rows="6"></textarea>
                                            </div>
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
                        <ul class="copyright">
                            <li>&copy; Joseph Sirna 2015</li>
                        </ul>
                    </footer>

            </div>
    </body>
    <script src="./customjquery.js"></script>
    <script>
    //disable uls by default
        $(function(){
            $("#engineering-types-list").toggle();
            $("#programming-types-list").toggle();
        });
    </script>
</html>
<?php
}
?>