<?php
require "./sessioncheck.php";

if(!isset($_SESSION['auth'])){
    echo '<meta http-equiv="refresh" content="0;URL=./login.php">';
}else if($_SESSION['auth'] === false){
    echo '<meta http-equiv="refresh" content="0;URL=./login.php">';
}else if($_SESSION['auth'] === true){
    //do nothing
}
?>