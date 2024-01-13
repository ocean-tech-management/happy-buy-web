<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Http\Resources\Admin\MaterialResource;
use App\Models\Material;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaterialApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('material_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaterialResource(Material::with(['language', 'roles'])->get());
    }

    public function store(StoreMaterialRequest $request)
    {
        $material = Material::create($request->all());
        $material->roles()->sync($request->input('roles', []));
        if ($request->input('file_1', false)) {
            $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_1'))))->toMediaCollection('file_1');
        }

        if ($request->input('file_2', false)) {
            $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_2'))))->toMediaCollection('file_2');
        }

        if ($request->input('file_3', false)) {
            $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_3'))))->toMediaCollection('file_3');
        }

        if ($request->input('file_4', false)) {
            $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_4'))))->toMediaCollection('file_4');
        }

        if ($request->input('file_5', false)) {
            $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_5'))))->toMediaCollection('file_5');
        }

        return (new MaterialResource($material))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Material $material)
    {
        abort_if(Gate::denies('material_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaterialResource($material->load(['language', 'roles']));
    }

    public function update(UpdateMaterialRequest $request, Material $material)
    {
        $material->update($request->all());
        $material->roles()->sync($request->input('roles', []));
        if ($request->input('file_1', false)) {
            if (!$material->file_1 || $request->input('file_1') !== $material->file_1->file_name) {
                if ($material->file_1) {
                    $material->file_1->delete();
                }
                $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_1'))))->toMediaCollection('file_1');
            }
        } elseif ($material->file_1) {
            $material->file_1->delete();
        }

        if ($request->input('file_2', false)) {
            if (!$material->file_2 || $request->input('file_2') !== $material->file_2->file_name) {
                if ($material->file_2) {
                    $material->file_2->delete();
                }
                $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_2'))))->toMediaCollection('file_2');
            }
        } elseif ($material->file_2) {
            $material->file_2->delete();
        }

        if ($request->input('file_3', false)) {
            if (!$material->file_3 || $request->input('file_3') !== $material->file_3->file_name) {
                if ($material->file_3) {
                    $material->file_3->delete();
                }
                $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_3'))))->toMediaCollection('file_3');
            }
        } elseif ($material->file_3) {
            $material->file_3->delete();
        }

        if ($request->input('file_4', false)) {
            if (!$material->file_4 || $request->input('file_4') !== $material->file_4->file_name) {
                if ($material->file_4) {
                    $material->file_4->delete();
                }
                $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_4'))))->toMediaCollection('file_4');
            }
        } elseif ($material->file_4) {
            $material->file_4->delete();
        }

        if ($request->input('file_5', false)) {
            if (!$material->file_5 || $request->input('file_5') !== $material->file_5->file_name) {
                if ($material->file_5) {
                    $material->file_5->delete();
                }
                $material->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_5'))))->toMediaCollection('file_5');
            }
        } elseif ($material->file_5) {
            $material->file_5->delete();
        }

        return (new MaterialResource($material))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Material $material)
    {
        abort_if(Gate::denies('material_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $material->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
