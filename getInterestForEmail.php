<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    require "./db.php";
    $email = sanitize($_POST['email']);
    $result = $db->query("SELECT `interested-in-me` FROM `assoc` WHERE email = '".$email."';");
    while($r=mysqli_fetch_assoc($result)){
        die(json_encode(array('response' => $r['interested-in-me'])));
    }
}else{
    die(json_encode(array('status' => 'reqest was not post')));
}