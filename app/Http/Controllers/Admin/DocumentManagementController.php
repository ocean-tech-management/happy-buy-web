<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DocumentNumberLog;
use App\Models\DocumentCreditNoteLog;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentPaymentVoucherLog;
use App\Models\DocumentReceiptLog;
use App\Models\DocumentShippingInvoiceLog;
use App\Models\DocumentMBRInvoiceLog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserEntry;
use App\Models\TransactionPointPurchase;
use App\Models\TransactionPointWithdraw;
use App\Models\TransactionShippingPurchase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DocumentManagementController extends Controller
{

    public function rearrangeInvoice(Request $request)
    {
        if(Auth::user()->id != 1) {
            die("STOP");
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('document_invoice_logs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $order = Order::select('id', 'invoice_number', 'created_at')->whereNotIn('user_id', [1,2,3])->where('status', 5)->get();
        $user_entries = UserEntry::select('id', 'deposit', 'fee', 'invoice_number', 'receipt_number', 'created_at')->whereNotIn('id',[1,2,3])->where('fee', '!=', 0)->get();
        $all = collect($order)->merge($user_entries)->sortBy('created_at');

        // $transaction_point_purchases = TransactionPointPurchase::select('id', 'invoice_number', 'created_at')->whereNotNull('invoice_number')->get();
        // $all = collect($order)->merge($user_entries)->merge($transaction_point_purchases)->sortBy('created_at');

        Order::whereNotNull('new_invoice_number')->update(['new_invoice_number' => null]);
        UserEntry::whereNotNull('new_invoice_number')->update(['new_invoice_number' => null]);
        // TransactionPointPurchase::whereNotNull('new_invoice_number')->update(['new_invoice_number' => null]);

        // dd($all, $order, $user_entries, $transaction_point_purchases);

        DB::beginTransaction();
        try {
            $x = 1;
            foreach ($all as $item) {
                switch ($item->table) {
                    case "orders":
                        $order = Order::findOrFail($item->id);
                        // Invoice_user_id confirm is millionaire
                        // Document invoice_log user_id is millionaire invoice_user_id,
                        // Order's Invoice_user_Id created_at must be late than user_agreement_logs's signature_at, user_agreement_id = 3
 
                        $user_id = $order->invoice_user_id;
                        if($order->invoice_user_id == null) {
                            $user = User::findOrfail($order->user_id);
                            $user_id = $user->upline_user_id;
                        }
                        $document_invoice_number = DocumentInvoiceLog::generateDocumentNumber($user_id, null, Carbon::parse($item->created_at)->format('y'));
                        DocumentInvoiceLog::where('name', $document_invoice_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                        $order->update([
                            'new_invoice_number' => $document_invoice_number,
                        ]);
                        break;
                    case "user_entries":
                        $user_entry = UserEntry::findOrFail($item->id);
                        $document_invoice_number = DocumentInvoiceLog::generateDocumentNumber($user_entry->user_id, null, Carbon::parse($item->created_at)->format('y'));
                        DocumentInvoiceLog::where('name', $document_invoice_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                        $user_entry->update([
                            'new_invoice_number' => $document_invoice_number,
                        ]);
                        break;
                    // case "transaction_point_purchases":
                    //     $transaction_point_purchases = TransactionPointPurchase::findOrFail($item->id);
                    //     $document_invoice_number = DocumentInvoiceLog::generateDocumentNumber($transaction_point_purchases->user_id, null, Carbon::parse($item->created_at)->format('y'));
                    //     DocumentInvoiceLog::where('name', $document_invoice_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                    //     $transaction_point_purchases->update([
                    //         'new_invoice_number' => $document_invoice_number,
                    //     ]);
                        break;
                    default:
                        die("Error - Table Not Found");
                }

                echo $x++ . ") " . "Table: " . $item->table . " ID: " . $item->id . " Created Time: " . $item->created_at . "<br>";
            }
            // dd($all, $order, $user_entries, $transaction_point_purchases);
            print("Completed Rearrange Invoice Document");
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        return back();
    }

    public function rearrangeReceipt(Request $request)
    {
        if(Auth::user()->id != 1) {
            die("STOP");
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('document_receipt_logs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $user_entries = UserEntry::select('id', 'receipt_number', 'created_at')->whereNotIn('id',[1,2,3])->where('deposit', '!=', 0)->get();
        // Switch Invoice to Receipt, So is checking invoice_number
        $transaction_point_purchases = TransactionPointPurchase::select('id', 'new_invoice_number', 'created_at')->whereNotNull('invoice_number')->get();
        $transaction_shipping_purchases = TransactionShippingPurchase::select('id', 'receipt_number', 'created_at')->where('gateway_status', 3)->get();
        $all = collect($user_entries)->merge($transaction_point_purchases)->merge($transaction_shipping_purchases)->sortBy('created_at');
        
        // User entries start with 4 
        UserEntry::whereNotNull('new_receipt_number')->update(['new_receipt_number' => null]);
        TransactionPointPurchase::whereNotNull('receipt_number')->update(['receipt_number' => null]);
        TransactionShippingPurchase::whereNotNull('receipt_number')->update(['receipt_number' => null]);
        // dd($all);
        // Shipping Purchase Receipt Number (Gateway Status 3)

        DB::beginTransaction();
        try {
            $x = 1;
            foreach ($all as $item) {
                switch ($item->table) {
                    case "user_entries":
                        $user_entry = UserEntry::findOrFail($item->id);
                        $document_receipt_number = DocumentReceiptLog::generateDocumentNumber($user_entry->user_id, null, Carbon::parse($item->created_at)->format('y'));
                        DocumentReceiptLog::where('name', $document_receipt_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                        $user_entry->update([
                            'new_receipt_number' => $document_receipt_number,
                        ]);
                        break;
                    case "transaction_point_purchases":
                        $transaction_point_purchases = TransactionPointPurchase::findOrFail($item->id);
                        $document_receipt_number = DocumentReceiptLog::generateDocumentNumber($transaction_point_purchases->user_id, null, Carbon::parse($item->created_at)->format('y'));
                        DocumentReceiptLog::where('name', $document_receipt_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                        $transaction_point_purchases->update([
                            'receipt_number' => $document_receipt_number,
                        ]);
                        break;
                    case "transaction_shipping_purchases":
                        $transaction_shipping_purchases = TransactionShippingPurchase::findOrFail($item->id);
                        $document_receipt_number = DocumentReceiptLog::generateDocumentNumber($transaction_shipping_purchases->user_id, null, Carbon::parse($item->created_at)->format('y'));
                        DocumentReceiptLog::where('name', $document_receipt_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                        $transaction_shipping_purchases->update([
                            'receipt_number' => $document_receipt_number,
                        ]);
                        break;
                    default:
                        die("Error - Table Not Found");
                }

                echo $x++ . ") " . "Table: " . $item->table . " ID: " . $item->id . " Created Time: " . $item->created_at . "<br>";
            }
            // dd($all, $order, $user_entries, $transaction_point_purchases);
            print("Completed Rearrange Receipt Document");
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        return back();
    }

    public function rearrangeShippingInvoice(Request $request)
    {
        if(Auth::user()->id != 1) {
            die("STOP");
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('document_shipping_invoice_logs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $order = Order::select('id', 'invoice_number', 'created_at')->whereNotNull('invoice_number')->where('collect_type', 2)->get();
        $all = collect($order)->sortBy('created_at');

        Order::whereNotNull('shipping_invoice_number')->update(['shipping_invoice_number' => null]);

        DB::beginTransaction();
        try {
            $x = 1;
            foreach ($all as $item) {
                switch ($item->table) {
                    case "orders":
                        $order = Order::findOrFail($item->id);
                        $document_shipping_invoice_number = DocumentShippingInvoiceLog::generateDocumentNumber($order->user_id, null, Carbon::parse($item->created_at)->format('y'));
                        DocumentShippingInvoiceLog::where('name', $document_shipping_invoice_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                        $order->update([
                            'shipping_invoice_number' => $document_shipping_invoice_number,
                        ]);
                        break;
                    default:
                        die("Error - Table Not Found");
                }

                echo $x++ . ") " . "Table: " . $item->table . " ID: " . $item->id . " Created Time: " . $item->created_at . "<br>";
            }
            // dd($all, $order, $user_entries, $transaction_point_purchases);
            print("Completed Rearrange Shipping Invoice Document");
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        return back();
    }

    public function rearrangePaymentVoucher(Request $request)
    {
        if(Auth::user()->id != 1) {
            die("STOP");
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('document_payment_voucher_logs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // $transaction_point_purchases = TransactionPointWithdraw::select('id', 'payment_voucher_number', 'created_at')->get();
        $transaction_point_withdraw = TransactionPointWithdraw::select('id', 'payment_voucher_number', 'created_at')->get();
        $all = collect($transaction_point_withdraw)->sortBy('created_at');
        // dd($all);
        TransactionPointWithdraw::whereNotNull('payment_voucher_number')->update(['payment_voucher_number' => null]);

        DB::beginTransaction();
        try {
            $x = 1;
            foreach ($all as $item) {
                switch ($item->table) {
                    case "transaction_point_withdraws":
                        $tpw = TransactionPointWithdraw::findOrFail($item->id);
                        $document_payment_voucher_number = DocumentPaymentVoucherLog::generateDocumentNumber($tpw->user_id, null, Carbon::parse($item->created_at)->format('y'));
                        DocumentPaymentVoucherLog::where('name', $document_payment_voucher_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                        $tpw->update([
                            'payment_voucher_number' => $document_payment_voucher_number,
                        ]);
                        break;
                    default:
                        die("Error - Table Not Found");
                }

                echo $x++ . ") " . "Table: " . $item->table . " ID: " . $item->id . " Created Time: " . $item->created_at . "<br>";
            }
            print("Completed Rearrange Payment Voucher Document");
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        return back();
    }

    public function rearrangeMBRInvoice(Request $request)
    {
        if(Auth::user()->id != 1) {
            die("STOP");
        }
        die("STOP");

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('document_mbr_invoice_logs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $order = Order::select('id', 'invoice_number', 'amount','invoice_user_id', 'user_id', 'created_at')->where('status', 5)->get();
        $transaction_point_purchases = TransactionPointPurchase::select('id', 'point', 'new_invoice_number', 'created_at')->whereNotNull('invoice_number')->get();
        $all = collect($order)->merge($transaction_point_purchases)->sortBy('created_at');

        DB::beginTransaction();
        try {
            $x = 1;
            foreach ($all as $item) {

                switch ($item->table) {
                    case "orders":
                        $user_id = $item->invoice_user_id;
                        $order_item = OrderItem::where('order_id', $item->id)->select(DB::raw('SUM(product_quantity) AS product_quantity'))->first(); 
                        $product_quantity = 1;
                        if($order_item) {
                            $product_quantity = $order_item->product_quantity;
                        }
                        if($item->invoice_user_id == null) {
                            $user = User::findOrfail($item->user_id);
                            $user_id = $user->upline_user_id;
                        }
                        $document_mbr_invoice_number = DocumentMBRInvoiceLog::generateDocumentNumber($user_id, null, Carbon::parse($item->created_at)->format('y'), $item->amount, $product_quantity);
                        DocumentMBRInvoiceLog::where('name', $document_mbr_invoice_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                        break;
                    case "transaction_point_purchases":
                        $transaction_point_purchases = TransactionPointPurchase::findOrFail($item->id);
                        $product_quantity = 0;
                        $document_mbr_invoice_number = DocumentMBRInvoiceLog::generateDocumentNumber($transaction_point_purchases->user_id, null, Carbon::parse($item->created_at)->format('y'), $item->point, $product_quantity);
                        DocumentMBRInvoiceLog::where('name', $document_mbr_invoice_number)->limit(1)->update(['created_at' => $item->created_at, 'updated_at' => $item->created_at]);
                        break;
                    default:
                        die("Error - Table Not Found");
                }

                echo $x++ . ") " . "Table: " . $item->table . " ID: " . $item->id . " Created Time: " . $item->created_at . "<br>";
            }
            print("Completed Rearrange MBR Invoice Document");
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        return back();
    }

    public function test_redemption_balance()
    {
        $startTime = "2022-02-10" . ' 00:00:00';
        $endTime = "2022-02-10" . ' 23:59:59';
        
        // $order = Order::whereStatus('5')->where('completed_at', '>=', $startTime)->where('completed_at', '<=', $endTime)->groupBy('user_id')->get();
        $order = Order::whereStatus('5')->where('completed_at', '>=', $startTime)->where('completed_at', '<=', $endTime)->where('user_id', 150)->get();

        // dd($order);
        foreach (Order::whereStatus('5')->where('completed_at', '>=', $startTime)->where('completed_at', '<=', $endTime)->where('user_id', 150)->cursor() as $value) {
            $totalRedemption = Order::whereStatus('5')
                ->where('completed_at', '>=', $startTime)
                ->where('completed_at', '<=', $endTime)
                ->whereIn('wallet_type', [1, 2, 3])
                ->whereRaw('IFNULL(cash_voucher_amount,0) = 0')
                ->whereUserId($value->user_id)
                ->sum('sub_total');
            dd($totalRedemption);
            $totalShipping = Order::whereStatus('5')
                ->where('completed_at', '>=', $startTime)
                ->where('completed_at', '<=', $endTime)
                ->whereUserId($value->user_id)
                ->sum('total_shipping');

            $pointTransaction = PointTransactionLog::whereUserId($value->user_id)->where('date', '=', Carbon::today()->subDay()->toDateString())->first();

            if ($pointTransaction) {
                $pointTransaction->update([
                    'total_redemption' => $totalRedemption,
                    'total_shipping' => $totalShipping,
                ]);
            } else {
                PointTransactionLog::create([
                    'top_up' => 0,
                    'point_convert' => 0,
                    'redemption' => $totalRedemption,
                    'shipping' => $totalShipping,
                    'cash_voucher' => 0,
                    'date' => Carbon::today()->subDay()->toDateString(),
                    'user_id' => $value->user_id,
                ]);
            }
        }
    }

    public function test_vip_double_balance() {
        $order = Order::findOrFail(2085);
        $pvAmount = 100;
        $cart_user = User::find($order->order_user_id);
        if(Carbon::parse($cart_user->date_of_birth)->month == date('n')){
            $orders = Order::where("order_user_id", $order->order_user_id)->where('status' ,'!=' , '4')->whereMonth('created_at', '=', date('n'))->whereYear('created_at', '=', date('Y'))->count();
            if(($orders - 1) == 0) {
                echo "Double Amount";

                $pvAmount = $pvAmount * 2;
            }
        }
        dd($order, $orders, Carbon::parse($cart_user->date_of_birth)->month, Date('m'), Date('n'), date('y'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
