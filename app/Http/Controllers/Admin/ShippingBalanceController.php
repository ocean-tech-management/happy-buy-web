<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ShippingBalanceExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShippingBalanceRequest;
use App\Http\Requests\StoreShippingBalanceRequest;
use App\Http\Requests\UpdateShippingBalanceRequest;
use App\Models\Point;
use App\Models\ShippingBalance;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;


class ShippingBalanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('shipping_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ShippingBalance::with(['user'])->search($request)->select(sprintf('%s.*', (new ShippingBalance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'shipping_balance_show';
                $editGate = 'shipping_balance_edit';
                $deleteGate = 'shipping_balance_delete';
                $crudRoutePart = 'shipping-balances';

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
                return $row->status ? ShippingBalance::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('settlement', function ($row) {
                return $row->settlement ? ShippingBalance::SETTLEMENT_SELECT[$row->settlement] : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.shippingBalances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('shipping_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.shippingBalances.create', compact('users'));
    }

    public function store(StoreShippingBalanceRequest $request)
    {
        $shippingBalance = ShippingBalance::create($request->all());

        return redirect()->route('admin.shipping-balances.index');
    }

    public function edit(ShippingBalance $shippingBalance)
    {
        abort_if(Gate::denies('shipping_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shippingBalance->load('user');

        return view('admin.shippingBalances.edit', compact('users', 'shippingBalance'));
    }

    public function update(UpdateShippingBalanceRequest $request, ShippingBalance $shippingBalance)
    {
        $shippingBalance->update($request->all());

        return redirect()->route('admin.shipping-balances.index');
    }

    public function show(ShippingBalance $shippingBalance)
    {
        abort_if(Gate::denies('shipping_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingBalance->load('user');

        return view('admin.shippingBalances.show', compact('shippingBalance'));
    }

    public function destroy(ShippingBalance $shippingBalance)
    {
        abort_if(Gate::denies('shipping_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingBalance->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippingBalanceRequest $request)
    {
        ShippingBalance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function balance(){

        foreach(ShippingBalance::whereStatus('1')->whereSettlement('1')->where('created_at', '<=', Carbon::today()->subDay()->toDateString().' 23:59:59')->groupBy('user_id')->cursor() as $value){

            $balance_credit = 0; $total_credit = 0;

            $balance_credit = ShippingBalance::whereStatus('1')->whereSettlement('1')->whereUserId($value->user_id)->sum('amount');

            $user_credit = (float)Point::whereUserId($value->user_id)->value('shipping_balance') ?? 0;

            $total_credit = $user_credit+$balance_credit;

            $point = Point::whereUserId($value->user_id)->first();

            if($point){
                $point->update(['shipping_balance' => $total_credit]);
            }else{
                Point::create([
                    'user_id' => $value->user_id,
                    'point_balance' => 0,
                    'point_manager_balance' => 0,
                    'point_executive_balance' => 0,
                    'point_bonus_balance'=> 0,
                    'voucher_balance' => 0,
                    'voucher_log' => 0,
                    'shipping_balance' => $total_credit,
                    'cash_voucher_balance' => 0,
                    'pv_balance' => 0
                ]);
            }

            ShippingBalance::whereUserId($value->user_id)->update(['settlement' => "2"]);

            echo $balance_credit." ".$value->user_id." ".$total_credit."<br/>";
        }      
    }

    public function export(Request $request){

        $filename = 'ShippingBalance'.date('YmdHis').'.xlsx';
   
        return Excel::download(new ShippingBalanceExport($request), $filename);
    }
}
