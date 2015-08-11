<?php
    if(isset($_GET['p'])){
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
        
        echo "Name: $name<br />";
        echo "Skills JSON: $skills_json<br />";
        echo "Team Number: $team_number<br />";
        echo "Comments: $comments<br />";
        echo "Phone: $phone<br />";
        echo "Email: $email<br />";
        echo "Address: $address<br />";
        echo "Type: $type<br />";
        echo "Age: $age<br />";
        echo "Account Type: $account_type<br />";
        
    }else{
        die('please specify a user');
    }
?>