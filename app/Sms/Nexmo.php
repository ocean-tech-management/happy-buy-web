<?php

namespace App\Sms;

class Nexmo {
    public static function numberInsight($phone)
    {

        $fields = array('api_key' => "fe6661bf", 'api_secret' => "r7Cm9GcfiTkjuZdO", 'number'=> $phone);
        $postvars = '';
        foreach($fields as $key=>$value) {
            $postvars .= $key . "=" . $value . "&";
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.nexmo.com/ni/basic/json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $postvars
        ));

        $responsex = curl_exec($curl);

        return json_decode($responsex, true);

        // return $responsex;

        // { "status": 0, "status_message": "Success", "request_id": "bbf8c328-fc2c-4f65-b00c-b359becaf194", "international_format_number": "6281293877777", "national_format_number": "0812-9387-7777", "country_code": "ID", "country_code_iso3": "IDN", "country_name": "Indonesia", "country_prefix": "62" }
    }
}
