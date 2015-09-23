<?php
header("Content-Type: application/javascript");
require "./db.php";
$result = $db->query("SELECT * FROM `logins`");
$a = array();

$teams = 0;
$verified = 0;
$total = 0;


while($r=mysqli_fetch_array($result)){
    $total++;
    if($r['TYPE']=='TEAM'){
        $teams++;
    }
    if($r['VERIFIED']=='true'){
        $verified++;
    }


    array_push($a, array(
        $r['EMAIL'],
        $r['VERIFIED'],
        $r['TYPE']
    ));
}

$mentors = $total - $teams;
$unverified = $total - $verified;
echo "total:$total, verified:$verified, teams:$teams, unverified:$unverified, mentors:$mentors".PHP_EOL;

die(json_encode($a));