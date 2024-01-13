<?php

namespace App\CustomClass;


use Illuminate\Support\Facades\Log;

class SenangPay
{

    public $merchantId;
    public $secretKey;
    public $url;

    public $detail;
    public $amount;
    public $orderId;
    public $name;
    public $email;
    public $phone;

    public function __construct($name, $email, $phone, $detail, $orderId, $amount)
    {
        $this->merchantId = config('senangpay.merchant_id');
        $this->secretKey = config('senangpay.secret_key');
        $this->detail = $detail; //usually order number
        $this->amount = $amount;
        $this->orderId = $orderId;

        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->url = 'https://sandbox.senangpay.my/payment/' . $this->merchantId;
        if (config('app.env') == 'production') {
            $this->url = 'https://app.senangpay.my/payment/' . $this->merchantId;
        }
    }

    public function generateHttpQuery()
    {
        $httpQuery = http_build_query([
            'detail' => $this->detail,
            'amount' => $this->amount,
            'order_id' => $this->orderId,
            'hash' => $this->generateHash(),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        return $httpQuery;
    }

    public function paymentProcess()
    {
        return $this->url . '?' . $this->generateHttpQuery();
    }

    public function generateHash()
    {
//        return md5($this->secretKey . $this->detail . $this->amount . $this->orderId); //md5
        return hash_hmac("SHA256", $this->secretKey . $this->detail . $this->amount . $this->orderId, $this->secretKey);
    }

    public static function generateReturnHash($request)
    {
//        return md5($this->secretKey . $request->status_id . $request->order_id . $request->transaction_id . $request->msg);  //md5
        return hash_hmac("SHA256", $request->secretKey . $request->status_id . $request->order_id . $request->transaction_id . $request->msg, $request->secretKey);
    }

    public function checkReturnHash($request)
    {

        return $request->return_hash == $this->generateReturnHash($request);
    }

}
