<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BonusGivenExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionBonusGivenRequest;
use App\Http\Requests\StoreTransactionBonusGivenRequest;
use App\Http\Requests\UpdateTransactionBonusGivenRequest;
use App\Models\Admin;
use App\Models\TransactionBonusGiven;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class TransactionBonusGivenController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_bonus_given_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            if ($request->is('admin/transaction-bonus-givens/referral')) {
                $request->request->add(['type' => 1]);               
            }else if ($request->is('admin/transaction-bonus-givens/personal-topup')) {
                $request->request->add(['type' => 2]);
            }else if ($request->is('admin/transaction-bonus-givens/team-topup')) {
                $request->request->add(['type' => 3]);
            }else if ($request->is('admin/transaction-bonus-givens/personal-annual')) {
                $request->request->add(['type' => 4]);                
            }else if ($request->is('admin/transaction-bonus-givens/team-annual')) {
                $request->request->add(['type' => 5]);  
            }

            $query = TransactionBonusGiven::with(['admin', 'user'])->search($request)->select(sprintf('%s.*', (new TransactionBonusGiven())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_bonus_given_show';
                $editGate = 'transaction_bonus_given_edit';
                $deleteGate = 'transaction_bonus_given_delete';
                $crudRoutePart = 'transaction-bonus-givens';

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
                return $row->type ? TransactionBonusGiven::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? TransactionBonusGiven::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'admin', 'user']);

            return $table->make(true);
        }

        return view('admin.transactionBonusGivens.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_bonus_given_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionBonusGivens.create', compact('admins', 'users'));
    }

    public function store(StoreTransactionBonusGivenRequest $request)
    {
        $transactionBonusGiven = TransactionBonusGiven::create($request->all());

        return redirect()->route('admin.transaction-bonus-givens.index');
    }

    public function edit(TransactionBonusGiven $transactionBonusGiven)
    {
        abort_if(Gate::denies('transaction_bonus_given_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionBonusGiven->load('admin', 'user');

        return view('admin.transactionBonusGivens.edit', compact('admins', 'users', 'transactionBonusGiven'));
    }

    public function update(UpdateTransactionBonusGivenRequest $request, TransactionBonusGiven $transactionBonusGiven)
    {
        $transactionBonusGiven->update($request->all());

        return redirect()->route('admin.transaction-bonus-givens.index');
    }

    public function show(TransactionBonusGiven $transactionBonusGiven)
    {
        abort_if(Gate::denies('transaction_bonus_given_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionBonusGiven->load('admin', 'user');

        return view('admin.transactionBonusGivens.show', compact('transactionBonusGiven'));
    }

    public function destroy(TransactionBonusGiven $transactionBonusGiven)
    {
        abort_if(Gate::denies('transaction_bonus_given_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionBonusGiven->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionBonusGivenRequest $request)
    {
        TransactionBonusGiven::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function export(Request $request){

        $filename = 'BonusGiven'.date('YmdHis').'.xlsx';
        return Excel::download(new BonusGivenExport($request), $filename);
    }
}
