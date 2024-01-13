<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePvBalanceRequest;
use App\Http\Requests\UpdatePvBalanceRequest;
use App\Http\Resources\Admin\PvBalanceResource;
use App\Models\PvBalance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PvBalanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pv_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PvBalanceResource(PvBalance::with(['user'])->get());
    }

    public function store(StorePvBalanceRequest $request)
    {
        $pvBalance = PvBalance::create($request->all());

        return (new PvBalanceResource($pvBalance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PvBalance $pvBalance)
    {
        abort_if(Gate::denies('pv_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PvBalanceResource($pvBalance->load(['user']));
    }

    public function update(UpdatePvBalanceRequest $request, PvBalance $pvBalance)
    {
        $pvBalance->update($request->all());

        return (new PvBalanceResource($pvBalance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PvBalance $pvBalance)
    {
        abort_if(Gate::denies('pv_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pvBalance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
