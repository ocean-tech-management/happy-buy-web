<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAdminRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AdminsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Admin::with(['roles'])->search($request)->select(sprintf('%s.*', (new Admin())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'admin_show';
                $editGate = 'admin_edit';
                $deleteGate = 'admin_delete';
                $crudRoutePart = 'admins';

                return view('partials.datatablesActions_Admin', compact(
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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Admin::STATUS_SELECT[$row->status] : '-';
            });
            $table->editColumn('profile_photo', function ($row) {
                if ($photo = $row->profile_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'profile_photo', 'roles']);

            return $table->make(true);
        }

        return view('admin.admins.index');
    }

    public function create()
    {
        abort_if(Gate::denies('admin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('admin')->pluck('name', 'id');

        return view('admin.admins.create', compact('roles'));
    }

    public function store(StoreAdminRequest $request)
    {
        $request->request->add(['password' => Hash::make(request('password'))]);
        $request->request->add(['password2' => request('password')]);

        $admin = Admin::create($request->all());
        $admin->syncRoles($request->input('roles', []));
        if ($request->input('profile_photo', false)) {
            $admin->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_photo'))))->toMediaCollection('profile_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $admin->id]);
        }

        return redirect()->route('admin.admins.index');
    }

    public function edit(Admin $admin)
    {
        abort_if(Gate::denies('admin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('admin')->pluck('name', 'id');

        $admin->load('roles');

        return view('admin.admins.edit', compact('roles', 'admin'));
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        if ($request->has('password')){
            if ($request->password != NULL){
                $request->request->add(['password' => Hash::make(request('password'))]);
                $request->request->add(['password2' => request('password')]);
            }else{
                $request->request->remove('password');
            }
        }else{
            $request->request->remove('password');
        }

        $admin->update($request->all());
        $admin->syncRoles($request->input('roles', []));
        if ($request->input('profile_photo', false)) {
            if (!$admin->profile_photo || $request->input('profile_photo') !== $admin->profile_photo->file_name) {
                if ($admin->profile_photo) {
                    $admin->profile_photo->delete();
                }
                $admin->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_photo'))))->toMediaCollection('profile_photo');
            }
        } elseif ($admin->profile_photo) {
            $admin->profile_photo->delete();
        }

        return redirect()->route('admin.admins.index');
    }

    public function show(Admin $admin)
    {
        abort_if(Gate::denies('admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admin->load('roles');

        return view('admin.admins.show', compact('admin'));
    }

    public function destroy(Admin $admin)
    {
        abort_if(Gate::denies('admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admin->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdminRequest $request)
    {
        Admin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('admin_create') && Gate::denies('admin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Admin();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
