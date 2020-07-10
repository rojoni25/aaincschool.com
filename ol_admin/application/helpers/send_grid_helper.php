<?php

function sendemail($f,$s,$t,$m)

{



    // include_once str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']) . 'application/libraries/sendgrid/SendGrid.php';

    // require 'vendor/autoload.php';



    if(is_array($t)){

        foreach ($t as $key => $value) {

            $from = new SendGrid\Email(getconfigMeta("comanyname"), $f);

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

        $from = new SendGrid\Email(getconfigMeta("comanyname"), $f);

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

