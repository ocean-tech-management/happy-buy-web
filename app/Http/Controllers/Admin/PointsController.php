<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointRequest;
use App\Http\Requests\StorePointRequest;
use App\Http\Requests\UpdatePointRequest;
use App\Models\Order;
use App\Models\Point;
use App\Models\PointConvert;
use App\Models\PointTransactionLog;
use App\Models\TransactionPointPurchase;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PointsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Point::with(['user'])->select(sprintf('%s.*', (new Point())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'point_show';
                $editGate = 'point_edit';
                $deleteGate = 'point_delete';
                $crudRoutePart = 'points';

                return view('partials.datatablesActions', compact(
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

            $table->editColumn('point_balance', function ($row) {
                return $row->point_balance ? $row->point_balance : '';
            });
            $table->editColumn('point_manager_balance', function ($row) {
                return $row->point_manager_balance ? $row->point_manager_balance : '';
            });
            $table->editColumn('point_executive_balance', function ($row) {
                return $row->point_executive_balance ? $row->point_executive_balance : '';
            });
            $table->editColumn('point_bonus_balance', function ($row) {
                return $row->point_bonus_balance ? $row->point_bonus_balance : '';
            });
            $table->editColumn('voucher_balance', function ($row) {
                return $row->voucher_balance ? $row->voucher_balance : '';
            });
            $table->editColumn('shipping_balance', function ($row) {
                return $row->shipping_balance ? $row->shipping_balance : '';
            });
            $table->editColumn('cash_voucher_balance', function ($row) {
                return $row->cash_voucher_balance ? $row->cash_voucher_balance : '';
            });
            $table->editColumn('pv_balance', function ($row) {
                return $row->pv_balance ? $row->pv_balance : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.points.index');
    }

    public function create()
    {
        abort_if(Gate::denies('point_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.points.create', compact('users'));
    }

    public function store(StorePointRequest $request)
    {
        $point = Point::create($request->all());

        return redirect()->route('admin.points.index');
    }

    public function edit(Point $point)
    {
        abort_if(Gate::denies('point_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $point->load('user');

        return view('admin.points.edit', compact('users', 'point'));
    }

    public function update(UpdatePointRequest $request, Point $point)
    {
        $point->update($request->all());

        return redirect()->route('admin.points.index');
    }

    public function show(Point $point)
    {
        abort_if(Gate::denies('point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point->load('user');

        return view('admin.points.show', compact('point'));
    }

    public function destroy(Point $point)
    {
        abort_if(Gate::denies('point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointRequest $request)
    {
        Point::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function topup_balance()
    {

        foreach (TransactionPointPurchase::whereStatus('3')->where('payment_verified_at', '>=', Carbon::today()->subDay()->toDateString() . ' 00:00:00')->where('payment_verified_at', '<=', Carbon::today()->subDay()->toDateString() . ' 23:59:59')->groupBy('user_id')->cursor() as $value) {

            $balance_credit = 0;
            $total_credit = 0;

            $total = TransactionPointPurchase::whereUserId($value->user_id)->whereStatus('3')->where('payment_verified_at', '>=', Carbon::today()->subDay()->toDateString() . ' 00:00:00')->where('payment_verified_at', '<=', Carbon::today()->subDay()->toDateString() . ' 23:59:59')->sum('price');
            //
            $pointTransaction = PointTransactionLog::whereUserId($value->user_id)->where('date', '=', Carbon::today()->subDay()->toDateString())->first();

            if ($pointTransaction) {
                $pointTransaction->update([
                    'top_up' => $total,
                ]);
            } else {
                PointTransactionLog::create([
                    'top_up' => $total,
                    'point_convert' => 0,
                    'redemption' => 0,
                    'shipping' => 0,
                    'cash_voucher' => 0,
                    'date' => Carbon::today()->subDay()->toDateString(),
                    'user_id' => $value->user_id,
                ]);
            }
            echo $total . "<br/>";


            //            $user_credit = (float)Point::whereUserId($value->user_id)->value('voucher_balance') ?? 0;
            //
            //            $total_credit = $user_credit+$balance_credit;
            //
            //            Point::whereUserId($value->user_id)->update(['voucher_balance' => $total_credit]);
            //            VoucherBalance::whereUserId($value->user_id)->update(['settlement' => "2"]);
            //
            //            echo $balance_credit." ".$value->user_id." ".$total_credit."<br/>";
        }

    }

    public function topup_balance_test(Request $request)
    {
        $date = request('date');
        $startTime = $date . ' 00:00:00';
        $endTime = $date . ' 23:59:59';

        echo $date;

        foreach (TransactionPointPurchase::whereStatus('3')->where('payment_verified_at', '>=', $startTime . ' 00:00:00')->where('payment_verified_at', '<=', $endTime . ' 23:59:59')->groupBy('user_id')->cursor() as $value) {

            $balance_credit = 0;
            $total_credit = 0;

            $total = TransactionPointPurchase::whereUserId($value->user_id)->whereStatus('3')->where('payment_verified_at', '>=', $startTime . ' 00:00:00')->where('payment_verified_at', '<=', $endTime . ' 23:59:59')->sum('price');
            //
            $pointTransaction = PointTransactionLog::whereUserId($value->user_id)->where('date', '=', $date)->first();

            if ($pointTransaction) {
                $pointTransaction->update([
                    'top_up' => $total,
                ]);
            } else {
                PointTransactionLog::create([
                    'top_up' => $total,
                    'point_convert' => 0,
                    'redemption' => 0,
                    'shipping' => 0,
                    'cash_voucher' => 0,
                    'date' => $date,
                    'user_id' => $value->user_id,
                ]);
            }
            echo $total . "<br/>";
        }

    }

    public function convert_balance()
    {

        foreach (PointConvert::where('created_at', '>=', Carbon::today()->subDay()->toDateString() . ' 00:00:00')->where('created_at', '<=', Carbon::today()->subDay()->toDateString() . ' 23:59:59')->groupBy('user_id')->cursor() as $value) {

            $balance_credit = 0;
            $total_credit = 0;

            $total = PointConvert::whereUserId($value->user_id)->where('created_at', '>=', Carbon::today()->subDay()->toDateString() . ' 00:00:00')->where('created_at', '<=', Carbon::today()->subDay()->toDateString() . ' 23:59:59')->sum('amount');
            //
            $pointTransaction = PointTransactionLog::whereUserId($value->user_id)->where('date', '=', Carbon::today()->subDay()->toDateString())->first();

            if ($pointTransaction) {
                $pointTransaction->update([
                    'point_convert' => $total,
                ]);
            } else {
                PointTransactionLog::create([
                    'top_up' => 0,
                    'point_convert' => $total,
                    'redemption' => 0,
                    'shipping' => 0,
                    'cash_voucher' => 0,
                    'date' => Carbon::today()->subDay()->toDateString(),
                    'user_id' => $value->user_id,
                ]);
            }
            echo $total . "<br/>";
        }

    }

    public function convert_balance_test(Request $request)
    {
        $date = request('date');
        $startTime = $date . ' 00:00:00';
        $endTime = $date . ' 23:59:59';

        echo $date;

        foreach (PointConvert::where('created_at', '>=', $startTime . ' 00:00:00')->where('created_at', '<=', $endTime . ' 23:59:59')->groupBy('user_id')->cursor() as $value) {

            $balance_credit = 0;
            $total_credit = 0;

            $total = PointConvert::whereUserId($value->user_id)->where('created_at', '>=', $startTime . ' 00:00:00')->where('created_at', '<=', $endTime . ' 23:59:59')->sum('amount');
            //
            $pointTransaction = PointTransactionLog::whereUserId($value->user_id)->where('date', '=', $date)->first();

            if ($pointTransaction) {
                $pointTransaction->update([
                    'point_convert' => $total,
                ]);
            } else {
                PointTransactionLog::create([
                    'top_up' => 0,
                    'point_convert' => $total,
                    'redemption' => 0,
                    'shipping' => 0,
                    'cash_voucher' => 0,
                    'date' => $date,
                    'user_id' => $value->user_id,
                ]);
            }
            echo $total . "<br/>";
        }

    }

    //    public function topup_balance(){
    //
    //        foreach(TransactionPointPurchase::whereStatus('3')->where('payment_verified_at', '>=', Carbon::today()->toDateString().' 00:00:00')->where('payment_verified_at', '<=', Carbon::today()->toDateString().' 23:59:59')->groupBy('user_id')->cursor() as $value){
    //
    //
    //            $balance_credit = 0; $total_credit = 0;
    //
    //            $total = TransactionPointPurchase::whereUserId($value->user_id)->whereStatus('3')->where('payment_verified_at', '>=', Carbon::today()->toDateString().' 00:00:00')->where('payment_verified_at', '<=', Carbon::today()->toDateString().' 23:59:59')->sum('price');
    ////
    //            $pointTransaction = PointTransactionLog::whereUserId($value->user_id)->where('date', '=', Carbon::today()->toDateString())->first();
    //
    //            if($pointTransaction){
    //                $pointTransaction->update([
    //                    'top_up' => $total,
    //                ]);
    //            }else{
    //                PointTransactionLog::create([
    //                    'top_up' => $total,
    //                    'redemption' => 0,
    //                    'shipping' => 0
    //                    'cash_voucher' => 0,
    //                    'date' => Carbon::today()->toDateString(),
    //                    'user_id' => $value->user_id,
    //                ]);
    //            }
    //            echo $total."<br/>";
    //        }
    //
    //    }

    public function redemption_balance()
    {
        $startTime = Carbon::today()->subDay()->toDateString() . ' 00:00:00';
        $endTime = Carbon::today()->subDay()->toDateString() . ' 23:59:59';

        foreach (Order::whereStatus('5')->where('completed_at', '>=', $startTime)->where('completed_at', '<=', $endTime)->groupBy('user_id')->cursor() as $value) {
            $totalRedemption = Order::whereStatus('5')
                ->where('completed_at', '>=', $startTime)
                ->where('completed_at', '<=', $endTime)
                ->whereIn('wallet_type', [1, 2, 3])
                // ->where('cash_voucher_amount', 0)
                ->whereRaw('IFNULL(cash_voucher_amount,0) = 0')
                ->whereUserId($value->user_id)
                ->sum('sub_total');

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

            // print_r("<br>" . $value . "<br>");
            echo "------------------------------------------------------------------------------------------------------------------------------------";
            echo "<br>Agent ID: " . $value->user_id . " -- Redemption: " . $totalRedemption . " Shipping: " . $totalShipping . "<br>";

            foreach (Order::whereStatus('5')->where('completed_at', '>=', $startTime)->where('completed_at', '<=', $endTime)->whereUserId($value->user_id)->whereRaw('user_id != order_user_id')->groupBy('order_user_id')->cursor() as $vip_value) {
                $totalVIPRedemption = Order::whereStatus('5')
                    ->where('completed_at', '>=', $startTime)
                    ->where('completed_at', '<=', $endTime)
                    ->whereIn('wallet_type', [1, 2, 3, 5])
                    ->whereNotNull('order_user_id')
                    ->where('order_user_id', $vip_value->order_user_id)
                    ->sum('sub_total');

                $totalVIPShipping = Order::whereStatus('5')
                    ->where('completed_at', '>=', $startTime)
                    ->where('completed_at', '<=', $endTime)
                    ->where('order_user_id', $vip_value->order_user_id)
                    ->sum('total_shipping');

                $totalVIPCashVoucher = Order::whereStatus('5')
                    ->where('completed_at', '>=', $startTime)
                    ->where('completed_at', '<=', $endTime)
                    ->whereIn('wallet_type', [1, 2, 3, 4])
                    ->whereRaw('IFNULL(cash_voucher_amount,0) = 0')
                    ->where('order_user_id', $vip_value->order_user_id)
                    ->sum('cash_voucher_amount');

                echo("VIP ID:" . $vip_value->order_user_id . " -- Redemption: " . $totalVIPRedemption. " Shipping: ". $totalVIPShipping .  " Cash Voucher: " . $totalVIPCashVoucher . "<br>");

                $vipPointTransaction = PointTransactionLog::whereUserId($vip_value->order_user_id)->where('date', '=', Carbon::today()->subDay()->toDateString())->first();

                if ($vipPointTransaction) {
                    $vipPointTransaction->update([
                        'redemption' => $totalVIPRedemption,
                        'cash_voucher' => $totalVIPCashVoucher,
                        'shipping' => $totalVIPShipping,
                    ]);

                } else {
                    PointTransactionLog::create([
                        'top_up' => 0,
                        'point_convert' => 0,
                        'redemption' => $totalVIPRedemption,
                        'shipping' => $totalVIPShipping,
                        'cash_voucher' => $totalVIPCashVoucher,
                        'date' => Carbon::today()->subDay()->toDateString(),
                        'user_id' => $vip_value->order_user_id,
                    ]);
                }
            }
        }
    }

    public function redemption_balance_test(Request $request)
    {
        $date = request('date');
        $startTime = $date . ' 00:00:00';
        $endTime = $date . ' 23:59:59';

        foreach (Order::whereStatus('5')->where('completed_at', '>=', $startTime)->where('completed_at', '<=', $endTime)->groupBy('user_id')->cursor() as $value) {
            $totalRedemption = Order::whereStatus('5')
                ->where('completed_at', '>=', $startTime)
                ->where('completed_at', '<=', $endTime)
                ->whereIn('wallet_type', [1, 2, 3])
                // ->where('cash_voucher_amount', 0)
                ->whereRaw('IFNULL(cash_voucher_amount,0) = 0')
                ->whereUserId($value->user_id)
                ->sum('sub_total');

            $totalShipping = Order::whereStatus('5')
                ->where('completed_at', '>=', $startTime)
                ->where('completed_at', '<=', $endTime)
                ->whereUserId($value->user_id)
                ->sum('total_shipping');

            $pointTransaction = PointTransactionLog::whereUserId($value->user_id)->where('date', '=', $date)->first();

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
                    'date' => $date,
                    'user_id' => $value->user_id,
                ]);
            }

            // print_r("<br>" . $value . "<br>");
            echo "------------------------------------------------------------------------------------------------------------------------------------";
            echo "<br>Agent ID: " . $value->user_id . " -- Redemption: " . $totalRedemption . " Shipping: " . $totalShipping . "<br>";

            foreach (Order::whereStatus('5')->where('completed_at', '>=', $startTime)->where('completed_at', '<=', $endTime)->whereUserId($value->user_id)->whereRaw('user_id != order_user_id')->groupBy('order_user_id')->cursor() as $vip_value) {
                $totalVIPRedemption = Order::whereStatus('5')
                    ->where('completed_at', '>=', $startTime)
                    ->where('completed_at', '<=', $endTime)
                    ->whereIn('wallet_type', [1, 2, 3, 5])
                    ->whereNotNull('order_user_id')
                    ->where('order_user_id', $vip_value->order_user_id)
                    ->sum('sub_total');

                $totalVIPShipping = Order::whereStatus('5')
                    ->where('completed_at', '>=', $startTime)
                    ->where('completed_at', '<=', $endTime)
                    ->where('order_user_id', $vip_value->order_user_id)
                    ->sum('total_shipping');

                $totalVIPCashVoucher = Order::whereStatus('5')
                    ->where('completed_at', '>=', $startTime)
                    ->where('completed_at', '<=', $endTime)
                    ->whereIn('wallet_type', [1, 2, 3, 4])
                    ->whereNotNull('cash_voucher_amount')
                    ->where('order_user_id', $vip_value->order_user_id)
                    ->sum('cash_voucher_amount');

                echo("VIP ID:" . $vip_value->order_user_id . " -- Redemption: " . $totalVIPRedemption. " Shipping: ". $totalVIPShipping .  " Cash Voucher: " . $totalVIPCashVoucher . "<br>");

                $vipPointTransaction = PointTransactionLog::whereUserId($vip_value->order_user_id)->where('date', '=', $date)->first();

                if ($vipPointTransaction) {
                    $vipPointTransaction->update([
                        'redemption' => $totalVIPRedemption,
                        'cash_voucher' => $totalVIPCashVoucher,
                        'shipping' => $totalVIPShipping,
                    ]);

                } else {
                    PointTransactionLog::create([
                        'top_up' => 0,
                        'point_convert' => 0,
                        'redemption' => $totalVIPRedemption,
                        'shipping' => $totalVIPShipping,
                        'cash_voucher' => $totalVIPCashVoucher,
                        'date' => $date,
                        'user_id' => $vip_value->order_user_id,
                    ]);
                }
            }
        }
    }

    // public function redemption_balance()
    // {
    //     $startTime = Carbon::today()->subDay()->toDateString() . ' 00:00:00';
    //     $endTime = Carbon::today()->subDay()->toDateString() . ' 23:59:59';

    //     foreach (Order::whereStatus('5')->where('completed_at', '>=', $startTime)->where('completed_at', '<=', $endTime)->whereRaw('user_id = order_user_id')->groupBy('user_id')->cursor() as $value) {
    //         $totalRedemption = Order::whereStatus('5')
    //             ->where('completed_at', '>=', $startTime)
    //             ->where('completed_at', '<=', $endTime)
    //             ->whereIn('wallet_type', [1, 2, 3, 4])
    //             ->whereNull('cash_voucher_amount')
    //             ->whereUserId($value->user_id)
    //             ->sum('sub_total');

    //         $totalShipping = Order::whereStatus('5')
    //             ->where('completed_at', '>=', $startTime)
    //             ->where('completed_at', '<=', $endTime)
    //             ->whereUserId($value->user_id)
    //             ->sum('total_shipping');

    //         $pointTransaction = PointTransactionLog::whereUserId($value->user_id)->where('date', '=', Carbon::today()->subDay()->toDateString())->first();

    //         if ($pointTransaction) {
    //             $pointTransaction->update([
    //                 'redemption' => $totalRedemption,
    //                 'shipping' => $totalShipping,
    //             ]);
    //         } else {
    //             PointTransactionLog::create([
    //                 'top_up' => 0,
    //                 'point_convert' => 0,
    //                 'redemption' => $totalRedemption,
    //                 'shipping' => $totalShipping,
    //                 'cash_voucher' => 0,
    //                 'date' => Carbon::today()->subDay()->toDateString(),
    //                 'user_id' => $value->user_id,
    //             ]);
    //         }

    //         // print_r("<br>" . $value . "<br>");
    //         echo "User ID: " . $value->user_id . "<br>Total Redemption: " . $totalRedemption . "<br> Total Shipping: " . $totalShipping . "<br><br>";
    //     }
    // }

    // Agent help VIP make an orders.
    // public function vip_redemption_balance()
    // {
    //     $startTime = Carbon::today()->subDay()->toDateString() . ' 00:00:00';
    //     $endTime = Carbon::today()->subDay()->toDateString() . ' 23:59:59';

    //     foreach (Order::whereStatus('5')->where('completed_at', '>=', $startTime)->where('completed_at', '<=', $endTime)->whereRaw('user_id != order_user_id')->groupBy('order_user_id')->cursor() as $value) {

    //         $totalRedemption = Order::whereStatus('5')
    //             ->where('completed_at', '>=', $startTime)
    //             ->where('completed_at', '<=', $endTime)
    //             ->whereIn('wallet_type', [5])
    //             ->whereNotNull('order_user_id')
    //             ->where('order_user_id', $value->order_user_id)
    //             ->sum('sub_total');

    //         $totalCashVoucher = Order::whereStatus('5')
    //             ->where('completed_at', '>=', $startTime)
    //             ->where('completed_at', '<=', $endTime)
    //             ->whereIn('wallet_type', [1, 2, 3, 4])
    //             ->whereNotNull('cash_voucher_amount')
    //             ->where('order_user_id', $value->order_user_id)
    //             ->sum('cash_voucher_amount');

    //         $totalShipping = Order::whereStatus('5')
    //             ->where('completed_at', '>=', $startTime)
    //             ->where('completed_at', '<=', $endTime)
    //             ->where('order_user_id', $value->order_user_id)
    //             ->sum('total_shipping');


    //         $pointTransaction = PointTransactionLog::whereUserId($value->order_user_id)->where('date', '=', Carbon::today()->subDay()->toDateString())->first();

    //         if ($pointTransaction) {
    //             $pointTransaction->update([
    //                 'total_redemption' => $totalRedemption,
    //                 'cash_voucher' => $totalCashVoucher,
    //                 'total_shipping' => $totalShipping,
    //             ]);
    //         } else {
    //             PointTransactionLog::create([
    //                 'top_up' => 0,
    //                 'point_convert' => 0,
    //                 'redemption' => $totalRedemption,
    //                 'shipping' => $totalShipping,
    //                 'cash_voucher' => $totalCashVoucher,
    //                 'date' => Carbon::today()->subDay()->toDateString(),
    //                 'user_id' => $value->order_user_id,
    //             ]);
    //         }

    //         // print_r("<br>" . $value . "<br>");
    //         echo "Order User ID: " . $value->order_user_id . "<br>Total Redemption: " . $totalRedemption . "<br> Total Cash Voucher Balance: " . $totalCashVoucher . "<br> Total Shipping: " . $totalShipping . "<br><br>";
    //     }
    // }
}
