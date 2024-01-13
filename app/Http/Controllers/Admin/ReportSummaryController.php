<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DepositSummaryExport;
use App\Exports\DepositBalanceExport;
use App\Exports\JoiningFeeExport;
use App\Exports\StockCreditSummaryExport;
use App\Exports\StockCreditBalanceExport;
use App\Exports\stockCreditBalanceTopupMillionaireExport;
use App\Exports\StockCreditBalanceTopupMillionaireDetailExport;
use App\Exports\StockCreditBalanceTopupAgentExport;
use App\Exports\StockCreditBalanceTopupAgentDetailExport;
use App\Exports\ShippingCreditSummaryExport;
use App\Exports\ShippingCreditBalanceExport;
use App\Exports\BonusCreditSummaryExport;
use App\Exports\BonusCreditBalanceExport;
use App\Exports\VoucherCreditSummaryExport;
use App\Exports\VoucherCreditBalanceExport;
use App\Exports\GetBalanceRankingExport;
use App\Exports\MBRExport;
use App\Http\Controllers\Controller;
use App\Models\TransactionPointPurchase;
use App\Models\TransactionPointWithdraw;
use App\Models\TransactionShippingPurchase;
use App\Models\TransactionAgentTopUp;
use App\Models\UserEntry;
use App\Models\User;
use App\Models\Order;
use App\Models\PointConvert;
use App\Models\PointBonusBalance;
use App\Models\VoucherBalance;
use App\Models\ReportStockCredit;
use App\Models\ReportShippingCredit;
use App\Models\ReportBonusCredit;
use App\Models\ReportVoucherCredit;
use App\Models\DocumentMBRInvoiceLog;
use App\Models\PointBalance;
use App\Models\PointManagerBalance;
use App\Models\PointExecutiveBalance;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReportSummaryController extends Controller
{

    private $default_start_date;
    public function __construct()
    {
        $this->default_start_date = "2021-09-15 00:00:00";
    }

    //
    public function summary(Request $request)
    {
        $totalDeposit = UserEntry::where('user_type','!=',4)->whereNotNull('deposit')->where('deposit','!=', 0)->sum('deposit');

        $totalFee = UserEntry::where('user_type','!=',4)->whereNotNull('fee')->where('fee','!=', 0)->sum('fee');

        $totalTopup = TransactionPointPurchase::whereType(1)->whereStatus(3)->sum('price');

        $totalShippingTopup = TransactionShippingPurchase::whereStatus(3)->whereGatewayStatus(3)->sum('price');

        $totalUpgradeTopup = TransactionPointPurchase::whereType(2)->whereStatus(3)->sum('price');

        $totalWithdraw = TransactionPointWithdraw::whereStatus(2)->sum('amount');


        return view('admin.report.summary', compact('totalDeposit', 'totalFee', 'totalTopup', 'totalShippingTopup', 'totalUpgradeTopup', 'totalWithdraw'));
    }

    public function depositSummary(Request $request)
    {
//        abort_if(Gate::denies('user_entry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserEntry::with(['user'])->whereNotIn('user_id',[1,2,3])->where('user_type', '!=', 4)->whereNotNull('deposit')->where('deposit','!=', 0)->search($request)->select(sprintf('*', (new UserEntry())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_entry_show';
                $editGate = 'user_entry_edit';
                $deleteGate = 'user_entry_delete';
                $crudRoutePart = 'user-entries';

                return view('partials.datatablesActions_DepositSummary', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user_type', function ($row) {
                return $row->user_type ? UserEntry::USER_TYPE_SELECT[$row->user_type] : '';
            });
            $table->editColumn('deposit', function ($row) {
                return $row->deposit ? $row->deposit : '';
            });
            $table->editColumn('description', function ($row) {
                return trans('cruds.userEntry.fields.deposit');
            });
            $table->editColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });
            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });
            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.report.deposit-summary');
    }

    public function depositSummaryExport(Request $request)
    {

        $filename = 'EryaDepositSummary'.date('YmdHis').'.xlsx';

        return Excel::download(new DepositSummaryExport($request), $filename);
    }


    public function depositBalance(Request $request)
    {
        if ($request->ajax()) {
            // $date = "2021-09-15";

            $query = UserEntry::with(['user'])->whereNotIn('user_id',[1,2,3])->where('user_type', '!=', 4)
            ->whereNotNull('deposit')->where('deposit','!=', 0)->groupBy('user_id')->search($request)
            ->select(
                sprintf('*', (new UserEntry())->table),
                DB::raw("SUM(user_entries.deposit) AS personalAmount"),
            );
            // $query = UserEntry::leftJoin('users AS u', function ($join) use ($request) {
            //     $join->on('u.id', '=', 'user_entries.user_id')
            //     ->whereDate('user_entries.created_at', '=', $request->date);
            // })
            // ->whereNotIn('user_id',[1,2,3])
            // ->where('u.user_type', '!=', 4)
            // ->whereNotNull('deposit')
            // ->where('deposit','!=', 0)
            // ->select(
            //     'user_entries.id AS id',
            //     'u.identity_no AS user_ic_number',
            //     'u.id AS user_id',
            //     'u.name AS user_name',
            //     DB::raw("IFNULL(SUM(CASE WHEN DATE(user_entries.created_at) = '$date' THEN user_entries.deposit END), '0') AS amount"),
            //     'user_entries.total AS total'
            // )
            // ->groupBy('u.id');
            // $userIdArray = $query->pluck('user_id');

            // $query2 = UserEntry::leftJoin('users AS u', function ($join) use ($date) {
            //     $join->on('u.id', '=', 'user_entries.user_id');
            // })
            // ->whereIn('user_id', $userIdArray)
            // ->where('u.user_type', '!=', 4)
            // ->whereNotNull('deposit')
            // ->where('deposit','!=', 0)
            // ->select([
            //     DB::raw('SUM(user_entries.deposit) AS total'),
            // ])
            // ->groupBy('u.id')->pluck('total');

            // $result = $query->get();
            // foreach ($result as $key => $item) {
            //     $result[$key]['total'] = $query2[$key];
            // }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_entry_show';
                $editGate = 'user_entry_edit';
                $deleteGate = 'user_entry_delete';
                $crudRoutePart = 'user-entries';

                return view('partials.datatablesActions_DepositBalance', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : '';
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) {
                if($row->personalAmount && $row->personalAmount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->personalAmount;
                }
                return $amount;
            });

            // $table->editColumn('total', function ($row) {
            //     return $row->total ? $row->total : '';
            // });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.report.deposit-balance');
    }

    public function depositBalanceDetail($memberId) {
        $deposit = UserEntry::where('user_type','!=',4)->where('user_id', $memberId)->whereNotNull('deposit')->where('deposit','!=', 0)->get();
        $user = User::findOrfail($memberId);
        // dd($deposit, $user);

        return view('admin.report.deposit-balance-detail', compact('deposit', 'user'));
    }

    public function depositBalanceExport(Request $request)
    {
        $filename = 'EryaDepositBalance'.date('YmdHis').'.xlsx';
        return Excel::download(new DepositBalanceExport($request), $filename);
    }

    public function joiningFee(Request $request) {
        if ($request->ajax()) {
            $total = 0;
            // DB::statement(DB::raw('set @total=0'));
            // DB::raw('@total  := @total + fee AS total')
            $query = UserEntry::with(['user'])->whereNotIn('user_id',[1,2,3])->where('user_type', '!=', 4)->whereNotNull('fee')->where('fee','!=', 0)->search($request)->select(sprintf('*', (new UserEntry())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : '';
            });

            $table->editColumn('new_invoice_number', function ($row) {
                // return $row->new_invoice_number ? $row->new_invoice_number : '';
                return $row->new_invoice_number ? "<a href=".route('admin.user-entries.fee-invoice', $row->id)." target='_blank'>".$row->new_invoice_number."</a><br/>" : '';
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->fee ? $row->fee : '';
            });

            $table->editColumn('total', function ($row) use ($total) {
                return $row->total ? $row->total : '';
            });

            $table->rawColumns(['placeholder', 'user', 'new_invoice_number']);

            return $table->make(true);
        }

        return view('admin.report.joining-fee');
    }

    public function joiningFeeExport(Request $request)
    {
        $filename = 'EryaJoiningFee'.date('YmdHis').'.xlsx';
        return Excel::download(new JoiningFeeExport($request), $filename);
    }

    public function stockCreditSummary(Request $request) {
        if ($request->ajax()) {
            $query = ReportStockCredit::with(['user'])->search($request)
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')            
            ->select(sprintf('*', (new ReportStockCredit())->table));
            // $query->whereIn('top_up_type', [0,1]);

            // if($request->route()->getName() == "admin.reports.stock-credit-summary-millionaire") {
            //     $query->whereIn('top_up_type', [0,1]);
            // } else {
            //     $query->whereIn('top_up_type', [0,2]);
            // }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->editColumn('document_no', function ($row) use ($request) {
                switch($row->from_table) {
                    case "transaction_point_purchases":
                        return "<a href=".route('admin.transaction-point-purchases.top-up-receipt', $row->from_table_id)." target='_blank'>".$row->document_no."</a><br/>";
                        break;
                    case "orders":
                        return "<a href=".route('admin.orders.invoice-pdf', $row->from_table_id)." target='_blank'>".$row->document_no."</a><br/>";
                        break;
                    case "transaction_agent_top_ups":
                        break;
                    case "point_converts":
                        break;
                    default:
                        return "<a href=".route('admin.transaction-point-purchases.top-up-receipt', $row->from_table_id)." target='_blank'>".$row->document_no."</a><br/>";
                };
                return null;
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->editColumn('amount', function ($row) {
                if($row->amount && $row->amount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->amount;
                }
                return $amount;
            });

            $table->editColumn('total', function ($row) use ($request) {
                $sub_total = $row->total;
                if($sub_total && $sub_total == 0) {
                    $total = "0";
                } else {
                    $total = $sub_total;
                }
                return $total;
            });

            $table->rawColumns(['placeholder', 'document_no', 'user']);

            return $table->make(true);
        }

        return view('admin.report.stock-credit-summary');
    }

    public function stockCreditSummaryExport(Request $request)
    {
        $filename = 'EryaStockCreditSummary'.date('YmdHis').'.xlsx';
        return Excel::download(new StockCreditSummaryExport($request), $filename);
    }


    # Notes
    # IF point_balances tables does not update also display wrong result.
    public function stockCreditBalance(Request $request) {
        if ($request->ajax()) {

            $query = ReportStockCredit::with(['user'])
            ->search($request)
            ->whereHas('user', fn ($query) =>
                $query->where('user_type', 3)->whereNotIn('id', [1,2,3])
            )
            ->whereIn('top_up_type', [0,1])
            // ->whereRaw('(CASE WHEN report_stock_credits.from_table = "transaction_agent_top_ups" THEN report_stock_credits.top_up_type = 1 ELSE report_stock_credits.top_up_type = 0 END)')
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
            ->whereIn('report_stock_credits.from_wallet', [0,3])
            // ->whereIn('top_up_type', [0,1])
            ->groupBy('report_stock_credits.user_id')
            ->select(
                sprintf('*', (new ReportStockCredit())->table),
                DB::raw('SUM(report_stock_credits.amount) AS personalAmount'),
            );

            $orderArray = Order::select('user_id', DB::raw('SUM(amount) AS pendingAmount'))
            ->where('wallet_type', 3)
            ->whereRaw('(invoice_user_id IS NOT NULL AND invoice_user_id = user_id)')
            ->whereIn('status', [1,2,3])->groupBy('user_id')
            // ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->whereBetween('created_at', [$request->start_date != null ? $request->start_date : $this->default_start_date, $request->end_date != null ? $request->end_date : Carbon::now()])
            ->pluck('pendingAmount','user_id')->toArray();
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_entry_show';
                $editGate = 'user_entry_edit';
                $deleteGate = 'user_entry_delete';
                $crudRoutePart = 'user-entries';
                return view('partials.datatablesActions_StockCreditBalance', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) use ($orderArray) {
                if(array_key_exists($row->user->id, $orderArray)) {
                    $pendingAmount = $orderArray[$row->user->id];
                } else {
                    $pendingAmount = 0;
                }
                if($row->personalAmount && $row->personalAmount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->personalAmount - $pendingAmount;
                }
                return $amount;
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'total']);

            return $table->make(true);
        }

        return view('admin.report.stock-credit-balance');
    }

    public function stockCreditBalanceDetail($memberId) {
        $stock_credit = ReportStockCredit::where('user_id', $memberId)->whereIn('top_up_type', [0,1])->whereIn('from_wallet',[0,3])
        ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
        ->get();

        DB::statement(DB::raw("set @order_table='orders'"));

        $order = Order::where('user_id', $memberId)->whereRaw('(invoice_user_id IS NOT NULL AND invoice_user_id = user_id)')->whereIn('status', [1,2,3])->where('wallet_type', 3)
        ->select(
        'id AS from_table_id',
        'created_at AS transaction_date',
        'new_invoice_number',
        DB::raw("(CASE
        WHEN (status = 1) THEN 'Sales (Pending)'
        WHEN (status = 2) THEN 'Sales (Shipped)'
        WHEN (status = 3) THEN 'Sales (Picked Up)'
        ELSE 0
        END) AS description"),
        DB::raw('(-1 * amount) AS amount'),
        // 'amount',
        DB::raw("@order_table AS from_table"),
        )->get();

        $all = collect($stock_credit)->merge($order)->sortBy('transaction_date');

        // dd($stock_credit, $order, $all);

        $user = User::findOrfail($memberId);

        return view('admin.report.stock-credit-detail', compact('all', 'user'));
    }

    public function stockCreditBalanceExport(Request $request)
    {
        $filename = 'EryaStockCreditBalance'.date('YmdHis').'.xlsx';
        return Excel::download(new StockCreditBalanceExport($request), $filename);
    }

    // TODO: Check filter start_date must be before end_date.
    // TODO: Sum previous filter start_date amount.
    // TODO: Only Need TOP UP and SALES, No Need AGENT TOP UP, - ALREADY DONE (NO CHANGING)
    // Stock Credit Balance Top Up (Millionaire)
    public function stockCreditBalanceTopupMillionaire(Request $request) 
    {
        if ($request->ajax()) {
            $query = ReportStockCredit::with(['user'])
            ->search($request)
            ->whereHas('user', fn ($query) =>
                $query->where('user_type', 3)->whereNotIn('id', [1,2,3])
            )
            ->whereIn('report_stock_credits.from_wallet', [0,3])
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
            ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
            ->where('report_stock_credits.from_table', '!=', 'point_converts')
            ->groupBy('report_stock_credits.user_id')
            ->select(
                sprintf('*', (new ReportStockCredit())->table),
                DB::raw('SUM(report_stock_credits.amount) AS personalAmount'),
            );

            // Get Previous Balance when have filter start_date
            if($request->has('start_date') && filled($request['start_date'])) {
                $userIdArray = $query->pluck('user_id');
                $pbQuery = ReportStockCredit::with(['user'])->whereHas('user', fn ($q) =>
                    $q->where('user_type', 3)->whereNotIn('id', [1,2,3])
                )
                ->where('transaction_date', '<=', $request['start_date']." 00:00:00")
                ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
                ->whereIn('top_up_type', [0,1])
                ->whereIn('report_stock_credits.from_wallet', [0,3])
                ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
                ->where('report_stock_credits.from_table', '!=', 'point_converts')
                ->whereIn('report_stock_credits.user_id', $userIdArray)
                ->groupBy('report_stock_credits.user_id')
                ->select(
                    'user_id',
                    DB::raw('SUM(report_stock_credits.amount) AS previousBalanceAmount'),
                );

                $query = $query->get();
                $pbData = $pbQuery->get();
                $filtered = $query->filter(function ($item) use ($pbData) {
                    foreach($pbData as $key => $pbItem) {
                        if($item->user_id == $pbItem->user_id) {
                            $item->personalAmount += $pbItem->previousBalanceAmount;
                            return $item;
                        }
                    }
                    return $item;
                });
            } else {
                $filtered = $query;
            }

            $orderArray = Order::select('user_id', DB::raw('SUM(amount) AS pendingAmount'))
            ->where('wallet_type', 3)
            ->whereRaw('(invoice_user_id IS NOT NULL AND invoice_user_id = user_id)')
            ->whereIn('status', [1,2,3])->groupBy('user_id')
            ->whereBetween('created_at', [$request->start_date != null ? $request->start_date : $this->default_start_date, $request->end_date != null ? $request->end_date : Carbon::now()])
            ->pluck('pendingAmount','user_id')->toArray();
            
            $table = Datatables::of($filtered);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) use ($request) {
                $viewGate = 'user_entry_show';
                $editGate = 'user_entry_edit';
                $deleteGate = 'user_entry_delete';
                $crudRoutePart = 'user-entries';
                return view('partials.datatablesActions_StockCreditBalanceMillionaireTopup', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row',
                    'request'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) use ($orderArray) {
                if(array_key_exists($row->user->id, $orderArray)) {
                    $pendingAmount = $orderArray[$row->user->id];
                } else {
                    $pendingAmount = 0;
                }
                if($row->personalAmount && $row->personalAmount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->personalAmount - $pendingAmount;
                }
                return $amount;
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'total']);

            return $table->make(true);
        }

        return view('admin.report.stock-credit-balance-millionaire-topup');
    }

    // TODO: In Detail Display filter start date amount on the top.
    public function stockCreditBalanceTopupMillionaireDetail($memberId, Request $request) 
    {
        $previousBalance = 0;
        if($request->has('start_date') && filled($request['start_date'])) {
            $pbQuery = ReportStockCredit::with(['user'])->whereHas('user', fn ($q) =>
                $q->where('user_type', 3)->whereNotIn('id', [1,2,3])
            )
            ->where('transaction_date', '<=', $request['start_date']." 00:00:00")
            ->whereIn('report_stock_credits.from_wallet', [0,3])
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
            ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
            ->where('report_stock_credits.from_table', '!=', 'point_converts')
            ->where('report_stock_credits.user_id', $memberId)
            ->select(
                DB::raw('SUM(report_stock_credits.amount) AS previousBalanceAmount'),
            )->first();
            if($pbQuery) {
                $previousBalance = $pbQuery->previousBalanceAmount;
            }
        }

        $stock_credit = ReportStockCredit::where('user_id', $memberId)
        ->search($request)
        ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
        ->where('report_stock_credits.from_table', '!=', 'point_converts')
        ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
        ->whereBetween('report_stock_credits.transaction_date', [$request->start_date != null ? $request->start_date : $this->default_start_date, $request->end_date != null ? $request->end_date : Carbon::now()])
        ->whereIn('top_up_type', [0,1])->whereIn('from_wallet',[0,3])->get();

        DB::statement(DB::raw("set @order_table='orders'"));

        $order = Order::where('user_id', $memberId)
        ->whereRaw('(invoice_user_id IS NOT NULL AND invoice_user_id = user_id)')->whereIn('status', [1,2,3])->where('wallet_type', 3)
        ->whereBetween('created_at', [$request->start_date != null ? $request->start_date : $this->default_start_date, $request->end_date != null ? $request->end_date : Carbon::now()])
        ->select(
            'id AS from_table_id',
            'created_at AS transaction_date',
            'new_invoice_number',
            DB::raw("(CASE
            WHEN (status = 1) THEN 'Sales (Pending)'
            WHEN (status = 2) THEN 'Sales (Shipped)'
            WHEN (status = 3) THEN 'Sales (Picked Up)'
            ELSE 0
            END) AS description"),
            DB::raw('(-1 * amount) AS amount'),
            DB::raw("@order_table AS from_table"),
        )->get();

        $all = collect($stock_credit)->merge($order)->sortBy('transaction_date');

        // dd($stock_credit, $order, $all);

        $user = User::findOrfail($memberId);

        return view('admin.report.stock-credit-topup-millionaire-detail', compact('all', 'user', 'previousBalance', 'request'));
    }

    public function stockCreditBalanceTopupMillionaireExport(Request $request)
    {
        $filename = 'EryaStockCreditBalanceMillionaireTopup'.date('YmdHis').'.xlsx';
        return Excel::download(new stockCreditBalanceTopupMillionaireExport($request), $filename);
    }

    public function stockCreditBalanceTopupMillionaireDetailExport(Request $request)
    {
        $filename = 'EryaStockCreditBalanceMillionaireTopupDetail'.date('YmdHis').'.xlsx';
        return Excel::download(new StockCreditBalanceTopupMillionaireDetailExport($request), $filename);
    }


    // Stock Credit Balance Top Up (Agent)
    public function stockCreditBalanceTopupAgent(Request $request) 
    {
        if ($request->ajax()) {
            $query = ReportStockCredit::with(['user'])
            ->search($request)
            ->whereHas('user', fn ($query) =>
                $query->whereIn('user_type', [1,2])->whereNotIn('id', [1,2,3])
            )
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type IN (1,2) ELSE report_stock_credits.order_wallet_type = 0 END)')
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "transaction_agent_top_ups" THEN report_stock_credits.top_up_type = 2 ELSE report_stock_credits.top_up_type = 0 END)')
            ->whereIn('report_stock_credits.from_wallet', [0,3])
            ->where('report_stock_credits.from_table', '!=', 'transaction_point_purchases')
            ->where('report_stock_credits.from_table', '!=', 'point_converts')
            ->groupBy('report_stock_credits.user_id')
            ->select(
                sprintf('*', (new ReportStockCredit())->table),
                DB::raw('SUM(report_stock_credits.amount) AS personalAmount'),
            );

            if($request->has('start_date') && filled($request['start_date'])) {
                $userIdArray = $query->pluck('user_id');
                $pbQuery = ReportStockCredit::with(['user'])->whereHas('user', fn ($q) =>
                    $q->whereIn('user_type', [1,2])->whereNotIn('id', [1,2,3])
                )
                ->where('transaction_date', '<=', $request['start_date']." 00:00:00")
                ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type IN (1,2) ELSE report_stock_credits.order_wallet_type = 0 END)')
                ->whereRaw('(CASE WHEN report_stock_credits.from_table = "transaction_agent_top_ups" THEN report_stock_credits.top_up_type = 2 ELSE report_stock_credits.top_up_type = 0 END)')
                ->where('report_stock_credits.from_table', '!=', 'transaction_point_purchases')
                ->where('report_stock_credits.from_table', '!=', 'point_converts')
                ->whereIn('report_stock_credits.user_id', $userIdArray)
                ->groupBy('report_stock_credits.user_id')
                ->select(
                    'user_id',
                    DB::raw('SUM(report_stock_credits.amount) AS previousBalanceAmount'),
                );

                $query = $query->get();
                $pbData = $pbQuery->get();
                $filtered = $query->filter(function ($item) use ($pbData) {
                    foreach($pbData as $key => $pbItem) {
                        if($item->user_id == $pbItem->user_id) {
                            $item->personalAmount += $pbItem->previousBalanceAmount;
                            return $item;
                        }
                    }
                    return $item;
                });
            } else {
                $filtered = $query;
            }

            $orderArray = Order::select('user_id', DB::raw('SUM(amount) AS pendingAmount'))
            ->whereIn('wallet_type', [1,2])
            ->whereIn('status', [1,2,3])->groupBy('user_id')
            ->whereBetween('created_at', [$request->start_date != null ? $request->start_date : $this->default_start_date, $request->end_date != null ? $request->end_date : Carbon::now()])
            ->pluck('pendingAmount','user_id')->toArray();
            
            $table = Datatables::of($filtered);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) use ($request) {
                $viewGate = 'user_entry_show';
                $editGate = 'user_entry_edit';
                $deleteGate = 'user_entry_delete';
                $crudRoutePart = 'user-entries';
                return view('partials.datatablesActions_StockCreditBalanceAgentTopup', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row',
                    'request'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) use ($orderArray) {
                if(array_key_exists($row->user->id, $orderArray)) {
                    $pendingAmount = $orderArray[$row->user->id];
                } else {
                    $pendingAmount = 0;
                }
                if($row->personalAmount && $row->personalAmount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->personalAmount - $pendingAmount;
                }
                return $amount;
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'total']);

            return $table->make(true);
        }

        return view('admin.report.stock-credit-balance-agent-topup');
    }

    public function stockCreditBalanceTopupAgentDetail($memberId, Request $request) 
    {
        $previousBalance = 0;
        if($request->has('start_date') && filled($request['start_date'])) {
            $pbQuery = ReportStockCredit::with(['user'])->whereHas('user', fn ($q) =>
                $q->whereIn('user_type', [1, 2])->whereNotIn('id', [1,2,3])
            )
            ->where('transaction_date', '<=', $request['start_date']." 00:00:00")
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type IN (1,2) ELSE report_stock_credits.order_wallet_type = 0 END)')
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "transaction_agent_top_ups" THEN report_stock_credits.top_up_type = 2 ELSE report_stock_credits.top_up_type = 0 END)')
            ->where('report_stock_credits.from_table', '!=', 'transaction_point_purchases')
            ->where('report_stock_credits.from_table', '!=', 'point_converts')
            ->where('report_stock_credits.user_id', $memberId)
            ->select(
                DB::raw('SUM(report_stock_credits.amount) AS previousBalanceAmount'),
            )->first();
            if($pbQuery) {
                $previousBalance = $pbQuery->previousBalanceAmount;
            }
        }

        $stock_credit = ReportStockCredit::where('user_id', $memberId)
        ->search($request)
        ->where('report_stock_credits.from_table', '!=', 'transaction_point_purchases')
        ->where('report_stock_credits.from_table', '!=', 'point_converts')
        ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type IN (1,2) ELSE report_stock_credits.order_wallet_type = 0 END)')
        ->whereRaw('(CASE WHEN report_stock_credits.from_table = "transaction_agent_top_ups" THEN report_stock_credits.top_up_type = 2 ELSE report_stock_credits.top_up_type = 0 END)')
        ->whereBetween('report_stock_credits.transaction_date', [$request->start_date != null ? $request->start_date : $this->default_start_date, $request->end_date != null ? $request->end_date : Carbon::now()])
        ->whereIn('from_wallet',[0,3])->get();

        DB::statement(DB::raw("set @order_table='orders'"));

        $order = Order::where('user_id', $memberId)
        ->whereIn('status', [1,2,3])->whereIn('wallet_type', [1,2])
        ->whereBetween('created_at', [$request->start_date != null ? $request->start_date : $this->default_start_date, $request->end_date != null ? $request->end_date : Carbon::now()])
        ->select(
            'id AS from_table_id',
            'created_at AS transaction_date',
            'new_invoice_number',
            DB::raw("(CASE
            WHEN (status = 1) THEN 'Sales (Pending)'
            WHEN (status = 2) THEN 'Sales (Shipped)'
            WHEN (status = 3) THEN 'Sales (Picked Up)'
            ELSE 0
            END) AS description"),
            DB::raw('(-1 * amount) AS amount'),
            DB::raw("@order_table AS from_table"),
        )->get();

        $all = collect($stock_credit)->merge($order)->sortBy('transaction_date');

        // dd($stock_credit, $order, $all);

        $user = User::findOrfail($memberId);

        return view('admin.report.stock-credit-topup-agent-detail', compact('all', 'user', 'previousBalance', 'request'));
    }

    public function stockCreditBalanceTopupAgentExport(Request $request)
    {
        $filename = 'EryaStockCreditBalanceAgentTopup'.date('YmdHis').'.xlsx';
        return Excel::download(new StockCreditBalanceTopupAgentExport($request), $filename);
    }

    public function stockCreditBalanceTopupAgentDetailExport(Request $request)
    {
        $filename = 'EryaStockCreditBalanceAgentTopupDetail'.date('YmdHis').'.xlsx';
        return Excel::download(new StockCreditBalanceTopupAgentDetailExport($request), $filename);
    }


    public function shippingCreditSummary(Request $request) {
        if ($request->ajax()) {
            $query = ReportShippingCredit::with(['user'])->search($request)->select(sprintf('*', (new ReportShippingCredit())->table));

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->editColumn('document_no', function ($row) {
                switch($row->from_table) {
                    case "transaction_shipping_purchases":
                        return "<a href=".route('admin.transaction-shipping-purchases.top-up-receipt', $row->from_table_id)." target='_blank'>".$row->document_no."</a><br/>";
                        break;
                    case "orders":
                        return "<a href=".route('admin.orders.invoice-pdf', $row->from_table_id)." target='_blank'>".$row->document_no."</a><br/>";
                        break;
                    default:
                        return "<a href=".route('admin.transaction-shipping-purchases.top-up-receipt', $row->from_table_id)." target='_blank'>".$row->document_no."</a><br/>";
                };
                return null;
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->editColumn('amount', function ($row) {
                if($row->amount && $row->amount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->amount;
                }
                return $amount;
            });

            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'document_no', 'user']);

            return $table->make(true);
        }

        return view('admin.report.shipping-credit-summary');
    }

    public function shippingCreditSummaryExport(Request $request)
    {
        $filename = 'EryaShippingCreditSummary'.date('YmdHis').'.xlsx';
        return Excel::download(new ShippingCreditSummaryExport($request), $filename);
    }

    public function shippingCreditBalance(Request $request) {
        if ($request->ajax()) {
            $query = ReportShippingCredit::with(['user'])->search($request)
            ->groupBy('user_id')
            ->select(
                sprintf('*', (new ReportShippingCredit())->table),
                DB::raw('SUM(report_shipping_credits.amount) AS personalAmount'),
            );

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_entry_show';
                $editGate = 'user_entry_edit';
                $deleteGate = 'user_entry_delete';
                $crudRoutePart = 'user-entries';
                return view('partials.datatablesActions_ShippingCreditBalance', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) {
                if($row->personalAmount && $row->personalAmount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->personalAmount;
                }
                return $amount;
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'total']);

            return $table->make(true);
        }

        return view('admin.report.shipping-credit-balance');
    }

    public function shippingCreditBalanceDetail($memberId) {
        $shipping_credit = ReportShippingCredit::where('user_id', $memberId)->get();
        $user = User::findOrfail($memberId);

        return view('admin.report.shipping-credit-detail', compact('shipping_credit', 'user'));
    }

    public function shippingCreditBalanceExport(Request $request)
    {
        $filename = 'EryaShippingCreditBalance'.date('YmdHis').'.xlsx';
        return Excel::download(new ShippingCreditBalanceExport($request), $filename);
    }


    // Report Bonus Credit
    public function bonusCreditSummary(Request $request) {
        if ($request->ajax()) {
            $query = ReportBonusCredit::with(['user'])->search($request)->select(sprintf('*', (new ReportBonusCredit())->table));

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->editColumn('amount', function ($row) {
                if($row->amount && $row->amount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->amount;
                }
                return $amount;
            });

            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.report.bonus-credit-summary');
    }

    public function bonusCreditSummaryExport(Request $request)
    {
        $filename = 'EryaBonusCreditSummary'.date('YmdHis').'.xlsx';
        return Excel::download(new BonusCreditSummaryExport($request), $filename);
    }

    public function bonusCreditBalance(Request $request) {
        if ($request->ajax()) {
            $query = ReportBonusCredit::with(['user'])->search($request)
            ->groupBy('user_id')
            ->select(
                sprintf('*', (new ReportBonusCredit())->table),
                DB::raw('SUM(report_bonus_credits.amount) AS personalAmount'),
            );

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_entry_show';
                $editGate = 'user_entry_edit';
                $deleteGate = 'user_entry_delete';
                $crudRoutePart = 'user-entries';
                return view('partials.datatablesActions_BonusCreditBalance', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) {
                if($row->personalAmount && $row->personalAmount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->personalAmount;
                }
                return $amount;
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'total']);

            return $table->make(true);
        }

        return view('admin.report.bonus-credit-balance');
    }

    public function bonusCreditBalanceDetail($memberId) {
        $bonus_credit = ReportBonusCredit::where('user_id', $memberId)->get();
        $user = User::findOrfail($memberId);

        return view('admin.report.bonus-credit-detail', compact('bonus_credit', 'user'));
    }

    public function bonusCreditBalanceExport(Request $request)
    {
        $filename = 'EryaBonusCreditBalance'.date('YmdHis').'.xlsx';
        return Excel::download(new BonusCreditBalanceExport($request), $filename);
    }

    // Report Voucher Credit
    public function voucherCreditSummary(Request $request) {
        if ($request->ajax()) {
            $query = ReportVoucherCredit::with(['user'])->search($request)->select(sprintf('*', (new ReportVoucherCredit())->table));

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->editColumn('amount', function ($row) {
                if($row->amount && $row->amount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->amount;
                }
                return $amount;
            });

            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.report.voucher-credit-summary');
    }

    public function voucherCreditSummaryExport(Request $request)
    {
        $filename = 'EryaVoucherCreditSummary'.date('YmdHis').'.xlsx';
        return Excel::download(new VoucherCreditSummaryExport($request), $filename);
    }

    public function voucherCreditBalance(Request $request) {
        if ($request->ajax()) {
            $query = ReportVoucherCredit::with(['user'])->search($request)
            ->groupBy('user_id')
            ->select(
                sprintf('*', (new ReportVoucherCredit())->table),
                DB::raw('SUM(report_voucher_credits.amount) AS personalAmount'),
            );

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_entry_show';
                $editGate = 'user_entry_edit';
                $deleteGate = 'user_entry_delete';
                $crudRoutePart = 'user-entries';
                return view('partials.datatablesActions_VoucherCreditBalance', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->transaction_date ? $row->transaction_date : "";
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) {
                if($row->personalAmount && $row->personalAmount == 0) {
                    $amount = "0";
                } else {
                    $amount = $row->personalAmount;
                }
                return $amount;
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'total']);

            return $table->make(true);
        }

        return view('admin.report.voucher-credit-balance');
    }

    public function voucherCreditBalanceDetail($memberId) {
        $voucher_credit = ReportVoucherCredit::where('user_id', $memberId)->get();
        $user = User::findOrfail($memberId);

        return view('admin.report.voucher-credit-detail', compact('voucher_credit', 'user'));
    }

    public function voucherCreditBalanceExport(Request $request)
    {
        $filename = 'EryaVoucherCreditBalance'.date('YmdHis').'.xlsx';
        return Excel::download(new VoucherCreditBalanceExport($request), $filename);
    }

    public function mbrReport(Request $request)
    {
        if ($request->ajax()) {
            // $query = Order::with(['user'])
            // ->leftjoin('document_mbr_invoice_logs as mbr', 'orders.id', 'mbr.order_id');

            // if($request->has('user') && !empty($request->user)){
            //     $query->when($request['user'] && filled($request['user']), function ($q) use($request) {
            //         $q->whereHas(
            //             'user', function($q) use($request){
            //             $q->where('name','like', '%'. $request['user']. '%');
            //         }
            //         );
            //     });
            // }

            // if($request->has('start_date') && !empty($request->start_date)){
            //     $query->where('orders.created_at', '>=', $request['start_date']." 00:00:00");
            // }

            // if($request->has('end_date') && !empty($request->end_date)){
            //     $query->where('orders.created_at', '<=', $request['end_date']." 23:59:59");
            // }

            // $query->where('orders.status', 5)
            // ->whereNotIn('orders.user_id', [1,2,3])
            // ->select(
            // sprintf('*', (new Order())->table),
            // 'orders.id AS id',
            // 'orders.created_at AS created_at',
            // 'mbr.name AS mbr_document_no'
            // );

            $query = DocumentMBRInvoiceLog::with(['user'])->whereNotNull('name')->groupBy('name')->search($request)->select(sprintf('*', (new DocumentMBRInvoiceLog())->table));

            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('transaction_date', function ($row) {
                return $row->created_at ? DocumentMBRInvoiceLog::whereName($row->name)->orderBy('amount', 'desc')->first()->created_at : "";
            });

            $table->editColumn('document_no', function ($row) use ($request) {
                return "<a href=".route('admin.reports.mbr-invoice-pdf', $row->id)." target='_blank'>".$row->name."</a><br/>";
            });

            $table->addColumn('user_ic', function ($row) {
                return $row->user ? $row->user->identity_no : '';
            });

            $table->addColumn('user_id', function ($row) {
                return $row->user ? $row->user->id : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? DocumentMBRInvoiceLog::whereName($row->name)->orderBy('amount', 'desc')->first()->user->name : '';
            });

            $table->addColumn('order_name', function ($row) {
                return $row->order_name ? $row->order_name : '';
            });

            $table->editColumn('amount', function ($row) {
                if($row->amount && $row->amount == 0) {
                    $amount = "0";
                } else {
                    $amount = DocumentMBRInvoiceLog::whereName($row->name)->sum('amount');
                }
                return $amount;
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '0';
            });

            $table->rawColumns(['placeholder', 'document_no', 'user']);

            $totalAmount = 0;
            $totalQuantity = 0;
            if($request->has('start_date') && !empty($request->start_date) && $request->has('end_date') && !empty($request->end_date)) {
                $result = $this->mbrSumAmount($request);
                $totalQuantity = $result->totalAmount/90;
                if($result->totalAmount != null) {
                    $totalAmount = $result->totalAmount;
                } else {
                    $totalAmount = 0;
                }
            }

            return $table->with(['totalAmount' => $totalAmount, 'totalQuantity' => $totalQuantity])->make(true);
        }

        return view('admin.report.mbr');
    }

    // (Task Request By Regend)
    public function getBalancesRanking(Request $request) 
    {
        $users = User::select('id')->get();

        $millionaire2 = 0;
        $manager2 = 0;
        $executive2 = 0;

        foreach ($users as $user)
        {
            $millionaire2 += getUserPointBalance($user->id);
            $manager2 += getUserManagerPointBalance($user->id);
            $executive2 += getUserExecutivePointBalance($user->id);
        }

        return view('admin.report.balances-ranking', compact('millionaire2', 'manager2', 'executive2'));
        // return view('admin.report.balances-ranking', compact('millionaire', 'manager', 'executive', 'millionaire2', 'manager2', 'executive2'));
    }

    public function getBalancesRankingExport(Request $request)
    {
        $filename = 'EryaGetBalancesRankingReport'.date('YmdHis').'.xlsx';
        return Excel::download(new GetBalanceRankingExport($request), $filename);
    }

    public function mbrExport(Request $request)
    {
        $filename = 'EryaMBR'.date('YmdHis').'.xlsx';
        return Excel::download(new MBRExport($request), $filename);
    }

    public function mbrSumAmount($request)
    {
        $query = DocumentMBRInvoiceLog::with(['user'])->whereNotNull('name')->search($request)->select(
            DB::raw('SUM(amount) AS totalAmount')
        );
        $result = $query->first();
        return $result;
    }

    public function MBRInvoicePdf($id)
    {
        $invoice = DocumentMBRInvoiceLog::findOrFail($id);

        $invoice = DocumentMBRInvoiceLog::where('name', $invoice->name)->orderBy('amount', 'desc')->first();

        $invoice->name = "Order Invoice-" . $invoice->name;
        $invoice->mbr_name = $invoice->name;
        $invoice->footnote = "Foot Note";

        $invoice_logs = DocumentMBRInvoiceLog::where('name', $invoice->name)->orderBy('amount', 'desc')->first();
        if($invoice_logs) {
            $from_user = User::where('id', $invoice_logs->from_user_id)->first();
            if(!in_array($from_user->id, [1,2,3], true)) {
                $invoice->from_name = $from_user->name;
                $invoice->from_email = $from_user->email;
                $invoice->from_phone = $from_user->phone;
            }
        }

        $pdf = PDF::loadView('user.print.mbr-order-invoice', compact('invoice'));
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($invoice->name . ".pdf");
    }

    // ********** REPORT DAILY TASK **********
    public function stockCreditRearrangeRecord(Request $request)
    {
        // RELATED TABLE - transaction_agent_top_ups, transaction_point_purchases, orders, point_converts,
        // orders' sub_total - voucher_amount;
        // point converts
        // orders just take user_id top up
        // orders' user_id == order_user_id, order_user_id is null
        // transaction_agent_tops_up merchant_pre_balance and merchant_post_balance cannot guaranteed correct.
        // transaction_agent_tops_up status 2 (approved)
        // transaction_agent_tops_up cannot just take amount, need see to_wallet, point_package_id, (point_package's deduct and deduct_2)

        Log::info("Start Running : Stock Credit Rearrange Record");
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('report_stock_credits')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::beginTransaction();

        try {
            DB::statement(DB::raw("set @transaction_point_purchases_description='Top Up'"));
            DB::statement(DB::raw("set @orders_description='Sales'"));
            DB::statement(DB::raw("set @transaction_agent_top_ups_description='Agent Top Up'"));
            DB::statement(DB::raw("set @point_converts_description='Point Converts'"));
            DB::statement(DB::raw("set @transaction_type_merchant='Merchant'"));
            DB::statement(DB::raw("set @transaction_type_user='User'"));
            DB::statement(DB::raw("set @blank_document=''"));
            // DB::statement(DB::raw("set @total=0"));

            $transaction_point_purchases = TransactionPointPurchase::leftJoin('users AS u', function ($join) use ($request) {
                $join->on('u.id', '=', 'transaction_point_purchases.user_id');
            })
            ->select('transaction_point_purchases.id AS id',
            'transaction_point_purchases.created_at AS createdDate',
            'transaction_point_purchases.receipt_number AS documentNo',
            'u.identity_no AS userIC',
            'u.id AS userID',
            'u.name AS userName',
            DB::raw("@transaction_point_purchases_description AS description"),
            DB::raw("IFNULL(transaction_point_purchases.point,'0') AS amount"),
            )
            // ->where('transaction_point_purchases.type', 1)
            ->whereNotIn('user_id',[1,2,3])->where('transaction_point_purchases.status', 3)
            ->whereNotNull('transaction_point_purchases.point')
            ->where('transaction_point_purchases.point','!=', 0)
            ->get();

            $orders = Order::leftJoin('users AS u', function ($join) use ($request) {
                $join->on('u.id', '=', 'orders.user_id');
            })
            ->select(
            'orders.id AS id',
            'orders.created_at AS createdDate',
            'orders.new_invoice_number AS documentNo',
            'u.identity_no AS userIC',
            'u.id AS userID',
            'u.name AS userName',
            DB::raw("@orders_description AS description"),
            'orders.wallet_type AS walletType',
            // DB::raw("IFNULL(orders.wallet_type, 0) AS walletType"),
            'orders.amount AS amount',

            )
            ->where('orders.status', 5)
            ->where('orders.wallet_type', 3) // This may need remove for Stock Credit Balance Top Up (Agent)
            ->whereNotIn('orders.user_id', [1,2,3])
            ->get();


            // From Wallet - 3 Millionaire, 2 - Manager, 1 - Executive
            $transaction_agent_top_ups_merchant = TransactionAgentTopUp::leftJoin('users AS u', function ($join) use ($request) {
                $join->on('u.id', '=', 'transaction_agent_top_ups.merchant_id');
            })
            ->leftJoin('point_packages AS pp', function ($join) use ($request) {
                $join->on('pp.id', '=', 'transaction_agent_top_ups.point_package_id');
            })
            ->select('transaction_agent_top_ups.id AS id',
            'transaction_agent_top_ups.created_at AS createdDate',
            DB::raw("@blank_document AS documentNo"),
            'u.identity_no AS userIC',
            'u.id AS userID',
            'u.name AS userName',
            DB::raw("@transaction_agent_top_ups_description AS description"),
            'transaction_agent_top_ups.from_wallet AS fromWallet',
            // 'transaction_agent_top_ups.amount AS amount',
            // DB::raw('SUM(merchant_pre_balance - merchant_post_balance) AS amount'),

            // DB::raw('(CASE
            //     WHEN (transaction_agent_top_ups.from_wallet = 3) AND (transaction_agent_top_ups.to_wallet = 1) THEN pp.deduct_2_level_point
            //     WHEN (transaction_agent_top_ups.from_wallet = 3) AND (transaction_agent_top_ups.to_wallet = 2) THEN pp.deduct_point
            //     WHEN (transaction_agent_top_ups.from_wallet = 2) AND (transaction_agent_top_ups.to_wallet = 1) THEN pp.deduct_point
            //     WHEN (transaction_agent_top_ups.from_wallet = 1) AND (transaction_agent_top_ups.to_wallet = 2) THEN pp.deduct_point
            //     WHEN (transaction_agent_top_ups.from_wallet = 1) AND (transaction_agent_top_ups.to_wallet = 3) THEN pp.deduct_2_level_point
            //     WHEN (transaction_agent_top_ups.from_wallet = 1) AND (transaction_agent_top_ups.to_wallet = 3) THEN pp.deduct_2_level_point
            //     ELSE 0
            //     END) AS amount'),


            DB::raw('(CASE
            WHEN (transaction_agent_top_ups.point_package_id != 99) AND (transaction_agent_top_ups.from_wallet = 3) AND (transaction_agent_top_ups.to_wallet = 1) THEN pp.deduct_2_level_point
            WHEN (transaction_agent_top_ups.point_package_id != 99) AND (transaction_agent_top_ups.from_wallet = 3) AND (transaction_agent_top_ups.to_wallet = 2) THEN pp.deduct_point
            WHEN (transaction_agent_top_ups.point_package_id != 99) AND (transaction_agent_top_ups.from_wallet = 2) AND (transaction_agent_top_ups.to_wallet = 1) THEN pp.deduct_point
            WHEN (transaction_agent_top_ups.point_package_id != 99) AND (transaction_agent_top_ups.from_wallet = 1) AND (transaction_agent_top_ups.to_wallet = 2) THEN pp.deduct_point
            WHEN (transaction_agent_top_ups.point_package_id != 99) AND (transaction_agent_top_ups.from_wallet = 1) AND (transaction_agent_top_ups.to_wallet = 3) THEN pp.deduct_2_level_point
            WHEN (transaction_agent_top_ups.point_package_id != 99) AND (transaction_agent_top_ups.from_wallet = 1) AND (transaction_agent_top_ups.to_wallet = 3) THEN pp.deduct_2_level_point
            WHEN (transaction_agent_top_ups.point_package_id = 99) THEN transaction_agent_top_ups.amount
            ELSE 0
            END) AS amount'),

            DB::raw("@transaction_type_merchant AS transaction_type"),
            )
            ->where('transaction_agent_top_ups.from_wallet', 3)
            // ->where('transaction_agent_top_ups.type', 1)
            ->where('transaction_agent_top_ups.status', 2)
            ->get();

            $transaction_agent_top_ups_user = TransactionAgentTopUp::leftJoin('users AS u', function ($join) use ($request) {
                $join->on('u.id', '=', 'transaction_agent_top_ups.user_id');
            })
            ->leftJoin('point_packages AS pp', function ($join) use ($request) {
                $join->on('pp.id', '=', 'transaction_agent_top_ups.point_package_id');
            })
            ->select('transaction_agent_top_ups.id AS id',
            'transaction_agent_top_ups.created_at AS createdDate',
            DB::raw("@blank_document AS documentNo"),
            'u.identity_no AS userIC',
            'u.id AS userID',
            'u.name AS userName',
            DB::raw("@transaction_agent_top_ups_description AS description"),
            'transaction_agent_top_ups.from_wallet AS fromWallet',
            'pp.point AS amount',
            DB::raw("@transaction_type_user AS transaction_type"),
            )
            // ->whereIn('transaction_agent_top_ups.from_wallet', [1,2])
            // ->where('transaction_agent_top_ups.type', 1)
            ->where('transaction_agent_top_ups.status', 2)
            ->get();

            $point_converts = PointConvert::leftJoin('users AS u', function ($join) use ($request) {
                $join->on('u.id', '=', 'point_converts.user_id');
            })
            ->select('point_converts.id AS id',
            'point_converts.created_at AS createdDate',
            DB::raw("@blank_document AS documentNo"),
            'u.identity_no AS userIC',
            'u.id AS userID',
            'u.name AS userName',
            DB::raw("@point_converts_description AS description"),
            DB::raw("IFNULL(point_converts.amount, '0') AS amount"),
            )->get();

            // dd($transaction_agent_top_ups_merchant, $transaction_agent_top_ups_user);

            $all = collect($transaction_point_purchases)->merge($orders)->merge($transaction_agent_top_ups_merchant)->merge($transaction_agent_top_ups_user)->merge($point_converts)->sortBy('createdDate');

            $amount = 0;
            $total = 0;
            $millionaire_total = 0; // Currently Not Use
            $x = 1;

            foreach($all as $item) {
                $top_up_type = 0;
                $from_wallet = 0;
                $order_wallet_type = 0;

                switch($item->table) {
                    case "transaction_point_purchases":
                        $millionaire_total += $item->amount;
                        $total += $item->amount;
                        $amount = $item->amount;
                        break;
                    case "orders":
                        $order_wallet_type = $item->walletType;
                        if($order_wallet_type == 3) {
                            $total -= $item->amount;
                            $millionaire_total -= $item->amount;
                        }
                        $amount = -($item->amount);
                        break;
                    case "transaction_agent_top_ups":
                        $from_wallet = $item->fromWallet;
                        if($item->transaction_type == "Merchant") {
                            $top_up_type = 1;
                            $total -= $item->amount;
                            $millionaire_total -= $item->amount;
                            $amount = -($item->amount);
                        }
                        if($item->transaction_type == "User") {
                            $top_up_type = 2;
                            $total += $item->amount;
                            $amount = $item->amount;
                        }
                        break;
                    case "point_converts":
                        $millionaire_total += $item->amount;
                        $total += $item->amount;
                        $amount = $item->amount;
                        break;
                    default:
                        die("Not Table Found");
                };

                if($top_up_type == 1) {
                    $insert_total = 0;
                    $insert_millionaire_total = $millionaire_total;
                } else if($top_up_type == 2) {
                    $insert_total = $total;
                    $insert_millionaire_total = 0;
                }

                ReportStockCredit::create([
                    'transaction_date' => $item->createdDate,
                    'document_no' => $item->documentNo,
                    'description' => $item->description,
                    'amount' => intval($amount),
                    'total' => $total,
                    'millionaire_total' => $millionaire_total,
                    'from_wallet' => $from_wallet,
                    'top_up_type' => $top_up_type,
                    'order_wallet_type' => $order_wallet_type,
                    'from_table' => $item->table,
                    'from_table_id' => $item->id,
                    'user_id' => $item->userID,
                ]);
                echo $x++ . ") " . "Table: " . $item->table . " ID: " . $item->id . " Created Time: " . $item->createdDate . "<br>";

            }
            DB::commit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("Error : Stock Credit Rearrange Record ${error_message}");
            DB::rollBack();
            dd($e->getMessage());
        }
        print("Completed Rearrange Stock Credit Report");

        return null;
    }

    public function shippingCreditRearrangeRecord(Request $request)
    {
        // $settings = "daily_update"
        // $startTime = Carbon::now();
        // $endTIme = Carbon::now();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('report_shipping_credits')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::beginTransaction();
        try {

            DB::statement(DB::raw("set @transaction_shipping_purchases_description='Top Up'"));
            DB::statement(DB::raw("set @orders_description='Sales'"));
            DB::statement(DB::raw("set @blank_document=''"));
            // DB::statement(DB::raw("set @total=0"));

            $transaction_shipping_purchases = TransactionShippingPurchase::leftJoin('users AS u', function ($join) use ($request) {
                $join->on('u.id', '=', 'transaction_shipping_purchases.user_id');
            })
            ->select('transaction_shipping_purchases.id AS id',
            'transaction_shipping_purchases.created_at AS createdDate',
            'transaction_shipping_purchases.receipt_number AS documentNo',
            'u.identity_no AS userIC',
            'u.id AS userID',
            'u.name AS userName',
            DB::raw("@transaction_shipping_purchases_description AS description"),
            DB::raw("IFNULL(transaction_shipping_purchases.point,'0') AS amount"),
            )
            ->whereNotIn('user_id',[1,2,3])->where('transaction_shipping_purchases.status', 3)->where('transaction_shipping_purchases.gateway_status', 3)->whereNotNull('transaction_shipping_purchases.point')->where('transaction_shipping_purchases.point','!=', 0)
            ->get();

            $orders = Order::leftJoin('users AS u', function ($join) use ($request) {
                $join->on('u.id', '=', 'orders.user_id');
            })
            ->select('orders.id AS id',
            'orders.created_at AS createdDate',
            'orders.new_invoice_number AS documentNo',
            'u.identity_no AS userIC',
            'u.id AS userID',
            'u.name AS userName',
            DB::raw("@orders_description AS description"),
            'orders.total_shipping AS amount',
            )
            ->where('orders.status', 5)
            ->where('orders.collect_type', 2)
            ->where('orders.user_id', '!=', 'orders.order_user_id')
            ->whereNull('orders.order_user_id')
            ->get();

            $all = collect($transaction_shipping_purchases)->merge($orders)->sortBy('createdDate');
            $amount = 0;
            $total = 0;
            $x = 1;
            foreach($all as $item) {
                switch($item->table) {
                    case "transaction_shipping_purchases":
                        $total += $item->amount;
                        $amount = $item->amount;
                        break;
                    case "orders":
                        $total -= $item->amount;
                        $amount = -($item->amount);
                        break;
                    default:
                        die("Not Table Found");
                };

                ReportShippingCredit::create([
                    'transaction_date' => $item->createdDate,
                    'document_no' => $item->documentNo,
                    'description' => $item->description,
                    'amount' => intval($amount),
                    'total' => $total,
                    'from_table' => $item->table,
                    'from_table_id' => $item->id,
                    'user_id' => $item->userID,
                ]);
                echo $x++ . ") " . "Table: " . $item->table . " ID: " . $item->id . " Created Time: " . $item->createdDate . "<br>";

            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
        print("Completed Rearrange Shipping Credit Report");

        return null;
    }

    public function bonusCreditRearrangeRecord(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('report_bonus_credits')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::beginTransaction();
        try {

            $bonus_balances = PointBonusBalance::with('user')
            ->whereNotIn('user_id',[1,2,3])
            ->get();

            // dd($bonus_balances);
            
            $amount = 0;
            $total = 0;
            $x = 1;
            foreach($bonus_balances as $item) {
                $remark = $item->remark;
                if(str_contains($remark, 'team topup bonus')) {
                    $description = "Team Topup Bonus";
                    $type = 1;
                } else if (str_contains($remark, 'referral bonus')) {
                    $description = "Referral Bonus";
                    $type = 1;
                } else if (str_contains($remark, 'personal topup bonus')) {
                    $description = "Personal Topup Bonus";
                    $type = 1;
                } else if (str_contains($remark, 'Bonus Withdraw')) {
                    $description = "Bonus Withdraw";
                    $type = 2;
                } else if (str_contains($remark, 'Point convert')) {
                    $description = "Point Convert";
                    $type = 2;
                } else {
                    die('No Bonus Category Found');
                }
                $amount = $item->amount;
                $total += $item->amount;

                ReportBonusCredit::create([
                    'transaction_date' => $item->created_at,
                    'type' => $type,
                    'description' => $description,
                    'amount' => intval($amount),
                    'total' => $total,
                    'from_table' => null,
                    'from_table_id' => null,
                    'user_id' => $item->user_id,
                ]);
                echo $x++ . ") " . " ID: " . $item->id . " Created Time: " . $item->created_at . "<br>";

            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
        print("Completed Rearrange Bonus Credit Report");
        return null;
        // return back();
    }

    public function voucherCreditRearrangeRecord(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('report_voucher_credits')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::beginTransaction();
        try {

            $voucher_balances = VoucherBalance::with('user')
            ->whereNotIn('user_id',[1,2,3])
            ->get();
            
            $amount = 0;
            $total = 0;
            $x = 1;
            foreach($voucher_balances as $item) {
                $remark = $item->remark;
                if(str_contains($remark, 'topup reward')) {
                    $description = "Topup Reward";
                    $type = 1;
                } else if (str_contains($remark, 'redeem order')) {
                    $description = "Redeem Order";
                    $type = 2;
                } else if (str_contains($remark, 'refund order')) {
                    $description = "Refund Order";
                    $type = 1;
                } else if (str_contains($remark, 'Point convert')) {
                    $description = "Point Convert";
                    $type = 1;
                } else {
                    die('No Bonus Category Found');
                }
                $amount = $item->amount;
                $total += $item->amount;

                ReportVoucherCredit::create([
                    'transaction_date' => $item->created_at,
                    'type' => $type,
                    'description' => $description,
                    'amount' => intval($amount),
                    'total' => $total,
                    'from_table' => null,
                    'from_table_id' => null,
                    'user_id' => $item->user_id,
                ]);
                echo $x++ . ") " . " ID: " . $item->id . " Created Time: " . $item->created_at . "<br>";

            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
        print("Completed Rearrange Voucher Credit Report");
        return null;
        // return back();
    }


    // Backup
    // public function depositBalance(Request $request)
    // {
    //     $date = request('date');
    //     $deposits = UserEntry::where('user_type','!=',4)->whereNotIn('user_id', [1,2,3])->whereNotNull('deposit')->where('deposit','!=', 0)->where('created_at','<=', $date." 23:59:59")->groupBy('user_id')->get();

    //     foreach ($deposits as $value) {
    //         $value->deposit = UserEntry::whereUserId($value->user_id)->where('deposit','!=', 0)->where('created_at','<=', $date." 23:59:59")->sum('deposit');
    //     }

    //     $total = 0;
    //     foreach ($deposits as $value){
    //         $total += $value->deposit;
    //         $value->total = $total;
    //     }

    //     return view('admin.report.deposit-balance', compact('deposits', 'date', 'total'));
    // }

    public function test(){

//        $model = UserEntry::where('created_at', '>=', '2022-03-08 00:00:00')->where('created_at', '<=', '2022-03-08 23:59:59')->whereNotNull('deposit')->where('deposit', '!=', 0)->get();

        foreach (UserEntry::where('created_at', '>=', '2022-03-08 00:00:00')->where('created_at', '<=', '2022-03-08 23:59:59')->whereNotNull('deposit')->where('deposit', '!=', 0)->cursor() as $value){

            $total = $value->deposit;
            DocumentMBRInvoiceLog::generateDocumentNumber2($value->user_id, 1, null, $total, 0, 90, $value->created_at);
        }
//        echo $model;
    }
}
