<?php
    require "./db.php";

    //sanitize input
    $key = sanitize($_GET['key']);

    $db->query("UPDATE `logins` SET `VERIFIED` = 'true' WHERE `KEY` = '$key'");

    echo '<script>window.location = "./login.php";</script>';