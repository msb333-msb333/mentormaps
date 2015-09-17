<?php
require "./config.php";
require "copy.php";

$db = new mysqli($mysqlip, $dbuser, $dbpass, $dbname);

//function to escape mysql characters that doesn't require a mysqli instance
function mysql_escape_mimic($inp)
{
    if (is_array($inp))
        return array_map(__METHOD__, $inp);
    if (!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
    }
    return $inp;
}

function sanitize($input)
{
    return htmlspecialchars(mysql_escape_mimic($input), ENT_QUOTES, "UTF-8");
}