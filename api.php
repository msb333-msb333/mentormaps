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

    $email = $r['EMAIL'];

    $result2 = $db->query("SELECT * FROM `data` WHERE `email` = '$email';");

    $a2 = array();
    while($r2=mysqli_fetch_assoc($result2)){
        array_push($a2, array(
            'lat' => $r2['LATITUDE'],
            'lng' => $r2['LONGITUDE']
            )
        );
    }

    array_push($a, array(
        $email,
        $r['VERIFIED'],
        $r['TYPE'],
        $a2
    ));
}

$mentors = $total - $teams;
$unverified = $total - $verified;
echo "total:$total, verified:$verified, teams:$teams, unverified:$unverified, mentors:$mentors".PHP_EOL;

die(json_encode($a));