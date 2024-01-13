<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PointBonusBalanceExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointBonusBalanceRequest;
use App\Http\Requests\StorePointBonusBalanceRequest;
use App\Http\Requests\UpdatePointBonusBalanceRequest;
use App\Models\Point;
use App\Models\PointBonusBalance;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PointBonusBalanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('point_bonus_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PointBonusBalance::with(['user'])->search($request)->select(sprintf('%s.*', (new PointBonusBalance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'point_bonus_balance_show';
                $editGate = 'point_bonus_balance_edit';
                $deleteGate = 'point_bonus_balance_delete';
                $crudRoutePart = 'point-bonus-balances';

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
                return $row->status ? PointBonusBalance::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('settlement', function ($row) {
                return $row->settlement ? PointBonusBalance::SETTLEMENT_SELECT[$row->settlement] : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.pointBonusBalances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('point_bonus_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pointBonusBalances.create', compact('users'));
    }

    public function store(StorePointBonusBalanceRequest $request)
    {
        $pointBonusBalance = PointBonusBalance::create($request->all());

        return redirect()->route('admin.point-bonus-balances.index');
    }

    public function edit(PointBonusBalance $pointBonusBalance)
    {
        abort_if(Gate::denies('point_bonus_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pointBonusBalance->load('user');

        return view('admin.pointBonusBalances.edit', compact('users', 'pointBonusBalance'));
    }

    public function update(UpdatePointBonusBalanceRequest $request, PointBonusBalance $pointBonusBalance)
    {
        $pointBonusBalance->update($request->all());

        return redirect()->route('admin.point-bonus-balances.index');
    }

    public function show(PointBonusBalance $pointBonusBalance)
    {
        abort_if(Gate::denies('point_bonus_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointBonusBalance->load('user');

        return view('admin.pointBonusBalances.show', compact('pointBonusBalance'));
    }

    public function destroy(PointBonusBalance $pointBonusBalance)
    {
        abort_if(Gate::denies('point_bonus_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointBonusBalance->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointBonusBalanceRequest $request)
    {
        PointBonusBalance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function balance(){

        foreach(PointBonusBalance::whereStatus('1')->whereSettlement('1')->where('created_at', '<=', Carbon::today()->subDay()->toDateString().' 23:59:59')->groupBy('user_id')->cursor() as $value){

            $balance_credit = 0; $total_credit = 0;

            $balance_credit = PointBonusBalance::whereStatus('1')->whereSettlement('1')->whereUserId($value->user_id)->sum('amount');

            $user_credit = (float)Point::whereUserId($value->user_id)->value('point_bonus_balance') ?? 0;

            $total_credit = $user_credit+$balance_credit;

            $point = Point::whereUserId($value->user_id)->first();

            if($point){
                $point->update(['point_bonus_balance' => $total_credit]);
            }else{
                Point::create([
                    'user_id' => $value->user_id,
                    'point_balance' => 0,
                    'point_manager_balance' => 0,
                    'point_executive_balance' => 0,
                    'point_bonus_balance'=> $total_credit,
                    'voucher_balance' => 0,
                    'voucher_log' => 0,
                    'shipping_balance' => 0,
                    'cash_voucher_balance' => 0,
                    'pv_balance' => 0
                ]);
            }

            PointBonusBalance::whereUserId($value->user_id)->update(['settlement' => "2"]);

            echo $balance_credit." ".$value->user_id." ".$total_credit."<br/>";
        }
    }

    public function export(Request $request){

        $filename = 'PointBonusBalance'.date('YmdHis').'.xlsx';
   
        return Excel::download(new PointBonusBalanceExport($request), $filename);
    }
}
