<?php
    require "./logincheck.php";
    require "./core.php";
    
    if(!isset($_GET['p'])){
        die("please specify a user");
    }
    
    function showEditPage(){
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
            <input id="name" type="text" placeholder="name" value="<?php echo $name; ?>"/>
            <input id="skills_json" type="text" placeholder="skills_json" value="<?php echo "skills_json_here"; ?>"/>
            <input id="team_number" type="text" placeholder="team_number" value="<?php echo $team_number; ?>"/>
            <input id="comments" type="text" placeholder="comments" value="<?php echo $comments; ?>"/>
            <input id="phone" type="text" placeholder="phone" value="<?php echo $phone; ?>"/>
            <input id="email" type="text" placeholder="email" value="<?php echo $email; ?>"/>
            <input id="address" type="text" placeholder="address" value="<?php echo $address; ?>"/>
            <input id="type" type="text" placeholder="type" value="<?php echo $type; ?>"/>
            <input id="age" type="text" placeholder="age" value="<?php echo $age; ?>"/>
            <input id="account_type" type="text" placeholder="account_type" value="<?php echo $account_type; ?>"/>
        <?php
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){//update fields
        $name = $_POST['NAME'];
        $skills_json = $_POST['SKILLS_JSON'];
        $team_number = $_POST['TEAM_NUMBER'];
        $comments = $_POST['COMMENTS'];
        $phone = $_POST['PHONE'];
        $email = $_POST['EMAIL'];
        $address = $_POST['ADDRESS'];
        $type = $_POST['TYPE'];
        $age = $_POST['AGE'];
        $account_type = $_POST['ACCOUNT_TYPE'];
        
        
        
    }else{//display edit page
        showEditPage();
    }
?>