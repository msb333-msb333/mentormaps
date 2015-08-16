<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
require "./logincheck.php";
checkIfUserLoggedIn($_POST['user_to_delete']);
require "./db.php":

$sql = "DELETE FROM `logins` WHERE EMAIL = '" . $_POST['user_to_delete'] . "' LIMIT 1;";
file_put_contents("./result.txt", $sql);
$sql = mysql_escape_mimic($sql);
$db->query($sql);
file_put_contents("./result.txt", $sql);
$sql = "DELETE FROM `data` WHERE EMAIL = '".$_POST['user_to_delete']."' LIMIT 1;";
$sql = mysql_escape_mimic($sql);
$db->query($sql);
file_put_contents("./result2.txt", $sql);
}else{
    die("must be POST");
}
?>