<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require "./db.php";
    $address = sanitize($_POST['address']);
    $longitude = sanitize($_POST['longitude']);
    $latitude = sanitize($_POST['latitude']);

    $db->query("UPDATE `data` SET LATITUDE = '$latitude' WHERE ADDRESS = '$address'");
    $db->query("UPDATE `data` SET LONGITUDE = '$longitude' WHERE ADDRESS = '$address'");
    echo '{"status":"queried successfully"}';
} else {
    die("not post");
}