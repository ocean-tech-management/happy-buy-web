<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PointBalance;
use App\Models\PointBonusBalance;
use App\Models\PointConvert;
use App\Models\PointExecutiveBalance;
use App\Models\PointManagerBalance;
use App\Models\PointPackage;
use App\Models\PointTransactionLog;
use App\Models\ProductVariant;
use App\Models\TransactionAgentTopUp;
use App\Models\TransactionIdLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function myPoint()
    {
        if (Auth::user()->roles[0]->id == 2) {
            $point_history = PointBalance::whereUserId(Auth::user()->id)->orderBy('created_at', 'desc')->take(5)->get();
        }elseif(Auth::user()->roles[0]->id == 4){
            $point_history = PointManagerBalance::whereUserId(Auth::user()->id)->orderBy('created_at', 'desc')->take(5)->get();
        }else{
            $point_history = PointExecutiveBalance::whereUserId(Auth::user()->id)->orderBy('created_at', 'desc')->take(5)->get();
        }
        $point_requests = [];
        if (Auth::user()->roles[0]->id == 2 || Auth::user()->roles[0]->id == 4) {
            $point_requests = TransactionAgentTopUp::where('merchant_id', Auth::user()->id)->where('type', 1)->orderBy('created_at', 'desc')->take(5)->get();
        }
        return view('user.my-point', compact('point_history', 'point_requests'));
    }

    public function pointHistory()
    {
        if (str_contains(url()->current(), 'point-history-manager')) {
            $point_history = PointManagerBalance::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        }else if (str_contains(url()->current(), 'point-history-executive')) {
            $point_history = PointExecutiveBalance::whereUserId(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $point_history = PointBalance::whereUserId(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('user.point-history', compact('point_history'));
    }

    public function pointRequests()
    {
        $point_requests = [];
        if (Auth::user()->roles[0]->id == 2 || Auth::user()->roles[0]->id == 4) {
            $point_requests = TransactionAgentTopUp::where('merchant_id', Auth::user()->id)->where('type', 1)->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('user.point-requests', compact('point_requests'));
    }

    public function proceedPointRequest($id)
    {
        $transactionAgentTopUp = TransactionAgentTopUp::find($id);
        return view('user.proceed-point-request', compact('transactionAgentTopUp'));
    }

    public function pointTransfer($id)
    {
        $transactionAgentTopUp = TransactionAgentTopUp::find($id);
        $requested_user = User::find($transactionAgentTopUp->user_id);
        $point_package = PointPackage::find($transactionAgentTopUp->point_package_id);

        //either is millionaire or manager
        $merchant = User::find($transactionAgentTopUp->merchant_id);

        if ($merchant->roles[0]->id == 2) { //millionaire to manager or executive

            $from_wallet = 3;
            if ($requested_user->roles[0]->id == 3) { // to executive
                $condition = 1;
                $addtodownline = $point_package->point;
                $deduct_point = $point_package->deduct_2_level_point;
                $user_balance = getUserExecutivePointBalance($transactionAgentTopUp->user_id);
                $merchant_balance = getUserPointBalance($transactionAgentTopUp->merchant_id);

            } else if ($requested_user->roles[0]->id == 4) { // to manager

                if($transactionAgentTopUp->to_wallet == 2){
                    $condition = 2;
                    $addtodownline = $point_package->point;
                    $deduct_point = $point_package->deduct_point;
                    $user_balance = getUserManagerPointBalance($transactionAgentTopUp->user_id);
                    $merchant_balance = getUserPointBalance($transactionAgentTopUp->merchant_id);
                }else{
                    $condition = 1;
                    $addtodownline = $point_package->point;
                    $deduct_point = $point_package->deduct_2_level_point;
                    $user_balance = getUserExecutivePointBalance($transactionAgentTopUp->user_id);
                    $merchant_balance = getUserPointBalance($transactionAgentTopUp->merchant_id);
                }
            } else if ($requested_user->roles[0]->id == 2){ // to millionaire , only clear 0 , so only wallet 1 and 2

                if($transactionAgentTopUp->to_wallet != 2){
                    $condition = 1;
                    $addtodownline = $point_package->point;
                    $deduct_point = $point_package->deduct_2_level_point;
                    $user_balance = getUserExecutivePointBalance($transactionAgentTopUp->user_id);
                    $merchant_balance = getUserPointBalance($transactionAgentTopUp->merchant_id);
                }else{
                    $condition = 2;
                    $addtodownline = $point_package->point;
                    $deduct_point = $point_package->deduct_point;
                    $user_balance = getUserManagerPointBalance($transactionAgentTopUp->user_id);
                    $merchant_balance = getUserPointBalance($transactionAgentTopUp->merchant_id);
                }
            }
            //check millionaire wallet 3
            if (getUserPointBalance($merchant->id) < $deduct_point) {
                return redirect(route('user.proceed-point-request', ['id' => $id]))->withErrors(__('user-portal.insufficient_point_balance'));
            }
        } else if ($merchant->roles[0]->id == 4) { //manager to executive

            $from_wallet = 2;
            $condition = 3;
            $addtodownline = $point_package->point;
            $deduct_point = $point_package->deduct_point;
            $user_balance = getUserExecutivePointBalance($transactionAgentTopUp->user_id);
            $merchant_balance = getUserManagerPointBalance($transactionAgentTopUp->merchant_id);

            //check manager wallet 2
            if (getUserManagerPointBalance($merchant->id) < $deduct_point) {
                return redirect(route('user.proceed-point-request', ['id' => $id]))->withErrors(__('user-portal.insufficient_point_balance'));
            }
        }


        DB::beginTransaction();
        try {
            TransactionAgentTopUp::find($id)->update([
                'user_pre_balance' => $user_balance,
                'user_post_balance' => $user_balance + $addtodownline,
                'merchant_pre_balance' => $merchant_balance,
                'merchant_post_balance' => $merchant_balance - $deduct_point,
                'status' => 2,
                'from_wallet' => $from_wallet,
                'approved_at' => Carbon::now(),
            ]);

//            PointTransactionLog::create([
//                'date' => Carbon::now()->format('Y-m-d'),
//                'top_up' => $addtodownline,
//                'redemption' => 0,
//                'shipping' => 0,
//                'user_id' => $requested_user->id,
//            ]);
//
//            PointTransactionLog::create([
//                'date' => Carbon::now()->format('Y-m-d'),
//                'top_up' => -$deduct_point,
//                'redemption' => 0,
//                'shipping' => 0,
//                'user_id' => $merchant->id,
//            ]);
            $startDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s','2021-10-10 00:00:00');
            $endDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s','2021-10-12 23:59:59');
            $check_between_dates =  \Carbon\Carbon::parse($transactionAgentTopUp->created_at)->between($startDate,$endDate);

            if ($condition == 1) {
                PointExecutiveBalance::create([
                    'user_id' => $requested_user->id,
                    'amount' => $addtodownline,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => 'Point Transfer from upline ' . $transactionAgentTopUp->transaction,
                ]);

                PointBalance::create([
                    'user_id' => $merchant->id,
                    'amount' => -$deduct_point,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => 'Point Transfer to donwline' . $transactionAgentTopUp->transaction,
                ]);
                if($check_between_dates){
                    addToCart($requested_user->id, 39, 1);
                }
            } else if ($condition == 2) {
                PointManagerBalance::create([
                    'user_id' => $requested_user->id,
                    'amount' => $addtodownline,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => 'Point Transfer from upline ' . $transactionAgentTopUp->transaction,
                ]);

                PointBalance::create([
                    'user_id' => $merchant->id,
                    'amount' => -$deduct_point,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => 'Point Transfer to donwline' . $transactionAgentTopUp->transaction,
                ]);
                if($check_between_dates){
                    addToCart($requested_user->id, 40, 1);
                }
            } else if ($condition == 3) {
                PointExecutiveBalance::create([
                    'user_id' => $requested_user->id,
                    'amount' => $addtodownline,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => 'Point Transfer from upline ' . $transactionAgentTopUp->transaction,
                ]);

                PointManagerBalance::create([
                    'user_id' => $merchant->id,
                    'amount' => -$deduct_point,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => 'Point Transfer to donwline' . $transactionAgentTopUp->transaction,
                ]);
                if($check_between_dates){
                    addToCart($requested_user->id, 39, 1);
                }
            }


            DB::commit();
            return redirect(route('user.my-point'))->with('message', __('user-portal.point_transfer_success'));

        } catch (\Exception $e) {
            \Log::info($e);
            DB::rollBack();
            return redirect(route('user.proceed-point-request', ['id' => $id]))->withErrors(['message' => 'Some error occur. Please contact admin.']);
        }

    }

    public function pointTransferReject($id){
        TransactionAgentTopUp::find($id)->update([
            'status' => 3,
        ]);

       return  redirect(route('user.my-point'))->with('message', __('user-portal.point_transfer_rejected'));
    }

    public function showPointConvert()
    {
        return view('user.point-convert');
    }

    public function pointConvert(Request $request)
    {

        $user = Auth::user();
        if($request->amount != "13500"){
            return redirect()->back()->withErrors(['balance' => __('user-portal.only_accept_13500')]);
        }
        if (getUserPointBonusBalance($user->id) < $request->amount) {
            return redirect()->back()->withErrors(['balance' => __('user-portal.insufficient_bonus_balance')]);
        }


        DB::beginTransaction();
        try {

            $point_convert = PointConvert::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'pre_cp_bonus_balance' => getUserPointBonusBalance($user->id),
                'post_cp_bonus_balance' => getUserPointBonusBalance($user->id) - $request->amount,
                'pre_cp_balance' => getUserPointBalance($user->id),
                'post_cp_balance' => getUserPointBalance($user->id) + $request->amount,
            ]);

            $transaction = TransactionIdLog::generateTransactionId('5', $user->id, $point_convert->id);
            PointConvert::find($point_convert->id)->update([
                'transaction' => $transaction
            ]);

            PointBonusBalance::create([
                'user_id' => $user->id,
                'amount' => -$request->amount,
                'status' => 1,
                'settlement' => 1,
                'remark' => 'Point convert ' . $transaction,
            ]);

            PointBalance::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'status' => 1,
                'settlement' => 1,
                'remark' => 'Point convert ' . $transaction,
            ]);

            addUserVoucherBalance(Auth::user()->id, $request->amount, 'convert reward: '.$transaction);
            addUserVoucherLog(Auth::user()->id, $request->amount, 'convert reward: '.$transaction);

            DB::commit();
            $return_data = [
                'transaction_id' => $transaction,
                'date' => $point_convert->created_at,
                'balance_bonus_after' => getUserPointBonusBalance($user->id),
                'balance_point_after' => getUserPointBalance($user->id),
            ];
            return view('user.point-convert-complete', compact('return_data'));
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Some error occur. Please contact admin.']);
        }


    }

    public function pointConvertHistory(){
        $convert_history = PointConvert::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('user.convert-point-history', compact('convert_history'));
    }

}
