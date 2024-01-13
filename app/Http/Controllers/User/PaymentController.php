<?php

namespace App\Http\Controllers\User;

use App\CustomClass\SenangPay;
use App\Http\Controllers\Controller;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentMBRInvoiceLog;
use App\Models\DocumentNumberLog;
use App\Models\PaymentCallbackLog;
use App\Models\ShippingBalance;
use App\Models\TransactionPointPurchase;
use App\Models\TransactionShippingPurchase;
use App\Models\DocumentReceiptLog;
use App\Models\UserEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function paymentReturn(Request $request)
    {
        Log::info('Return url params from api: ' . $request);
        Log::info('Return full url from api: ' . $request->fullUrl());

        $status = $request->status_id;
        $order_id = $request->order_id; //this represent $transaction in erya system
        $transaction_id = $request->transaction_id;
        $msg = $request->msg;
        $return_hash = $request->hash;
        $status_id = $request->status_id;
        $request->secretKey = config('senangpay.secret_key');
        if (SenangPay::generateReturnHash($request) == $return_hash) {
            if (substr($order_id, 0, 6) == "ERYABP") {

                if ($status_id == "1") {//2 for pending authorization, 1 for successful and 0 for failed
                    //update back to topup order
                    $transactionPointPurchase = TransactionPointPurchase::where('transaction', $order_id)->first();

                    TransactionPointPurchase::where('transaction', $order_id)->update([
                        'gateway_response' => $msg,
                        'gateway_status' => 3,
                        'gateway_transaction' => $transaction_id,
                        'receipt_number' => DocumentReceiptLog::generateDocumentNumber($transactionPointPurchase->user->id)
                    ]);

                    return redirect(route('user.top-up-complete', ['id' => $transactionPointPurchase->id]));
                } else {
                    //update back to topup order
                    TransactionPointPurchase::where('transaction', $order_id)->update([
                        'status' => 1,
                        'gateway_response' => $msg,
                        'gateway_status' => 2,
                        'gateway_transaction' => $transaction_id,
                    ]);

                    $transactionPointPurchase = TransactionPointPurchase::where('transaction', $order_id)->first();

                    return redirect(route('user.top-up-failed', ['id' => $transactionPointPurchase->id]));
                }
            } else if (substr($order_id, 0, 6) == "ERYASP") {

                if ($status_id == "1") {//2 for pending authorization, 1 for successful and 0 for failed

                    // $tpp = TransactionPointPurchase::where('transaction', $order_id)->first();
                    $transactionShippingPurchase = TransactionShippingPurchase::where('transaction', $order_id)->first();

                    TransactionShippingPurchase::where('transaction', $order_id)->update([
                        'status' => 3,
                        'gateway_response' => $msg,
                        'gateway_status' => 3,
                        'gateway_transaction' => $transaction_id,
                        'receipt_number' => DocumentReceiptLog::generateDocumentNumber($transactionShippingPurchase->user->id)
                    ]);
                    // $transactionShippingPurchase = TransactionShippingPurchase::where('transaction', $order_id)->first();
                    $shippingBalancesCount = ShippingBalance::where('remark', 'Top Up Shipping Point: ' . $order_id)->count();
                    if ($shippingBalancesCount == 0) {
                        ShippingBalance::create([
                            'user_id' => $transactionShippingPurchase->user->id,
                            'amount' => $transactionShippingPurchase->point,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => 'Top Up Shipping Point: ' . $order_id,
                        ]);
                        // $documentMBRInvoiceLog = DocumentMBRInvoiceLog::generateDocumentNumber($transactionShippingPurchase->user_id, null, Date('y'), $transactionShippingPurchase->price, null, null);
                    }
                    return redirect(route('user.shipping-complete', ['id' => $transactionShippingPurchase->id]));
                } else {
                    TransactionShippingPurchase::where('transaction', $order_id)->update([
                        'status' => 1,
                        'gateway_response' => $msg,
                        'gateway_status' => 2,
                        'gateway_transaction' => $transaction_id,
                    ]);
                    $transactionShippingPurchase = TransactionShippingPurchase::where('transaction', $order_id)->first();

                    return redirect(route('user.shipping-failed', ['id' => $transactionShippingPurchase->id]));
                }
            }else if (substr($order_id, 0, 6) == "ERYAUA") {

                if ($status_id == "1") {//2 for pending authorization, 1 for successful and 0 for failed

                    //update back to topup order
                    $userEntry = UserEntry::where('transaction', $order_id)->first();

                    UserEntry::where('transaction', $order_id)->update([
                        'gateway_response' => $msg,
                        'gateway_status' => 3,
                        'gateway_transaction' => $transaction_id,
                        'receipt_number' => DocumentNumberLog::generateDocumentNumber("2", $userEntry->user->id),
                        'new_receipt_number' => DocumentReceiptLog::generateDocumentNumber($userEntry->user->id),
                        'new_invoice_number' => DocumentInvoiceLog::generateDocumentNumber($userEntry->user->id),
                    ]);

                    return redirect(route('user.top-up-complete', ['id' => $userEntry->id]));

                }else{
                    //update back to topup order
                    UserEntry::where('transaction', $order_id)->update([
                        'status' => 1,
                        'gateway_response' => $msg,
                        'gateway_status' => 2,
                        'gateway_transaction' => $transaction_id,
                    ]);

                    $userEntry = UserEntry::where('transaction', $order_id)->first();

                    return redirect(route('user.top-up-failed', ['id' => $userEntry->id]));
                }

            }
        } else {
            return view('user.top-up-failed');
        }
    }

    public function paymentCallback(Request $request)
    {
        Log::info('Callback url params from api: ' . $request);

        $order_id = $request->order_id;
        if (substr($order_id, 0, 6) == "ERYABP") {
            $transactionPointPurchase = TransactionPointPurchase::where('transaction', $order_id)->first();
            if ($transactionPointPurchase->gateway_transaction == NULL) {
                if ($request->status_id == "1") {//2 for pending authorization, 1 for successful and 0 for failed
                    TransactionPointPurchase::find($transactionPointPurchase->id)->update([
                        'status' => 3,
                        'gateway_response' => $request->msg,
                        'gateway_status' => 3,
                        'gateway_transaction' => $request->transaction_id,
                        'receipt_number' => DocumentReceiptLog::generateDocumentNumber($transactionPointPurchase->user->id)
                    ]);
                } else {
                    TransactionPointPurchase::where('transaction', $order_id)->update([
                        'status' => 1,
                        'gateway_response' => $request->msg,
                        'gateway_status' => 2,
                        'gateway_transaction' => $request->transaction_id,
                    ]);
                }
            }

            PaymentCallbackLog::create([
                'transaction' => $order_id,
                'remark' => "Top Up " . $transactionPointPurchase->name,
                'callback_data' => $request,
            ]);
        } else if (substr($order_id, 0, 6) == "ERYASP") {
            $transactionShippingPurchase = TransactionShippingPurchase::where('transaction', $order_id)->first();
            if ($transactionShippingPurchase->gateway_transaction == NULL) {
                if ($request->status_id == "1") {//2 for pending authorization, 1 for successful and 0 for failed
                    TransactionShippingPurchase::where('transaction', $order_id)->update([
                        'status' => 3,
                        'gateway_response' => $request->msg,
                        'gateway_status' => 3,
                        'gateway_transaction' => $request->transaction_id,
                        'receipt_number' => DocumentReceiptLog::generateDocumentNumber($transactionShippingPurchase->user->id)
                    ]);

                    $shippingBalancesCount = ShippingBalance::where('remark', 'Top Up Shipping Point: ' . $order_id)->count();
                    if ($shippingBalancesCount == 0) {
                        ShippingBalance::create([
                            'user_id' => $transactionShippingPurchase->user->id,
                            'amount' => $transactionShippingPurchase->point,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => 'Top Up Shipping Point: ' . $order_id,
                        ]);
                        // $documentMBRInvoiceLog = DocumentMBRInvoiceLog::generateDocumentNumber($transactionShippingPurchase->user_id, null, Date('y'), $transactionShippingPurchase->price, null, null);
                    }


                } else {
                    TransactionShippingPurchase::where('transaction', $order_id)->update([
                        'status' => 1,
                        'gateway_response' => $request->msg,
                        'gateway_status' => 2,
                        'gateway_transaction' => $request->transaction_id,
                    ]);
                }

                PaymentCallbackLog::create([
                    'transaction' => $order_id,
                    'remark' => "Top Up Shipping Point" . $transactionShippingPurchase->name,
                    'callback_data' => $request,
                ]);
            }
        }


        return "OK";
    }
}

