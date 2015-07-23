<?php
require "./logincheck.php";

$_SESSION['auth'] = false;

echo '<meta http-equiv="refresh" content="0;URL=./index.html">';
?>