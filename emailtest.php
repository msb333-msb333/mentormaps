<?php
require "./config.php";
require "./mailsender.php";

$part1 = file_get_contents('./pages/reset_pass_header.html');
$part2 = file_get_contents('./pages/reset_pass_footer.html');
$var = "<a href='http://mrflark.org/mmdev/mentormaps/index.php'>test</a>";

sendEmail($sendgrid_api_key, 'jonathan.logrippo@servitehs.org', 'SUBJECT', $part1 . $var . $part2);
?>