<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PointExecutiveBalanceExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointExecutiveBalanceRequest;
use App\Http\Requests\StorePointExecutiveBalanceRequest;
use App\Http\Requests\UpdatePointExecutiveBalanceRequest;
use App\Models\Point;
use App\Models\PointExecutiveBalance;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PointExecutiveBalanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('point_executive_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PointExecutiveBalance::with(['user'])->search($request)->select(sprintf('%s.*', (new PointExecutiveBalance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'point_executive_balance_show';
                $editGate = 'point_executive_balance_edit';
                $deleteGate = 'point_executive_balance_delete';
                $crudRoutePart = 'point-executive-balances';

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
                return $row->status ? PointExecutiveBalance::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('settlement', function ($row) {
                return $row->settlement ? PointExecutiveBalance::SETTLEMENT_SELECT[$row->settlement] : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.pointExecutiveBalances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('point_executive_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pointExecutiveBalances.create', compact('users'));
    }

    public function store(StorePointExecutiveBalanceRequest $request)
    {
        $pointExecutiveBalance = PointExecutiveBalance::create($request->all());

        return redirect()->route('admin.point-executive-balances.index');
    }

    public function edit(PointExecutiveBalance $pointExecutiveBalance)
    {
        abort_if(Gate::denies('point_executive_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pointExecutiveBalance->load('user');

        return view('admin.pointExecutiveBalances.edit', compact('users', 'pointExecutiveBalance'));
    }

    public function update(UpdatePointExecutiveBalanceRequest $request, PointExecutiveBalance $pointExecutiveBalance)
    {
        $pointExecutiveBalance->update($request->all());

        return redirect()->route('admin.point-executive-balances.index');
    }

    public function show(PointExecutiveBalance $pointExecutiveBalance)
    {
        abort_if(Gate::denies('point_executive_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointExecutiveBalance->load('user');

        return view('admin.pointExecutiveBalances.show', compact('pointExecutiveBalance'));
    }

    public function destroy(PointExecutiveBalance $pointExecutiveBalance)
    {
        abort_if(Gate::denies('point_executive_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointExecutiveBalance->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointExecutiveBalanceRequest $request)
    {
        PointExecutiveBalance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function balance(){

        foreach(PointExecutiveBalance::whereStatus('1')->whereSettlement('1')->where('created_at', '<=', Carbon::today()->subDay()->toDateString().' 23:59:59')->groupBy('user_id')->cursor() as $value){

            $balance_credit = 0; $total_credit = 0;

            $balance_credit = PointExecutiveBalance::whereStatus('1')->whereSettlement('1')->whereUserId($value->user_id)->sum('amount');

            $user_credit = (float)Point::whereUserId($value->user_id)->value('point_executive_balance') ?? 0;

            $total_credit = $user_credit+$balance_credit;

            $point = Point::whereUserId($value->user_id)->first();

            if($point){
                $point->update(['point_executive_balance' => $total_credit]);
            }else{
                Point::create([
                    'user_id' => $value->user_id,
                    'point_balance' => 0,
                    'point_manager_balance' => 0,
                    'point_executive_balance' => $total_credit,
                    'point_bonus_balance'=> 0,
                    'voucher_balance' => 0,
                    'voucher_log' => 0,
                    'shipping_balance' => 0,
                    'cash_voucher_balance' => 0,
                    'pv_balance' => 0
                ]);
            }

            PointExecutiveBalance::whereUserId($value->user_id)->update(['settlement' => "2"]);

            echo $balance_credit." ".$value->user_id." ".$total_credit."<br/>";
        }
    }

    public function export(Request $request){

        $filename = 'PointExecutiveBalance'.date('YmdHis').'.xlsx';
   
        return Excel::download(new PointExecutiveBalanceExport($request), $filename);
    }
}
