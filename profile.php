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
                <div id="profile-page" style="padding-left: 60px;">
                    <h2><?php echo $name . "'s"?> Profile Page</h2>
                </div>
            </header>
            <div style="display: inline-block;">
                <div style="float: left; width: 50%;">
                <div id="personal-info"style="padding-left: 90px;">
                    <h3>Personal Info</h3>
                </div>
                <div style="padding-left: 130px;">
                    <div id="name-div">
                        <b style="color: #19D1AC;">Name:</b>   
                            <?php 
                                echo $name;
                            ?>
                    </div>
                    <div id="age-div">
                        <b style="color:#19D1AC;">Age:</b>   
                            <?php 
                                echo $age;
                            ?>
                    </div>
                    <div id="email-div">
                        <b style="color:#19D1AC;">Email Address:</b>   
                            <?php 
                                echo $email;
                            ?>
                    </div>
                    <div id="address-div">
                        <b style="color:#19D1AC;">Address:</b>   
                            <?php 
                                echo $address;
                            ?>
                    </div>
                    <div id="phone-div">
                        <b style="color:#19D1AC;">Phone Number:</b>   
                            <?php 
                                echo $phone;
                            ?>
                    </div>
                    <div id="bio-div">
                        <b style="color:#19D1AC;">Bio: </b>   
                            <?php 
                                echo $comments;
                            ?>
                    </div>
                    <div id="type-div">
                        <b style="color:#19D1AC;">Program Affiliation:</b>   
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
                </div>
                <div style="float:right; width: 50%;">
                <div id="skill-info"style="padding-left: 90px;">
                    <h3>Mentor Skillset</h3>
                </div>
                <div style="padding-left: 130px;">
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
                                }else if(key=='skill-programming' || key=='skill-engineering'){
                                    //don't print these keys
                                }else if(value=='true'){
                                    document.write(assoc[key] + "<br />");
                                }
                            }
                        });
                    </script>
                </div>
                </div>
                </div>
        </section>
    </article>
<?php
        
    }else{
        die('please specify a user');
    }
?>

