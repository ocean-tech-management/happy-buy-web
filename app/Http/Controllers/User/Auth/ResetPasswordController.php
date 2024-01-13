<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtpSms;
use App\Models\OtpLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function sendOTPFromEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please enter a valid email']);
        }

        //send otp
        //make random opt code save to db
//        $otp = Str::random(6);
        $otp = rand(100000, 999999);
        $content = "";

        $content = "Erya Phoenix: Your OTP code is " . $otp ;
        User::where('email', $request->email)->update(['otp_code' => $otp]);
        $user = User::where('email', $request->email)->first();
        SendOtpSms::dispatch($user->phone,$content,$otp, $user->id)->onQueue('sms-otp');
//        OtpLog::create([
//            'phone' => $user->phone,
//            'code' => $otp,
//            'content' => $content,
//            'status' => 0,
//            'api_responose' => '',
//            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now(),
//            'user_id' => $user->id,
//        ]);
        $email = $user->email;

        return view('user.auth.password-verify-otp', compact('email'), ['message' => 'A OTP code has sent to your phone number']);
    }

    public function verifyOTP(Request $request)
    {
        //if code opt code is valid
        $user = User::where('email', $request->email)->first();
        if (OtpLog::where('user_id', $user->id)->where('used_at', NULL)->where('code', $request->otp_code)->count() >= 1) {
            if ($request->type == 'register') {
                User::where('id', $user->id)->update(['register_verify_at' => Carbon::now()]);
            }
            OtpLog::where('user_id', $user->id)->where('used_at', NULL)->update([
                'updated_at' => Carbon::now(),
                'used_at' => Carbon::now(),
            ]);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]);
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->first();

            return json_encode(['success' => true, 'token' => $tokenData->token, 'email' => $request->email]);
        } else {
            return json_encode(['success' => false, 'count' => OtpLog::where('user_id', $user->id)->where('used_at', NULL)->where('code', $request->otp_code)->count()]);
        }
    }

    public function showResetForm(Request $request)
    {
        $email = $request->email;

        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        if (!$tokenData) return redirect( route('password.request'))->withErrors(['error' => __('user-portal.invalid_token_please_try_again')]);

        $token = $tokenData->token;

        return view('user.auth.reset-password', compact('email', 'token'));
    }

    public function reset(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
            'token' => 'required' ]);

        //check if payload is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $password = $request->password;// Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();// Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

        $user = User::where('email', $tokenData->email)->first();

        // Redirect the user back if the email is invalid
        $user->password = \Hash::make($password);
        $user->update(); //or $user->save();

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        return redirect(route('login'))->with('message',__('user-portal.your_password_is_reset'));

    }


}
