<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "./db.php";
    $address = htmlspecialchars(mysql_escape_mimic($_POST['address']), ENT_QUOTES, "UTF-8");
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];

    $db->query("UPDATE `data` SET LATITUDE = '$latitude' WHERE ADDRESS = '$address'");
    $db->query("UPDATE `data` SET LONGITUDE = '$longitude' WHERE ADDRESS = '$address'");
    echo '{"status":"queried successfully"}';
}else{
    die("not post");
}
?>