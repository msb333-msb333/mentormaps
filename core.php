<?php
require "./sessioncheck.php";

function echoHeader(){
    include "./pages/header.php";
}

function echoHeaderPro(){
	include "./pages/headerprofile.php"
}

function echoHeaderDash(){
	include "./pages/headerdash.php"
}

function echoHeaderSurvey(){
	include "./pages/headersurvey.php"
}

function echoHeaderEdit(){
	include "./pages/headeredit.php"
}

function echoHeaderLogin(){
	include "./pages/headerlogin.php"
}

function echoHeaderReg(){
	include "./pages/headerregister.php"
}
?>