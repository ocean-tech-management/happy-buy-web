<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionBonuRequest;
use App\Http\Requests\UpdateTransactionBonuRequest;
use App\Http\Resources\Admin\TransactionBonuResource;
use App\Models\TransactionBonu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionBonusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_bonu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionBonuResource(TransactionBonu::with(['admin', 'user'])->get());
    }

    public function store(StoreTransactionBonuRequest $request)
    {
        $transactionBonu = TransactionBonu::create($request->all());

        return (new TransactionBonuResource($transactionBonu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransactionBonu $transactionBonu)
    {
        abort_if(Gate::denies('transaction_bonu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionBonuResource($transactionBonu->load(['admin', 'user']));
    }

    public function update(UpdateTransactionBonuRequest $request, TransactionBonu $transactionBonu)
    {
        $transactionBonu->update($request->all());

        return (new TransactionBonuResource($transactionBonu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransactionBonu $transactionBonu)
    {
        abort_if(Gate::denies('transaction_bonu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionBonu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
