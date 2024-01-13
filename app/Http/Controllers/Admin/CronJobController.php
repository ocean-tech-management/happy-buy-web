<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TransactionIdLog;
use App\Models\TransactionPointPurchase;
use App\Models\TransactionBonusGiven;
use App\Models\BonusFirstUpline;
use App\Models\BonusTeamCar;
use App\Models\BonusTeamHouse;
use App\Models\PointBonusBalance;
use App\Models\BonusFirstUplineLog;
use App\Models\BonusJoin;
use App\Models\UplinePreserveLog;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class CronJobController extends Controller
{
    public function __construct()
    {
        $this->business_model_start_day = "2022-08-01";
    }

    // Upgrade Millionaire Leader Status (DAILY CRON JOB)
    // Better run before teamCarAndHouseBonus cronjob function.
    // Foreach all user, who is his/her downline by using, upline_user_id, upline_user_1_id. (Check the account_verify = 2 (verified))
    // If upline_user_id more than 5 and If upline_user_1_id mroe than 5
    // Upgrade the user millionaire leader status.
    public function upgradeMillionaireLeaderStatus(Request $request)
    {
        // if (env('APP_ENV') == "production") {
        //     if (Carbon::now()->toDateTimeString() <= Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
        //         die("STOP");
        //     }
        // }
        // die("STOP");

        Log::info("(CronJob) Start Running : Upgrade Millionaire Leader Status");
        $logFileName = "upgradeMillionaireLeaderStatus.txt";
        $this->writeLog('upgradeMillionaireLeaderStatus', $logFileName, "The Upgrade Millionaire Leader Status have run in: " . Carbon::now()->toDateTimeString());

        DB::beginTransaction();
        try {

            $targetUplineUserId = 5;
            $targetUplineUserFirstId = 5;

            // Scan User who is Millionaire, and NOT Millionaire Leader, Status is Active
            foreach (User::select('id')->whereNotIn('id', [1, 2, 3, 4])->where('user_type', 3)->where('sub_user_type', 1)->where('status', 1)->groupBy('id')->cursor() as $user) {
                $uplineUser = User::where('upline_user_id', $user->id)->role(['Merchant-Millionaire'])->where('status', 1)->count();
                $uplineFirstUser = User::where('upline_user_1_id', $user->id)->role(['Merchant-Millionaire'])->where('status', 1)->count();

                if ($uplineUser >= $targetUplineUserId && $uplineFirstUser >= $targetUplineUserFirstId) {
                    $user->update([
                        'sub_user_type' => 2, // Upgrade to Millionaire Leader
                        'sub_user_type_at' => Carbon::now(), // Upgrade to Millionaire Leader
                    ]);
                    echo "User ID: " . $user->id . " Upgrade tp Millioanire Leader" . "<br/>";
                    $this->writeLog('upgradeMillionaireLeaderStatus', $logFileName, "User ID: " . $user->id . " Upgrade tp Millioanire Leader");

                } else {
                    echo "User ID: " . $user->id . " Maintain Millionaire" . "<br/>";
                    $this->writeLog('upgradeMillionaireLeaderStatus', $logFileName, "User ID: " . $user->id . " Maintain Millionaire");
                }
            }
            DB::commit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("(CronJob) Error: Upgrade Millionaire Leader Status - ${error_message}");
            $this->writeLog('upgradeMillionaireLeaderStatus - ERROR', $logFileName, $error_message);
            DB::rollback();
            dd($e->getMessage());
            return back();
        }

        echo "Done - Upgrade Millionaire Leader Status" . "<br/>";
    }

    // Team Car Bonus and Team House Bonus (DAILY CRON JOB)
    // Foreach user who is millionaire leader,
    // Scan and pluck the user_id from users table, who is his/her downline by using, upline_user_id, upline_user_1_id.

    // (Not sure the plucked user_id will conflict or not) // Better check and remove duplicate user_id, if occur.

    // Scan transaction_point_purchase based on plucked user_id and and sum the price.
    // Modular total/target = (int)(Remaining) [qualify to earn how many times team car bonus or team house bonus]
    // Count the transaction_bonus_given, type 8 (Team Bonus Car)
    // Count the transaction_bonus_given, type 9 (Team House Bonus)
    // Then give the bonus 100k to the millionaire leader user.
    public function teamCarAndHouseBonus(Request $request)
    {
        // if (env('APP_ENV') == "production") {
        //     if (Carbon::now()->toDateTimeString() <= Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
        //         die("STOP");
        //     }
        // }
        // die("STOP");

        Log::info("(CronJob) Start Running : Team Car and House Bonus");
        $logFileName = "teamCarAndHouseBonus.txt";
        $this->writeLog('teamCarAndHouseBonus', $logFileName, "The Team Car and House Bonus have run in: " . Carbon::now()->toDateTimeString());

        DB::beginTransaction();
        try {

            // Scan User who is Millionaire, and Millionaire Leader, Status is Active
            // Only Millioanire Leader Have Qualification to Take Team Car and Team House Bonus.
            $bonusTeamCar = BonusTeamCar::findOrFail(1)->first();
            $bonusTeamHouse = BonusTeamHouse::findOrFail(1)->first();


            // $bonusTeamCarTargetAmount = 500000; // Reduce amount for testing purpose.

            $bonusTeamCarTargetAmount = $bonusTeamCar->target_amount;
            $bonusTeamCarBonusAmount = $bonusTeamCar->bonus_amount;
            $bonusTeamHouseTargetAmount = $bonusTeamHouse->target_amount;
            $bonusTeamHouseBonusAmount = $bonusTeamHouse->bonus_amount;

            // Check All the Millionaire Leader User.
            foreach (User::select('id')->where('user_type', 3)->where('sub_user_type', 2)->where('status', 1)->groupBy('id')->cursor() as $user) {

                // Check the users' upline_user_id, upline_user_1_id.
                $uplineUserArr = User::where('upline_user_id', $user->id)->where('status', 1)->pluck('id')->toArray();
                $uplineFirstUserArr = User::where('upline_user_1_id', $user->id)->where('status', 1)->pluck('id')->toArray();

                $mergedUplineArr = array_merge($uplineUserArr, $uplineFirstUserArr);
                $removedDuplicateDownlineUserIdArray = array_map("unserialize", array_unique(array_map("serialize", $mergedUplineArr))); // Optional (Original array's value[user_id] also not duplicate) (This is remove duplicate value in array)
                // dd($user, $removeDuplicateDownlineUserIdArray);

                $accumulatedDownlineTransactionPointPurchase = TransactionPointPurchase::whereIn('user_id', $removedDuplicateDownlineUserIdArray)
                    ->where('created_at', '>=', $user->sub_user_type_at)
                    ->where('type', 1)->where('status', 3)->sum('price');

                $accumulatedDownlineTransactionPointPurchase2 = TransactionPointPurchase::whereIn('user_id', $removedDuplicateDownlineUserIdArray)
                    ->where('created_at', '>=', $user->sub_user_type_at)
                    ->where('type', 1)->where('status', 3)->get();

                foreach ($accumulatedDownlineTransactionPointPurchase2 as $item){
                    echo "User ID: " . $user->id . $item->transaction. " - ".$item->created_at. "<br>";
                    $this->writeLog('teamCarAndHouseBonus', $logFileName, "User ID: " . $user->id . $item->transaction. " - ".$item->created_at);
                }

                echo "User ID: " . $user->id . " Accumulated Downline Top Up Amount: " . $accumulatedDownlineTransactionPointPurchase . $user->sub_user_type_at . "<br>";
                $this->writeLog('teamCarAndHouseBonus', $logFileName, "User ID: " . $user->id . " Accumulated Downline Top Up Amount: " . $accumulatedDownlineTransactionPointPurchase);


                if ($accumulatedDownlineTransactionPointPurchase >= $bonusTeamCarTargetAmount) {

                    // Check Previously the user have receive how many times bonus team car.
                    $countTeamCarBonusGave = TransactionBonusGiven::where('user_id', $user->id)->where('type', 8)->where('status', 2)->first();

                    if (!$countTeamCarBonusGave) {
                        echo "Team Car Bonus Given - User ID: " . $user->id . " (Given)" . "<br>";

                        $transactionBonusGiven = TransactionBonusGiven::create([
                            'user_id' => $user->id,
                            'type' => 8,
                            'amount' => $bonusTeamCarBonusAmount,
                            'title' => 'team bonus car',
                            'remark' => 'team bonus car',
                            'status' => 2
                        ]);
                        $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
                        $transactionBonusGiven->update([
                            'transaction' => $transactionNo,
                            'given_at' => Carbon::now()
                        ]);

                        PointBonusBalance::create([
                            'amount' => $bonusTeamCarBonusAmount,
                            'user_id' => $user->id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "team bonus car " . $transactionNo,
                            'model_type' => '\App\Models\TransactionBonusGiven',
                            'model' => $transactionBonusGiven->id,
                        ]);
                    } else {
                        echo "Team Car Bonus Given - User ID: " . $user->id . " (Already Given)" . "<br>";
                        $this->writeLog('teamCarAndHouseBonus', $logFileName, "Team Car Bonus Given - User ID: " . $user->id . " (Already Given)");
                    }
                } else {
                    echo "Team Car Bonus Given - User ID: " . $user->id . " (Not Given)" . "<br>";
                    $this->writeLog('teamCarAndHouseBonus', $logFileName, "Team Car Bonus Given - User ID: " . $user->id . " (Not Given)");
                }

                if ($accumulatedDownlineTransactionPointPurchase >= $bonusTeamHouseTargetAmount) {

                    // Check Previously the user have receive how many times bonus team house.
                    $countTeamHouseBonusGave = TransactionBonusGiven::where('user_id', $user->id)->where('type', 9)->where('status', 2)->first();

                    if (!$countTeamHouseBonusGave) {
                        echo "Team House Bonus Given - User ID: " . $user->id . " (Given)" . "<br>";

                        $transactionBonusGiven2 = TransactionBonusGiven::create([
                            'user_id' => $user->id,
                            'type' => 9,
                            'amount' => $bonusTeamHouseBonusAmount,
                            'title' => 'team bonus house',
                            'remark' => 'team bonus house',
                            'status' => 2
                        ]);
                        $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven2->user_id, $transactionBonusGiven2->id);
                        $transactionBonusGiven2->update([
                            'transaction' => $transactionNo,
                            'given_at' => Carbon::now()
                        ]);

                        PointBonusBalance::create([
                            'amount' => $bonusTeamHouseBonusAmount,
                            'user_id' => $user->id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "team bonus house " . $transactionNo,
                        ]);
                    } else {
                        echo "Team House Bonus Given - User ID: " . $user->id . " (Already Given)" . "<br>";
                        $this->writeLog('teamCarAndHouseBonus', $logFileName, "Team House Bonus Given - User ID: " . $user->id . " (Already Given)");
                    }
                } else {
                    echo "Team House Bonus - User ID: " . $user->id . " (Not Given)" . "<br>";
                    $this->writeLog('teamCarAndHouseBonus', $logFileName, "Team House Bonus - User ID: " . $user->id . " (Not Given)");
                }
                echo "<br>";
                // dd($user, $bonusTeamCar, $bonusTeamHouse, $accumulatedDownlineTransactionPointPurchase, $bonusTeamCarModularized, $bonusTeamCarQualifyCount, $countTeamCarBonusGave, $countTeamHouseBonusGave);

            }
            DB::commit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("(CronJob) Error: Team Car and House Bonus - ${error_message}");
            $this->writeLog('teamCarAndHouseBonus - ERROR', $logFileName, $error_message);
            DB::rollback();
            dd($e->getMessage());
            return back();
        }

        echo "Done - Team Car and House Bonus" . "<br/>";
    }


    // This can do (By Action) or (By CronJob)
    // Referral Bonus First Generation Bonus or First Upline Bonus (DAILY CRON JOB)
    // Count his/her upline_user_id;
    public function referralBonusFirstGeneration(Request $request)
    {
        // if (env('APP_ENV') == "production") {
        //     if (Carbon::now()->toDateTimeString() <= Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
        //         die("STOP");
        //     }
        // }
        // die("STOP");

        Log::info("(CronJob) Start Running : Referral Bonus First Generation");
        $logFileName = "referralBonusFirstGeneration.txt";
        $this->writeLog('referralBonusFirstGeneration', $logFileName, "The First Generation Referral Bonus have run in: " . Carbon::now()->toDateTimeString());

        DB::beginTransaction();
        try {
            $bonusFirstUpline = BonusFirstUpline::whereStatus(1)->get()->toArray(); // Should I Descending this record?
            $bonusJoin = BonusJoin::whereId(1)->first();

            foreach (User::select('id', 'upline_user_id')->whereNotIn('id', [1, 2, 3])->where('user_type', '=', 3)->where('status', 1)->groupBy('id')->cursor() as $user) {

                echo "User ID: " . $user->id . "<br>";
                $this->writeLog('referralBonusFirstGeneration', $logFileName, "User ID: " . $user->id);

                $countReferralFound = User::where('user_type', '=', 3)->where('upline_user_id', $user->id)->where('status', 1)->count('id');
                // This have check before 01-08-2022
                $userDirectUplineBeforeBusinessModel = User::where('user_type', '=', 3)->where('created_at', '<=', $this->business_model_start_day)->where('upline_user_id', $user->id)->where('status', 1)->count('id');

                $countFirstUplineBonusGave = TransactionBonusGiven::where('user_id', $user->id)->whereIn('type', [6, 11])->where('status', 2)->count('id');
                // $countFirstUplineBonusGave = TransactionBonusGiven::where('user_id', $user->id)->whereIn('type', [6])->where('status', 2)->count('id');
                $remainingBonusShouldGive = $countReferralFound - $userDirectUplineBeforeBusinessModel - $countFirstUplineBonusGave; // REMEMBER CHANGE $remainingBonusShouldGive => 31 To testing.

                // $currentReferralLevel = $countFirstUplineBonusGave + $userDirectUplineBeforeBusinessModel + 1;
                // dd($currentReferralLevel, $remainingBonusShouldGive, $countReferralFound, $userDirectUplineBeforeBusinessModel, $countFirstUplineBonusGave);

                echo "Count Remaining Bonus Should Give: " . $remainingBonusShouldGive . "<br>";
                $this->writeLog('referralBonusFirstGeneration', $logFileName, "Count Remaining Bonus Should Give: " . $remainingBonusShouldGive);

                // $userDirectUplineBeforeBusinessModel2 = UplinePreserveLog::where('user_type', '=', 3)->where('referred_at', '<=', $this->business_model_start_day)->where('upline_user_id', $user->id)->where('status', 1)->count('id');
                // $remainingBonusShouldGive2 = $countReferralFound - $userDirectUplineBeforeBusinessModel2 - $countFirstUplineBonusGave; // REMEMBER CHANGE $remainingBonusShouldGive => 31 To testing.
                // echo "Remaining Bonus Should Give2: " . $remainingBonusShouldGive2 . "<br>";

                // Remaining Time Require To Give Point Bonus Balance
                for ($x = 1; $x <= $remainingBonusShouldGive; $x++) {

                    $shouldGiveBonusAmount = 0;
                    $currentReferralLevel = $countFirstUplineBonusGave + $userDirectUplineBeforeBusinessModel + $x;

                    foreach ($bonusFirstUpline as $key => $bonusItem) {
                        if ($currentReferralLevel >= $bonusItem['referral_count']) {
                            $shouldGiveBonusAmount = $bonusItem['bonus_amount'] ?? 0.00;
                        }
                    }

                    if ($shouldGiveBonusAmount != 0) {
                        // echo "(Referal) Referral Count: " . $currentReferralLevel . " Bonus Amount: " . $shouldGiveBonusAmount . "<br>";
                        $transactionBonusGiven = TransactionBonusGiven::create([
                            'user_id' => $user->id,
                            'type' => 6,
                            'amount' => $shouldGiveBonusAmount,
                            'title' => 'first upline bonus',
                            'remark' => 'first upline bonus',
                            'status' => 2
                        ]);
                        $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
                        $transactionBonusGiven->update([
                            'transaction' => $transactionNo,
                            'given_at' => Carbon::now()
                        ]);

                        PointBonusBalance::create([
                            'amount' => $shouldGiveBonusAmount,
                            'user_id' => $user->id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "first upline bonus " . $transactionNo,
                        ]);

                        BonusFirstUplineLog::create([
                            'level' => $currentReferralLevel,
                            'transaction_remark' => $transactionNo,
                            'remark' => 'First Upline Bonus',
                            'amount' => $shouldGiveBonusAmount,
                            'type' => 1,
                            'status' => 1,
                            'user_id' => $user->id,
                        ]);
                        echo "Referral Level: " . $currentReferralLevel . " Bonus Amount: " . $shouldGiveBonusAmount . "<br>";
                        $this->writeLog('referralBonusFirstGeneration', $logFileName, "Referral Level: " . $currentReferralLevel . " Bonus Amount: " . $shouldGiveBonusAmount);

                        // Second Upline Bonus From Bonus Join
                        $transactionBonusGiven2 = TransactionBonusGiven::create([
                            'user_id' => $user->upline_user_id, // User's Upline (Second Upline Id)
                            'type' => 10,
                            'amount' => $bonusJoin->second_upline_bonus,
                            'title' => 'second upline bonus',
                            'remark' => 'second upline bonus',
                            'status' => 2
                        ]);
                        $transactionNo2 = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven2->user_id, $transactionBonusGiven2->id);
                        $transactionBonusGiven2->update([
                            'transaction' => $transactionNo2,
                            'given_at' => Carbon::now()
                        ]);

                        PointBonusBalance::create([
                            'amount' => $bonusJoin->second_upline_bonus,
                            'user_id' => $user->upline_user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "second upline bonus " . $transactionNo2,
                        ]);

                        echo "Second Upline: " . $user->upline_user_id . " Second Upline Bonus Amount: " . $bonusJoin->second_upline_bonus . "<br>";
                        $this->writeLog('referralBonusFirstGeneration', $logFileName, "Second Upline: " . $user->upline_user_id . " Second Upline Bonus Amount: " . $bonusJoin->second_upline_bonus);

                    }
                }

                echo "<br>";
            }
            // dd("STOP");

            DB::commit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("(CronJob) Error: Referral Bonus First Generation - ${error_message}");
            $this->writeLog('referralBonusFirstGeneration - ERROR', $logFileName, $error_message);
            DB::rollback();
            dd($e->getMessage());
            return back();
        }

        echo "Done - Referral Bonus First Generation" . "<br/>";
    }


    // Top Up Bonus First Generation Bonus or First Upline Extra Bonus (DAILY CRON JOB)
    // This will create a bonus first upline log when reach certain referral count.
    // This function would not give bonus. (Give Top Up Bonus is )
    public function topUpBonusFirstGeneration(Request $request)
    {
        // if (env('APP_ENV') == "production") {
        //     if (Carbon::now()->toDateTimeString() <= Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
        //         die("STOP");
        //     }
        // }
        // die("STOP");

        Log::info("(CronJob) Start Running : Top Up Bonus First Generation");
        $logFileName = "topUpBonusFirstGeneration.txt";
        $this->writeLog('topUpBonusFirstGeneration', $logFileName, "The Top Up First Generation Bonus have run in: " . Carbon::now()->toDateTimeString());

        DB::beginTransaction();
        try {

            // Only need to store top_up_count is not null
            $bonusFirstUpline = BonusFirstUpline::whereStatus(1)->whereNotNull('top_up_count')->get()->toArray();

            foreach (User::select('id')->whereNotIn('id', [1, 2, 3])->where('user_type', '=', 3)->where('status', 1)->groupBy('id')->cursor() as $user) {

                echo "User ID: " . $user->id . "<br>";
                $this->writeLog('topUpBonusFirstGeneration', $logFileName, "User ID: " . $user->id);

                $userDirectUpline = User::select('id', 'register_verify_at')->where('user_type', '=', 3)->where('upline_user_id', $user->id)->where('status', 1)->get();
                $countReferralFound = count($userDirectUpline);

                // $countTotalTopUp = TransactionPointPurchase::where('user_id', $user->id)->where('type', 1)->where('status', 3)->count('id');


                foreach ($bonusFirstUpline as $key => $bonusItem) {
                    if ($countReferralFound >= $bonusItem['referral_count']) {
                        $referralCount = $bonusItem['referral_count'] ?? 0;
                        $delayDaysToSendTopUpBonus = $bonusItem['days'] ?? 0;

                        if ($delayDaysToSendTopUpBonus != 0) {
                            $checkBonusFirstUplineLog = BonusFirstUplineLog::where('level', $referralCount)->where('user_id', $user->id)->first();

                            if (!$checkBonusFirstUplineLog) {
                                echo "Level: " . $referralCount . "<br>";
                                $this->writeLog('topUpBonusFirstGeneration', $logFileName, "Level: " . $referralCount);

                                BonusFirstUplineLog::create([
                                    'level' => $referralCount, // Fifth Cron Job is using Referral Level.
                                    'transaction_remark' => null,
                                    'remark' => 'First Upline Extra Bonus',
                                    'amount' => null,
                                    'type' => 2,
                                    'status' => 2, // On Hold
                                    'user_id' => $user->id,
                                ]);
                            }
                        }
                    }
                }

                echo "<br>";
            }
            // dd("STOP");

            DB::commit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("(CronJob) Error: Top Up Bonus First Generation - ${error_message}");
            $this->writeLog('topUpBonusFirstGeneration - ERROR', $logFileName, $error_message);
            DB::rollback();
            dd($e->getMessage());
            return back();
        }

        echo "Done - Top Up Bonus First Generation" . "<br/>";
    }


    // Scan Bonus Upline Log where status is on hold (DAILY CRON JOB)
    // Check specific user's direct upline have exist or not.
    // Better run after TopUpBonusFirstGeneration (Cron Job)
    public function onHoldTopUpBonusFirstGeneration(Request $request)
    {
        // if (env('APP_ENV') == "production") {
        //     if (Carbon::now()->toDateTimeString() <= Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
        //         die("STOP");
        //     }
        // }
        // die("STOP");

        Log::info("(CronJob) Start Running : On Hold Top Up Bonus First Generation");
        $logFileName = "onHoldTopUpBonusFirstGeneration.txt";
        $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "The On Hold Top Up First Generation Bonus have run in: " . Carbon::now()->toDateTimeString());

        DB::beginTransaction();
        try {
            $bonusFirstUpline = BonusFirstUpline::whereStatus(1)->whereNotNull('top_up_count')->get()->toArray();

            // Scan BonusFirstUplineLog where status is ON HOLD.
            foreach (BonusFirstUplineLog::select('id', 'level', 'user_id', 'created_at')->where('type', 2)->where('status', 2)->cursor() as $bonusFirstUplineItem) {
                $refIndex = 0;
                $user_id = $bonusFirstUplineItem->user_id;
                $statusGiveBonus = false;

                $countTotalTopUp = TransactionPointPurchase::where('user_id', $user_id)->where('type', 1)->where('status', 3)->count('id');
                $currentReferralLevel = $bonusFirstUplineItem->level;
                $userDirectUpline = User::select('id', 'register_verify_at')->where('user_type', '=', 3)->where('upline_user_id', $user_id)->where('status', 1)->get();

                // echo "Current Total Top Up: " . $countTotalTopUp . "<br>";
                echo "ID: " . $bonusFirstUplineItem->id . " Level: " . $bonusFirstUplineItem->level . " Current Total Top Up: " . $countTotalTopUp . " User ID: " . $user_id . "<br>";
                $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " Level: " . $bonusFirstUplineItem->level . " Current Total Top Up: " . $countTotalTopUp . " User ID: " . $user_id);

                foreach ($bonusFirstUpline as $key => $bonusItem) {
                    if ($currentReferralLevel == $bonusItem['referral_count']) {
                        $referralCount = $bonusItem['referral_count'] ?? 0;
                        $topUpCount = $bonusItem['top_up_count'] ?? 0;
                        $shouldGiveTopUpExtraAmount = $bonusItem['extra_top_up_bonus'] ?? 0.00;
                        $delayDaysToSendTopUpBonus = $bonusItem['days'] ?? 0;
                    }
                }
                $refIndex = $referralCount - 1; // If Referral Count is 10, RefIndex should be 9.
                // dd($bonusFirstUplineItem, $refIndex);
                if ($delayDaysToSendTopUpBonus != 0) {

                    $getRelatedUserDirectUplineJoinRecord = $userDirectUpline[$refIndex] ?? null;
                    if ($getRelatedUserDirectUplineJoinRecord) {
                        $getSpecificJoinDate = $getRelatedUserDirectUplineJoinRecord->register_verify_at;
                        // Mean already more than 7 days.
                        // dd($userDirectUpline, ($referralCount + $refIndex));
                        if ($getSpecificJoinDate) {
                            if (Carbon::now() >= Carbon::parse($getSpecificJoinDate)->addDays($delayDaysToSendTopUpBonus)) {
                                BonusFirstUplineLog::where('id', $bonusFirstUplineItem->id)->update([
                                    'status' => 3, // Failed
                                ]);
                                echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Failed (1)" .  "<br>";
                                $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Failed (1)");

                            } else {
                                // PASSED (GIVE BONUS)
                                if ($countTotalTopUp >= $topUpCount) {
                                    $checkFoundReferralAfterAugust = User::where('upline_user_id', $user_id)->where('user_type', '=',3)->where('created_at', '>=', $this->business_model_start_day)->where('status', 1)->first();
                                    if ($checkFoundReferralAfterAugust) {
                                        $statusGiveBonus = true;
                                        echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Success (1)" .  "<br>";
                                        $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Failed (1)");
                                    } else {
                                        echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Maintain (1)" .  "<br>";
                                        $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Maintain (1)");
                                    }
                                }
                            }
                        } else {
                            if (Carbon::now() >= Carbon::parse($bonusFirstUplineItem->created_at)->addDays($delayDaysToSendTopUpBonus)) {
                                BonusFirstUplineLog::where('id', $bonusFirstUplineItem->id)->update([
                                    'status' => 3, // Failed
                                ]);
                                echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Failed (2)" .  "<br>";
                                $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Failed (2)");
                            } else {
                                echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Maintain (2)" .  "<br>";
                                $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Maintain (2)");
                            }
                        }
                    } else {
                        // User have not invite new downline for checking ().
                        // Check current record have more than 7 days or not.
                        if (Carbon::now() >= Carbon::parse($bonusFirstUplineItem->created_at)->addDays($delayDaysToSendTopUpBonus)) {
                            BonusFirstUplineLog::where('id', $bonusFirstUplineItem->id)->update([
                                'status' => 3, // Failed
                            ]);
                            echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Failed (3)" .  "<br>";
                            $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Failed (3)");
                        } else {
                            echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Maintain (3)" .  "<br>";
                            $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Maintain (3)");
                        }
                    }
                } else {
                    if ($countTotalTopUp >= $topUpCount) {
                        $checkFoundReferralAfterAugust = User::where('upline_user_id', $user_id)->where('user_type', '=',3)->where('created_at', '>=', $this->business_model_start_day)->where('status', 1)->first();
                        if ($checkFoundReferralAfterAugust) {
                            $statusGiveBonus = true;
                            echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Success (4)" .  "<br>";
                            $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Success (4)");
                        } else {
                            echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Maintain (4)" .  "<br>";
                            $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Status: Maintain (4)");
                        }
                    }
                }

                // Top Up Count Settings is 0 mean something wrong.
                // if($topUpCount == 0) {
                //     $statusGiveBonus = false;

                //     BonusFirstUplineLog::where('id', $bonusFirstUplineItem->id)->update([
                //         'status' => 3, // Failed
                //     ]);

                //     echo "Cannot Found any Top Up Settings from BonusFirstUpline" .  "<br>";
                // }

                if ($statusGiveBonus == true) {
                    $transactionBonusGiven = TransactionBonusGiven::create([
                        'user_id' => $user_id,
                        'type' => 7,
                        'amount' => $shouldGiveTopUpExtraAmount,
                        'title' => 'first upline extra bonus',
                        'remark' => 'first upline extra bonus',
                        'status' => 2
                    ]);
                    $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
                    $transactionBonusGiven->update([
                        'transaction' => $transactionNo,
                        'given_at' => Carbon::now()
                    ]);

                    PointBonusBalance::create([
                        'amount' => $shouldGiveTopUpExtraAmount,
                        'user_id' => $user_id,
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "first upline extra bonus " . $transactionNo,
                    ]);

                    BonusFirstUplineLog::where('id', $bonusFirstUplineItem->id)->update([
                        'transaction_remark' => $transactionNo,
                        'amount' => $shouldGiveTopUpExtraAmount,
                        'status' => 1, // Success
                    ]);

                    echo "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Amount Given: " . $shouldGiveTopUpExtraAmount .  "<br>";
                    $this->writeLog('onHoldTopUpBonusFirstGeneration', $logFileName, "ID: " . $bonusFirstUplineItem->id . " User ID: " . $user_id . " Amount Given: " . $shouldGiveTopUpExtraAmount);

                }
                echo "<br>";
            }
            // dd("STOP");

            DB::commit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("(CronJob) Error: On Hold Top Up Bonus First Generation - ${error_message}");
            $this->writeLog('onHoldTopUpBonusFirstGeneration - ERROR', $logFileName, $error_message);
            DB::rollback();
            dd($e->getMessage());
            return back();
        }

        echo "Done - On Hold Top Up Bonus First Generation" . "<br/>";
    }

    // Private Function
    private function realPath($file)
    {
        $path_name = '/debug_log/' . date('Ym') . '/' . date('Ymd');
        $path = base_path() . '/storage' . $path_name;

        if (!is_dir($path)) {
            File::makeDirectory($path, $mode = 0775, true, true);
        }

        return $path . '/' . $file;
    }

    private function writeLog($action, $file, $content)
    {
        $file_path = $this->realPath($file);

        $xhtml = "----$action----\r\n";

        if (is_string($content)) {
            $xhtml .= $content . "\r\n";
        }

        $xhtml .= "\r\r\n";

        if (($fp = fopen($file_path, 'a+')) == true) {
            flock($fp, LOCK_EX);
            $result = fwrite($fp, $xhtml);
            flock($fp, LOCK_UN);
            fclose($fp);

            return $result;
        } else {
            return false;
        }
    }



    // BACK UP
    // public function teamCarAndHouseBonus(Request $request)
    // {
    //     // if (env('APP_ENV') == "production") {
    //     //     if (Carbon::now()->toDateTimeString() <= Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
    //     //         die("STOP");
    //     //     }
    //     // }
    //     // die("STOP");

    //     Log::info("(CronJob) Start Running : Team Car and House Bonus");

    //     DB::beginTransaction();
    //     try {

    //         // Scan User who is Millionaire, and Millionaire Leader, Status is Active
    //         // Only Millioanire Leader Have Qualification to Take Team Car and Team House Bonus.
    //         $bonusTeamCar = BonusTeamCar::findOrFail(1)->first();
    //         $bonusTeamHouse = BonusTeamHouse::findOrFail(1)->first();


    //         // $bonusTeamCarTargetAmount = 500000; // Reduce amount for testing purpose.

    //         $bonusTeamCarTargetAmount = $bonusTeamCar->target_amount;
    //         $bonusTeamCarBonusAmount = $bonusTeamCar->bonus_amount;
    //         $bonusTeamHouseTargetAmount = $bonusTeamHouse->target_amount;
    //         $bonusTeamHouseBonusAmount = $bonusTeamHouse->bonus_amount;

    //         // Check All the Millionaire Leader User.
    //         foreach (User::select('id')->where('user_type', 3)->where('sub_user_type', 2)->where('status', 1)->groupBy('id')->cursor() as $user) {

    //             // Check the users' upline_user_id, upline_user_1_id.
    //             $uplineUserArr = User::where('upline_user_id', $user->id)->where('status', 1)->pluck('id')->toArray();
    //             $uplineFirstUserArr = User::where('upline_user_1_id', $user->id)->where('status', 1)->pluck('id')->toArray();

    //             $mergedUplineArr = array_merge($uplineUserArr, $uplineFirstUserArr);
    //             $removedDuplicateDownlineUserIdArray = array_map("unserialize", array_unique(array_map("serialize", $mergedUplineArr))); // Optional (Original array's value[user_id] also not duplicate) (This is remove duplicate value in array)
    //             // dd($user, $removeDuplicateDownlineUserIdArray);

    //             $accumulatedDownlineTransactionPointPurchase = TransactionPointPurchase::whereIn('user_id', $removedDuplicateDownlineUserIdArray)
    //             ->where('created_at', '>=', $this->business_model_start_day)
    //             ->where('type', 1)->where('status', 3)->sum('price');

    //             echo "User ID: " . $user->id . " Accumulated Downline Top Up Amount: " . $accumulatedDownlineTransactionPointPurchase . "<br>";

    //             $bonusTeamCarModularized = $accumulatedDownlineTransactionPointPurchase / $bonusTeamCarTargetAmount;
    //             $bonusTeamCarQualifyCount = (int)$bonusTeamCarModularized;
    //             $bonusTeamHouseModularized = $accumulatedDownlineTransactionPointPurchase / $bonusTeamHouseTargetAmount;
    //             $bonusTeamHouseQualifyCount = (int)$bonusTeamHouseModularized;
    //             // $modularized = (int)1.9999999999999; // If decimal number have more than 13 digits will auto convert to 2. Else it will 1.

    //             $countTeamCarBonusGave = $countTeamHouseBonusGave = 0;
    //             if ($bonusTeamCarQualifyCount != 0) {

    //                 // Check Previously the user have receive how many times bonus team car.
    //                 $countTeamCarBonusGave = TransactionBonusGiven::where('user_id', $user->id)->where('type', 8)->where('status', 2)->count('id');

    //                 // Remaining how many times bonus should give, (Qualify Given Count) - (Bonus Already Given Count)
    //                 $giveTeamCarBonusCount = $bonusTeamCarQualifyCount - $countTeamCarBonusGave;
    //                 for ($x = 1; $x <= $giveTeamCarBonusCount; $x++) {
    //                     echo "Team House Bonus - User ID: " . $user->id . " x" . $countTeamCarBonusGave + $x . "<br>";

    //                     $transactionBonusGiven = TransactionBonusGiven::create([
    //                         'user_id' => $user->id,
    //                         'type' => 8,
    //                         'amount' => $bonusTeamCarBonusAmount,
    //                         'title' => 'team bonus car',
    //                         'remark' => 'team bonus car: ' . " x" . $countTeamCarBonusGave + $x,
    //                         'status' => 2
    //                     ]);
    //                     $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
    //                     $transactionBonusGiven->update([
    //                         'transaction' => $transactionNo,
    //                         'given_at' => Carbon::now()
    //                     ]);

    //                     PointBonusBalance::create([
    //                         'amount' => $bonusTeamCarBonusAmount,
    //                         'user_id' => $user->id,
    //                         'status' => 1,
    //                         'settlement' => 1,
    //                         'remark' => "team bonus car " . $transactionNo,
    //                     ]);
    //                 }
    //             } else {
    //                 echo "Team Car Bonus Given - User ID: " . $user->id . " (Not Given)" . "<br>";
    //             }

    //             if ($bonusTeamHouseQualifyCount != 0) {

    //                 // Check Previously the user have receive how many times bonus team house.
    //                 $countTeamHouseBonusGave = TransactionBonusGiven::where('user_id', $user->id)->where('type', 9)->where('status', 2)->count('id');

    //                 // Remaining how many times bonus should give, (Qualify Given Count) - (Bonus Already Given Count)
    //                 $giveTeamHouseBonusCount = $bonusTeamHouseQualifyCount - $countTeamHouseBonusGave;
    //                 for ($x = 1; $x <= $giveTeamHouseBonusCount; $x++) {
    //                     echo "Team House Bonus - User ID: " . $user->id . " x" . $countTeamHouseBonusGave + $x . "<br>";

    //                     $transactionBonusGiven = TransactionBonusGiven::create([
    //                         'user_id' => $user->id,
    //                         'type' => 9,
    //                         'amount' => $bonusTeamHouseBonusAmount,
    //                         'title' => 'team bonus house',
    //                         'remark' => 'team bonus house: ' . " x" . $countTeamHouseBonusGave + $x,
    //                         'status' => 2
    //                     ]);
    //                     $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
    //                     $transactionBonusGiven->update([
    //                         'transaction' => $transactionNo,
    //                         'given_at' => Carbon::now()
    //                     ]);

    //                     PointBonusBalance::create([
    //                         'amount' => $bonusTeamHouseBonusAmount,
    //                         'user_id' => $user->id,
    //                         'status' => 1,
    //                         'settlement' => 1,
    //                         'remark' => "team bonus house " . $transactionNo,
    //                     ]);
    //                 }
    //             } else {
    //                 echo "Team House Bonus - User ID: " . $user->id . " (Not Given)" . "<br>";
    //             }
    //             echo "<br>";
    //             // dd($user, $bonusTeamCar, $bonusTeamHouse, $accumulatedDownlineTransactionPointPurchase, $bonusTeamCarModularized, $bonusTeamCarQualifyCount, $countTeamCarBonusGave, $countTeamHouseBonusGave);

    //         }
    //         DB::commit();
    //     } catch (Exception $e) {
    //         $error_message = $e->getMessage();
    //         Log::error("(CronJob) Error: Team Car and House Bonus - ${error_message}");
    //         DB::rollback();
    //         dd($e->getMessage());
    //         return back();
    //     }

    //     echo "Done - Team Car and House Bonus" . "<br/>";
    // }






    // Top Up Bonus First Generation Bonus or First Upline Extra Bonus (DAILY CRON JOB)
    // public function topUpBonusFirstGeneration(Request $request)
    // {
    //     if(env('APP_ENV') == "production") {
    //         if(Carbon::now()->toDateTimeString() <= Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
    //             die("STOP");
    //         }
    //     }
    //     die("STOP");

    //     Log::info("(CronJob) Start Running : Top Up Bonus First Generation");

    //     DB::beginTransaction();
    //     try {
    //         $bonusFirstUpline = BonusFirstUpline::whereStatus(1)->get()->toArray(); // Should I Descending this record?
    //         $minTopUpCount = BonusFirstUpline::whereStatus(1)->whereNotNull('top_up_count')->where('top_up_count', '!=' , 0)->min('top_up_count'); // Minimum Top Up Count is 5.
    //         $minForTopUpReferralCount = BonusFirstUpline::whereStatus(1)->where('top_up_count', $minTopUpCount)->min('referral_count'); // Minimum Referral Count where Top Up Count also minumum is 10.

    //         foreach (User::select('id')->whereNotIn('id', [1, 2, 3, 4])->where('user_type', 3)->where('status', 1)->groupBy('id')->cursor() as $user) {

    //             echo "User ID: " . $user->id . "<br>";

    //             $userDirectUpline = User::select('id', 'register_verify_at')->where('user_type', '!=', 4)->where('upline_user_id', $user->id)->where('status', 1)->get();
    //             $countReferralFound = count($userDirectUpline);
    //             $countTotalTopUp = TransactionPointPurchase::where('user_id', $user->id)->where('type', 1)->where('status', 3)->count('id');

    //             // Check Minimum Requirement Referral Found also reach.
    //             if($countReferralFound >= $minForTopUpReferralCount && $countReferralFound >= $countTotalTopUp) {
    //                 // $countFirstUplineExtraBonusGave = TransactionBonusGiven::where('user_id', $user->id)->where('type', 7)->where('status', 2)->count('id');
    //                 $countFirstUplineExtraBonusGave = BonusFirstUplineLog::where('user_id', $user->id)->where('type', 2)->whereIn('status', [1,3])->count('id');
    //                 $remainingTopUpBonusShouldGive = ($countTotalTopUp - $countFirstUplineExtraBonusGave) - $minTopUpCount;

    //                 $tempReferralCount = 0;
    //                 $refIndex = 0;

    //                 for ($x = 0; $x <= $remainingTopUpBonusShouldGive; $x++) {
    //                     $giveBonusStatus = true;
    //                     $shouldGiveTopUpExtraAmount = 0;
    //                     $currentTopUpLevel = ($countFirstUplineExtraBonusGave + $x) + ($minTopUpCount);
    //                     foreach ($bonusFirstUpline as $key => $bonusItem) {
    //                         if ($currentTopUpLevel >= $bonusItem['top_up_count']) {
    //                             $referralCount = $bonusItem['referral_count'] ?? 0;
    //                             $topUpCount = $bonusItem['top_up_count'] ?? 0;
    //                             $shouldGiveTopUpExtraAmount = $bonusItem['extra_top_up_bonus'] ?? 0.00;
    //                             $delayDaysToSendTopUpBonus = $bonusItem['days'] ?? 0;
    //                         }
    //                     }

    //                     // Use for checking specific user for top up reference with specific referral found user index.
    //                     if($tempReferralCount != $referralCount) {
    //                         if($countFirstUplineExtraBonusGave == 0) {
    //                             $refIndex = 0; // New Record or First Time Cron Job Running.
    //                         } else {
    //                             $refIndex = $countTotalTopUp - $topUpCount;
    //                         }
    //                     } else {
    //                         $refIndex++;
    //                     }
    //                     $tempReferralCount = $referralCount;

    //                     // echo("<br>");
    //                     // echo("USER ID: " . $user->id . " " . "Total Referral Found: " . $countReferralFound . "<br>");
    //                     // echo("USER ID: " . $user->id . " " . "Total Topup Times: " . $countTotalTopUp . "<br>");
    //                     // echo("USER ID: " . $user->id . " " . "Extra Bonus Gave: " . $countFirstUplineExtraBonusGave . "<br>");
    //                     // echo("USER ID: " . $user->id . " " . "referralCount: " . $referralCount . " topUpCount: ". $topUpCount . "<br>");
    //                     // echo("USER ID: " . $user->id . " " . "RefIndex: " .  $refIndex. "<br>");
    //                     // echo("USER ID: " . $user->id . " " . "Answer : " . ($referralCount + $refIndex) - 1 . "<br><br>");

    //                     // Check Delay Top Up Can get bonus or not.
    //                     if($delayDaysToSendTopUpBonus != 0) {
    //                         // CHECK this logic make sense or not. It should use referral found better instead of minForTopUpReferralCount ?
    //                         // $getRelatedUserDirectUplineJoinRecord = $userDirectUpline[$minForTopUpReferralCount + $x - 1] ?? null;

    //                         $getRelatedUserDirectUplineJoinRecord = $userDirectUpline[($referralCount + $refIndex) - 1] ?? null;
    //                         // dd($userDirectUpline, $getRelatedUserDirectUplineJoinRecord);
    //                         if($getRelatedUserDirectUplineJoinRecord) {
    //                             $getSpecificJoinDate = $getRelatedUserDirectUplineJoinRecord->register_verify_at;
    //                             // Mean already more than 7 days.
    //                             if(Carbon::now() >= Carbon::parse($getSpecificJoinDate)->addDays($delayDaysToSendTopUpBonus) || $getSpecificJoinDate == null ) {
    //                                 $giveBonusStatus = false;
    //                                 echo "Top Up Level: " . $currentTopUpLevel . " User Join Date: " . $getSpecificJoinDate . " Status: Expired" . "<br>";

    //                                 BonusFirstUplineLog::create([
    //                                     'level' => $currentTopUpLevel,
    //                                     'transaction_remark' => null,
    //                                     'remark' => 'First Upline Extra Bonus',
    //                                     'amount' => null,
    //                                     'type' => 2,
    //                                     'status' => 3, // Failed
    //                                     'user_id' => $user->id,
    //                                 ]);

    //                             } else {
    //                                 echo "Top Up Level: " . $currentTopUpLevel . " User Join Date: " . $getSpecificJoinDate . " Status: Success" . "<br>";
    //                             }
    //                         } else {
    //                             // Does not found any reference downline details.
    //                             // Example: Top Up 9 Times.
    //                             // 5th top up record's created_at is compare => 10th user's register_verify_at ($userDirectUpline[9])
    //                             // 6th top up record's created_at is compare => 11th user's register_verify_at ($userDirectUpline[10])
    //                             // 7th top up record's created_at is compare => 12th user's register_verify_at ($userDirectUpline[11])
    //                             // ......
    //                             // 10th top up record's created_at => due to the settings does not have days record. So need compare. Just Give the bonus.
    //                             $giveBonusStatus = false;

    //                             $checkBonusFirstUplineLog = BonusFirstUplineLog::where('level', $currentTopUpLevel)->where('type', 2)->where('status', 2)->where('user_id', $user->id)->first();

    //                             if(!$checkBonusFirstUplineLog) {
    //                                 echo "Top Up Level: " . $currentTopUpLevel . " Cannot Find Specific User's register_verify_at" . " Status: On Hold" . "<br>";
    //                                 BonusFirstUplineLog::create([
    //                                     'level' => $currentTopUpLevel,
    //                                     'transaction_remark' => null,
    //                                     'remark' => 'First Upline Extra Bonus',
    //                                     'amount' => null,
    //                                     'type' => 2,
    //                                     'status' => 2, // On Hold
    //                                     'user_id' => $user->id,
    //                                 ]);
    //                             }

    //                         }
    //                     }

    //                     if($shouldGiveTopUpExtraAmount != 0 && $giveBonusStatus == true && $countReferralFound >= $referralCount) {
    //                         $transactionBonusGiven = TransactionBonusGiven::create([
    //                             'user_id' => $user->id,
    //                             'type' => 7,
    //                             'amount' => $shouldGiveTopUpExtraAmount,
    //                             'title' => 'first upline extra bonus',
    //                             'remark' => 'first upline extra bonus',
    //                             'status' => 2
    //                         ]);
    //                         $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
    //                         $transactionBonusGiven->update([
    //                             'transaction' => $transactionNo,
    //                             'given_at' => Carbon::now()
    //                         ]);

    //                         PointBonusBalance::create([
    //                             'amount' => $shouldGiveTopUpExtraAmount,
    //                             'user_id' => $user->id,
    //                             'status' => 1,
    //                             'settlement' => 1,
    //                             'remark' => "first upline extra bonus " . $transactionNo,
    //                         ]);

    //                         BonusFirstUplineLog::create([
    //                             'level' => $currentTopUpLevel,
    //                             'transaction_remark' => $transactionNo,
    //                             'remark' => 'First Upline Extra Bonus',
    //                             'amount' => $shouldGiveTopUpExtraAmount,
    //                             'type' => 2,
    //                             'status' => 1, // Success
    //                             'user_id' => $user->id,
    //                         ]);

    //                         echo "Top Up Level: " . $currentTopUpLevel . " Top Up Bonus Amount: " . $shouldGiveTopUpExtraAmount . " Delays Days: " . $delayDaysToSendTopUpBonus ."<br>";

    //                     }
    //                 }
    //             }

    //             echo "<br>";
    //         }
    //         // dd("STOP");

    //         DB::commit();
    //     } catch (Exception $e) {
    //         $error_message = $e->getMessage();
    //         Log::error("(CronJob) Error: Top Up Bonus First Generation - ${error_message}");
    //         DB::rollback();
    //         dd($e->getMessage());
    //         return back();
    //     }

    //     echo "Done - Top Up Bonus First Generation" . "<br/>";
    // }
}
