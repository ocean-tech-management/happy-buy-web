<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusGroupRequest;
use App\Http\Requests\StoreBonusGroupRequest;
use App\Http\Requests\UpdateBonusGroupRequest;
use App\Models\BonusGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BonusGroupController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bonus_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BonusGroup::query()->select(sprintf('%s.*', (new BonusGroup())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bonus_group_show';
                $editGate = 'bonus_group_edit';
                $deleteGate = 'bonus_group_delete';
                $crudRoutePart = 'bonus-groups';

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
            $table->editColumn('point', function ($row) {
                return $row->point ? $row->point : '';
            });
            $table->editColumn('percent', function ($row) {
                return $row->percent ? $row->percent : '';
            });
            $table->editColumn('after_point', function ($row) {
                return $row->after_point ? $row->after_point : '';
            });
            $table->editColumn('after_percent', function ($row) {
                return $row->after_percent ? $row->after_percent : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bonusGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusGroups.create');
    }

    public function store(StoreBonusGroupRequest $request)
    {
        $bonusGroup = BonusGroup::create($request->all());

        return redirect()->route('admin.bonus-groups.index');
    }

    public function edit(BonusGroup $bonusGroup)
    {
        abort_if(Gate::denies('bonus_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusGroups.edit', compact('bonusGroup'));
    }

    public function update(UpdateBonusGroupRequest $request, BonusGroup $bonusGroup)
    {
        $bonusGroup->update($request->all());

        return redirect()->route('admin.bonus-settings.index')->with('tab', 'bonus4');
    }

    public function show(BonusGroup $bonusGroup)
    {
        abort_if(Gate::denies('bonus_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusGroups.show', compact('bonusGroup'));
    }

    public function destroy(BonusGroup $bonusGroup)
    {
        abort_if(Gate::denies('bonus_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusGroupRequest $request)
    {
        BonusGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
