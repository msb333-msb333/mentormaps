<?php /** checks the user's session cookies to verify that they are logged in **/

//start the php session
require "./sessioncheck.php";
if(!isset($_SESSION['auth'])){//if they aren't logged in, redirect them to the login page
    echo '<meta http-equiv="refresh" content="0;URL=./login.php">';
}else if($_SESSION['auth'] === false){//if they logged out previously and never logged in, redirect them to the login page
    echo '<meta http-equiv="refresh" content="0;URL=./login.php">';
}else if($_SESSION['auth'] === true){//if the user is logged in
    //do nothing
}
?>