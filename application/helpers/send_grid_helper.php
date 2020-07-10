<?php

function sendemail($f,$s,$t,$m)

{

   /* if(is_array($t)){

    }else{
        $ci=& get_instance();
        $ci->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.jetstreamteam.com';
        $config['smtp_user'] = 'sys@jetstreamteam.com';
        $config['smtp_pass'] = 'pW$Ut%wMh-TS';
        $config['smtp_port'] = '465';
        $ci->email->initialize($config);

        $ci->email->from($f);
        $ci->email->to($t);
        $ci->email->subject($s);
        $ci->email->message($m);

        if($ci->email->send()) {
            return 'Sent';
        } else {
            return $ci->email->print_debugger();
        }
    }*/

    // include_once str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']) . 'application/libraries/sendgrid/SendGrid.php';

    // require 'vendor/autoload.php';



    if(is_array($t)){

        foreach ($t as $key => $value) {
            $from = new SendGrid\Email(getconfigMeta('comanyname'), $f);
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
        $from = new SendGrid\Email(getconfigMeta('comanyname'), $f);
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

