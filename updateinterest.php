<?php
    require "./db.php";

    $theirEmail = $_POST['theirEmail'];
    $myEmail = $_POST['myEmail'];
    $theirIntJSON = $_POST['theirIntJSON'];
    $myIntJSON = $_POST['myIntJSON'];

    $sql = "UPDATE `assoc` SET `interested-in-me` = '$theirIntJSON' WHERE EMAIL = '$theirEmail';";
    $db->query($sql);
    $sql = "UPDATE `assoc` SET `interested-in` = '$myIntJSON' WHERE EMAIL = '$myEmail';";
    $db->query($sql);
?>