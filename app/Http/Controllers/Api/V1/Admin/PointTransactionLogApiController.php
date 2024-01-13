<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePointTransactionLogRequest;
use App\Http\Requests\UpdatePointTransactionLogRequest;
use App\Http\Resources\Admin\PointTransactionLogResource;
use App\Models\PointTransactionLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointTransactionLogApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('point_transaction_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointTransactionLogResource(PointTransactionLog::with(['user'])->get());
    }

    public function store(StorePointTransactionLogRequest $request)
    {
        $pointTransactionLog = PointTransactionLog::create($request->all());

        return (new PointTransactionLogResource($pointTransactionLog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PointTransactionLog $pointTransactionLog)
    {
        abort_if(Gate::denies('point_transaction_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointTransactionLogResource($pointTransactionLog->load(['user']));
    }

    public function update(UpdatePointTransactionLogRequest $request, PointTransactionLog $pointTransactionLog)
    {
        $pointTransactionLog->update($request->all());

        return (new PointTransactionLogResource($pointTransactionLog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PointTransactionLog $pointTransactionLog)
    {
        abort_if(Gate::denies('point_transaction_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointTransactionLog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
