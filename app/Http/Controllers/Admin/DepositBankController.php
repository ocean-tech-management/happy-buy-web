<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDepositBankRequest;
use App\Http\Requests\StoreDepositBankRequest;
use App\Http\Requests\UpdateDepositBankRequest;
use App\Models\BankList;
use App\Models\DepositBank;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DepositBankController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('deposit_bank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DepositBank::with(['bank'])->search($request)->select(sprintf('%s.*', (new DepositBank())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'deposit_bank_show';
                $editGate = 'deposit_bank_edit';
                $deleteGate = 'deposit_bank_delete';
                $statusChangeGate = 'deposit_bank_status_change';
                $crudRoutePart = 'deposit-banks';

                return view('partials.datatablesActions_DepositBank', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'statusChangeGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('bank_name', function ($row) {
                return $row->bank ? $row->bank->bank_name : '';
            });

            $table->editColumn('bank_account_name', function ($row) {
                return $row->bank_account_name ? $row->bank_account_name : '';
            });
            $table->editColumn('bank_account_number', function ($row) {
                return $row->bank_account_number ? $row->bank_account_number : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? DepositBank::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'bank']);

            return $table->make(true);
        }

        return view('admin.depositBanks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('deposit_bank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankList::pluck('bank_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.depositBanks.create', compact('banks'));
    }

    public function store(StoreDepositBankRequest $request)
    {
        $depositBank = DepositBank::create($request->all());

        return redirect()->route('admin.deposit-banks.index');
    }

    public function edit(DepositBank $depositBank)
    {
        abort_if(Gate::denies('deposit_bank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankList::pluck('bank_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $depositBank->load('bank');

        return view('admin.depositBanks.edit', compact('banks', 'depositBank'));
    }

    public function update(UpdateDepositBankRequest $request, DepositBank $depositBank)
    {
        $depositBank->update($request->all());

        return redirect()->route('admin.deposit-banks.index');
    }

    public function show(DepositBank $depositBank)
    {
        abort_if(Gate::denies('deposit_bank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $depositBank->load('bank');

        return view('admin.depositBanks.show', compact('depositBank'));
    }

    public function destroy(DepositBank $depositBank)
    {
        abort_if(Gate::denies('deposit_bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $depositBank->delete();

        return back();
    }

    public function massDestroy(MassDestroyDepositBankRequest $request)
    {
        DepositBank::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function changeStatus(Request $request)
    {
        $model = DepositBank::findOrFail(request('id'));
        $model->update([
            'status' => request('status')
        ]);
        return back();
    }
}
