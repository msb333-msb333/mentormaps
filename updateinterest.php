<?php
    require "./db.php";

    //sanitize input
    $theirEmail     = htmlspecialchars(mysql_escape_mimic($_POST['theirEmail']),    ENT_QUOTES, "UTF-8");
    $myEmail        = htmlspecialchars(mysql_escape_mimic($_POST['myEmail']),       ENT_QUOTES, "UTF-8");
    $theirIntJSON   = htmlspecialchars(mysql_escape_mimic($_POST['theirIntJSON']),  ENT_QUOTES, "UTF-8");
    $myIntJSON      = htmlspecialchars(mysql_escape_mimic($_POST['myIntJSON']),     ENT_QUOTES, "UTF-8");

    $db->query("UPDATE `assoc` SET `interested-in-me` = '$theirIntJSON' WHERE EMAIL = '$theirEmail';");
    $db->query("UPDATE `assoc` SET `interested-in` = '$myIntJSON' WHERE EMAIL = '$myEmail';");
?>