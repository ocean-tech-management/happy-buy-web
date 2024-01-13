<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonusTopUpPersonalRequest;
use App\Http\Requests\UpdateBonusTopUpPersonalRequest;
use App\Http\Resources\Admin\BonusTopUpPersonalResource;
use App\Models\BonusTopUpPersonal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusTopUpPersonalApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_top_up_personal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusTopUpPersonalResource(BonusTopUpPersonal::with(['ranking'])->get());
    }

    public function store(StoreBonusTopUpPersonalRequest $request)
    {
        $bonusTopUpPersonal = BonusTopUpPersonal::create($request->all());

        return (new BonusTopUpPersonalResource($bonusTopUpPersonal))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BonusTopUpPersonal $bonusTopUpPersonal)
    {
        abort_if(Gate::denies('bonus_top_up_personal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonusTopUpPersonalResource($bonusTopUpPersonal->load(['ranking']));
    }

    public function update(UpdateBonusTopUpPersonalRequest $request, BonusTopUpPersonal $bonusTopUpPersonal)
    {
        $bonusTopUpPersonal->update($request->all());

        return (new BonusTopUpPersonalResource($bonusTopUpPersonal))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BonusTopUpPersonal $bonusTopUpPersonal)
    {
        abort_if(Gate::denies('bonus_top_up_personal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusTopUpPersonal->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
