<?php

namespace App\Jobs;

use App\Models\OtpLog;
use App\Sms\SensSms;
use App\Sms\SilverStreetSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOtpSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $number;
    protected $content;
    protected $otp_code;
    protected $user_id;

    public function __construct($number, $content, $otp_code, $user_id)
    {
        //
        $this->number = $number;
        $this->content = $content;
        $this->otp_code = $otp_code;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $number = $this->number;
        $content = $this->content;
        $otp_code = $this->otp_code;
        $user_id = $this->user_id;

//        $sens_sms = SilverStreetSMS::sendSms($number, $content);
        $sens_sms = SensSms::sendSms($number, $content);

        $sms_response = json_decode($sens_sms, true);

        $sens_status = 2;
        if ($sms_response['status'] == 0){
            $sens_status = 1;
        }else{
            $sens_status = 2;
        }

        //do the request
        $otpRequest = new OtpLog();
        $otpRequest->user_id = $user_id;
        $otpRequest->phone = $number;
        $otpRequest->code = $otp_code;
        $otpRequest->content = $content;
        $otpRequest->status = $sens_status;
        $otpRequest->api_response = $sens_sms;
        $otpRequest->save();
    }
}
