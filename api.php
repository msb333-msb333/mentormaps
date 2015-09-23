<?php
header("Content-Type: application/javascript");
require "./db.php";
$result = $db->query("SELECT * FROM `logins`");
$a = array();

while($r=mysqli_fetch_array($result)){
    array_push($a, array(
        $r['EMAIL'],
        $r['VERIFIED'],
        $r['ACCOUNT_TYPE']
    ));
}

die(json_encode($a));