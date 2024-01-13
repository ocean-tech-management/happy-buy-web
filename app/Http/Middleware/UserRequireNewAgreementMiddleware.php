<?php

namespace App\Http\Middleware;

use App\Models\UserAgreementLog;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequireNewAgreementMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->route()->uri;
        if(!$request->is('admin/*')) {
            if (Auth::guard('user')->check()) {
                // NO VIP And Millionaire
                if(Auth::guard('user')->user()->user_type != 4 && Auth::guard('user')->user()->user_type != 3) {

                    // User - Manager and Executive who required to sign the new agreement form.
//                    if(Auth::guard('user')->user()->new_sign_required == 2) {
//                        if($uri != 'logout' && $uri != 'user/sign-new-agreement') {
//                            if($uri != 'user/new-agreement-form') {
//                                return redirect(route('user.new-agreement-form'));
//                            }
//                        }
//                    }
                }else{
                    if(Auth::guard('user')->user()->user_type == 3) {

                        $userAgreementLog = UserAgreementLog::whereUserId(Auth::guard('user')->user()->id)->orderBy('id', 'desc')->first();

                        if($userAgreementLog){
                            $signatureAt = $userAgreementLog->signature_at;
                            $expiredAt = Carbon::parse($signatureAt)->addYears(1)->toDateTimeString();

                            if(Carbon::now() > $expiredAt){

                                if($uri != 'logout' && $uri != 'user/renew-agreement-form' && $uri != 'user/sign-renew-agreement' ) {
                                    if ($uri != 'user/renew-agreement-form') {
//                                        return redirect(route('user.renew-agreement-form'));
                                    }
                                }
                            }
                        }

                    }
                }
            }
        }

        return $next($request);
    }
}
