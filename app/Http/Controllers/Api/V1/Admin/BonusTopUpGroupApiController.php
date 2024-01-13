<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonusTopUpGroupRequest;
use App\Http\Requests\UpdateBonusTopUpGroupRequest;
use App\Http\Resources\Admin\BonusTopUpGroupResource;
use App\Models\BonusTopUpGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusTopUpGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_top_up_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusTopUpGroupResource(BonusTopUpGroup::with(['ranking'])->get());
    }

    public function store(StoreBonusTopUpGroupRequest $request)
    {
        $bonusTopUpGroup = BonusTopUpGroup::create($request->all());

        return (new BonusTopUpGroupResource($bonusTopUpGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BonusTopUpGroup $bonusTopUpGroup)
    {
        abort_if(Gate::denies('bonus_top_up_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusTopUpGroupResource($bonusTopUpGroup->load(['ranking']));
    }

    public function update(UpdateBonusTopUpGroupRequest $request, BonusTopUpGroup $bonusTopUpGroup)
    {
        $bonusTopUpGroup->update($request->all());

        return (new BonusTopUpGroupResource($bonusTopUpGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BonusTopUpGroup $bonusTopUpGroup)
    {
        abort_if(Gate::denies('bonus_top_up_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusTopUpGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
