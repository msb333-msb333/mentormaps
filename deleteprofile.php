<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
require "./logincheck.php";
checkIfUserLoggedIn($_SESSION['email']);
require "./db.php":

$sql = mysql_escape_mimic("DELETE FROM `logins` WHERE EMAIL = '" . $_POST['user_to_delete'] . "' LIMIT 1;");
$db->query($sql);
file_put_contents("./result.txt", $sql);
$sql = mysql_escape_mimic("DELETE FROM `data` WHERE EMAIL = '".$_POST['user_to_delete']."' LIMIT 1;");
$db->query($sql);
file_put_contents("./result2.txt", $sql);
}else{
    die("must be POST");
}
?>