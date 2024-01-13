<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonalCodeLogRequest;
use App\Http\Requests\UpdatePersonalCodeLogRequest;
use App\Http\Resources\Admin\PersonalCodeLogResource;
use App\Models\PersonalCodeLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonalCodeLogApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('personal_code_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PersonalCodeLogResource(PersonalCodeLog::all());
    }

    public function store(StorePersonalCodeLogRequest $request)
    {
        $personalCodeLog = PersonalCodeLog::create($request->all());

        return (new PersonalCodeLogResource($personalCodeLog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PersonalCodeLog $personalCodeLog)
    {
        abort_if(Gate::denies('personal_code_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PersonalCodeLogResource($personalCodeLog);
    }

    public function update(UpdatePersonalCodeLogRequest $request, PersonalCodeLog $personalCodeLog)
    {
        $personalCodeLog->update($request->all());

        return (new PersonalCodeLogResource($personalCodeLog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PersonalCodeLog $personalCodeLog)
    {
        abort_if(Gate::denies('personal_code_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalCodeLog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
