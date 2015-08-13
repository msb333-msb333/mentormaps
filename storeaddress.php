<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "./db.php";
    $address = $_POST['address'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $db->query(mysql_escape_mimic("INSERT INTO `locations` (ADDRESS, LATITUDE, LONGITUDE) VALUES ('$address', '$latitude', '$longitude');"));
}else{
    die("post");
}
?>