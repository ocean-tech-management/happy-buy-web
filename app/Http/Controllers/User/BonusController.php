<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BonusGroup;
use App\Models\BonusPersonal;
use App\Models\PointBonusBalance;
use App\Models\User;
use App\Models\UserAgreementLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    public function myBonus(Request $request)
    {
        $purchase_bonus = 0;
        $personal_annual_bonus = 0;
        $team_annual_bonus = 0;

        $start_date = Carbon::now()->startOfMonth();
        $end_date = Carbon::now();

        if( $request->start_date ){$start_date = $request->start_date;}
        if( $request->end_date){$end_date = $request->end_date;}

        $point_history = PointBonusBalance::whereUserId(Auth::user()->id)->orderBy('created_at', 'desc')->take(5)->get();
        $bonus_group = BonusGroup::find(1);
        $bonus_personal = BonusPersonal::find(1);

        $agreement = UserAgreementLog::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();

        return view('user.my-bonus', compact(  'point_history', 'bonus_personal' ,'bonus_group', 'agreement'));
    }

    public function bonusMemberList($level){
        //check if this user under this user 3 line
//        $this_dl = User::find(Auth::user()->id);
//        $first_layer_dl = User::where('direct_upline_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->whereHas(
//            'roles', function($q){
//            $q->where('name','like', '%Merchant%');
//        })->get();
//        $first_layer_dl_ids = User::where('direct_upline_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->whereHas(
//            'roles', function($q){
//            $q->where('name','like', '%Merchant%');
//        })->pluck('id', 'name');
//
//        $second_layer_dl = User::whereIn('direct_upline_id', $first_layer_dl_ids)->whereHas(
//            'roles', function($q){
//            $q->where('name','like', '%Merchant%');
//        })->get();
//
//        $second_layer_dl_ids = User::whereIn('direct_upline_id', $first_layer_dl_ids)->whereHas(
//            'roles', function($q){
//            $q->where('name','like', '%Merchant%');
//        })->pluck('id', 'name');
//
//        $third_layer_dl = User::whereIn('direct_upline_id', $second_layer_dl_ids)->whereHas(
//            'roles', function($q){
//            $q->where('name','like', '%Merchant%');
//        })->get();
//
//        $third_layer_dl_ids = User::whereIn('direct_upline_id', $second_layer_dl_ids)->whereHas(
//            'roles', function($q){
//            $q->where('name','like', '%Merchant%');
//        })->pluck('id', 'name');

       if ($level == 1){
           $first_layer_dl = User::where('upline_user_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->whereHas(
               'roles', function($q){
               $q->where('name','like', '%Merchant%');
           })->get();
           $millionaires = $first_layer_dl;
       }else if ($level == 2){
           $second_layer_dl = User::where('upline_user_1_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->whereHas(
               'roles', function($q){
               $q->where('name','like', '%Merchant%');
           })->get();
           $millionaires = $second_layer_dl;
       }else if ($level == 3){
           $third_layer_dl = User::where('upline_user_2_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->whereHas(
               'roles', function($q){
               $q->where('name','like', '%Merchant%');
           })->get();
           $millionaires = $third_layer_dl;
       }

        foreach ($millionaires as $millionaire){
            $millionaire->latest_agreement = UserAgreementLog::where('user_id', $millionaire->id)->orderBy('created_at', 'desc')->first();
        }

       return view('user.components.bonus-users', compact('millionaires'));
    }

    public function pointBonusHistory(){

        $point_history = PointBonusBalance::whereUserId(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);;

        return view('user.point-bonus-history', compact('point_history'));
    }
}
