<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonusPersonalRequest;
use App\Http\Requests\UpdateBonusPersonalRequest;
use App\Http\Resources\Admin\BonusPersonalResource;
use App\Models\BonusPersonal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusPersonalApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_personal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusPersonalResource(BonusPersonal::all());
    }

    public function store(StoreBonusPersonalRequest $request)
    {
        $bonusPersonal = BonusPersonal::create($request->all());

        return (new BonusPersonalResource($bonusPersonal))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BonusPersonal $bonusPersonal)
    {
        abort_if(Gate::denies('bonus_personal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusPersonalResource($bonusPersonal);
    }

    public function update(UpdateBonusPersonalRequest $request, BonusPersonal $bonusPersonal)
    {
        $bonusPersonal->update($request->all());

        return (new BonusPersonalResource($bonusPersonal))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BonusPersonal $bonusPersonal)
    {
        abort_if(Gate::denies('bonus_personal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusPersonal->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
