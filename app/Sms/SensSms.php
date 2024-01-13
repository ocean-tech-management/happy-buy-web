<?php

namespace App\Sms;

class SensSms{

    public static function sendSms($number, $content){

        $username = "ss5634";
        $secret_key = "bgfm6jfkb";

        $url =  "https://sendsms.asia/api/v1/send/sms?username=".$username."&secret_key=".$secret_key."&phone=".$number."&content=".urlencode($content);

        $response = file_get_contents($url);

        return $response;

    }
}
