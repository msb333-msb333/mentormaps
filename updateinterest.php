<?php
require "./db.php";

//sanitize inputs
$theirEmail = sanitize($_POST['theirEmail']);
$myEmail = sanitize($_POST['myEmail']);
$theirIntJSON = mysql_escape_mimic($_POST['theirIntJSON']);
$myIntJSON = mysql_escape_mimic($_POST['myIntJSON']);

$db->query("UPDATE `assoc` SET `interested-in-me` = '$theirIntJSON' WHERE EMAIL = '$theirEmail';");
$db->query("UPDATE `assoc` SET `interested-in` = '$myIntJSON' WHERE EMAIL = '$myEmail';");