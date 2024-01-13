<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtpSms;
use App\Models\OtpLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VerifyOTPController extends Controller
{
    use VerifiesEmails;

    public $redirectTo = "/user/home";

    public function showRegistrationOTPForm(Request $request)
    {
        return view('user.auth.register-otp');
    }


    function sendOTP(Request $request)
    {
        //make random opt code
        $otp = rand(100000, 999999);
        $content = "";

        //$request->type.

        $content = "Erya Phoenix: Your OTP code is ". $otp;

        User::where('id', Auth::user()->id)->update(['otp_code' => $otp]);

        SendOtpSms::dispatch(Auth::user()->phone,$content,$otp, Auth::user()->id)->onQueue('sms-otp');

        return json_encode(['success' => true]);
    }

    function verifyOTP(Request $request)
    {
        //if code opt code is valid
        if (OtpLog::where('user_id', Auth::user()->id)->where('used_at', NULL)->where('code', $request->otp_code)->count() >= 1) {
            if ($request->type == 'register') {
                User::where('id', Auth::user()->id)->update(['register_verify_at' => Carbon::now()]);
            }
            OtpLog::where('user_id', Auth::user()->id)->where('used_at', NULL)->update([
                'updated_at' => Carbon::now(),
                'used_at' => Carbon::now(),
            ]);
            return json_encode(['success' => true]);
        } else {

            return json_encode(['success' => false, 'count' => OtpLog::where('user_id', Auth::user()->id)->where('used_at', NULL)->where('code', $request->otp_code)->count()]);
        }
    }
}
