<?php

function sendemail($f,$s,$t,$m)

{



    // include_once str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']) . 'application/libraries/sendgrid/SendGrid.php';

    // require 'vendor/autoload.php';



    if(is_array($t)){

        foreach ($t as $key => $value) {

            $from = new SendGrid\Email(null, $f);

            $subject = $s;

            $to = new SendGrid\Email(null, $value);

            $content = new SendGrid\Content("text/html", $m);

            $mail = new SendGrid\Mail($from, $subject, $to, $content);



            $apiKey = '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';

            $sg = new \SendGrid($apiKey);



            $response = $sg->client->mail()->send()->post($mail);

        }

        return $response->statusCode();

    } else{

        $from = new SendGrid\Email(null, $f);

        $subject = $s;

        $to = new SendGrid\Email(null, $t);

        $content = new SendGrid\Content("text/html", $m);

        $mail = new SendGrid\Mail($from, $subject, $to, $content);



        $apiKey = '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';

        $sg = new \SendGrid($apiKey);



        $response = $sg->client->mail()->send()->post($mail);

        return $response->statusCode();

    }



    // echo $response->headers();

    // echo $response->body();

}

