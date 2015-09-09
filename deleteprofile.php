<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require './db.php';
    require "./logincheck.php";
    //make sure that the user to be deleted is the one that is actually logged in
    checkIfUserLoggedIn($_POST['user_to_delete']);

    $sql = "DELETE FROM `logins` WHERE EMAIL = '" . $_POST['user_to_delete'] . "' LIMIT 1";
    $db->query($sql);

    $sql = "DELETE FROM `data` WHERE EMAIL = '".$_POST['user_to_delete']."' LIMIT 1";
    $db->query($sql);

    echo '{"status":"deleted profile successfully"}';
}else{
    die("must be POST");
}
?>