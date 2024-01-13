<?php

namespace App\Http\Controllers\User;

use App\CustomClass\SenangPay;
use App\Http\Controllers\Controller;
use App\Models\DocumentInvoiceLog;
use App\Models\PaymentMethod;
use App\Models\ShippingPackage;
use App\Models\TransactionIdLog;
use App\Models\TransactionPointPurchase;
use App\Models\TransactionShippingPurchase;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function view(){

        $shipping_packages = ShippingPackage::all();
        return view('user.shipping', compact('shipping_packages'));
    }

    public function checkout($id){

        if(Auth::user()->status == 2){
            return back()->withErrors(['upgrade-account' => __('user-portal.your_account_is_not_verified_yet')]);
        }

        if(Auth::user()->allow_order_status == 2) {
            return back();
        }
        
        $shipping_package = ShippingPackage::find($id);

        $payment_methods = PaymentMethod::whereIn('id', [2])->pluck('name', 'id');

        return view('user.shipping-checkout', compact('shipping_package', 'payment_methods'));
    }

    public function payment(Request $request){
        $shipping_package = ShippingPackage::find($request->shipping_package_id);

        $transactionShippingPurchase = TransactionShippingPurchase::create([
            'user_id' => Auth::user()->id,
            'shipping_package_id' => $shipping_package->id,
            'point' => $shipping_package->point,
            'price' => $shipping_package->price,
            'payment_method_id' => $request->payment_method,
            'status' => 2,
            'gateway_status'=> 1,
        ]);

        $transaction = TransactionIdLog::generateTransactionId('6',  Auth::user()->id, $transactionShippingPurchase->id);
        TransactionShippingPurchase::where('id', $transactionShippingPurchase->id)->update([
            'transaction' => $transaction,
        ]);

        return redirect((new SenangPay(Auth::user()->name, Auth::user()->email, Auth::user()->phone, "Top Up Shipping Point Package " . $shipping_package->name, $transaction, $shipping_package->price))->paymentProcess());

    }

    public function complete(Request $request){

        $transactionShippingPurchase = TransactionShippingPurchase::find($request->id);
        $return_data = [
            'transaction_id' => $transactionShippingPurchase->transaction,
            'date' => $transactionShippingPurchase->created_at,
            'balance_after' => $transactionShippingPurchase->point + getUserShippingBalance($transactionShippingPurchase->user->id),
        ];
        return view('user.shipping-complete', compact('return_data'));
    }

    public function failed(Request $request){
        $transactionShippingPurchase = TransactionShippingPurchase::find($request->id);
        $return_data = [
            'transaction_id' => $transactionShippingPurchase->transaction,
            'date' => $transactionShippingPurchase->created_at,
        ];
        return view('user.shipping-failed', compact('return_data'));
    }

    public function history(){
        $point_history = TransactionShippingPurchase::where('user_id', Auth::user()->id)->paginate(10);
        return view('user.shipping-history', compact('point_history'));
    }

    public function shippingInvoicePDF($id){

        $invoice = TransactionShippingPurchase::find($id);
        $invoice->name ="Shipping Invoice";
        $invoice->footnote ="Foot Note";

        $invoice_logs = DocumentInvoiceLog::where('name', $invoice->new_invoice_number)->first();
        if($invoice_logs) {
            $from_user = User::where('id', $invoice_logs->from_user_id)->first();
            if(!in_array($from_user->id, [1,2,3], true)) {
                $invoice->from_name = $from_user->name;
                $invoice->from_email = $from_user->email;
                $invoice->from_phone = $from_user->phone;
            }
        }

        $pdf = PDF::loadView('user.print.shipping-invoice', compact('invoice'));
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($invoice->name.".pdf");
    }
}
