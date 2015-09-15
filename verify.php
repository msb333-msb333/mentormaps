<?php
    require "./db.php";

    //sanitize input
    $key = htmlspecialchars(mysql_escape_mimic($_GET['key']), ENT_QUOTES, "UTF-8");

    $db->query("UPDATE `logins` SET `VERIFIED` = 'true' WHERE `KEY` = '$key'");

    echo '<script>window.location = "./login.php";</script>';
?>