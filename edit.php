<?php
    require "./core.php";
    function showEditPage(){
        require "./db.php";
        require "./logincheck.php";
        checkIfUserLoggedIn($_GET['p']);
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
        
        <style>
        #readonlyInput .readonlyInputNotifier{
             display:none;
        }
        #readonlyInput:hover .readonlyInputNotifier{
             display:block;
        }
        .notifier {
            width:200px;
            height:20px;
            height:auto;
            position:relative;
            left:50%;
            margin-left:-100px;
            bottom:20px;
            background-color: #383838;
            color: #F0F0F0;
            font-family: Calibri;
            font-size: 20px;
            padding:10px;
            text-align:center;
            border-radius: 2px;
            -webkit-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
            -moz-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
            box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
        }
        </style>
        
        <script>
        
        function del(){
            if(confirm("Are you sure you want to delete your profile?")){
                $.ajax({
                    url: "./deleteprofile.php",
                    type: 'POST',
                    data: {
                        'profile_to_delete' : <?php echo $_SESSION['email']; ?>
                    },
                    success : function(){
                        window.location = "./logout.php";
                    }
                });
            }
        }
        
            function submit(){
                var team_number =  document.getElementById("team_number").value;
                var name =    document.getElementById("name").value;
                var address = document.getElementById("address").value;
                var phone = document.getElementById("phone").value;
                var age =    document.getElementById("age").value;
                
                $.ajax({
                    type: 'POST',
                    url: "./edit.php",
                    data: {
                        'NAME' : name,
                        'userToUpdate' :                <?php echo $_SESSION['email']; ?>,
                        'ADDRESS':                      address,
                        'PHONE':                        phone,
                        'TEAM_NUMBER':                  team_number,
                        'AGE' :                         age,
                        'NAME' :                        name,
            
                        'skill-engineering':            document.getElementById("skill-engineering"           ).checked,
                        'engineering-mechanical' :      document.getElementById("engineering-mechanical"      ).checked,
                        'engineering-electrical' :      document.getElementById("engineering-electrical"      ).checked,
                        
                        'skill-manufacturing':          document.getElementById("skill-manufacturing"         ).checked,
            
                        'skill-programming':            document.getElementById("skill-programming"           ).checked,
                        'programming-c':                document.getElementById("programming-c"               ).checked,
                        'programming-java':             document.getElementById("programming-java"            ).checked,
                        'programming-csharp':           document.getElementById("programming-csharp"          ).checked,
                        'programming-python':           document.getElementById("programming-python"          ).checked,
                        'programming-robotc':           document.getElementById("programming-robotc"          ).checked,
                        'programming-nxt':              document.getElementById("programming-nxt"             ).checked,
                        'programming-labview':          document.getElementById("programming-labview"         ).checked,
                        'programming-easyc':            document.getElementById("programming-easyc"           ).checked,
                        'programming-ev3':              document.getElementById("programming-ev3"             ).checked,
                        
                        'skill-cad':                    document.getElementById("skill-cad"                   ).checked,
                        'skill-design':                 document.getElementById("skill-design"                ).checked,
                        'skill-strategy':               document.getElementById("skill-strategy"              ).checked,
                        'skill-scouting':               document.getElementById("skill-scouting"              ).checked,
                        'skill-business':               document.getElementById("skill-business"              ).checked,
                        'skill-fundraising':            document.getElementById("skill-fundraising"           ).checked,
                        'skill-marketing':              document.getElementById("skill-marketing"             ).checked,
                        'skill-other':                  document.getElementById("skill-other"                 ).checked,
                        'other-text-box':               document.getElementById("other-text-box"              ).value,
                        'COMMENTS':                     document.getElementById("comments"                    ).value
                    },
                    success:function(data){
                        $('.notifier').fadeIn(400).delay(3000).fadeOut(400);
                    }
                });
            }
        </script>
        
        <article id="editprofile-article">
            <section class="wrapper style5" style="padding-left:10%;">
                <div class="6u 12u$(small)">
                Name
                    <input id="name" name="NAME"type="text" placeholder="name" value="<?php echo $name; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Email
                    <input id="readonly1" type="text" value="<?php echo $email; ?>" readonly>
                    <div id="notice1" style="color:red;display:none;">Not editable</div>
                </div>
                <br />
                
                <div class="3u 12u$(small)">
                Skills
                <br />
                <br />
                    <?php include './pages/skillset_form.html'; ?>
                    <script>
                        <?php echo 'var skills_json = ' . $skills_json . ';' . PHP_EOL; ?>
                        
                        $.each(skills_json['programming-desc'], function(key, value){
                            skills_json[key] = value;
                        });
                        
                        $.each(skills_json['engineering-desc'], function(key, value){
                            skills_json[key] = value;
                        });
                        
                        $.each(skills_json, function(key, value){
                            if(value=='true'){
                                $("#" + key).prop('checked', true);
                            }
                        });
                    </script>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Team Number
                    <input id="team_number" name="TEAM_NUMBER" type="text" placeholder="team_number" value="<?php echo $team_number; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Comments
                    <input id="comments" name="COMMENTS" type="text" placeholder="comments" value="<?php echo $comments; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Phone
                    <input id="phone" name="PHONE" type="text" placeholder="phone" value="<?php echo $phone; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Email
                    <input id="email" name="EMAIL" type="text" placeholder="email" value="<?php echo $email; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Address
                    <input id="address" name="ADDRESS" type="text" placeholder="address" value="<?php echo $address; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Type
                    <!--<input id="type" name="TYPE" type="text" placeholder="type" value="<?php echo 'type_here'; ?>" readonly/>-->
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Age
                    <input id="age" name="AGE" type="text" placeholder="age" value="<?php echo $age; ?>"/>
                </div>
                <br />
                <div class="6u 12u$(small)">
                Account Type
                    <input id="readonly2" type="text" placeholder="account_type" value="<?php echo $account_type; ?>" readonly/>
                    <div id="notice2" style="color:red;display:none;">Not editable</div>
                </div>
                <br />
                <div class="6u 12u$(small)">
                    <button onclick="submit();">Update Profile</button><div class='notifier' class="notifier" style='display:none'>Profile Updated</div><button onclick="del();">Update Profile</button>
                </div>
                <script>
                var element1 = document.getElementById("readonly1");
                element1.onmouseover = function(){
                    document.getElementById("notice1").style.display = "block";
                }
                element1.onmouseout = function(){
                    document.getElementById("notice1").style.display = "none";
                }
                var element2 = document.getElementById("readonly2");
                element2.onmouseover = function(){
                    document.getElementById("notice2").style.display = "block";
                }
                element2.onmouseout = function(){
                    document.getElementById("notice2").style.display = "none";
                }
                </script>
            </section>
        </article>
        <?php
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){//update fields
        require "./logincheck.php";
        require "./db.php";
        checkIfUserLoggedIn($_POST['userToUpdate']);
        $session_email = $_SESSION['email'];
        
        $json_encoded_skills = json_encode(
                                    array(
                                        'skill-engineering' => $_POST['skill-engineering'],
                                        'engineering-desc'  => array(
                                                                            'engineering-mechanical' => $_POST['engineering-mechanical'],
                                                                            'engineering-electrical' => $_POST['engineering-electrical']),
                                                    
                                        'skill-programming' => $_POST['skill-programming'],
                                        'skill-cad' => $_POST['skill-cad'],
                                        'programming-desc' => array(
                                                                            'programming-c' => $_POST['programming-c'],
                                                                            'programming-java' => $_POST['programming-java'],
                                                                            'programming-csharp' => $_POST['programming-csharp'],
                                                                            'programming-python' => $_POST['programming-python'],
                                                                            'programming-robotc' => $_POST['programming-robotc'],
                                                                            'programming-labview' => $_POST['programming-labview'],
                                                                            'programming-easyc' => $_POST['programming-easyc'],
                                                                            'programming-nxt' => $_POST['programming-nxt'],
                                                                            'programming-ev3' => $_POST['programming-ev3']),
                                                                            
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
        
        $name = str_replace("<script", "im a dirty little hacker: ", mysql_escape_mimic($_POST['NAME']));
        $sql = "UPDATE `data` SET NAME = '$name' WHERE EMAIL = '$session_email'";
        $db->query($sql);
        
        $skills_json = $json_encoded_skills;
        $sql = "UPDATE `data` SET SKILLS_JSON = '$skills_json' WHERE EMAIL = '$session_email'";
        $db->query($sql);
        
        $team_number = str_replace("<script", "im a dirty little hacker: ", mysql_escape_mimic($_POST['TEAM_NUMBER']));
        $sql = "UPDATE `data` SET TEAM_NUMBER = '$team_number' WHERE EMAIL = '$session_email'";
        $db->query($sql);
        
        $comments = str_replace("<script", "im a dirty little hacker: ", mysql_escape_mimic($_POST['COMMENTS']));
        $sql = "UPDATE `data` SET COMMENTS = '$comments' WHERE EMAIL = '$session_email'";
        $db->query($sql);
        
        $phone = str_replace("<script", "im a dirty little hacker: ", mysql_escape_mimic($_POST['PHONE']));
        $sql = "UPDATE `data` SET PHONE = '$phone' WHERE EMAIL = '$session_email'";
        $db->query($sql);
        
        $address = str_replace("<script", "im a dirty little hacker: ", mysql_escape_mimic($_POST['ADDRESS']));
        $sql = "UPDATE `data` SET ADDRESS = '$address' WHERE EMAIL = '$session_email'";
        $db->query($sql);
        
        $age = str_replace("<script", "im a dirty little hacker: ", mysql_escape_mimic($_POST['AGE']));
        $sql = "UPDATE `data` SET AGE = '$age' WHERE EMAIL = '$session_email'";
        $db->query($sql);
        
        echo '<meta http-equiv="refresh" content="0;URL=./edit.php?p='.$session_email.'">';
        
    }else{//display edit page
        if(!isset($_GET['p'])){
            die("please specify a user");
        }
        showEditPage();
    }
?>