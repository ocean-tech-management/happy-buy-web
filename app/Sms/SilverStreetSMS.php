<?php

namespace App\Sms;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use App\Models\OtpLog;

class SilverStreetSMS
{
    public static function sendSMS($number, $content)
    {
        $id = date('YmdHis').rand(1000,9999);
        $response = Http::get('https://api.silverstreet.com/send.php?username=eCari&password=RGvAZmsn&reference='.$id.'&destination='.$number.'&sender=Carinow&body='.$content.'&concat=1');

    }
}
