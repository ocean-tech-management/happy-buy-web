<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayoutLimitRequest;
use App\Http\Requests\UpdatePayoutLimitRequest;
use App\Http\Resources\Admin\PayoutLimitResource;
use App\Models\PayoutLimit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PayoutLimitApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payout_limit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PayoutLimitResource(PayoutLimit::with(['user'])->get());
    }

    public function store(StorePayoutLimitRequest $request)
    {
        $payoutLimit = PayoutLimit::create($request->all());

        return (new PayoutLimitResource($payoutLimit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PayoutLimit $payoutLimit)
    {
        abort_if(Gate::denies('payout_limit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PayoutLimitResource($payoutLimit->load(['user']));
    }

    public function update(UpdatePayoutLimitRequest $request, PayoutLimit $payoutLimit)
    {
        $payoutLimit->update($request->all());

        return (new PayoutLimitResource($payoutLimit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PayoutLimit $payoutLimit)
    {
        abort_if(Gate::denies('payout_limit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payoutLimit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
