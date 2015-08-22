<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "./config.php";
    require "./db.php";
    require "./mailsender.php";

    $result=$db->query("SELECT * FROM `logins` WHERE `EMAIL` = '".$_POST['email']."';");
    while($r=mysqli_fetch_assoc($result)){
        $key = $r['KEY'];
    }
    if(isset($key)){
        sendEmail($sendgrid_api_key, $_POST['email'], 'MentorMaps: Reset Password', '<a href="http://mrflark.org/mmdev/mentormaps/reset.php?key='.$key.'">reset</a>');
        die("sent reset email");
    }else{
        die("so such email in db");
    }
}else{
    ?>
    
    <form method="post">
        Email: <input type="text" name="email" /><br/>
        <input type="submit" value="reset" />
    </form>

    <?php
}
?>