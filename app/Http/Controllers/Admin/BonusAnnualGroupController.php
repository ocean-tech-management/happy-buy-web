<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusAnnualGroupRequest;
use App\Http\Requests\StoreBonusAnnualGroupRequest;
use App\Http\Requests\UpdateBonusAnnualGroupRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusAnnualGroupController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_annual_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusAnnualGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_annual_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusAnnualGroups.create');
    }

    public function store(StoreBonusAnnualGroupRequest $request)
    {
        $bonusAnnualGroup = BonusAnnualGroup::create($request->all());

        return redirect()->route('admin.bonus-annual-groups.index');
    }

    public function edit(BonusAnnualGroup $bonusAnnualGroup)
    {
        abort_if(Gate::denies('bonus_annual_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusAnnualGroups.edit', compact('bonusAnnualGroup'));
    }

    public function update(UpdateBonusAnnualGroupRequest $request, BonusAnnualGroup $bonusAnnualGroup)
    {
        $bonusAnnualGroup->update($request->all());

        return redirect()->route('admin.bonus-annual-groups.index');
    }

    public function show(BonusAnnualGroup $bonusAnnualGroup)
    {
        abort_if(Gate::denies('bonus_annual_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusAnnualGroups.show', compact('bonusAnnualGroup'));
    }

    public function destroy(BonusAnnualGroup $bonusAnnualGroup)
    {
        abort_if(Gate::denies('bonus_annual_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusAnnualGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusAnnualGroupRequest $request)
    {
        BonusAnnualGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
