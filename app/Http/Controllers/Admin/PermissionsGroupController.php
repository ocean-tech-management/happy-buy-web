<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionsGroupRequest;
use App\Http\Requests\StorePermissionsGroupRequest;
use App\Http\Requests\UpdatePermissionsGroupRequest;
use App\Models\PermissionsGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PermissionsGroupController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('permissions_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PermissionsGroup::with(['parent'])->select(sprintf('%s.*', (new PermissionsGroup())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'permissions_group_show';
                $editGate = 'permissions_group_edit';
                $deleteGate = 'permissions_group_delete';
                $crudRoutePart = 'permissions-groups';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('parent_name', function ($row) {
                return $row->parent ? $row->parent->name : '';
            });

            // $table->filter(function ($instance) use ($request) {
            //     if (!empty($request->search['value'])) {
            //         $instance->where(function ($query) use ($request) {
            //             $query
            //             // ->where('name', 'LIKE', '%' . $request->search['value'] . '%')
            //             ->whereHas(
            //                 'parent',
            //                 function ($q) use ($request) {
            //                     $q->where('name', 'LIKE', '%' . $request->search['value'] . '%');
            //                 }
            //             );
            //         });
            //     }
            // });

            $table->rawColumns(['actions', 'placeholder', 'parent']);

            return $table->make(true);
        }

        return view('admin.permissionsGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('permissions_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = PermissionsGroup::whereNull('parent_id')->orderBy('name')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // dd($parents);

        return view('admin.permissionsGroups.create', compact('parents'));
    }

    public function store(StorePermissionsGroupRequest $request)
    {
        $permissionsGroup = PermissionsGroup::create($request->all());

        return redirect()->route('admin.permissions-groups.index');
    }

    public function edit(PermissionsGroup $permissionsGroup)
    {
        abort_if(Gate::denies('permissions_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = PermissionsGroup::whereNull('parent_id')->orderBy('name')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $permissionsGroup->load('parent');

        return view('admin.permissionsGroups.edit', compact('parents', 'permissionsGroup'));
    }

    public function update(UpdatePermissionsGroupRequest $request, PermissionsGroup $permissionsGroup)
    {
        $permissionsGroup->update($request->all());

        return redirect()->route('admin.permissions-groups.index');
    }

    public function show(PermissionsGroup $permissionsGroup)
    {
        abort_if(Gate::denies('permissions_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissionsGroup->load('parent');

        return view('admin.permissionsGroups.show', compact('permissionsGroup'));
    }

    public function destroy(PermissionsGroup $permissionsGroup)
    {
        abort_if(Gate::denies('permissions_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissionsGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyPermissionsGroupRequest $request)
    {
        PermissionsGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
