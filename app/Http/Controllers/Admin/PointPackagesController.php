<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPointPackageRequest;
use App\Http\Requests\StorePointPackageRequest;
use App\Http\Requests\UpdatePointPackageRequest;
use App\Models\PointPackage;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PointPackagesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('point_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PointPackage::with(['roles'])->select(sprintf('%s.*', (new PointPackage())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'point_package_show';
                $editGate = 'point_package_edit';
                $deleteGate = 'point_package_delete';
                $statusChangeGate = 'point_package_status_change';
                $crudRoutePart = 'point-packages';

                return view('partials.datatablesActions_PointPackage', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'statusChangeGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name_en', function ($row) {
                return $row->name_en ? $row->name_en : '';
            });
            $table->editColumn('name_zh', function ($row) {
                return $row->name_zh ? $row->name_zh : '';
            });
            $table->editColumn('package_photo', function ($row) {
                if ($photo = $row->package_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('point', function ($row) {
                return $row->point ? $row->point : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('deduct_point', function ($row) {
                return $row->deduct_point ? $row->deduct_point : '';
            });
            $table->editColumn('role', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="badge bg-primary ms-1">%s</span>', $role->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? PointPackage::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'package_photo', 'role']);

            return $table->make(true);
        }

        return view('admin.pointPackages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('point_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('user')->pluck('name', 'id');

        return view('admin.pointPackages.create', compact('roles'));
    }

    public function store(StorePointPackageRequest $request)
    {
        $pointPackage = PointPackage::create($request->all());
        $pointPackage->roles()->sync($request->input('roles', []));
        if ($request->input('package_photo', false)) {
            $pointPackage->addMedia(storage_path('tmp/uploads/' . basename($request->input('package_photo'))))->toMediaCollection('package_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pointPackage->id]);
        }

        return redirect()->route('admin.point-packages.index');
    }

    public function edit(PointPackage $pointPackage)
    {
        abort_if(Gate::denies('point_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('user')->pluck('name', 'id');

        $pointPackage->load('roles');

        return view('admin.pointPackages.edit', compact('roles', 'pointPackage'));
    }

    public function update(UpdatePointPackageRequest $request, PointPackage $pointPackage)
    {
        $pointPackage->update($request->all());
        $pointPackage->roles()->sync($request->input('roles', []));
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

        return redirect()->route('admin.point-packages.index');
    }

    public function show(PointPackage $pointPackage)
    {
        abort_if(Gate::denies('point_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointPackage->load('roles');

        return view('admin.pointPackages.show', compact('pointPackage'));
    }

    public function destroy(PointPackage $pointPackage)
    {
        abort_if(Gate::denies('point_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointPackage->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointPackageRequest $request)
    {
        PointPackage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('point_package_create') && Gate::denies('point_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PointPackage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function changeStatus(Request $request)
    {
        $model = PointPackage::findOrFail(request('id'));
        $model->update([
            'status' => request('status')
        ]);
        return back();
    }
}
