<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VoucherBalanceExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVoucherBalanceRequest;
use App\Http\Requests\StoreVoucherBalanceRequest;
use App\Http\Requests\UpdateVoucherBalanceRequest;
use App\Models\Point;
use App\Models\User;
use App\Models\VoucherBalance;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class VoucherBalanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('voucher_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VoucherBalance::with(['user'])->search($request)->select(sprintf('%s.*', (new VoucherBalance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'voucher_balance_show';
                $editGate = 'voucher_balance_edit';
                $deleteGate = 'voucher_balance_delete';
                $crudRoutePart = 'voucher-balances';

                return view('partials.datatablesActions_PointBalance', compact(
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
                return $row->status ? VoucherBalance::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('settlement', function ($row) {
                return $row->settlement ? VoucherBalance::SETTLEMENT_SELECT[$row->settlement] : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.voucherBalances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('voucher_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.voucherBalances.create', compact('users'));
    }

    public function store(StoreVoucherBalanceRequest $request)
    {
        $voucherBalance = VoucherBalance::create($request->all());

        return redirect()->route('admin.voucher-balances.index');
    }

    public function edit(VoucherBalance $voucherBalance)
    {
        abort_if(Gate::denies('voucher_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $voucherBalance->load('user');

        return view('admin.voucherBalances.edit', compact('users', 'voucherBalance'));
    }

    public function update(UpdateVoucherBalanceRequest $request, VoucherBalance $voucherBalance)
    {
        $voucherBalance->update($request->all());

        return redirect()->route('admin.voucher-balances.index');
    }

    public function show(VoucherBalance $voucherBalance)
    {
        abort_if(Gate::denies('voucher_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $voucherBalance->load('user');

        return view('admin.voucherBalances.show', compact('voucherBalance'));
    }

    public function destroy(VoucherBalance $voucherBalance)
    {
        abort_if(Gate::denies('voucher_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $voucherBalance->delete();

        return back();
    }

    public function massDestroy(MassDestroyVoucherBalanceRequest $request)
    {
        VoucherBalance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function balance(){

        foreach(VoucherBalance::whereStatus('1')->whereSettlement('1')->where('created_at', '<=', Carbon::today()->subDay()->toDateString().' 23:59:59')->groupBy('user_id')->cursor() as $value){

            $balance_credit = 0; $total_credit = 0;

            $balance_credit = VoucherBalance::whereStatus('1')->whereSettlement('1')->whereUserId($value->user_id)->sum('amount');

            $user_credit = (float)Point::whereUserId($value->user_id)->value('voucher_balance') ?? 0;

            $total_credit = $user_credit+$balance_credit;

            $point = Point::whereUserId($value->user_id)->first();

            if($point){
                $point->update(['voucher_balance' => $total_credit]);
            }else{
                Point::create([
                    'user_id' => $value->user_id,
                    'point_balance' => 0,
                    'point_manager_balance' => 0,
                    'point_executive_balance' => 0,
                    'point_bonus_balance'=> 0,
                    'voucher_balance' => $total_credit,
                    'voucher_log' => 0,
                    'shipping_balance' => 0,
                    'cash_voucher_balance' => 0,
                    'pv_balance' => 0
                ]);
            }

            VoucherBalance::whereUserId($value->user_id)->update(['settlement' => "2"]);

            echo $balance_credit." ".$value->user_id." ".$total_credit."<br/>";
        }
    }

    public function export(Request $request){

        $filename = 'VoucherBalance'.date('YmdHis').'.xlsx';
   
        return Excel::download(new VoucherBalanceExport($request), $filename);
    }
}
