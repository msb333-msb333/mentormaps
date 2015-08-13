<?php
//dump all profile data for the provided email
    if(isset($_GET['p'])){
        require "./core.php";
        $refurl = "./profile.php?p=" . $_GET['p'];
        require "./logincheck.php";
        require "./db.php";
        
        $result=$db->query("SELECT * FROM `data` WHERE EMAIL = '".$_GET['p']."'");
        $name = "";
        $skills_json = "";
        $team_number = "";
        $comments = "";
        $phone = "";
        $email = "";
        $address = "";
        $type = "";
        $age = "";
        $account_type = "";
        while($i=mysqli_fetch_assoc($result)){
            $name = $i['NAME'];
            $skills_json = $i['SKILLS_JSON'];
            $team_number = $i['TEAM_NUMBER'];
            $comments = $i['COMMENTS'];
            $phone = $i['PHONE'];
            $email = $i['EMAIL'];
            $address = $i['ADDRESS'];
            $type = $i['TYPE'];
            $age = $i['AGE'];
            $account_type = $i['ACCOUNT_TYPE'];
        }
        echoHeader();
?>
    <article id="main"> 
        <section class="wrapper style5">
            <header>
                <h3><?php echo $name . "'s"?> Profile Page</h3>
            </header>
                <div id="personal-info"style="padding-left: 25px;">
                    <h4>Personal Info</h4>
                </div>
                <div style="padding-left: 60px;">
                    <div id="name-div">
                        <b>Name:</b>   
                            <?php 
                                echo $name;
                            ?>
                    </div>
                    <div id="age-div">
                        <b>Age:</b>   
                            <?php 
                                echo $age;
                            ?>
                    </div>
                    <div id="email-div">
                        <b>Email Address:</b>   
                            <?php 
                                echo $email;
                            ?>
                    </div>
                    <div id="address-div">
                        <b>Address:</b>   
                            <?php 
                                echo $address;
                            ?>
                    </div>
                    <div id="phone-div">
                        <b>Phone Number:</b>   
                            <?php 
                                echo $phone;
                            ?>
                    </div>
                    <div id="bio-div">
                        <b>Bio: </b>   
                            <?php 
                                echo $comments;
                            ?>
                    </div>
                    <div id="type-div">
                        <b>Program Affiliation:</b>   
                                <script>
                                    <?php 
                                        echo 'var type = '.$type.';' . PHP_EOL;
                                    ?>
                                    var types_array = [];
                                    $.each(type, function(key, value){
                                        if(value=='true'){
                                            if(key=='pref_frc'){
                                                types_array.push("FRC");
                                            }
                                            if(key=='pref_ftc'){
                                                types_array.push("FTC");
                                            }
                                            if(key=='pref_fll'){
                                                types_array.push("FLL");
                                            }
                                            if(key=='pref_vex'){
                                                types_array.push("VEX");
                                            }
                                        }
                                    });
                                    for(var i=0; i<types_array.length; i++){
                                        if(i==types_array.length-1){
                                            document.write(types_array[i]);
                                        }else{
                                            document.write(types_array[i] + ", ");
                                        }
                                    }
                                </script>
                    </div>
                </div>
                <div id="skill-info"style="padding-left: 25px; padding-top: 15px;">
                    <h4>Mentor Skillset</h4>
                </div>
                <div style="padding-left: 60px;">
                    <script>
                        <?php 
                            echo 'var skills_json = ' . $skills_json . ';' . PHP_EOL;
                        ?>
                        var assoc = {
                            "skill-engineering" : '',
                            "skill-programming" : '',
                            "skill-cad" : 'CAD',
                            "skill-strategy" : 'Strategy',
                            "skill-business" : 'Business',
                            "skill-marketing" : 'Marketing',
                            "skill-manufacturing" : 'Manufacturing',
                            "skill-design" : 'Design',
                            "skill-fundraising" : 'Fundraising',
                            "skill-scouting" : 'Scouting',
                            "skill-other" : '',
                            "programming-c" : 'C Programming',
                            "programming-java" : 'Java Programming',
                            "programming-csharp" : 'C# Programming',
                            "programming-python" : 'Python Programming',
                            "programming-robotc" : 'RobotC Programming',
                            "programming-labview" : 'LabView Programming',
                            "programming-nxt" : 'NXT Programming',
                            "programming-ev3" : 'EV3 Programming',
                            "engineering-mechanical" : 'Mechanical Engineering',
                            "engineering-electrical" : 'Electrical Engineering'
                        };
                        $.each(skills_json['programming-desc'], function(key, value){
                            skills_json[key] = value;
                        });
                        
                        $.each(skills_json['engineering-desc'], function(key, value){
                            skills_json[key] = value;
                        });
                        
                        $.each(skills_json, function(key, value){
                            if(key != 'engineering-desc' && key != 'programming-desc'){
                                if(key=='skill-other-desc'){
                                    if(skills_json['skills-other']=='true'){
                                        document.write("Other Skill: ("+value+")<br />");  
                                    }
                                    }if(value=='true'){
                                        document.write(assoc[key] + "<br />");
                                      
                                }
                            }
                        });
                    </script>
                </div>
        </section>
    </article>
<?php
        
    }else{
        die('please specify a user');
    }
?>

