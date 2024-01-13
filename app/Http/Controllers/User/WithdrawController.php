<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PayoutLimit;
use App\Models\PointBonusBalance;
use App\Models\TransactionIdLog;
use App\Models\TransactionPointWithdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function withdraw()
    {
        $payout_limit = PayoutLimit::where('role_id', Auth::user()->roles[0]->id)->first();

        $pending_withdraw_histories = TransactionPointWithdraw::where('user_id', Auth::user()->id)->where('status', 1)->orderBy('created_at', 'desc')->count();

        return view('user.withdraw', compact('payout_limit', 'pending_withdraw_histories'));
    }

    public function withdrawHistory()
    {

        $withdraw_history = TransactionPointWithdraw::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('user.withdraw-history', compact('withdraw_history'));
    }

    public function withdrawConfirmation(Request $request)
    {
        $user = Auth::user();
        $amount = $request->amount;
        $payout_limit = PayoutLimit::where('role_id', Auth::user()->roles[0]->id)->first();

        $pending_withdraw_histories = TransactionPointWithdraw::where('user_id', Auth::user()->id)->where('status', 1)->orderBy('created_at', 'desc')->count();

        if ($user->bank_name == NULL) {
            return redirect(route('user.withdraw'))->withErrors(['bank' => __('user-portal.please_provide_your_bank_info')]);
        } else if (getUserPointBonusBalance($user->id) < $amount) {
            return redirect(route('user.withdraw'))->withErrors(['balance' => __('user-portal.insufficient_bonus_balance')]);
        } else if($pending_withdraw_histories > 1){
            return redirect(route('user.withdraw'))->withErrors(['balance' => __('user-portal.please_wait_for_previous_request_to_complete_b4_making_another_withdraw')]);
        } else if($amount < $payout_limit->min_amount){
            return redirect(route('user.withdraw'))->withErrors(['balance' => __('user-portal.please_enter_a_valid_amount')]);
        }else if($amount > $payout_limit->max_amount){
            return redirect(route('user.withdraw'))->withErrors(['balance' => __('user-portal.please_enter_a_valid_amount')]);
        }

        return view('user.withdraw-confirmation', compact('amount'));
    }

    public function withdrawConfirm(Request $request)
    {
        $user = Auth::user();
        $amount = $request->amount;

        //check last submit date, 2 min per submit, prevent doulbe submit
        $last_withdraw_submit = TransactionPointWithdraw::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        if ($last_withdraw_submit) {
            $difference = Carbon::now()->diff($last_withdraw_submit->created_at);
            if ($difference->i < 2) {
                return redirect(route('user.withdraw'))->withErrors(['time' => __('user-portal.you_can_only_submit_another_withdrawal')]);
            }
        }

        $withdraw_data = TransactionPointWithdraw::create([
            'amount' => $amount,
            'bank_name' => $user->bank_name,
            'bank_account_name' => $user->bank_account_name,
            'bank_account_number' => $user->bank_account_number,
            'status' => 1,
            'remark' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => $user->id,
        ]);

        $transaction = TransactionIdLog::generateTransactionId('3', $user->id, $withdraw_data->id);
        TransactionPointWithdraw::where('id', $withdraw_data->id)->update([
            'transaction' => $transaction,
        ]);

        PointBonusBalance::create([
            'user_id' => $user->id,
            'amount' => -$request->amount,
            'status' => 1,
            'settlement' => 1,
            'remark' => 'Bonus Withdraw ' . $transaction,
        ]);

        $return_data = [
            'transaction_id' => $transaction,
            'date' => $withdraw_data->created_at,
            'balance_after' => getUserPointBalance($user->id),
        ];

        return view('user.withdraw-complete', compact('return_data'));
    }
}
