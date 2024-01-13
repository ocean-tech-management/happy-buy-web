<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionIdLogRequest;
use App\Http\Requests\UpdateTransactionIdLogRequest;
use App\Http\Resources\Admin\TransactionIdLogResource;
use App\Models\TransactionIdLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionIdLogApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_id_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionIdLogResource(TransactionIdLog::with(['user'])->get());
    }

    public function store(StoreTransactionIdLogRequest $request)
    {
        $transactionIdLog = TransactionIdLog::create($request->all());

        return (new TransactionIdLogResource($transactionIdLog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransactionIdLog $transactionIdLog)
    {
        abort_if(Gate::denies('transaction_id_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionIdLogResource($transactionIdLog->load(['user']));
    }

    public function update(UpdateTransactionIdLogRequest $request, TransactionIdLog $transactionIdLog)
    {
        $transactionIdLog->update($request->all());

        return (new TransactionIdLogResource($transactionIdLog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransactionIdLog $transactionIdLog)
    {
        abort_if(Gate::denies('transaction_id_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionIdLog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
