<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTransactionPointWithdrawRequest;
use App\Http\Requests\UpdateTransactionPointWithdrawRequest;
use App\Http\Resources\Admin\TransactionPointWithdrawResource;
use App\Models\TransactionPointWithdraw;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionPointWithdrawApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('transaction_point_withdraw_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionPointWithdrawResource(TransactionPointWithdraw::with(['user', 'admin'])->get());
    }

    public function store(StoreTransactionPointWithdrawRequest $request)
    {
        $transactionPointWithdraw = TransactionPointWithdraw::create($request->all());

        if ($request->input('receipt', false)) {
            $transactionPointWithdraw->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
        }

        return (new TransactionPointWithdrawResource($transactionPointWithdraw))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransactionPointWithdraw $transactionPointWithdraw)
    {
        abort_if(Gate::denies('transaction_point_withdraw_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionPointWithdrawResource($transactionPointWithdraw->load(['user', 'admin']));
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

        return (new TransactionPointWithdrawResource($transactionPointWithdraw))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransactionPointWithdraw $transactionPointWithdraw)
    {
        abort_if(Gate::denies('transaction_point_withdraw_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionPointWithdraw->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
