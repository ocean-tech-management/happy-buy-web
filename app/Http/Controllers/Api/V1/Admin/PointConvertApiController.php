<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePointConvertRequest;
use App\Http\Requests\UpdatePointConvertRequest;
use App\Http\Resources\Admin\PointConvertResource;
use App\Models\PointConvert;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointConvertApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('point_convert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointConvertResource(PointConvert::with(['user'])->get());
    }

    public function store(StorePointConvertRequest $request)
    {
        $pointConvert = PointConvert::create($request->all());

        return (new PointConvertResource($pointConvert))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PointConvert $pointConvert)
    {
        abort_if(Gate::denies('point_convert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointConvertResource($pointConvert->load(['user']));
    }

    public function update(UpdatePointConvertRequest $request, PointConvert $pointConvert)
    {
        $pointConvert->update($request->all());

        return (new PointConvertResource($pointConvert))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PointConvert $pointConvert)
    {
        abort_if(Gate::denies('point_convert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointConvert->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
