<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPayoutLimitRequest;
use App\Http\Requests\StorePayoutLimitRequest;
use App\Http\Requests\UpdatePayoutLimitRequest;
use App\Models\PayoutLimit;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PayoutLimitController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('payout_limit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PayoutLimit::with(['role'])->select(sprintf('%s.*', (new PayoutLimit())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'payout_limit_show';
                $editGate = 'payout_limit_edit';
                $deleteGate = 'payout_limit_delete';
                $crudRoutePart = 'payout-limits';

                return view('partials.datatablesActions_PayoutLimit', compact(
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
            $table->addColumn('role_title', function ($row) {
                return $row->role ? $row->role->name : '';
            });

            $table->editColumn('min_amount', function ($row) {
                return $row->min_amount ? $row->min_amount : '';
            });
            $table->editColumn('max_amount', function ($row) {
                return $row->max_amount ? $row->max_amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'role']);

            return $table->make(true);
        }

        return view('admin.payoutLimits.index');
    }

    public function create()
    {
        abort_if(Gate::denies('payout_limit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('user')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.payoutLimits.create', compact('roles'));
    }

    public function store(StorePayoutLimitRequest $request)
    {
        $model = PayoutLimit::whereRoleId(request('role_id'))->first();

        if($model){
            return back()->with('error', trans('cruds.payoutLimit.fields.role_exists'))->withInput();
        }else{

            if(request('min_amount') >= request('max_amount')){
                return back()->with('error', trans('cruds.payoutLimit.fields.max_should_greater_than_min'))->withInput();
            }else{
                $payoutLimit = PayoutLimit::create($request->all());
                return redirect()->route('admin.payout-limits.index');
            }


        }




    }

    public function edit(PayoutLimit $payoutLimit)
    {
        abort_if(Gate::denies('payout_limit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('user')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payoutLimit->load('role');

        return view('admin.payoutLimits.edit', compact('roles', 'payoutLimit'));
    }

    public function update(UpdatePayoutLimitRequest $request, PayoutLimit $payoutLimit)
    {
        $payoutLimit->update($request->all());

        return redirect()->route('admin.payout-limits.index');
    }

    public function show(PayoutLimit $payoutLimit)
    {
        abort_if(Gate::denies('payout_limit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payoutLimit->load('role');

        return view('admin.payoutLimits.show', compact('payoutLimit'));
    }

    public function destroy(PayoutLimit $payoutLimit)
    {
        abort_if(Gate::denies('payout_limit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payoutLimit->delete();

        return back();
    }

    public function massDestroy(MassDestroyPayoutLimitRequest $request)
    {
        PayoutLimit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
