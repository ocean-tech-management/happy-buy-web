<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VoucherLogExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVoucherLogRequest;
use App\Http\Requests\StoreVoucherLogRequest;
use App\Http\Requests\UpdateVoucherLogRequest;
use App\Models\Point;
use App\Models\User;
use App\Models\VoucherBalance;
use App\Models\VoucherLog;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class VoucherLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('voucher_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VoucherLog::with(['user'])->search($request)->select(sprintf('%s.*', (new VoucherLog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'voucher_log_show';
                $editGate = 'voucher_log_edit';
                $deleteGate = 'voucher_log_delete';
                $crudRoutePart = 'voucher-logs';

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
                return $row->status ? VoucherLog::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('settlement', function ($row) {
                return $row->settlement ? VoucherLog::SETTLEMENT_SELECT[$row->settlement] : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.voucherLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('voucher_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.voucherLogs.create', compact('users'));
    }

    public function store(StoreVoucherLogRequest $request)
    {
        $voucherLog = VoucherLog::create($request->all());

        return redirect()->route('admin.voucher-logs.index');
    }

    public function edit(VoucherLog $voucherLog)
    {
        abort_if(Gate::denies('voucher_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $voucherLog->load('user');

        return view('admin.voucherLogs.edit', compact('users', 'voucherLog'));
    }

    public function update(UpdateVoucherLogRequest $request, VoucherLog $voucherLog)
    {
        $voucherLog->update($request->all());

        return redirect()->route('admin.voucher-logs.index');
    }

    public function show(VoucherLog $voucherLog)
    {
        abort_if(Gate::denies('voucher_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $voucherLog->load('user');

        return view('admin.voucherLogs.show', compact('voucherLog'));
    }

    public function destroy(VoucherLog $voucherLog)
    {
        abort_if(Gate::denies('voucher_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $voucherLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyVoucherLogRequest $request)
    {
        VoucherLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function balance(){

        foreach(VoucherLog::whereStatus('1')->whereSettlement('1')->where('created_at', '<=', Carbon::today()->subDay()->toDateString().' 23:59:59')->groupBy('user_id')->cursor() as $value){

            $balance_credit = 0; $total_credit = 0;

            $balance_credit = VoucherLog::whereStatus('1')->whereSettlement('1')->whereUserId($value->user_id)->sum('amount');

            $user_credit = (float)Point::whereUserId($value->user_id)->value('voucher_log') ?? 0;

            $total_credit = $user_credit+$balance_credit;

            $point = Point::whereUserId($value->user_id)->first();

            if($point){
                $point->update(['voucher_log' => $total_credit]);
            }else{
                Point::create([
                    'user_id' => $value->user_id,
                    'point_balance' => 0,
                    'point_manager_balance' => 0,
                    'point_executive_balance' => 0,
                    'point_bonus_balance'=> 0,
                    'voucher_balance' => 0,
                    'voucher_log' => $total_credit,
                    'shipping_balance' => 0,
                    'cash_voucher_balance' => 0,
                    'pv_balance' => 0
                ]);
            }

            VoucherLog::whereUserId($value->user_id)->update(['settlement' => "2"]);

            echo $balance_credit." ".$value->user_id." ".$total_credit."<br/>";
        }

    }

    public function export(Request $request){

        $filename = 'VoucherLog'.date('YmdHis').'.xlsx';
   
        return Excel::download(new VoucherLogExport($request), $filename);
    }
}
