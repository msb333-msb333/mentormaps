<?php
header("Content-Type: application/javascript");
require "./db.php";
$r = mysqli_fetch_array($db->query("SELECT * FROM `logins`"));
die(json_encode($r));