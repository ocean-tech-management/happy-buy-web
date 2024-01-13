<?php

namespace App\Http\Middleware;

use App\Models\TransactionAgentTopUp;
use App\Models\UserAgreement;
use App\Models\UserAgreementLog;
use App\Models\UserEntry;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MillionaireJoiningFeeMiddleware
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
//        dd($uri);
        if(!$request->is('admin/*')) {
            if (Auth::guard('user')->check()) {
                // Only Millionaire
                Log::info(Auth::guard('user')->user()->user_type);
                if(Auth::guard('user')->user()->user_type == 3) {

                    // User - Millionaire who required to pay deposit and joining fee.
                    $userEntry = UserEntry::whereUserId(Auth::guard('user')->user()->id)->whereUserType(3)->where(function ($query) {
                        $query->where('status', 2)
                        ->orWhere('status',3);
                    })->first();

                    if(!$userEntry) {
                        if($uri != 'logout' && $uri != 'user/upgrade-account/{type}' && $uri != 'user/upgrade-account-millionaire') {
                            if($uri != 'user/upgrade-account/{type}') {
                                return redirect(route('user.upgrade-account', ['type' => 'million']));
                            }
                        }
                    }
                }else if(Auth::guard('user')->user()->user_type == 1 || Auth::guard('user')->user()->user_type == 2) {

                    if(Auth::guard('user')->user()->created_at >= '2022-11-12 00:00:00' || Auth::guard('user')->user()->upgraded_at >= '2022-11-12 00:00:00'){

                        $userAgreement = UserAgreement::where('role_id', Auth::guard('user')->user()->roles[0]->id)->first();
                        $signed_agreement = UserAgreementLog::where('user_id', Auth::guard('user')->user()->id)->where('user_agreement_id', $userAgreement->id)->count();
                        if ($signed_agreement > 0) {
                            if(Auth::guard('user')->user()->hasOTPVerified()){


                                $transactionAgentTopUpApproved = TransactionAgentTopUp::whereType(2)->whereUserId(Auth::guard('user')->user()->id)->where(function ($query) {
                                    $query->where('status',2);
                                })->first();

                                if($transactionAgentTopUpApproved){

                                }else{
                                    $transactionAgentTopUp = TransactionAgentTopUp::whereType(2)->whereUserId(Auth::guard('user')->user()->id)->where(function ($query) {
                                        $query->where('status', 1)
                                            ->orWhere('status',3);
                                    })->count();

                                    if($transactionAgentTopUp < 1) {
                                        if($uri != 'logout' && $uri != 'user/upgrade-account/{type}' && $uri != 'user/upgrade-account-executive' && $uri != 'user/upgrade-account-manager' && $uri != 'user/media') {
                                            if($uri != 'user/upgrade-account/{type}') {
                                                if(Auth::guard('user')->user()->user_type == 1) {
                                                    return redirect(route('user.upgrade-account', ['type' => 'executive']));
                                                }else{
                                                    return redirect(route('user.upgrade-account', ['type' => 'manager']));
                                                }

                                            }
                                        }
                                    }else{
                                        if($uri != 'logout' && $uri != 'user/upgrade-account-select') {
                                            return redirect(route('user.upgrade-account-select'));
                                        }
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
