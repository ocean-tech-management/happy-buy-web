<?php

namespace App\Http\Controllers\Admin;

use App\Exports\WithdrawExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\ApproveTransactionPointWithdrawRequest;
use App\Http\Requests\MassDestroyTransactionPointWithdrawRequest;
use App\Http\Requests\StoreTransactionPointWithdrawRequest;
use App\Http\Requests\UpdateTransactionPointWithdrawRequest;
use App\Jobs\NotifyCompletedWithdrawExport;
use App\Models\Admin;
use App\Models\DocumentPaymentVoucherLog;
use App\Models\PointBalance;
use App\Models\PointBonusBalance;
use App\Models\TransactionIdLog;
use App\Models\TransactionPointWithdraw;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransactionPointWithdrawController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_point_withdraw_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if ($request->is('admin/transaction-point-withdraws/pending')) {
                $request->request->add(['status' => 1]);
            }else if ($request->is('admin/transaction-point-withdraws/processing')) {
                $request->request->add(['status' => 4]);
            }else if ($request->is('admin/transaction-point-withdraws/completed')) {
                $request->request->add(['status' => 2]);
            }else if ($request->is('admin/transaction-point-withdraws/rejected')) {
                $request->request->add(['status' => 3]);
            }

            $query = TransactionPointWithdraw::with(['user', 'admin'])->search($request)->select(sprintf('%s.*', (new TransactionPointWithdraw())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_point_withdraw_show';
                $editGate = 'transaction_point_withdraw_edit';
                $deleteGate = 'transaction_point_withdraw_delete';
                $toApproveGate = 'transaction_point_withdraw_to_approve';
                $toRejectGate = 'transaction_point_withdraw_to_reject';
                $crudRoutePart = 'transaction-point-withdraws';

                return view('partials.datatablesActions_TransactionPointWithdraw', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'toApproveGate',
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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('bank_name', function ($row) {
                return $row->bank_name ? $row->bank_name : '';
            });
            $table->editColumn('bank_account_name', function ($row) {
                return $row->bank_account_name ? $row->bank_account_name : '';
            });
            $table->editColumn('bank_account_number', function ($row) {
                return $row->bank_account_number ? $row->bank_account_number : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? TransactionPointWithdraw::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('admin_name', function ($row) {
                return $row->admin ? $row->admin->name : '';
            });

            $table->editColumn('receipt', function ($row) {
                if ($photo = $row->receipt) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'admin', 'receipt']);

            return $table->make(true);
        }

        return view('admin.transactionPointWithdraws.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_point_withdraw_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionPointWithdraws.create', compact('users', 'admins'));
    }

    public function store(StoreTransactionPointWithdrawRequest $request)
    {
        $user = User::findOrFail(request('user_id'));
        $requestAmount = request('amount');

        if($user->bank_name != null && $user->bank_account_name != null  && $user->bank_account_number != null ){
            $pointBonus = getUserPointBonusBalance($user->id);
            if($pointBonus > $requestAmount){

                $request->request->add(['bank_name' => $user->bank_name]);
                $request->request->add(['bank_account_name' => $user->bank_account_name]);
                $request->request->add(['bank_account_number' => $user->bank_account_number]);
                $transactionPointWithdraw = TransactionPointWithdraw::create($request->all());
                $order_number = TransactionIdLog::generateTransactionId(3, $user->id, $transactionPointWithdraw->id);
                $transactionPointWithdraw->update([
                    'transaction' => $order_number,
                ]);

                if($transactionPointWithdraw){
                    PointBonusBalance::create([
                        'amount' => '-'.$requestAmount,
                        'user_id' => $user->id,
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "request withdraw ".$order_number,
                    ]);
                }

                return redirect()->route('admin.transaction-point-withdraws.index');
            }else{
                return back()->with('error', trans('cruds.transactionPointWithdraw.fields.insufficient_point_bonus'));
            }
        }else{
            return back()->with('error', trans('cruds.transactionPointWithdraw.fields.no_bank'));
        }



//        if ($request->input('receipt', false)) {
//            $transactionPointWithdraw->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
//        }
//
//        if ($media = $request->input('ck-media', false)) {
//            Media::whereIn('id', $media)->update(['model_id' => $transactionPointWithdraw->id]);
//        }


    }

    public function edit(TransactionPointWithdraw $transactionPointWithdraw)
    {
        abort_if(Gate::denies('transaction_point_withdraw_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionPointWithdraw->load('user', 'admin');

        return view('admin.transactionPointWithdraws.edit', compact('users', 'admins', 'transactionPointWithdraw'));
    }

    public function update(UpdateTransactionPointWithdrawRequest $request, TransactionPointWithdraw $transactionPointWithdraw)
    {
        $transactionPointWithdraw->update($request->all());

        if ($request->input('receipt', false)) {
            if (!$transactionPointWithdraw->receipt || $request->input('receipt') !== $transactionPointWithdraw->receipt->file_name) {
                if ($transactionPointWithdraw->receipt) {
                    $transactionPointWithdraw->receipt->delete();
                }
                $transactionPointWithdraw->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
            }
        } elseif ($transactionPointWithdraw->receipt) {
            $transactionPointWithdraw->receipt->delete();
        }

        return redirect()->route('admin.transaction-point-withdraws.index');
    }

    public function show(TransactionPointWithdraw $transactionPointWithdraw)
    {
        abort_if(Gate::denies('transaction_point_withdraw_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionPointWithdraw->load('user', 'admin');

        return view('admin.transactionPointWithdraws.show', compact('transactionPointWithdraw'));
    }

    public function destroy(TransactionPointWithdraw $transactionPointWithdraw)
    {
        abort_if(Gate::denies('transaction_point_withdraw_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionPointWithdraw->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionPointWithdrawRequest $request)
    {
        TransactionPointWithdraw::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('transaction_point_withdraw_create') && Gate::denies('transaction_point_withdraw_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TransactionPointWithdraw();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function toApprove(Request $request)
    {
        abort_if(Gate::denies('transaction_point_withdraw_to_approve'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionPointWithdraw = TransactionPointWithdraw::findOrFail(request('id'));

        if($transactionPointWithdraw->status == 1){
            return view('admin.transactionPointWithdraws.to_approve', compact('transactionPointWithdraw'));
        }else{
            return redirect()->route('admin.transaction-point-withdraws.show', $transactionPointWithdraw->id);
        }
    }

    public function confirmApprove(ApproveTransactionPointWithdrawRequest $request)
    {
        $transactionPointWithdraw = TransactionPointWithdraw::findOrFail(request('id'));

        $transactionPointWithdraw->update([
            'remark' => request('remark'),
            'status' => 2,
            'admin_id' => Auth::guard('admin')->user()->id,
            'payment_voucher_number' => DocumentPaymentVoucherLog::generateDocumentNumber($transactionPointWithdraw->user_id, 1)
        ]);

        if ($request->input('receipt', false)) {
            $transactionPointWithdraw->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $transactionPointWithdraw->id]);
        }

        return redirect()->route('admin.transaction-point-withdraws.index');
    }

    public function confirmReject(Request $request)
    {
        $transactionPointWithdraw = TransactionPointWithdraw::findOrFail(request('id'));
        $requestAmount = $transactionPointWithdraw->amount;
        $userId = $transactionPointWithdraw->user->id;
        $orderNumber = $transactionPointWithdraw->transaction;

        $transactionPointWithdraw->update([
            'remark' => request('reason'),
            'status' => 3,
            'admin_id' => Auth::guard('admin')->user()->id
        ]);

        if($transactionPointWithdraw){
            DB::beginTransaction();
            try{
                PointBonusBalance::create([
                    'amount' => $requestAmount,
                    'user_id' => $userId,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => "refund withdraw ".$orderNumber,
                ]);
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollBack();
                return back();
            }

        }
        return back();
    }

    public function export(){

        $filename = 'withdraw'.date('YmdHis').'.xlsx';

        Excel::store(new WithdrawExport, $filename)->onQueue('withdraw-excel')->chain([
            new NotifyCompletedWithdrawExport($filename, Auth::guard('admin')->user()->id),
        ]);

        return redirect()->route('admin.withdraw-excels.index');
    }
}
