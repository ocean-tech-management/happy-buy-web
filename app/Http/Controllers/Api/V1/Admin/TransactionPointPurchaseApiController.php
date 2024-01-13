<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTransactionPointPurchaseRequest;
use App\Http\Requests\UpdateTransactionPointPurchaseRequest;
use App\Http\Resources\Admin\TransactionPointPurchaseResource;
use App\Models\TransactionPointPurchase;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionPointPurchaseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('transaction_point_purchase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionPointPurchaseResource(TransactionPointPurchase::with(['user', 'point_package', 'payment_method', 'admin'])->get());
    }

    public function store(StoreTransactionPointPurchaseRequest $request)
    {
        $transactionPointPurchase = TransactionPointPurchase::create($request->all());

        if ($request->input('receipt', false)) {
            $transactionPointPurchase->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
        }

        return (new TransactionPointPurchaseResource($transactionPointPurchase))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransactionPointPurchase $transactionPointPurchase)
    {
        abort_if(Gate::denies('transaction_point_purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionPointPurchaseResource($transactionPointPurchase->load(['user', 'point_package', 'payment_method', 'admin']));
    }

    public function update(UpdateTransactionPointPurchaseRequest $request, TransactionPointPurchase $transactionPointPurchase)
    {
        $transactionPointPurchase->update($request->all());

        if ($request->input('receipt', false)) {
            if (!$transactionPointPurchase->receipt || $request->input('receipt') !== $transactionPointPurchase->receipt->file_name) {
                if ($transactionPointPurchase->receipt) {
                    $transactionPointPurchase->receipt->delete();
                }
                $transactionPointPurchase->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
            }
        } elseif ($transactionPointPurchase->receipt) {
            $transactionPointPurchase->receipt->delete();
        }

        return (new TransactionPointPurchaseResource($transactionPointPurchase))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransactionPointPurchase $transactionPointPurchase)
    {
        abort_if(Gate::denies('transaction_point_purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionPointPurchase->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
