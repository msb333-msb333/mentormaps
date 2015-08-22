<?php
    require "./config.php";
    require("./vendor/autoload.php");

    function sendEmail($to, $subject, $html){
        $sendgrid = new SendGrid($sendgrid_api_key);
        $email    = new SendGrid\Email();
        $email->addTo($to)
            ->setFrom("donotreply@mentormaps.net")
            ->setSubject($subject)
            ->setHtml($html);
        $sendgrid->send($email);
    }
?>