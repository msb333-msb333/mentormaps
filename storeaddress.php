<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "./db.php";
    $address = mysql_escape_mimic($_POST['address']);
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $sql = "INSERT INTO `locations` (ADDRESS, LATITUDE, LONGITUDE) VALUES ('$address', '$latitude', '$longitude')";
    $db->query($sql);
    echo '{"status":"queried successfully"}';
}else{
    die("post");
}
?>