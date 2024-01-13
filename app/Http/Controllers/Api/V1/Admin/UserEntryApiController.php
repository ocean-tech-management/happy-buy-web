<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserEntryRequest;
use App\Http\Requests\UpdateUserEntryRequest;
use App\Http\Resources\Admin\UserEntryResource;
use App\Models\UserEntry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserEntryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_entry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserEntryResource(UserEntry::with(['ranking'])->get());
    }

    public function store(StoreUserEntryRequest $request)
    {
        $userEntry = UserEntry::create($request->all());

        return (new UserEntryResource($userEntry))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserEntry $userEntry)
    {
        abort_if(Gate::denies('user_entry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserEntryResource($userEntry->load(['ranking']));
    }

    public function update(UpdateUserEntryRequest $request, UserEntry $userEntry)
    {
        $userEntry->update($request->all());

        return (new UserEntryResource($userEntry))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserEntry $userEntry)
    {
        abort_if(Gate::denies('user_entry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userEntry->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
