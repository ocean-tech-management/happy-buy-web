<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonusGroupRequest;
use App\Http\Requests\UpdateBonusGroupRequest;
use App\Http\Resources\Admin\BonusGroupResource;
use App\Models\BonusGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusGroupResource(BonusGroup::all());
    }

    public function store(StoreBonusGroupRequest $request)
    {
        $bonusGroup = BonusGroup::create($request->all());

        return (new BonusGroupResource($bonusGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BonusGroup $bonusGroup)
    {
        abort_if(Gate::denies('bonus_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusGroupResource($bonusGroup);
    }

    public function update(UpdateBonusGroupRequest $request, BonusGroup $bonusGroup)
    {
        $bonusGroup->update($request->all());

        return (new BonusGroupResource($bonusGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BonusGroup $bonusGroup)
    {
        abort_if(Gate::denies('bonus_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
