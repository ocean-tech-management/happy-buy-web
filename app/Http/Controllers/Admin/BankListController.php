<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBankListRequest;
use App\Http\Requests\StoreBankListRequest;
use App\Http\Requests\UpdateBankListRequest;
use App\Models\BankList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BankListController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bank_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankList::query()->search($request)->select(sprintf('%s.*', (new BankList())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bank_list_show';
                $editGate = 'bank_list_edit';
                $deleteGate = 'bank_list_delete';
                $statusChangeGate = 'bank_list_status_change';
                $crudRoutePart = 'bank-lists';

                return view('partials.datatablesActions_BankList', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'statusChangeGate',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('bank_name', function ($row) {
                return $row->bank_name ? $row->bank_name : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? BankList::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bankLists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bank_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankLists.create');
    }

    public function store(StoreBankListRequest $request)
    {
        $bankList = BankList::create($request->all());

        return redirect()->route('admin.bank-lists.index');
    }

    public function edit(BankList $bankList)
    {
        abort_if(Gate::denies('bank_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankLists.edit', compact('bankList'));
    }

    public function update(UpdateBankListRequest $request, BankList $bankList)
    {
        $bankList->update($request->all());

        return redirect()->route('admin.bank-lists.index');
    }

    public function show(BankList $bankList)
    {
        abort_if(Gate::denies('bank_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankLists.show', compact('bankList'));
    }

    public function destroy(BankList $bankList)
    {
        abort_if(Gate::denies('bank_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankList->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankListRequest $request)
    {
        BankList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function changeStatus(Request $request)
    {
        $model = BankList::findOrFail(request('id'));
        $model->update([
            'status' => request('status')
        ]);
        return back();
    }
}
