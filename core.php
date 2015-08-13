<?php
require "./sessioncheck.php";

function echoHeader(){
    include "./pages/header.php";
}

function echoProfileLink(){
    if(!isset($_SESSION['auth']) || !isset($_SESSION['email'])){
        echo './login.php';
    }else{
        echo './profile.php?p=' . $_SESSION['email'];
    }
}

function echoEditLink(){
    if($_SESSION['auth']==false || !isset($_SESSION['auth']) || !isset($_SESSION['email'])){
        echo './login.php';
    }else{
        echo './edit.php?p=' . $_SESSION['email'];
    }
}
?>