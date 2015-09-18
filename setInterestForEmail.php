<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    require "./db.php";
    $newIntInMe = $_POST['theirInt'];
    $email = $_POST['email'];
    $db->query("UPDATE `assoc` SET `interested-in-me` = '".$newIntInMe."' WHERE `email` = '".$email."';");
    die(json_encode(array('status' => 'updated successfully')));
}else{
    die(json_encode(array('error' => 'must be post')));
}