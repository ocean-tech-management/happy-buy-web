<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePointBalanceRequest;
use App\Http\Requests\UpdatePointBalanceRequest;
use App\Http\Resources\Admin\PointBalanceResource;
use App\Models\PointBalance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointBalanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('point_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointBalanceResource(PointBalance::with(['user'])->get());
    }

    public function store(StorePointBalanceRequest $request)
    {
        $pointBalance = PointBalance::create($request->all());

        return (new PointBalanceResource($pointBalance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PointBalance $pointBalance)
    {
        abort_if(Gate::denies('point_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointBalanceResource($pointBalance->load(['user']));
    }

    public function update(UpdatePointBalanceRequest $request, PointBalance $pointBalance)
    {
        $pointBalance->update($request->all());

        return (new PointBalanceResource($pointBalance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PointBalance $pointBalance)
    {
        abort_if(Gate::denies('point_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointBalance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
