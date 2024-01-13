<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRedeemProductRequest;
use App\Http\Requests\UpdateTransactionRedeemProductRequest;
use App\Http\Resources\Admin\TransactionRedeemProductResource;
use App\Models\TransactionRedeemProduct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionRedeemProductApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_redeem_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionRedeemProductResource(TransactionRedeemProduct::with(['product', 'user', 'address', 'shipped_by', 'completed_by', 'refund_by', 'shipping_company'])->get());
    }

    public function store(StoreTransactionRedeemProductRequest $request)
    {
        $transactionRedeemProduct = TransactionRedeemProduct::create($request->all());

        return (new TransactionRedeemProductResource($transactionRedeemProduct))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransactionRedeemProduct $transactionRedeemProduct)
    {
        abort_if(Gate::denies('transaction_redeem_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionRedeemProductResource($transactionRedeemProduct->load(['product', 'user', 'address', 'shipped_by', 'completed_by', 'refund_by', 'shipping_company']));
    }

    public function update(UpdateTransactionRedeemProductRequest $request, TransactionRedeemProduct $transactionRedeemProduct)
    {
        $transactionRedeemProduct->update($request->all());

        return (new TransactionRedeemProductResource($transactionRedeemProduct))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransactionRedeemProduct $transactionRedeemProduct)
    {
        abort_if(Gate::denies('transaction_redeem_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionRedeemProduct->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
