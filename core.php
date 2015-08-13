<?php
function echoHeader(){
    include "./pages/header.php";
}

function echoProfileLink(){
    require "./sessioncheck.php";
    if($_SESSION['auth']==false || !isset($_SESSION['auth']) || !isset($_SESSION['email'])){
        echo './login.php';
    }else{
        echo './profile.php?p=' . $_SESSION['email'];
    }
}

function echoEditLink(){
    require "./sessioncheck.php";
    if($_SESSION['auth']==false || !isset($_SESSION['auth']) || !isset($_SESSION['email'])){
        echo './login.php';
    }else{
        echo './edit.php?p=' . $_SESSION['email'];
    }
}
?>