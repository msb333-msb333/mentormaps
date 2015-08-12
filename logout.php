<?php
//check that the user is actually logged in
require "./logincheck.php";

//set the correct session variable
$_SESSION['auth'] = false;

//redirect the user to the index page
echo '<meta http-equiv="refresh" content="0;URL=./index.php">';
?>