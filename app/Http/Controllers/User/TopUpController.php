<?php

namespace App\Http\Controllers\User;

use App\CustomClass\SenangPay;
use App\Http\Controllers\Controller;
use App\Models\DepositBank;
use App\Models\PaymentMethod;
use App\Models\PointPackage;
use App\Models\Role;
use App\Models\TransactionAgentTopUp;
use App\Models\TransactionIdLog;
use App\Models\TransactionPointPurchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class TopUpController extends Controller
{
    public function topUpExecutive()
    {
        $user_role_id = Auth::user()->roles[0]->id;

        if(Auth::user()->status == 2){
            return back()->withErrors(['upgrade-account' => __('user-portal.your_account_is_not_verified_yet')]);
        }

        if ($user_role_id == 3) { //normal top up
            $role = Role::find($user_role_id);
            $point_packages = $role->pointPackages;
        } else if ($user_role_id == 2 || $user_role_id == 4) { //clear 0
            $point_packages = PointPackage::where('id', 99)->get();
        }

        return view('user.top-up', compact('point_packages'));
    }

    public function topUpManager()
    {
        $user_role_id = Auth::user()->roles[0]->id;

        if ($user_role_id == 4) { //normal top up
            $role = Role::find($user_role_id);
            $point_packages = $role->pointPackages;
        } else if ($user_role_id == 2) { //clear 0
            $point_packages = PointPackage::where('id', 99)->get();
        }

        return view('user.top-up', compact('point_packages'));
    }

    public function topUpMillionaire()
    {
        $user_role_id = Auth::user()->roles[0]->id;

        if ($user_role_id == 2) { //normal top up
            $role = Role::find($user_role_id);
            $point_packages = $role->pointPackages;
        }

        return view('user.top-up', compact('point_packages'));
    }


    public function topUpHistory()
    {
        if (Auth::user()->roles[0]->id == 2) {
            $point_history = TransactionPointPurchase::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
            if (\Request::getRequestUri() == ('/user/top-up-history-manager')) {
                $point_history = TransactionAgentTopUp::where('user_id', Auth::user()->id)->where('to_wallet', 2)->orderBy('created_at', 'desc')->paginate(10);
            } elseif (\Request::getRequestUri() == ('/user/top-up-history-executive')) {
                $point_history = TransactionAgentTopUp::where('user_id', Auth::user()->id)->where('to_wallet', 1)->orderBy('created_at', 'desc')->paginate(10);
            }
        } else {
            $point_history = TransactionAgentTopUp::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('user.top-up-history', compact('point_history'));
    }


    public function topUpCheckOut($id)
    {
        if(Auth::user()->allow_order_status == 2) {
            return back();
        }

        $user = Auth::user();

        $point_package = PointPackage::find($id);
        $deposit_bank = DepositBank::first();

        if ($user->roles[0]->id == 3 || $user->roles[0]->id == 4) {
            $direct_upline = User::find($user->direct_upline->id);
            if ($direct_upline->bank_name == null) {
                return back()->withErrors(['upgrade-account' => __('user-portal.your_upline_bank_info_is_not_complete')]);
            }elseif(Auth::user()->status == 2){
                return back()->withErrors(['upgrade-account' => __('user-portal.your_account_is_not_verified_yet')]);
            }elseif( TransactionAgentTopUp::where('status', 1)->where('user_id', Auth::user()->id)->count() > 0){
                return back()->withErrors(['upgrade-account' => __('user-portal.please_wait_for_previous_request_to_complete_b4_making_another_topup')]);
            }
            $payment_methods = PaymentMethod::where('id', 1)->get()->pluck('name', 'id');
        } else {
            $direct_upline = null;
            if ($point_package->id != 99) {
                $payment_methods = PaymentMethod::whereIn('id', [1, 2])->pluck('name', 'id');
            } else {
                $payment_methods = PaymentMethod::whereIn('id', [1])->pluck('name', 'id');
            }
        }
        if (str_contains(url()->previous(), 'top-up-executive')) {
            return view('user.top-up-checkout', compact('point_package', 'payment_methods', 'deposit_bank', 'direct_upline'));
        } else if (str_contains(url()->previous(), 'top-up-manager')) {
            return view('user.top-up-checkout', compact('point_package', 'payment_methods', 'deposit_bank', 'direct_upline'));
        } else {
            return view('user.top-up-checkout', compact('point_package', 'payment_methods', 'deposit_bank', 'direct_upline'));
        }
    }

    public function topUpPayment(Request $request)
    {
        if(Auth::user()->allow_order_status == 2) {
            return back();
        }

        $user = Auth::user();
        $point_package = PointPackage::find($request->point_package_id);
        if ($user->roles[0]->id == 2) {
            if (str_contains(url()->previous(), 'top-up-checkout-executive') || str_contains(url()->previous(), 'top-up-checkout-manager')) {
                if (str_contains(url()->previous(), 'top-up-checkout-executive')) {
                    $wallet_type = 1;
                    $amount = 110 - (getUserExecutivePointBalance($user->id) % 110);
                } else if (str_contains(url()->previous(), 'top-up-checkout-manager')) {
                    $wallet_type = 2;
                    $amount = 100 - (getUserManagerPointBalance($user->id) % 100);
                }
                $transaction_data = [
                    'type' => 1,
                    'user_id' => $user->id,
                    'merchant_id' => $user->direct_upline->id, //as upline id now , not just merchant already
                    'amount' => $amount,
                    'to_wallet' => $wallet_type,
                    'status' => 1,
                    'deposit_bank' => $user->direct_upline->bank_name,
                    'deposit_bank_account_name' => $user->direct_upline->bank_account_name,
                    'deposit_bank_account_number' => $user->direct_upline->bank_account_number,
                    'point_package_id' => $point_package->id,
                ];

                $transactionAgentTopUp = TransactionAgentTopUp::create($transaction_data);
                $transactionAgentTopUp->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt_photo');

                $transaction = TransactionIdLog::generateTransactionId('1', $user->id, $transactionAgentTopUp->id);
                $transactionAgentTopUp::where('id', $transactionAgentTopUp->id)->update([
                    'transaction' => $transaction,
                ]);

                $return_data = [
                    'transaction_id' => $transaction,
                    'date' => $transactionAgentTopUp->created_at,
                    'balance_after' => $transactionAgentTopUp->amount + getUserPointBalance($user->id),
                ];

                return view('user.top-up-complete', compact('return_data'));
            } else {
                if ($request->payment_method == 1) {
                    //Merchant Top-up flow
                    $transaction_data = [
                        'type' => 1,
                        'point' => $point_package->point,
                        'price' => $point_package->price,
                        'status' => 2,
                        'gateway_status' => 1,
                        'user_id' => $user->id,
                        'point_package_id' => $point_package->id,
                        'payment_method_id' => $request->payment_method,
                    ];
                    $transactionPointPurchase = TransactionPointPurchase::create($transaction_data);
                    //follow seeder id 1 equals upload receipt
                    if ($request->payment_method == 1) {
                        $transactionPointPurchase->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
                    }

                    $transaction = TransactionIdLog::generateTransactionId('1', $user->id, $transactionPointPurchase->id);
                    TransactionPointPurchase::where('id', $transactionPointPurchase->id)->update([
                        'transaction' => $transaction,
                    ]);

                    $return_data = [
                        'transaction_id' => $transaction,
                        'date' => $transactionPointPurchase->created_at,
                        'balance_after' => $transactionPointPurchase->point + getUserPointBalance($user->id),
                    ];
                    return view('user.top-up-complete', compact('return_data'));
                } else if ($request->payment_method == 2) {

                    //Merchant Top-up flow
                    $transaction_data = [
                        'type' => 1,
                        'point' => $point_package->point,
                        'price' => $point_package->price,
                        'status' => 2,
                        'gateway_status' => 3,
                        'user_id' => $user->id,
                        'point_package_id' => $point_package->id,
                        'payment_method_id' => $request->payment_method,
                    ];
                    $transactionPointPurchase = TransactionPointPurchase::create($transaction_data);

                    $transaction = TransactionIdLog::generateTransactionId('1', $user->id, $transactionPointPurchase->id);
                    TransactionPointPurchase::where('id', $transactionPointPurchase->id)->update([
                        'transaction' => $transaction,
                    ]);


                    return redirect((new SenangPay($user->name, $user->email, $user->phone, "Top Up Package " . $point_package->name, $transaction, $point_package->price))->paymentProcess());
                }
            }

        } else if ($user->roles[0]->id == 4 || $user->roles[0]->id == 3) {
            if(Auth::user()->status == 2){
                return back()->withErrors(['upgrade-account' => __('user-portal.your_account_is_not_verified_yet')]);
            }else if( TransactionAgentTopUp::where('status', 1)->where('user_id', Auth::user()->id)->count() > 0){
                return back()->withErrors(['upgrade-account' => __('user-portal.please_wait_for_previous_request_to_complete_b4_making_another_topup')]);
            }
            //will get back here and check for manager top up
            $amount = 0;
            if (str_contains(url()->previous(), 'top-up-checkout-executive')) {
                $wallet_type = 1;
                if ($user->roles[0]->id == 4) {
                    $amount = 110 - (getUserExecutivePointBalance($user->id) % 110);
                }
            } else if (str_contains(url()->previous(), 'top-up-checkout-manager')) {
                $wallet_type = 2;
            }

            //Agent top up rquest to merchant
            $transaction_date = [
                'type' => 1,
                'user_id' => $user->id,
                'merchant_id' => $user->direct_upline->id, //as upline id now , not just merchant already
                'amount' => $amount != 0 ? $amount : $point_package->point,
                'to_wallet' => $wallet_type,
                'status' => 1,
                'deposit_bank' => $user->direct_upline->bank_name,
                'deposit_bank_account_name' => $user->direct_upline->bank_account_name,
                'deposit_bank_account_number' => $user->direct_upline->bank_account_number,
                'point_package_id' => $point_package->id,
            ];

            $transactionAgentTopUp = TransactionAgentTopUp::create($transaction_date);
            $transactionAgentTopUp->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt_photo');

            $transaction = TransactionIdLog::generateTransactionId('1', $user->id, $transactionAgentTopUp->id);
            $transactionAgentTopUp::where('id', $transactionAgentTopUp->id)->update([
                'transaction' => $transaction,
            ]);

            $return_data = [
                'transaction_id' => $transaction,
                'date' => $transactionAgentTopUp->created_at,
                'balance_after' => $transactionAgentTopUp->amount + getUserPointBalance($user->id),
            ];
        }

        return view('user.top-up-complete', compact('return_data'));
    }

    public function topUpComplete(Request $request)
    {
        $transactionPointPurchase = TransactionPointPurchase::find($request->id);
        $return_data = [
            'transaction_id' => $transactionPointPurchase->transaction,
            'date' => $transactionPointPurchase->created_at,
        ];
        return view('user.top-up-complete', compact('return_data'));
    }

    public function topUpFailed(Request $request){
        $transactionPointPurchase = TransactionPointPurchase::find($request->id);
        $return_data = [
            'transaction_id' => $transactionPointPurchase->transaction,
            'date' => $transactionPointPurchase->created_at,
        ];
        return view('user.top-up-failed', compact('return_data'));
    }

    public function topupReceiptPDF($id){

        $receipt = TransactionPointPurchase::find($id);
        $receipt->name ="Top Up Receipt";
        $receipt->footnote ="Foot Note";
        $pdf = PDF::loadView('user.print.top-up-receipt', compact('receipt'));
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($receipt->name.".pdf");
    }
}
