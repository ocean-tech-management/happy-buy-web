<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonusJoinRequest;
use App\Http\Requests\UpdateBonusJoinRequest;
use App\Http\Resources\Admin\BonusJoinResource;
use App\Models\BonusJoin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusJoinApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_join_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusJoinResource(BonusJoin::all());
    }

    public function store(StoreBonusJoinRequest $request)
    {
        $bonusJoin = BonusJoin::create($request->all());

        return (new BonusJoinResource($bonusJoin))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BonusJoin $bonusJoin)
    {
        abort_if(Gate::denies('bonus_join_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusJoinResource($bonusJoin);
    }

    public function update(UpdateBonusJoinRequest $request, BonusJoin $bonusJoin)
    {
        $bonusJoin->update($request->all());

        return (new BonusJoinResource($bonusJoin))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BonusJoin $bonusJoin)
    {
        abort_if(Gate::denies('bonus_join_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusJoin->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
