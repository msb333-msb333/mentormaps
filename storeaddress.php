<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "./db.php";
    $address = mysql_escape_mimic($_POST['address']);
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $sql = "UPDATE `data` SET LATITUDE = '$latitude' WHERE ADDRESS = '$address'";
    $db->query($sql);
    $sql = "UPDATE `data` SET LONGITUDE = '$longitude' WHERE ADDRESS = '$address'";
    $db->query($sql);
    echo '{"status":"queried successfully"}';
}else{
    die("not post");
}
?>