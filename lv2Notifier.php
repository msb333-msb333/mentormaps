<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    require "./mailsender.php";
    $to = $_POST['theirEmail'];
    $from = $_POST['myEmail'];
    //TODO
    //sendEmail(...);
    die(json_encode(array('status' => 'sent email successfully')));
}else{
    die(json_encode(array('status' => 'not post')));
}