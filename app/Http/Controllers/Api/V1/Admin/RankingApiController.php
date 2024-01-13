<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRankingRequest;
use App\Http\Requests\UpdateRankingRequest;
use App\Http\Resources\Admin\RankingResource;
use App\Models\Ranking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RankingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ranking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RankingResource(Ranking::all());
    }

    public function store(StoreRankingRequest $request)
    {
        $ranking = Ranking::create($request->all());

        return (new RankingResource($ranking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ranking $ranking)
    {
        abort_if(Gate::denies('ranking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RankingResource($ranking);
    }

    public function update(UpdateRankingRequest $request, Ranking $ranking)
    {
        $ranking->update($request->all());

        return (new RankingResource($ranking))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ranking $ranking)
    {
        abort_if(Gate::denies('ranking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ranking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
