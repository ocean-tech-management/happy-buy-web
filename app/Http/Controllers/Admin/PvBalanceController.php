<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PvBalanceExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPvBalanceRequest;
use App\Http\Requests\StorePvBalanceRequest;
use App\Http\Requests\UpdatePvBalanceRequest;
use App\Models\Point;
use App\Models\PvBalance;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class PvBalanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('pv_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PvBalance::with(['user'])->search($request)->select(sprintf('%s.*', (new PvBalance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pv_balance_show';
                $editGate = 'pv_balance_edit';
                $deleteGate = 'pv_balance_delete';
                $crudRoutePart = 'pv-balances';

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
                return $row->status ? PvBalance::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('settlement', function ($row) {
                return $row->settlement ? PvBalance::SETTLEMENT_SELECT[$row->settlement] : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.pvBalances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pv_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pvBalances.create', compact('users'));
    }

    public function store(StorePvBalanceRequest $request)
    {
        $pvBalance = PvBalance::create($request->all());

        return redirect()->route('admin.pv-balances.index');
    }

    public function edit(PvBalance $pvBalance)
    {
        abort_if(Gate::denies('pv_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pvBalance->load('user');

        return view('admin.pvBalances.edit', compact('pvBalance', 'users'));
    }

    public function update(UpdatePvBalanceRequest $request, PvBalance $pvBalance)
    {
        $pvBalance->update($request->all());

        return redirect()->route('admin.pv-balances.index');
    }

    public function show(PvBalance $pvBalance)
    {
        abort_if(Gate::denies('pv_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pvBalance->load('user');

        return view('admin.pvBalances.show', compact('pvBalance'));
    }

    public function destroy(PvBalance $pvBalance)
    {
        abort_if(Gate::denies('pv_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pvBalance->delete();

        return back();
    }

    public function massDestroy(MassDestroyPvBalanceRequest $request)
    {
        PvBalance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function balance(){

        foreach(PvBalance::whereStatus('1')->whereSettlement('1')->where('created_at', '<=', Carbon::today()->subDay()->toDateString().' 23:59:59')->groupBy('user_id')->cursor() as $value){

            $balance_credit = 0; $total_credit = 0;

            $balance_credit = PvBalance::whereStatus('1')->whereSettlement('1')->whereUserId($value->user_id)->sum('amount');

            $user_credit = (float)Point::whereUserId($value->user_id)->value('pv_balance') ?? 0;

            $total_credit = $user_credit+$balance_credit;

            $point = Point::whereUserId($value->user_id)->first();

            if($point){
                $point->update(['pv_balance' => $total_credit]);
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
                    'cash_voucher_balance' => 0,
                    'pv_balance' => $total_credit
                ]);
            }

            PvBalance::whereUserId($value->user_id)->update(['settlement' => "2"]);

            echo $balance_credit." ".$value->user_id." ".$total_credit."<br/>";
        }
    }

    public function export(Request $request){

        $filename = 'PvBalance'.date('YmdHis').'.xlsx';
   
        return Excel::download(new PvBalanceExport($request), $filename);
    }
}
