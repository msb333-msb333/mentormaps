Installation:
create a file called 'config.php' in the root directory and define the following variables in php:

1. mysqlip //mysql ip address ie localhost
2. dbuser //database username
3. dbpass //database password
4. dbname //database name
5. sendgrid_api_key //the api key for sendgrid

example config.php:
--
<?php
    $mysqlip = "localhost";
    $dbuser = "mentor_maps_db_user";
    $dbpass = "mentor_maps_db_pass";
    $dbname = "mentormaps_db";

    $sendgrid_api_key = "SG.xxxxxxxxxxxxxxxxxxxxxx.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
?>
--