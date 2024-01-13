<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusSettingRequest;
use App\Http\Requests\StoreBonusSettingRequest;
use App\Http\Requests\UpdateBonusSettingRequest;
use App\Models\BonusGroup;
use App\Models\BonusJoin;
use App\Models\BonusPersonal;
use App\Models\BonusTopUpGroup;
use App\Models\BonusTopUpPersonal;
use App\Models\BonusVIP;

use App\Models\BonusTeamCar;
use App\Models\BonusTeamHouse;

use App\Models\PointPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusSettingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusJoin = BonusJoin::whereId(1)->first();

        $point_packages = PointPackage::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');
        $bonusTopUpGroup = BonusTopUpGroup::whereId(1)->first();

        $bonusTopUpPersonal = BonusTopUpPersonal::whereId(1)->first();

        // This will Remove
        $bonusGroup = BonusGroup::whereId(1)->first();
        $bonusPersonal = BonusPersonal::whereId(1)->first();

        $bonusTeamCar = BonusTeamCar::whereId(1)->first();
        $bonusTeamHouse = BonusTeamHouse::whereId(1)->first();

        // $bonusVIP = BonusVIP::whereId(1)->first();

        return view('admin.bonusSettings.index', compact('bonusJoin', 'bonusTopUpGroup', 'point_packages', 'bonusTopUpPersonal', 'bonusGroup', 'bonusPersonal', 'bonusTeamCar', 'bonusTeamHouse'));
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusSettings.create');
    }

    public function store(StoreBonusSettingRequest $request)
    {
        $bonusSetting = BonusSetting::create($request->all());

        return redirect()->route('admin.bonus-settings.index');
    }

    public function edit(BonusSetting $bonusSetting)
    {
        abort_if(Gate::denies('bonus_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusSettings.edit', compact('bonusSetting'));
    }

    public function update(UpdateBonusSettingRequest $request, BonusSetting $bonusSetting)
    {
        $bonusSetting->update($request->all());

        return redirect()->route('admin.bonus-settings.index');
    }

    public function show(BonusSetting $bonusSetting)
    {
        abort_if(Gate::denies('bonus_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusSettings.show', compact('bonusSetting'));
    }

    public function destroy(BonusSetting $bonusSetting)
    {
        abort_if(Gate::denies('bonus_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusSettingRequest $request)
    {
        BonusSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
