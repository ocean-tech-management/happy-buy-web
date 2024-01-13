<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CashVoucherBalanceExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCashVoucherBalanceRequest;
use App\Http\Requests\StoreCashVoucherBalanceRequest;
use App\Http\Requests\UpdateCashVoucherBalanceRequest;
use App\Models\Point;
use App\Models\CashVoucherBalance;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CashVoucherBalanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('cash_voucher_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CashVoucherBalance::with(['user'])->search($request)->select(sprintf('%s.*', (new CashVoucherBalance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'cash_voucher_balance_show';
                $editGate = 'cash_voucher_balance_edit';
                $deleteGate = 'cash_voucher_balance_delete';
                $crudRoutePart = 'cash-voucher-balances';

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

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? CashVoucherBalance::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('settlement', function ($row) {
                return $row->settlement ? CashVoucherBalance::SETTLEMENT_SELECT[$row->settlement] : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.cashVoucherBalances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cash_voucher_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cashVoucherBalances.create', compact('users'));
    }

    public function store(StoreCashVoucherBalanceRequest $request)
    {
        $cashVoucherBalance = CashVoucherBalance::create($request->all());

        return redirect()->route('admin.cash-voucher-balances.index');
    }

    public function edit(CashVoucherBalance $cashVoucherBalance)
    {
        abort_if(Gate::denies('cash_voucher_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cashVoucherBalance->load('user');

        return view('admin.cashVoucherBalances.edit', compact('cashVoucherBalance', 'users'));
    }

    public function update(UpdateCashVoucherBalanceRequest $request, CashVoucherBalance $cashVoucherBalance)
    {
        $cashVoucherBalance->update($request->all());

        return redirect()->route('admin.cash-voucher-balances.index');
    }

    public function show(CashVoucherBalance $cashVoucherBalance)
    {
        abort_if(Gate::denies('cash_voucher_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashVoucherBalance->load('user');

        return view('admin.cashVoucherBalances.show', compact('cashVoucherBalance'));
    }

    public function destroy(CashVoucherBalance $cashVoucherBalance)
    {
        abort_if(Gate::denies('cash_voucher_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashVoucherBalance->delete();

        return back();
    }

    public function massDestroy(MassDestroyCashVoucherBalanceRequest $request)
    {
        CashVoucherBalance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function balance(){

        foreach(CashVoucherBalance::whereStatus('1')->whereSettlement('1')->where('created_at', '<=', Carbon::today()->subDay()->toDateString().' 23:59:59')->groupBy('user_id')->cursor() as $value){

            $balance_credit = 0; $total_credit = 0;

            $balance_credit = CashVoucherBalance::whereStatus('1')->whereSettlement('1')->whereUserId($value->user_id)->sum('amount');

            $user_credit = (float)Point::whereUserId($value->user_id)->value('cash_voucher_balance') ?? 0;

            $total_credit = $user_credit+$balance_credit;

            $point = Point::whereUserId($value->user_id)->first();

            if($point){
                $point->update(['cash_voucher_balance' => $total_credit]);
            }else{
                Point::create([
                    'user_id' => $value->user_id,
                    'point_balance' => 0,
                    'point_manager_balance' => 0,
                    'point_executive_balance' => 0,
                    'point_bonus_balance'=> 0,
                    'voucher_balance' => 0,
                    'voucher_log' => 0,
                    'shipping_balance' => 0,
                    'cash_voucher_balance' => $total_credit,
                    'pv_balance' => 0
                ]);
            }

            CashVoucherBalance::whereUserId($value->user_id)->update(['settlement' => "2"]);

            echo $balance_credit." ".$value->user_id." ".$total_credit."<br/>";
        }
    }

    public function export(Request $request){

        $filename = 'CashVoucherBalance'.date('YmdHis').'.xlsx';
   
        return Excel::download(new CashVoucherBalanceExport($request), $filename);
    }
}
