<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaterialRequest;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Language;
use App\Models\Material;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('material_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Material::with(['language', 'roles'])->select(sprintf('%s.*', (new Material())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'material_show';
                $editGate = 'material_edit';
                $deleteGate = 'material_delete';
                $crudRoutePart = 'materials';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('language_name', function ($row) {
                return $row->language ? $row->language->name : '';
            });

            $table->editColumn('file_title_1', function ($row) {
                return $row->file_title_1 ? $row->file_title_1 : '';
            });
            $table->editColumn('file_1', function ($row) {
                return $row->file_1 ? '<a href="' . $row->file_1->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('file_title_2', function ($row) {
                return $row->file_title_2 ? $row->file_title_2 : '';
            });
            $table->editColumn('file_2', function ($row) {
                return $row->file_2 ? '<a href="' . $row->file_2->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('file_title_3', function ($row) {
                return $row->file_title_3 ? $row->file_title_3 : '';
            });
            $table->editColumn('file_3', function ($row) {
                return $row->file_3 ? '<a href="' . $row->file_3->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('file_title_4', function ($row) {
                return $row->file_title_4 ? $row->file_title_4 : '';
            });
            $table->editColumn('file_4', function ($row) {
                return $row->file_4 ? '<a href="' . $row->file_4->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('file_title_5', function ($row) {
                return $row->file_title_5 ? $row->file_title_5 : '';
            });
            $table->editColumn('file_5', function ($row) {
                return $row->file_5 ? '<a href="' . $row->file_5->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('publish_year', function ($row) {
                return $row->publish_year ? $row->publish_year : '';
            });
            $table->editColumn('publish_month', function ($row) {
                return $row->publish_month ? $row->publish_month : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Material::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('role', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="badge bg-info">%s</span>', $role->name);
                }
                
                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'language', 'file_1', 'file_2', 'file_3', 'file_4', 'file_5', 'role']);

            return $table->make(true);
        }

        return view('admin.materials.index');
    }

    public function create()
    {
        abort_if(Gate::denies('material_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.materials.create', compact('languages', 'roles'));
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $material->id]);
        }

        return redirect()->route('admin.materials.index');
    }

    public function edit(Material $material)
    {
        abort_if(Gate::denies('material_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('name', 'id');

        $material->load('language', 'roles');

        return view('admin.materials.edit', compact('languages', 'roles', 'material'));
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

        return redirect()->route('admin.materials.index');
    }

    public function show(Material $material)
    {
        abort_if(Gate::denies('material_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $material->load('language', 'roles');

        return view('admin.materials.show', compact('material'));
    }

    public function destroy(Material $material)
    {
        abort_if(Gate::denies('material_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $material->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaterialRequest $request)
    {
        Material::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('material_create') && Gate::denies('material_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Material();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
