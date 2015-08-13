<?php /** checks the user's session cookies to verify that they are logged in **/

//start the php session
require "./sessioncheck.php";
if(!isset($_SESSION['auth'])){//if they aren't logged in, redirect them to the login page
    die('<meta http-equiv="refresh" content="0;URL=./login.php">');
}else if($_SESSION['auth'] === false){//if they logged out previously and never logged in, redirect them to the login page
    die('<meta http-equiv="refresh" content="0;URL=./login.php">');
}else if($_SESSION['auth'] === true){//if the user is logged in
    if(isset($_GET['p'])){
        if($_SESSION['email'] == $_GET['p']){
            //do nothing, passed both checks
        }else{
            die("wrong user");
        }
    }
}
?>