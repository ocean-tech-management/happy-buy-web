<?php

namespace App\Http\Controllers\User;

use App\CustomClass\SenangPay;
use App\Http\Controllers\Controller;
use App\Models\BankList;
use App\Models\Country;
use App\Models\DepositBank;
use App\Models\PaymentMethod;
use App\Models\PointBalance;
use App\Models\PointManagerBalance;
use App\Models\PointPackage;
use App\Models\Role;
use App\Models\TransactionAgentTopUp;
use App\Models\TransactionIdLog;
use App\Models\TransactionPointPurchase;
use App\Models\User;
use App\Models\UserEntry;
use App\Models\UserUpgrade;
use App\Models\DocumentNumberLog;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentReceiptLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserUpgradeController extends Controller
{
    public function upgradeAccountSelect()
    {
        if (Auth::user()->roles[0]->id != 2) {
            if (Auth::user()->roles[0]->id == 4 || Auth::user()->roles[0]->id == 3) {
                $transactionagentTopup = NULL;
                $userEntryManager = NULL;
            } else {
                $transactionagentTopup = TransactionAgentTopUp::whereUserId(Auth::user()->id)->where('type', 2)->where('status', 3)->orderBy('created_at', 'desc')->first();
                $userEntryManager = UserEntry::whereUserId(Auth::user()->id)->whereUserType(2)->whereStatus(1)->orderBy('id', 'desc')->first();

            }

            $transactionagentPointPurchase = TransactionPointPurchase::whereUserId(Auth::user()->id)->where('type', 2)->where('status', 1)->orderBy('created_at', 'desc')->first();
            $userEntryMillionaire = UserEntry::whereUserId(Auth::user()->id)->whereUserType(3)->whereStatus(1)->orderBy('id', 'desc')->first();

            //check if any pending request then cannot proceed to next page
            $transactionagentTopup_pending = TransactionAgentTopUp::whereUserId(Auth::user()->id)->where('to_wallet', 2)->where('status', 1)->where('type', 2)->first();
            $transactionagentTopupExecutive_pending = TransactionAgentTopUp::whereUserId(Auth::user()->id)->where('to_wallet', 1)->where('status', 1)->where('type', 2)->first();
            $transactionagentPointPurchase_pending = TransactionPointPurchase::whereUserId(Auth::user()->id)->where('status', 2)->where('type', 2)->first();

            $userEntryManager_pending = UserEntry::whereUserId(Auth::user()->id)->whereUserType(2)->whereStatus(2)->first();
            $userEntryMillionaire_pending = UserEntry::whereUserId(Auth::user()->id)->whereUserType(3)->whereStatus(2)->first();

            return view('user.upgrade-account-select', compact('transactionagentPointPurchase', 'transactionagentTopup', 'transactionagentTopup_pending', 'transactionagentTopupExecutive_pending', 'transactionagentPointPurchase_pending', 'userEntryMillionaire_pending','userEntryManager_pending', 'userEntryManager','userEntryMillionaire'));
        }else{
            return abort(404);
        }
    }

    public function upgradeAccount(string $type)
    {
        if(Auth::user()->status == 2){
            return back()->withErrors(['upgrade-account' => __('user-portal.your_account_is_not_verified_yet')]);
        }
//        $transactionagentTopup = TransactionAgentTopUp::whereUserId(Auth::user()->id)->where('status', 1)->where('type', 2)->first();
//        $transactionagentPointPurchase = TransactionPointPurchase::whereUserId(Auth::user()->id)->where('status', 2)->where('type', 2)->first();

        $userEntryManager_pending = UserEntry::whereUserId(Auth::user()->id)->whereUserId(Auth::user()->id)->whereUserType(2)->whereStatus(2)->first();
        $userEntryMillionaire_pending = UserEntry::whereUserId(Auth::user()->id)->whereUserId(Auth::user()->id)->whereUserType(3)->whereStatus(2)->first();

        if ($userEntryManager_pending || $userEntryMillionaire_pending) {
            return redirect(route('user.home'))->withErrors(['upgrade-account' => __('user-portal.you_have_one_application_to_upgrade_your_account_now')]);
        } else {
            if ($type == "manager") {
                //upgrade to manager look from table agent top up

                $payment_methods = PaymentMethod::whereIn('id', [1])->pluck('name', 'id');
                $point_package = PointPackage::find(2);
                //bank shows upline bank

                $user_entry = UserEntry::whereUserId(Auth::user()->id)->first();
                //1 check if upline isupgradeAccountMillionaireNew million or not
                $direct_upline = User::find(Auth::user()->direct_upline->id);
                if ($direct_upline->roles[0]->id != 2) {
                    return redirect(route('user.home'))->withErrors(['upgrade-account' => 'You cannot perform this action. Your upline is not Millionaire']);
                } else {
                    if ($direct_upline->bank_name == null) {
                        return redirect(route('user.home'))->withErrors(['upgrade-account' => 'Your upline bank info is not complete. Please try again later']);
                    }
                }
            }else if ($type == "executive") {
                    //upgrade to manager look from table agent top up

                    $payment_methods = PaymentMethod::whereIn('id', [1])->pluck('name', 'id');
                    $point_package = PointPackage::find(2);
                    //bank shows upline bank

                    $user_entry = UserEntry::whereUserId(Auth::user()->id)->first();
                    //1 check if upline isupgradeAccountMillionaireNew million or not
                    $direct_upline = User::find(Auth::user()->direct_upline->id);
                    if ($direct_upline->roles[0]->id == 3) { //upline not Millionaire or Manager
                        return redirect(route('user.home'))->withErrors(['upgrade-account' => 'You cannot perform this action. Your upline is not Millionaire or Manager']);
                    } else {
                        if ($direct_upline->bank_name == null) {
                            return redirect(route('user.home'))->withErrors(['upgrade-account' => 'Your upline bank info is not complete. Please try again later']);
                        }
                    }
            } else if ($type == 'million') {
                $payment_methods = PaymentMethod::whereIn('id', [1, 2])->pluck('name', 'id');
                $point_package = PointPackage::find(3);
                //check also if upline is million or not
                $user_entry = UserEntry::whereUserId(Auth::user()->id)->first();
                $direct_upline = User::find(Auth::user()->direct_upline->id);
                if ($direct_upline->roles[0]->id != 2) {
                    return redirect(route('user.home'))->withErrors(['upgrade-account' => 'You cannot perform this action. Your upline is not Millionaire']);
                }
                $bank = null;

            } else {
                return abort(404);
            }

            $deposit_bank = DepositBank::first();

            return view('user.upgrade-account', compact('payment_methods', 'deposit_bank', 'direct_upline', 'type', 'point_package', 'user_entry'));
        }
    }


    public function upgradeAccountManager(Request $request)
    {
        $point_package = PointPackage::find($request->point_package);

        $transactionAgentTopUp = TransactionAgentTopUp::create([
            'type' => 2,
            'user_id' => Auth::user()->id,
            'merchant_id' => Auth::user()->direct_upline->id,
            'from_wallet' => 3,
            'to_wallet' => 2,
            'amount' => 9800,
            'deposit_bank' => Auth::user()->direct_upline->bank_name,
            'deposit_bank_account_name' => Auth::user()->direct_upline->bank_account_name,
            'deposit_bank_account_number' => Auth::user()->direct_upline->bank_account_number,
            'point_package_id' => null,
            'status' => 1,
        ]);
        //view blade got upload second time for this photo to be available by plugin
        $transactionAgentTopUp->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt_photo'))))->toMediaCollection('receipt_photo');

        $transaction = TransactionIdLog::generateTransactionId('1', Auth::user()->id, $transactionAgentTopUp->id);

        $transactionAgentTopUp::where('id', $transactionAgentTopUp->id)->update([
            'transaction' => $transaction,
        ]);

        return redirect(route('user.home'))->with('message', __('user-portal.upgrade_request_sent_please_wait_for_approval'));
    }

    public function upgradeAccountExecutive2(Request $request)
    {
        $point_package = PointPackage::find($request->point_package);

        Log::info("fdfdf");

        if(Auth::user()->direct_upline->user_type == 3){
            $fromWallet = 3;
        }else if(Auth::user()->direct_upline->user_type == 2){
            $fromWallet = 2;
        }else{
            $fromWallet = 1;
        }

        $transactionAgentTopUp = TransactionAgentTopUp::create([
            'type' => 2,
            'user_id' => Auth::user()->id,
            'merchant_id' => Auth::user()->direct_upline->id,
            'from_wallet' => $fromWallet,
            'to_wallet' => 1,
            'amount' => 2800,
            'deposit_bank' => Auth::user()->direct_upline->bank_name,
            'deposit_bank_account_name' => Auth::user()->direct_upline->bank_account_name,
            'deposit_bank_account_number' => Auth::user()->direct_upline->bank_account_number,
            'point_package_id' => null,
            'status' => 1,
        ]);
        //view blade got upload second time for this photo to be available by plugin
        $transactionAgentTopUp->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt_photo'))))->toMediaCollection('receipt_photo');

        $transaction = TransactionIdLog::generateTransactionId('1', Auth::user()->id, $transactionAgentTopUp->id);

        $transactionAgentTopUp::where('id', $transactionAgentTopUp->id)->update([
            'transaction' => $transaction,
        ]);

        return redirect(route('user.home'))->with('message', __('user-portal.upgrade_request_sent_please_wait_for_approval'));
    }

    //millionaire view downline upgrade request
    public function viewUpgradeAccount($id)
    {
        $request_upgrade = TransactionAgentTopUp::find($id);
        if ($request_upgrade->status != 1) {
            return redirect(route('user.downline'));
        }

        return view('user.upgrade-account-view', compact('request_upgrade'));
    }

    //millionaire approve downline upgrade request
    public function upgradeAccountManagerAction($id)
    {
//        $point_package = PointPackage::find(2);

        //todo check if upline(me) has enough point to deduct, b4 do approval
//        if (getUserPointBalance(Auth::user()->id) < $point_package->deduct_point) {
//            return back()->withErrors(['error' => __('user-portal.insufficient_point_balance')]);
//        }

        DB::beginTransaction();
        try {
            //update agent top up transaction status and transfer point
            $transactionTopUp = TransactionAgentTopUp::find($id);
            TransactionAgentTopUp::find($id)->update([
                'status' => 2,
                'approved_at' => Carbon::now(),
                'merchant_pre_balance' => getUserPointBalance(Auth::user()->id),
                'merchant_post_balance' => getUserPointBalance(Auth::user()->id) - 9800,
                'user_pre_balance' => getUserPointBalance($transactionTopUp->user->id),
                'user_post_balance' => getUserPointBalance($transactionTopUp->user->id) + 9800,
            ]);

            $transactionTopUp = TransactionAgentTopUp::find($id);

//            $point_package = PointPackage::find($transactionTopUp->point_package_id); //gold package

            //hide point deduct
//            PointBalance::create([
//                'user_id' => $transactionTopUp->user->direct_upline->id,
//                'amount' => -$point_package->deduct_point,
//                'status' => 1,
//                'settlement' => 1,
//                'remark' => 'User Upgrade TopUp: ' . $transactionTopUp->transaction,
//            ]);
//
//            PointManagerBalance::create([
//                'user_id' => $transactionTopUp->user->id,
//                'amount' => $point_package->point,
//                'status' => 1,
//                'settlement' => 1,
//                'remark' => 'User Upgrade TopUp: ' . $transactionTopUp->transaction,
//            ]);


            //update downline roles
            if($transactionTopUp->to_wallet == 2){
                $transactionTopUp->user->roles()->sync(4);
                User::find($transactionTopUp->user->id)->update([
                    'user_type' => 2,
                ]);
            }


            $startDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s','2021-10-10 00:00:00');
            $endDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s','2021-10-12 23:59:59');
            $check_between_dates =  \Carbon\Carbon::parse($transactionTopUp->created_at)->between($startDate,$endDate);

            if($check_between_dates){
                addToCart($transactionTopUp->user->id, 40, 1);
            }

            DB::commit();
            return view('user.upgrade-account-complete', compact('transactionTopUp'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e);
            return redirect()->back()->withErrors(['message' => 'Some error occur. Please contact admin.']);
        }
    }

    public function upgradeAccountManagerReject($id)
    {
        TransactionAgentTopUp::find($id)->update([
            'status' => 3,
        ]);

        return redirect(route('user.downline'))->with('message', __('user-portal.upgrade_request_has_been_rejected'));
    }

    public function upgradeAccountMillionaire(Request $request){

            $point_package = PointPackage::find(3);
        if($request->payment_method == 1){


            $transactionPointPurchase = TransactionPointPurchase::create([
                'type' => 2,
                'point' => $point_package->point,
                'price' => $point_package->price,
                'deposit' => 2000,
                'fee' => 6000,
                'status' => 2,
                'gateway_status' => 3,
                'user_id' => Auth::user()->id,
                'point_package_id' => $point_package->id,
                'payment_method_id' => 1,
            ]);
            $transaction = TransactionIdLog::generateTransactionId('1', Auth::user()->id, $transactionPointPurchase->id);
            TransactionPointPurchase::where('id', $transactionPointPurchase->id)->update([
                'transaction' => $transaction,
            ]);


            $transactionPointPurchase->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');


            return redirect(route('user.home'))->with('message', __('user-portal.upgrade_request_sent_please_wait_for_approval'));
        }else{

            $transactionPointPurchase = TransactionPointPurchase::create([
                'type' => 2,
                'point' => $point_package->point,
                'price' => $point_package->price,
                'deposit' => 2000,
                'fee' => 6000,
                'status' => 2,
                'gateway_status' => 1,
                'user_id' => Auth::user()->id,
                'point_package_id' => $point_package->id,
                'payment_method_id' => 2,
            ]);
            $transaction = TransactionIdLog::generateTransactionId('1', Auth::user()->id, $transactionPointPurchase->id);
            TransactionPointPurchase::where('id', $transactionPointPurchase->id)->update([
                'transaction' => $transaction,
            ]);

            //goto payment method
            return redirect((new SenangPay(Auth::user()->name, Auth::user()->email, Auth::user()->phone, "Top Up Package and Upgrade Account" , $transaction, (2000 + 6000 + $point_package->price)))->paymentProcess());
        }


    }

    public function upgradeAccountMillionaireNew(Request $request){

//        $point_package = PointPackage::find(3);
        $deposit = $request->deposit;
        $fee = $request->fee;

        if($request->payment_method == 1){

            $userEntry = UserEntry::create([
                'user_id' => Auth::guard('user')->user()->id,
                'user_type' => 3,
                'deposit' => $deposit,
                'fee' => $fee,
                'top_up' => 0,
                'total' => $deposit+$fee,
                'status' => 2,
                'gateway_status' => 3,
                'payment_method_id' => 1,
            ]);

            $transaction = TransactionIdLog::generateTransactionId('7', Auth::user()->id, $userEntry->id);
            UserEntry::where('id', $userEntry->id)->update([
                'transaction' => $transaction,
            ]);

            $userEntry->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');

            return redirect(route('user.home'))->with('message', __('user-portal.upgrade_request_sent_please_wait_for_approval'));
        }else{

            $userEntry = UserEntry::create([
                'user_id' => Auth::guard('user')->user()->id,
                'user_type' => 3,
                'deposit' => $deposit,
                'fee' => $fee,
                'top_up' => 0,
                'total' => $deposit+$fee,
                'status' => 2,
                'gateway_status' => 1,
                'payment_method_id' => 2,
            ]);

            $transaction = TransactionIdLog::generateTransactionId('7', Auth::user()->id, $userEntry->id);
            UserEntry::where('id', $userEntry->id)->update([
                'transaction' => $transaction,
            ]);

            //goto payment method
            return redirect((new SenangPay(Auth::user()->name, Auth::user()->email, Auth::user()->phone, "Upgrade Account" , $transaction, ($deposit+$fee)))->paymentProcess());
        }


    }

    public function upgradeComplete(Request $request)
    {
        $userEntry = UserEntry::find($request->id);
        $return_data = [
            'transaction_id' => $userEntry->transaction,
            'date' => $userEntry->created_at,
        ];
        return view('user.upgrade-complete', compact('return_data'));
    }

    public function upgradeFailed(Request $request){
        $userEntry = UserEntry::find($request->id);
        $return_data = [
            'transaction_id' => $userEntry->transaction,
            'date' => $userEntry->created_at,
        ];
        return view('user.upgrade-failed', compact('return_data'));
    }

    public function upgradeAccountExecutiveShow(){
        $bank_list = BankList::all();
        $countries = Country::where('status', 1)->get();
        $roles = Role::whereGuardName('user')->pluck('name', 'id');
        $user = Auth::guard('user')->user();
        $directUpline = User::find($user->direct_upline_id);
        return view('user.auth.upgrade-vip-executive', ['countries' => $countries, 'roles' => $roles, 'bank_list' => $bank_list, 'user' => $user, 'direct_upline' => $directUpline]);
    }

    public function upgradeAccountExecutive(Request $request){

        $user = Auth::guard('user')->user();
        $this->upgradeExecutiveValidator($request->all())->validate();

        $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('first_payment_receipt'))))->toMediaCollection('first_payment_receipt_photo');

        $data = $request->all();

        $user->update([
            'user_type' => 1,
            'upgraded_at' => Carbon::now(),
        ]);
        $bank = BankList::find($data['bank']);
        $user->update([
            'bank_name' => $bank->bank_name,
            'bank_account_name' => $data['beneficiary_name'],
            'bank_account_number' => $data['bank_account'],
            'bank_list_id' => $bank->id,
        ]);

        $deposit = 1000;
        $fee = 0;
        $top_up = 0;

        //last record of UserEntry for deposit
        $lastUserEntry = UserEntry::where('deposit' , '!=' , 0)->where('total', '!=' , 0)->orderBy('created_at', 'desc')->first();
        $total = $lastUserEntry->deposit + 1000;

        UserEntry::create([
            'user_id' => $user->id,
            'user_type' => 1,
            'deposit' => $deposit,
            'fee' => $fee,
            'top_up' => $top_up,
            'total' => $total,
            'receipt_number' => DocumentNumberLog::generateDocumentNumber("2", $user->id),
            'new_receipt_number' => DocumentReceiptLog::generateDocumentNumber($user->id),
        ]);

        $user->roles()->sync(3);

        return redirect(route('user.home'))->with('message', __('user-portal.upgrade_request_sent_please_wait_for_approval'));
    }

    protected function upgradeExecutiveValidator(array $data)
    {
        return Validator::make($data, [

            'bank' => ['required', 'int'],
            'bank_account' => ['required', 'string'],
            'beneficiary_name' => ['required', 'string'],

            'payment_date' => ['required', 'string'],
            'first_payment_receipt' => ['required'],
        ]);
    }

}
