<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require './db.php';
    require "./logincheck.php";
    checkIfUserLoggedIn($_POST['user_to_delete']);

    $userToDelete = htmlspecialchars(mysql_escape_mimic($_POST['user_to_delete']), ENT_QUOTES, "UTF-8");

    $db->query("DELETE FROM `logins` WHERE EMAIL = '" . $userToDelete . "' LIMIT 1;");
    $db->query("DELETE FROM `data` WHERE EMAIL = '". $userToDelete ."' LIMIT 1;");

    echo '{"status":"deleted profile successfully"}';
}else{
    die("must be POST");
}
?>