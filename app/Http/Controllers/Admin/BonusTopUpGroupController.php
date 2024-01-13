<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusTopUpGroupRequest;
use App\Http\Requests\StoreBonusTopUpGroupRequest;
use App\Http\Requests\UpdateBonusTopUpGroupRequest;
use App\Models\BonusTopUpGroup;
use App\Models\PointPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BonusTopUpGroupController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bonus_top_up_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BonusTopUpGroup::with(['point_package'])->select(sprintf('%s.*', (new BonusTopUpGroup())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bonus_top_up_group_show';
                $editGate = 'bonus_top_up_group_edit';
                $deleteGate = 'bonus_top_up_group_delete';
                $crudRoutePart = 'bonus-top-up-groups';

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
            $table->addColumn('point_package_name_en', function ($row) {
                return $row->point_package ? $row->point_package->name_en : '';
            });

            $table->editColumn('first_upline_bonus', function ($row) {
                return $row->first_upline_bonus ? $row->first_upline_bonus : '';
            });
            $table->editColumn('second_upline_bonus', function ($row) {
                return $row->second_upline_bonus ? $row->second_upline_bonus : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'point_package']);

            return $table->make(true);
        }

        return view('admin.bonusTopUpGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_top_up_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point_packages = PointPackage::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bonusTopUpGroups.create', compact('point_packages'));
    }

    public function store(StoreBonusTopUpGroupRequest $request)
    {
        $bonusTopUpGroup = BonusTopUpGroup::create($request->all());

        return redirect()->route('admin.bonus-top-up-groups.index');
    }

    public function edit(BonusTopUpGroup $bonusTopUpGroup)
    {
        abort_if(Gate::denies('bonus_top_up_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point_packages = PointPackage::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bonusTopUpGroup->load('point_package');

        return view('admin.bonusTopUpGroups.edit', compact('point_packages', 'bonusTopUpGroup'));
    }

    public function update(UpdateBonusTopUpGroupRequest $request, BonusTopUpGroup $bonusTopUpGroup)
    {
        $bonusTopUpGroup->update($request->all());

        return redirect()->route('admin.bonus-settings.index')->with('tab', 'bonus2');
    }

    public function show(BonusTopUpGroup $bonusTopUpGroup)
    {
        abort_if(Gate::denies('bonus_top_up_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusTopUpGroup->load('point_package');

        return view('admin.bonusTopUpGroups.show', compact('bonusTopUpGroup'));
    }

    public function destroy(BonusTopUpGroup $bonusTopUpGroup)
    {
        abort_if(Gate::denies('bonus_top_up_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusTopUpGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusTopUpGroupRequest $request)
    {
        BonusTopUpGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
