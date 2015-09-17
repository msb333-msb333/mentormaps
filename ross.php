<?php
    require "./db.php";
    $db->query("TRUNCATE `logins`;");
    $db->query("TRUNCATE `data`;");
    $db->query("TRUNCATE `survey_results`;");
    $db->query("TRUNCATE `assoc`;");
?>