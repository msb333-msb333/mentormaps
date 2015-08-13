<?php
function echoHeader(){
    include "./pages/header.html";
}

function echoProfileLink(){
    require "./sessioncheck.php";
    if($_SESSION['auth']==false || !isset($_SESSION['auth']) || !isset($_SESSION['email'])){
        echo './login.php';
    }else{
        echo './profile.php?p=' . $_SESSION['email'];
    }
}
?>