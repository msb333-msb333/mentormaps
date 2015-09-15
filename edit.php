<?php
    function showEditPage(){
        require "./db.php";
        if(isset($_GET['p'])){
            checkIfUserLoggedIn($_GET['p']);
            $result=$db->query("SELECT * FROM `data` WHERE EMAIL = '".sanitize($_GET['p'])."';");
            while($i=mysqli_fetch_assoc($result)){
                $name = $i['NAME'];
                $skills_json = $i['SKILLS_JSON'];
                $team_number = $i['TEAM_NUMBER'];
                $comments = $i['COMMENTS'];
                $phone = $i['PHONE'];
                $email = $i['EMAIL'];
                $address = $i['ADDRESS'];
                $type = json_decode($i['TYPE'], true);
                $age = $i['AGE'];
                $account_type = $i['ACCOUNT_TYPE'];
            }
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
        
        <script src="./customjquery.js"></script>
        <script>
            function del(){
                if(confirm("Are you sure you want to delete your profile?")){
                    $.ajax({
                        url: "./deleteprofile.php",
                        type: 'POST',
                        data: {
                            'user_to_delete' : '<?php echo $_SESSION['email']; ?>'
                        },
                        success : function(){
                            window.location = "./logout.php";
                        }
                    });
                }
            }
        
            function submit(){
                var address = document.getElementById("address").value;

                //add new address entry if it changed
                if(!(address=='<?php echo $address; ?>')){
                    submitAddress(address);
                }

                var checkboxes = [
                    'frc',
                    'ftc',
                    'vex',
                    'fll',
                    'skill-engineering',
                    'engineering-mechanical',
                    'engineering-electrical',
                    'skill-manufacturing',
                    'skill-programming',
                    'programming-c',
                    'programming-java',
                    'programming-csharp',
                    'programming-python',
                    'programming-robotc',
                    'programming-nxt',
                    'programming-labview',
                    'programming-easyc',
                    'programming-ev3',
                    'skill-cad',
                    'skill-design',
                    'skill-strategy',
                    'skill-scouting',
                    'skill-business',
                    'skill-fundraising',
                    'skill-marketing',
                    'skill-other'
                ];
                var fields = [
                    'name',
                    'address',
                    'phone',
                    'team-number',
                    'age',
                    'other-text-box',
                    'comments'
                ];

                var info = {};
                info['userToUpdate'] = '<?php echo $_SESSION['email']; ?>';

                for(var index in fields){
                    var fieldName = fields[index];
                    info[fieldName] = $("#"+fieldName).val();
                }

                for(var index in checkboxes){
                    var indexName = checkboxes[index];
                    info[indexName] = $("#"+indexName).is(":checked");
                }

                //update user info
                $.ajax({
                    type: 'POST',
                    url: "./edit.php",
                    data: info,
                    success:function(){
                        $('.notifier').fadeIn(400).delay(3000).fadeOut(400);
                    }
                });
            }
        </script>

        <style>
        #readonlyInput .readonlyInputNotifier{
             display:none;
        }
        #readonlyInput:hover .readonlyInputNotifier{
             display:block;
        }
        .notifier {
            width:200px;
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
            -webkit-box-shadow: 0 0 24px -1px rgba(56, 56, 56, 1);
            -moz-box-shadow: 0 0 24px -1px rgba(56, 56, 56, 1);
            box-shadow: 0 0 24px -1px rgba(56, 56, 56, 1);
        }
        </style>
        
        <article id="editprofile-article">
            <section class="wrapper style5" style="padding-left:10%;">
                <div class="6u 12u$(small)">
                Name
                    <input id="name" name="NAME"type="text" placeholder="name" value="<?php if(isset($name))echo $name;else echo 'loading...'; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Email
                    <input id="readonly1" type="text" value="<?php if(isset($email))echo $email;else echo 'loading...'; ?>" readonly>
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
                                if(key=="skill-other"){
                                    document.getElementById("other-text-box").style.visibility = "visible";
                                }
                            }
                            if(key=="skill-other-desc"){
                                $("#other-text-box").val(value);
                            }
                        });
                    </script>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Team Number
                    <input id="team-number" type="text" placeholder="team number" value="<?php if(isset($team_number))echo $team_number;else echo 'loading...'; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Comments
                    <input id="comments"  maxlength="200" type="text" placeholder="comments" value="<?php if(isset($comments))echo $comments;else echo 'loading...'; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Phone
                    <input id="phone" type="text" placeholder="phone" value="<?php if(isset($phone))echo $phone;else echo 'loading...'; ?>"/>
                </div>
                <br />
                
                <div class="6u 12u$(small)">
                Address
                    <input id="address" type="text" placeholder="address" value="<?php if(isset($address))echo $address;else echo 'loading...'; ?>"/>
                </div>
                <br />

                <div class="3u 12u$(small)">
                    Program Affiliation:
                </div>
                <br/>
                <div class="3u 12u$(small)">
                    <input type="checkbox" id="FLLcheck" name="typeChecks" <?php if($type['fll']=='true') echo 'checked'; ?>>
                    <label for="FLLcheck">FLL</label>
                </div>
                <div class="3u 12u$(small)">
                    <input type="checkbox" id="FTCcheck" name="typeChecks" <?php if($type['ftc']=='true') echo 'checked'; ?>>
                    <label for="FTCcheck">FTC</label>
                </div>
                <div class="3u 12u$(small)">
                    <input type="checkbox" id="FRCcheck" name="typeChecks" <?php if($type['frc']=='true') echo 'checked'; ?>>
                    <label for="FRCcheck">FRC</label>
                </div>
                <div class="3u 12u$(small)">
                    <input type="checkbox" id="VEXcheck" name="typeChecks" <?php if($type['vex']=='true') echo 'checked'; ?>>
                    <label for="VEXcheck">VEX</label>
                </div>
                <br/>
                <div class="6u 12u$(small)">
                <?php if($account_type=="MENTOR"){
                    echo 'Years of ';
                } ?>Experience
                    <input id="age" name="AGE" type="text" placeholder="age" value="<?php if(isset($age))echo $age;else echo 'loading...'; ?>"/>
                </div>
                <br />
                <div class="6u 12u$(small)">
                    <button onclick="submit();">Update Profile</button><button onclick="del();" class="button special">Delete Profile</button><div class='notifier' class="notifier" style='display:none'>Profile Updated</div>
                </div>
                <script>
                var element1 = document.getElementById("readonly1");
                element1.onmouseover = function(){
                    document.getElementById("notice1").style.display = "block";
                };
                element1.onmouseout = function(){
                    document.getElementById("notice1").style.display = "none";
                };
                if($("#skill-other").is(":checked")){
                    $("#other-text-box").css("");//dunno what this was
                    //TODO figure it out            ^
                }
                </script>
            </section>
        </article>
        <?php
    }
    require "./logincheck.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){//update fields
        require "./db.php";
        checkIfUserLoggedIn($_POST['userToUpdate']);
        $session_email = sanitize($_SESSION['email']);

        $json_encoded_skills = json_encode(
            array(
                'skill-engineering' => $_POST['skill-engineering'],
                'engineering-desc' => array(
                    'engineering-mechanical' => $_POST['engineering-mechanical'],
                    'engineering-electrical' => $_POST['engineering-electrical']
                ),

                'skill-programming' => $_POST['skill-programming'],
                'programming-desc' => array(
                    'programming-c' => $_POST['programming-c'],
                    'programming-java' => $_POST['programming-java'],
                    'programming-csharp' => $_POST['programming-csharp'],
                    'programming-python' => $_POST['programming-python'],
                    'programming-robotc' => $_POST['programming-robotc'],
                    'programming-labview' => $_POST['programming-labview'],
                    'programming-easyc' => $_POST['programming-easyc'],
                    'programming-nxt' => $_POST['programming-nxt'],
                    'programming-ev3' => $_POST['programming-ev3']
                ),

                'skill-cad' => $_POST['skill-cad'],
                'skill-strategy' => $_POST['skill-strategy'],
                'skill-business' => $_POST['skill-business'],
                'skill-marketing' => $_POST['skill-marketing'],
                'skill-manufacturing' => $_POST['skill-manufacturing'],
                'skill-design' => $_POST['skill-design'],
                'skill-scouting' => $_POST['skill-scouting'],
                'skill-fundraising' => $_POST['skill-fundraising'],
                'skill-other' => $_POST['skill-other'],
                'skill-other-desc' => sanitize($_POST['other-text-box'])
            )
        );

        $name = sanitize($_POST['name']);
        $db->query("UPDATE `data` SET NAME = '$name' WHERE EMAIL = '$session_email'");

        $db->query("UPDATE `data` SET SKILLS_JSON = '$json_encoded_skills' WHERE EMAIL = '$session_email'");
        
        $team_number = sanitize($_POST['team-number']);
        $db->query("UPDATE `data` SET TEAM_NUMBER = '$team_number' WHERE EMAIL = '$session_email'");
        
        $comments = sanitize($_POST['comments']);
        $db->query("UPDATE `data` SET COMMENTS = '$comments' WHERE EMAIL = '$session_email'");
        
        $phone = sanitize($_POST['phone']);
        $db->query("UPDATE `data` SET PHONE = '$phone' WHERE EMAIL = '$session_email'");
        
        $address = sanitize($_POST['address']);
        $db->query("UPDATE `data` SET ADDRESS = '$address' WHERE EMAIL = '$session_email'");
        
        $age =  sanitize($_POST['age']);
        $db->query("UPDATE `data` SET AGE = '$age' WHERE EMAIL = '$session_email'");

        $typeKeys = array('frc', 'ftc', 'fll', 'vex');

        $type = array();
        foreach($typeKeys as $typeKey){
            $type[$typeKey] = $_POST[$typeKey];
        }

        echo '<script>console.log("'.$type.'");</script>';
        $sql = "UPDATE `data` SET `TYPE` = '$type' WHERE EMAIL = '$session_email';";
        echo '<script>console.log("'.$sql.'");</script>';
        $db->query($sql);

        if($db->errno){
            echo $db->error();
        }
    }else{
        if(!isset($_GET['p'])){
            echo '<meta http-equiv="refresh" content="0;URL=./edit.php?p='.$_SESSION['email'].'">';
        }
        showEditPage();
    }
?>