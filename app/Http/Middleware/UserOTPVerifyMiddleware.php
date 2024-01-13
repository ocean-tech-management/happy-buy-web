<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserAgreement;
use App\Models\UserAgreementLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOTPVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->route()->uri;
        if (Auth::guard('user')->check()) {
            if(Auth::guard('user')->user()->user_type != 4) {
                if ($uri != 'user/register-otp' && $uri != 'user/verify-otp' && $uri != 'user/send-otp' && $uri != 'user/agreement' && $uri != 'logout') {
                    $user = User::findOrFail(Auth::guard('user')->user()->id);

                    //check if user sign the agreement according to his role
                    $userAgreement = UserAgreement::where('role_id', Auth::guard('user')->user()->roles[0]->id)->first();
                    $signed_agreement = UserAgreementLog::where('user_id', Auth::guard('user')->user()->id)->where('user_agreement_id', $userAgreement->id)->count();
                    if ($signed_agreement < 1) {
                        return redirect(route('user.register-agreement'))
                            ->with('message', __('user-portal.please_sign_agreement'));
                    } else if (!$user->hasOTPVerified()) {
                        return redirect(route('user.registerOTP'))
                            ->with('message', __('user-portal.please_verify_your_phone_number'));
                    }
                } else if ($uri == 'user/register-otp') {
                    $user = User::findOrFail(Auth::guard('user')->user()->id);
                    if ($user->hasOTPVerified()) {
                        return redirect(route('user.home'));
                    }
                } else if ($uri == 'user/agreement') {
                    $userAgreement = UserAgreement::where('role_id', Auth::guard('user')->user()->roles[0]->id)->first();
                    $signed_agreement = UserAgreementLog::where('user_id', Auth::guard('user')->user()->id)->where('user_agreement_id', $userAgreement->id)->count();
                    if ($signed_agreement >= 1) {
                        return redirect(route('user.home'));
                    }
                }
            }

            if ($uri == 'register' || $uri == 'login'){
                return redirect(route('user.home'));
            }
        }

        return $next($request);
    }
}
