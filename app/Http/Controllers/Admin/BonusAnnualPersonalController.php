<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusAnnualPersonalRequest;
use App\Http\Requests\StoreBonusAnnualPersonalRequest;
use App\Http\Requests\UpdateBonusAnnualPersonalRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusAnnualPersonalController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_annual_personal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusAnnualPersonals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_annual_personal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusAnnualPersonals.create');
    }

    public function store(StoreBonusAnnualPersonalRequest $request)
    {
        $bonusAnnualPersonal = BonusAnnualPersonal::create($request->all());

        return redirect()->route('admin.bonus-annual-personals.index');
    }

    public function edit(BonusAnnualPersonal $bonusAnnualPersonal)
    {
        abort_if(Gate::denies('bonus_annual_personal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusAnnualPersonals.edit', compact('bonusAnnualPersonal'));
    }

    public function update(UpdateBonusAnnualPersonalRequest $request, BonusAnnualPersonal $bonusAnnualPersonal)
    {
        $bonusAnnualPersonal->update($request->all());

        return redirect()->route('admin.bonus-annual-personals.index');
    }

    public function show(BonusAnnualPersonal $bonusAnnualPersonal)
    {
        abort_if(Gate::denies('bonus_annual_personal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusAnnualPersonals.show', compact('bonusAnnualPersonal'));
    }

    public function destroy(BonusAnnualPersonal $bonusAnnualPersonal)
    {
        abort_if(Gate::denies('bonus_annual_personal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusAnnualPersonal->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusAnnualPersonalRequest $request)
    {
        BonusAnnualPersonal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
