<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePointBonusBalanceRequest;
use App\Http\Requests\UpdatePointBonusBalanceRequest;
use App\Http\Resources\Admin\PointBonusBalanceResource;
use App\Models\PointBonusBalance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointBonusBalanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('point_bonus_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointBonusBalanceResource(PointBonusBalance::with(['user'])->get());
    }

    public function store(StorePointBonusBalanceRequest $request)
    {
        $pointBonusBalance = PointBonusBalance::create($request->all());

        return (new PointBonusBalanceResource($pointBonusBalance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PointBonusBalance $pointBonusBalance)
    {
        abort_if(Gate::denies('point_bonus_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointBonusBalanceResource($pointBonusBalance->load(['user']));
    }

    public function update(UpdatePointBonusBalanceRequest $request, PointBonusBalance $pointBonusBalance)
    {
        $pointBonusBalance->update($request->all());

        return (new PointBonusBalanceResource($pointBonusBalance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PointBonusBalance $pointBonusBalance)
    {
        abort_if(Gate::denies('point_bonus_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointBonusBalance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
