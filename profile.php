<?php
require "./logincheck.php";
    if(isset($_GET['p'])){
        $refurl = "./profile.php?p=" . $_GET['p'];
        require "./db.php";
        
        $result=$db->query("SELECT * FROM `data` WHERE EMAIL = '".$_GET['p']."'");
        $name                   = "";
        $skills_json            = "";
        $team_number            = "";
        $comments               = "";
        $phone                  = "";
        $email                  = "";
        $address                = "";
        $type                   = "";
        $age                    = "";
        $account_type           = "";
        while($i=mysqli_fetch_assoc($result)){
            $name               = $i['NAME'         ];
            $skills_json        = $i['SKILLS_JSON'  ];
            $team_number        = $i['TEAM_NUMBER'  ];
            $comments           = $i['COMMENTS'     ];
            $phone              = $i['PHONE'        ];
            $email              = $i['EMAIL'        ];
            $address            = $i['ADDRESS'      ];
            $type               = $i['TYPE'         ];
            $age                = $i['AGE'          ];
            $account_type       = $i['ACCOUNT_TYPE' ];
        }
        echo '<!--this is a ' . $account_type . '-->';

        $theirInterests;
        $sql = "SELECT * FROM `assoc` WHERE EMAIL = '$email'";
        $result=$db->query($sql);
        while($r=mysqli_fetch_assoc($result)){
            $theirInterests = $r['interested-in-me'];
        }
        
        $myInterests;
        $sql = "SELECT * FROM `assoc` WHERE EMAIL = '".$_SESSION['email']."'";
        $result=$db->query($sql);
        while($r=mysqli_fetch_assoc($result)){
            $myInterests = $r['interested-in'];
        }

        if($myInterests==""){
            $myInterests = "{\"lv1\":[], \"lv2\":[]}";
        }
        if($theirInterests==""){
            $theirInterests = "{\"lv1\":[], \"lv2\":[]}";
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
        <script src="./interest.js"></script>
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
                    if (!Array.prototype.indexOf){
                        Array.prototype.indexOf = function(searchElement /*, fromIndex */){
                            "use strict";
                            if (this === void 0 || this === null)
                    throw new TypeError();
                var t = Object(this);
                var len = t.length >>> 0;
                if (len === 0)
                    return -1;
                var n = 0;
                if (arguments.length > 0){
                    n = Number(arguments[1]);
                    if (n !== n)
                        n = 0;
                    else if (n !== 0 && n !== (1 / 0) && n !== -(1 / 0))
                        n = (n > 0 || -1) * Math.floor(Math.abs(n));
                }
                if (n >= len)
                    return -1;
                var k = n >= 0 ? n : Math.max(len - Math.abs(n), 0);

                for (; k < len; k++){
                    if (k in t && t[k] === searchElement)
                        return k;
                    }
                return -1;
            };
        }

        var myInterests = <?php echo $myInterests; ?>;
        var theirInterests = <?php echo $theirInterests; ?>;

        $(function(){
            if(myInterests.lv1.indexOf('<?php echo $email; ?>') > -1){
                $("#im-interested").prop('checked', true);
            }
        });

        function redirectToEditPage(){
            window.location = './edit.php';
        }
    </script>

    <article id="main"> 
        <section class="wrapper style5">
            <div id="map-nav" style="padding-left:3%;padding-bottom:1%;">
                <a href="./map.php">
                    &#9664; Return to Map
                </a>
            </div>
            <header>
                <div id="profile-page" style="padding-left: 60px;" style="display:inline-block;">
                    <h2>
                        <?php echo $name . "'s Profile Page"; ?>
                    </h2>
                    <div id="im-interested-wrapper" class="6u 12u$(small)">
                        <input type="checkbox" id="im-interested"/>
                        <label for="im-interested">I'm interested in this <?php echo strtolower($account_type); ?></label>
                        <script>
                            $(function(){
                                if('<?php echo $email; ?>' == '<?php echo $_SESSION['email'] ?>'){
                                    $("#im-interested-wrapper").hide();
                                }
                            });
                            $("#im-interested").change(function(){
                                if($("#im-interested").is(':checked')){
                                    updateInterest(true, '<?php echo $email; ?>', "<?php echo $_SESSION['email']; ?>", 1);
                                }else{
                                    updateInterest(false, '<?php echo $email; ?>', "<?php echo $_SESSION['email']; ?>", 1);
                                }
                            });
                        </script>
                    </div>
                </div>
            </header>
            <div style="display: inline-block;">
                <div style="float: left;width:50%;">
                    <div id="personal-info"style="padding-left: 90px;">
                        <h3>
                            Personal Info
                        </h3>
                    </div>
                    <div style="padding-left: 130px;">
                        <div id="name-div">
                            <b style="color: #19D1AC;">
                                Name:
                            </b>
                            <?php echo $name; ?>
                        </div>
                        <div id="age-div">
                            <b style="color:#19D1AC;">
                                <?php if($account_type=="MENTOR"){
                                    echo 'Years of';
                                } ?> Experience: 
                            </b>
                            <?php echo $age; ?>
                        </div>
                        <div id="email-div">
                            <b style="color:#19D1AC;">
                                Email Address: 
                            </b>
                            <?php echo $email; ?>
                        </div>
                        <div id="address-div">
                            <b style="color:#19D1AC;">
                                Address: 
                            </b>
                            <?php echo $address; ?>
                        </div>
                        <div id="phone-div">
                            <b style="color:#19D1AC;">
                                Phone Number: 
                            </b>   
                            <?php echo $phone; ?>
                        </div>
                        <div id="bio-div">
                            <b style="color:#19D1AC;">
                                Bio: 
                            </b>   
                            <?php echo $comments; ?>
                        </div>
                        <div id="type-div">
                            <b style="color:#19D1AC;">
                                Program Affiliation: 
                            </b>   
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
                <div style="float:right;width:50%;">
                    <div id="skill-info"style="padding-left: 90px;">
                        <?php if($account_type=="MENTOR"){ ?><h3>Mentor Skillset</h3><?php }else{ ?><h3>Searching For Help with</h3><?php } ?>
                    </div>
                    <div style="padding-left: 130px;">
                        <script>
                            <?php 
                                echo 'var skills_json = ' . $skills_json . ';' . PHP_EOL;
                            ?>
                            var assoc = {
                                "skill-engineering"         : '',
                                "skill-programming"         : '',
                                "skill-other"               : '',
                                "skill-cad"                 : 'CAD',
                                "skill-strategy"            : 'Strategy',
                                "skill-business"            : 'Business',
                                "skill-marketing"           : 'Marketing',
                                "skill-manufacturing"       : 'Manufacturing',
                                "skill-design"              : 'Design',
                                "skill-fundraising"         : 'Fundraising',
                                "skill-scouting"            : 'Scouting',
                                "programming-c"             : 'C Programming',
                                "programming-java"          : 'Java Programming',
                                "programming-csharp"        : 'C# Programming',
                                "programming-python"        : 'Python Programming',
                                "programming-robotc"        : 'RobotC Programming',
                                "programming-labview"       : 'LabView Programming',
                                "programming-nxt"           : 'NXT Programming',
                                "programming-easyc"         : 'EasyC Programming',
                                "programming-ev3"           : 'EV3 Programming',
                                "engineering-mechanical"    : 'Mechanical Engineering',
                                "engineering-electrical"    : 'Electrical Engineering'
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
                                        if(skills_json['skill-other']=='true'){
                                            document.write("<li>Other Skill: ("+value+")</li>");  
                                        }
                                    }else if(key=='skill-programming' || key=='skill-engineering'||key=="skill-other"){
                                        //don't print these keys
                                    }else if(value=='true'){
                                        document.write('<li>' + assoc[key] + '</li>');
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
                <?php if($_GET['p'] == $_SESSION['email']){ ?>
                <div style="padding-left: 60%;">
                    <button type="button" onclick="redirectToEditPage();">Edit Profile</button>
                </div>
                <?php } ?>
            </div>
        </section>
    </article>
<?php
    }else{
        echo '<meta http-equiv="refresh" content="0;URL=./profile.php?p='.$_SESSION['email'].'">';
    }
?>