<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TransactionBonusGiven;
use App\Models\PointBonusBalance;
use App\Models\TransactionIdLog;
use App\Models\BonusFirstUplineLog;
use App\Models\UplinePreserveLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class OneTimeUsageController extends Controller
{
    public function index(Request $request) {

        if(Auth::guard('admin')->check()) {
            if(Auth::guard('admin')->user()->id != 1) {
                die("STOP");
            }
        } else {
            die("STOP");
        }

        return view('admin.oneTimeUse.index');
    }

    public function updateSignRequired(Request $request) {
        die("STOP");
        $users = User::all();

        foreach($users as $key => $item) {
            $user_type = $item->user_type;

            switch($user_type) {
                case "1":
                case "2":
                    DB::table('users')->where('id', $item->id)->update([
                        'new_sign_required' => 2, // Need Sign (Yes)
                    ]);
                    break;
                case "3":
                case "4":
                    DB::table('users')->where('id', $item->id)->update([
                        'new_sign_required' => 1, // No Need Sign (No)
                    ]);
                    break;
                default:
                    DB::table('users')->where('id', $item->id)->update([
                        'new_sign_required' => 1, // No Need Sign (No)
                    ]);
            }
        }
        return redirect()->route('admin.one-time-use');
    }

    public function updateB2BSignRequired(Request $request) {
        $users = User::all();

        foreach($users as $key => $item) {
            $user_type = $item->user_type;

            switch($user_type) {
                case "1":
                case "2":
                    DB::table('users')->where('id', $item->id)->update([
                        'b2b_sign_required' => 2, // Need Sign (Yes)
                    ]);
                    break;
                case "3":
                case "4":
                    DB::table('users')->where('id', $item->id)->update([
                        'b2b_sign_required' => 1, // No Need Sign (No)
                    ]);
                    break;
                default:
                    DB::table('users')->where('id', $item->id)->update([
                        'b2b_sign_required' => 1, // No Need Sign (No)
                    ]);
            }
        }
        return redirect()->route('admin.one-time-use');
    }

    // 24/8/2022 (Fix The Second Upline Referral Bonus does not give to second upline user)
    public function giveUpline2Bonus(Request $request)
    {
        $user_id = 5; //User ID 107's upline_user_id

        $transactionBonusGiven = TransactionBonusGiven::create([
            'user_id' => $user_id, // User's Upline (Second Upline Id)
            'type' => 10,
            'amount' => 2700,
            'title' => 'second upline bonus',
            'remark' => 'second upline bonus',
            'status' => 2
        ]);
        $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
        $transactionBonusGiven->update([
            'transaction' => $transactionNo,
            'given_at' => Carbon::now()
        ]);

        PointBonusBalance::create([
            'amount' => 2700,
            'user_id' => $user_id,
            'status' => 1,
            'settlement' => 1,
            'remark' => "second upline bonus " . $transactionNo,
        ]);

        return redirect()->route('admin.one-time-use');
    }

    public function giveUserUpgradeUpline1and2Bonus(Request $request)
    {
        // Upline 2 Not need give due to its is ID 1,2,3
        $first_upline_user_id = 6; // User ID 18's upline_user_id
        $second_upline_user_id = 4; // User ID 18's upline_user_id

        // First Upline
        $business_model_start_day = "2022-08-01";
        $userDirectUplineBeforeBusinessModel = User::where('user_type', '=', 3)->where('created_at', '<=', $business_model_start_day)->where('upline_user_id', $first_upline_user_id)->where('status', 1)->count('id');
        $countFirstUplineBonusGave = TransactionBonusGiven::where('user_id', $first_upline_user_id)->whereIn('type', [6, 11])->where('status', 2)->count('id');
        $currentReferralLevel = $countFirstUplineBonusGave + $userDirectUplineBeforeBusinessModel + 1;

        $transactionBonusGiven = TransactionBonusGiven::create([
            'user_id' => $first_upline_user_id, // User's Upline (Second Upline Id)
            'type' => 11,
            'amount' => 6750,
            'title' => 'user upgrade first upline bonus',
            'remark' => 'user upgrade first upline bonus',
            'status' => 2
        ]);
        $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
        $transactionBonusGiven->update([
            'transaction' => $transactionNo,
            'given_at' => Carbon::now()
        ]);

        PointBonusBalance::create([
            'amount' => 6750,
            'user_id' => $first_upline_user_id,
            'status' => 1,
            'settlement' => 1,
            'remark' => "user ugprade first upline bonus " . $transactionNo,
        ]);

        BonusFirstUplineLog::create([
            'level' => $currentReferralLevel,
            'transaction_remark' => $transactionNo,
            'remark' => 'User Upgrade First Upline Bonus',
            'amount' => 6750,
            'type' => 3,
            'status' => 1,
            'user_id' => $first_upline_user_id,
        ]);

        // Second Upline
        $transactionBonusGiven = TransactionBonusGiven::create([
            'user_id' => $second_upline_user_id, // User's Upline (Second Upline Id)
            'type' => 12,
            'amount' => 2700,
            'title' => 'user upgrade second upline bonus',
            'remark' => 'user upgrade second upline bonus',
            'status' => 2
        ]);
        $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
        $transactionBonusGiven->update([
            'transaction' => $transactionNo,
            'given_at' => Carbon::now()
        ]);

        PointBonusBalance::create([
            'amount' => 2700,
            'user_id' => $second_upline_user_id,
            'status' => 1,
            'settlement' => 1,
            'remark' => "user ugprade second upline bonus " . $transactionNo,
        ]);

        return redirect()->route('admin.one-time-use');

    }

    public function storeUplinePreserveLog(Request $request)
    {
        UplinePreserveLog::truncate();
        foreach (User::cursor() as $user) {
            UplinePreserveLog::insert([
                'user_id' => $user->id,
                'direct_upline_id' => $user->direct_upline_id,
                'upline_user_id' => $user->upline_user_id,
                'upline_user_1_id' => $user->upline_user_1_id,
                'upline_user_2_id' => $user->upline_user_2_id,
                'status' => $user->status,
                'user_type' => $user->user_type,
                'referred_at' => $user->created_at,
                'created_at' => '2022-08-01 00:00:00',
                'updated_at' => '2022-08-01 00:00:00',
            ]);
        }

        UplinePreserveLog::where('user_id', 18)->update([
            'direct_upline_id' => 6,
            'upline_user_id' => 4,
            'upline_user_1_id' => 1,
            'upline_user_2_id' => 2,
            'status' => 1,
            'user_type' => 2,
        ]);       
  
        return redirect()->route('admin.one-time-use');
    }
}
