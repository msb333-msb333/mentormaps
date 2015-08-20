<?php
header("Content-Type:text");
require "./db.php";
$sql = "SELECT * FROM `survey_results`;";
$result=$db->query($sql);
while($r=mysqli_fetch_assoc($result)){
    echo $r['TO_ADD_FEATURES'] . PHP_EOL;
}
?>