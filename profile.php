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
                    <div id="name-div" style="padding-left: 60px;">
                        <b>Name:</b>   
                            <?php 
                                echo $name;
                            ?>
                    </div>
                    <div id="age-div" style="padding-left: 60px;">
                        <b>Age:</b>   
                            <?php 
                                echo $age;
                            ?>
                    </div>
                    <div id="email-div" style="padding-left: 60px;">
                        <b>Email Address:</b>   
                            <?php 
                                echo $email;
                            ?>
                    </div>
                    <div id="address-div" style="padding-left: 60px;">
                        <b>Address:</b>   
                            <?php 
                                echo $address;
                            ?>
                    </div>
                    <div id="phone-div" style="padding-left: 60px;">
                        <b>Phone Number:</b>   
                            <?php 
                                echo $phone;
                            ?>
                    </div>
                    <div id="type-div" style="padding-left: 60px;">
                        <b>Program Affiliation:</b>   
                            <?php 
                                echo $type;
                            ?>
                    </div>
                <div class="inner">
                    <?php /*
                    
                        $array = json_decode($skills_json, true);
                        
                        $assoc_array = array();
                        for($i = 0; $i < sizeof($array); $i++){
                           $key = $array[$i]['name'];
                           $assoc_array[$key] = $array[$i]['value'];
                        }
                        foreach($assoc_array as $element) {
                            if($assoc_array[$element] == 'true'){
                                echo $element;
                            }
                        }
                        
                    */?>    
                </div>
        </section>
    </article>
<?php
        
    }else{
        die('please specify a user');
    }
?>