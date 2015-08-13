<?php
require "./logincheck.php";
checkIfUserLoggedIn($_SESSION['email']);
require "./db.php":

$db->query(mysql_escape_mimic("DELETE FROM `logins` WHERE EMAIL = '" . $_POST['user_to_delete'] . "' LIMIT 1;"));
$db->query(mysql_escape_mimic("DELETE FROM `data` WHERE EMAIL = '".$_POST['user_to_delete']."' LIMIT 1;"));
?>