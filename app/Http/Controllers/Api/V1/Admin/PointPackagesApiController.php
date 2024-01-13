<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePointPackageRequest;
use App\Http\Requests\UpdatePointPackageRequest;
use App\Http\Resources\Admin\PointPackageResource;
use App\Models\PointPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointPackagesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('point_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointPackageResource(PointPackage::all());
    }

    public function store(StorePointPackageRequest $request)
    {
        $pointPackage = PointPackage::create($request->all());

        if ($request->input('package_photo', false)) {
            $pointPackage->addMedia(storage_path('tmp/uploads/' . basename($request->input('package_photo'))))->toMediaCollection('package_photo');
        }

        return (new PointPackageResource($pointPackage))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PointPackage $pointPackage)
    {
        abort_if(Gate::denies('point_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointPackageResource($pointPackage);
    }

    public function update(UpdatePointPackageRequest $request, PointPackage $pointPackage)
    {
        $pointPackage->update($request->all());

        if ($request->input('package_photo', false)) {
            if (!$pointPackage->package_photo || $request->input('package_photo') !== $pointPackage->package_photo->file_name) {
                if ($pointPackage->package_photo) {
                    $pointPackage->package_photo->delete();
                }
                $pointPackage->addMedia(storage_path('tmp/uploads/' . basename($request->input('package_photo'))))->toMediaCollection('package_photo');
            }
        } elseif ($pointPackage->package_photo) {
            $pointPackage->package_photo->delete();
        }

        return (new PointPackageResource($pointPackage))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PointPackage $pointPackage)
    {
        abort_if(Gate::denies('point_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointPackage->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
