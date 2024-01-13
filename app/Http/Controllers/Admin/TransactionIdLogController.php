<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionIdLogRequest;
use App\Http\Requests\StoreTransactionIdLogRequest;
use App\Http\Requests\UpdateTransactionIdLogRequest;
use App\Models\TransactionIdLog;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransactionIdLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_id_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TransactionIdLog::with(['user'])->search($request)->select(sprintf('%s.*', (new TransactionIdLog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_id_log_show';
                $editGate = 'transaction_id_log_edit';
                $deleteGate = 'transaction_id_log_delete';
                $crudRoutePart = 'transaction-id-logs';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? TransactionIdLog::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.transactionIdLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_id_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionIdLogs.create', compact('users'));
    }

    public function store(StoreTransactionIdLogRequest $request)
    {
        $transactionIdLog = TransactionIdLog::create($request->all());

        return redirect()->route('admin.transaction-id-logs.index');
    }

    public function edit(TransactionIdLog $transactionIdLog)
    {
        abort_if(Gate::denies('transaction_id_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionIdLog->load('user');

        return view('admin.transactionIdLogs.edit', compact('users', 'transactionIdLog'));
    }

    public function update(UpdateTransactionIdLogRequest $request, TransactionIdLog $transactionIdLog)
    {
        $transactionIdLog->update($request->all());

        return redirect()->route('admin.transaction-id-logs.index');
    }

    public function show(TransactionIdLog $transactionIdLog)
    {
        abort_if(Gate::denies('transaction_id_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionIdLog->load('user');

        return view('admin.transactionIdLogs.show', compact('transactionIdLog'));
    }

    public function destroy(TransactionIdLog $transactionIdLog)
    {
        abort_if(Gate::denies('transaction_id_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionIdLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionIdLogRequest $request)
    {
        TransactionIdLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
