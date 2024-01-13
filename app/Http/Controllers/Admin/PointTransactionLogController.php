<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointTransactionLogRequest;
use App\Http\Requests\StorePointTransactionLogRequest;
use App\Http\Requests\UpdatePointTransactionLogRequest;
use App\Models\Order;
use App\Models\PointTransactionLog;
use App\Models\TransactionPointPurchase;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PointTransactionLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('point_transaction_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PointTransactionLog::with(['user'])->search($request)->select(sprintf('%s.*', (new PointTransactionLog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'point_transaction_log_show';
                $editGate = 'point_transaction_log_edit';
                $deleteGate = 'point_transaction_log_delete';
                $crudRoutePart = 'point-transaction-logs';

                return view('partials.datatablesActions_PointTransactionLog', compact(
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

            $table->editColumn('top_up', function ($row) {
                return $row->top_up ? $row->top_up : '';
            });
            $table->editColumn('redemption', function ($row) {
                return $row->redemption ? $row->redemption : '';
            });
            $table->editColumn('shipping', function ($row) {
                return $row->shipping ? $row->shipping : '';
            });

            $table->editColumn('topup_receipt', function ($row) {

                $topup_receipt = "";
                if($row->top_up != 0){
                    foreach (TransactionPointPurchase::whereUserId($row->user_id)->where('created_at', '>=', $row->date." 00:00:00")->where('created_at', '<=', $row->date." 23:59:59")->whereStatus(3)->cursor() as $value){
                        $topup_receipt .= "<a href='#'>".$value->new_invoice_number."</a><br/>";
                    }
                    return $topup_receipt;
                }else{
                    return $topup_receipt;
                }

            });

            $table->editColumn('stock_invoice', function ($row) {
                $stock_invoice = "";

                if($row->redemption != 0){
                    foreach (Order::whereOrderUserId($row->user_id)->where('completed_at', '>=', $row->date." 00:00:00")->where('completed_at', '<=', $row->date." 23:59:59")->whereStatus(5)->cursor() as $value){
                        $stock_invoice .= "<a href=".route('admin.orders.invoice-pdf', $value->id)." target='_blank'>".$value->new_invoice_number."</a><br/>";
                    }
                    return $stock_invoice;
                }else{
                    return $stock_invoice;
                }

            });

            $table->editColumn('shipping_invoice', function ($row) {

                $shipping_invoice = "";

                if($row->shipping != 0){
                    foreach (Order::whereOrderUserId($row->user_id)->where('completed_at', '>=', $row->date." 00:00:00")->where('completed_at', '<=', $row->date." 23:59:59")->whereStatus(5)->cursor() as $value){

                        $shipping_invoice .="<a href='#'>".$value->shipping_invoice_number."</a><br/>";
                    }

                    return $shipping_invoice;
                }else{
                    return $shipping_invoice;
                }

            });


            $table->rawColumns(['actions', 'placeholder', 'user', 'topup_receipt','stock_invoice', 'shipping_invoice']);

            return $table->make(true);
        }

        return view('admin.pointTransactionLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('point_transaction_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pointTransactionLogs.create', compact('users'));
    }

    public function store(StorePointTransactionLogRequest $request)
    {
        $pointTransactionLog = PointTransactionLog::create($request->all());

        return redirect()->route('admin.point-transaction-logs.index');
    }

    public function edit(PointTransactionLog $pointTransactionLog)
    {
        abort_if(Gate::denies('point_transaction_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pointTransactionLog->load('user');

        return view('admin.pointTransactionLogs.edit', compact('users', 'pointTransactionLog'));
    }

    public function update(UpdatePointTransactionLogRequest $request, PointTransactionLog $pointTransactionLog)
    {
        $pointTransactionLog->update($request->all());

        return redirect()->route('admin.point-transaction-logs.index');
    }

    public function show(PointTransactionLog $pointTransactionLog)
    {
        abort_if(Gate::denies('point_transaction_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointTransactionLog->load('user');

        return view('admin.pointTransactionLogs.show', compact('pointTransactionLog'));
    }

    public function destroy(PointTransactionLog $pointTransactionLog)
    {
        abort_if(Gate::denies('point_transaction_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointTransactionLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointTransactionLogRequest $request)
    {
        PointTransactionLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
