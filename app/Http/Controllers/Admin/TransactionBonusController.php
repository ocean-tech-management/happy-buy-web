<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionBonuRequest;
use App\Http\Requests\StoreTransactionBonuRequest;
use App\Http\Requests\UpdateTransactionBonuRequest;
use App\Models\Admin;
use App\Models\TransactionBonu;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransactionBonusController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_bonu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TransactionBonu::with(['admin', 'user'])->select(sprintf('%s.*', (new TransactionBonu())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_bonu_show';
                $editGate = 'transaction_bonu_edit';
                $deleteGate = 'transaction_bonu_delete';
                $crudRoutePart = 'transaction-bonus';

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
            $table->editColumn('transaction', function ($row) {
                return $row->transaction ? $row->transaction : '';
            });
            $table->addColumn('admin_name', function ($row) {
                return $row->admin ? $row->admin->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? TransactionBonu::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? TransactionBonu::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'admin', 'user']);

            return $table->make(true);
        }

        return view('admin.transactionBonus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_bonu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionBonus.create', compact('admins', 'users'));
    }

    public function store(StoreTransactionBonuRequest $request)
    {
        $transactionBonu = TransactionBonu::create($request->all());

        return redirect()->route('admin.transaction-bonus.index');
    }

    public function edit(TransactionBonu $transactionBonu)
    {
        abort_if(Gate::denies('transaction_bonu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionBonu->load('admin', 'user');

        return view('admin.transactionBonus.edit', compact('admins', 'users', 'transactionBonu'));
    }

    public function update(UpdateTransactionBonuRequest $request, TransactionBonu $transactionBonu)
    {
        $transactionBonu->update($request->all());

        return redirect()->route('admin.transaction-bonus.index');
    }

    public function show(TransactionBonu $transactionBonu)
    {
        abort_if(Gate::denies('transaction_bonu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionBonu->load('admin', 'user');

        return view('admin.transactionBonus.show', compact('transactionBonu'));
    }

    public function destroy(TransactionBonu $transactionBonu)
    {
        abort_if(Gate::denies('transaction_bonu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionBonu->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionBonuRequest $request)
    {
        TransactionBonu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
