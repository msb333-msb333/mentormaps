<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "./config.php";
    require "./db.php";
    require "./mailsender.php";
    $result=$db->query("SELECT * FROM `logins` WHERE `EMAIL` = '".sanitize($_POST['email'])."';");
    while($r=mysqli_fetch_assoc($result)){
        $key = $r['KEY'];
    }
    if(isset($key)){
        require "./pages/default_header.html";
        require "./config.php";
        require "./pages/reset_password_email.php";
        sendEmail($sendgrid_api_key, $_POST['email'], 'MentorMaps: Reset Password', echoResetPasswordEmail($key, $SITE_ROOT));
        die("sent reset email");
        require "./pages/default_footer.html";
    }else{
        require "./pages/default_header.html";
        die("no such email in db");
        require "./pages/default_footer.html";
    }
}else{
    require "./pages/default_header.html";
    ?>
    
    <form method="post">
        Email: <input type="text" name="email" /><br/>
        <input type="submit" value="reset" />
    </form>

    <?php
    require "./pages/default_footer.html";
}
?>