<?php

namespace App\Http\Controllers\User;

use App\CustomClass\SenangPay;
use App\Http\Controllers\Controller;
use App\Models\DepositBank;
use App\Models\PaymentMethod;
use App\Models\PointPackage;
use App\Models\TransactionAgentTopUp;
use App\Models\TransactionIdLog;
use App\Models\User;
use App\Models\UserAgreementLog;
use App\Models\UserUpgrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

//        $c_phone = str_replace("-", "", $request->phone);
//        $c_phone = str_replace(" ", "", $c_phone);
//        $c_phone = str_replace("+", "", $c_phone);
//        if ($c_phone[0] == '0') {
//            $c_phone = '6' . $c_phone;
//        }

//        $user->update([
//            'name'            => $request->name,
//            'phone'           => $c_phone,
//            'email'           => $request->email,
//            'date_of_birth'   => $request->birthday,
//            'gender'          => $request->gender,
//        ]);

        if ($request->input('profile_photo', false)) {
            if (!$user->profile_photo || $request->input('profile_photo') !== $user->profile_photo->file_name) {
                if ($user->profile_photo) {
                    $user->profile_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_photo'))))->toMediaCollection('profile_photo');
            }
        } elseif ($user->profile_photo) {
            $user->profile_photo->delete();
        }

        if ($request->input('ssm_photo', false)) {
            if (!$user->ssm_photo || $request->input('ssm_photo') !== $user->ssm_photo->file_name) {
                if ($user->ssm_photo) {
                    $user->ssm_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ssm_photo'))))->toMediaCollection('ssm_photo');
            }
        } elseif ($user->ssm_photo) {
            $user->ssm_photo->delete();
        }

        if ($request->input('ic_photo', false)) {
            if (!$user->ic_photo || $request->input('ic_photo') !== $user->ic_photo->file_name) {
                if ($user->ic_photo) {
                    $user->ic_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ic_photo'))))->toMediaCollection('ic_photo');
            }
        } elseif ($user->ic_photo) {
            $user->ic_photo->delete();
        }

        if ($request->input('shop_photo', false)) {
            if (!$user->shop_photo || $request->input('shop_photo') !== $user->shop_photo->file_name) {
                if ($user->shop_photo) {
                    $user->shop_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('shop_photo'))))->toMediaCollection('shop_photo');
            }
        } elseif ($user->shop_photo) {
            $user->shop_photo->delete();
        }


        return redirect(route('user.home'))->with('message', __('global.update_profile_success'));
    }

    public function viewAgreement()
    {
        $user = Auth::user();

        $user_agreement_log =  UserAgreementLog::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->first();

        return view('user.signed-agreement', compact('user_agreement_log'));
    }

    public function addressBook()
    {
        return view('user.my-address-book');
    }

    public function shop()
    {
        return view('user.shop');
    }

    public function downline()
    {
        return view('user.downline');
    }

    public function memberTree()
    {
        return view('user.member-tree');
    }

}
