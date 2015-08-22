<?php
    require "./db.php";
    $key = $_GET['key'];
    $sql = "UPDATE `logins` SET `VERIFIED` = 'true' WHERE `KEY` = '$key'";
    $db->query($sql);
    echo '<script>window.location = "./login.php";</script>';
?>