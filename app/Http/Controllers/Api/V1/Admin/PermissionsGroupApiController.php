<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionsGroupRequest;
use App\Http\Requests\UpdatePermissionsGroupRequest;
use App\Http\Resources\Admin\PermissionsGroupResource;
use App\Models\PermissionsGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionsGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permissions_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PermissionsGroupResource(PermissionsGroup::with(['parent'])->get());
    }

    public function store(StorePermissionsGroupRequest $request)
    {
        $permissionsGroup = PermissionsGroup::create($request->all());

        return (new PermissionsGroupResource($permissionsGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PermissionsGroup $permissionsGroup)
    {
        abort_if(Gate::denies('permissions_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PermissionsGroupResource($permissionsGroup->load(['parent']));
    }

    public function update(UpdatePermissionsGroupRequest $request, PermissionsGroup $permissionsGroup)
    {
        $permissionsGroup->update($request->all());

        return (new PermissionsGroupResource($permissionsGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PermissionsGroup $permissionsGroup)
    {
        abort_if(Gate::denies('permissions_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissionsGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
