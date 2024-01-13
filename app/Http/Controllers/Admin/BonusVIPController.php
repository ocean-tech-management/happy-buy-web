<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusVIPRequest;
use App\Http\Requests\StoreBonusVIPRequest;
use App\Http\Requests\UpdateBonusVIPRequest;
use App\Models\BonusVIP;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusVIPController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_vip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusVIP.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_vip_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusVIP.create');
    }

    public function store(StoreBonusVIPRequest $request)
    {
        $BonusVIP = BonusVIP::create($request->all());

        return redirect()->route('admin.bonusVIP.index');
    }

    public function edit(BonusVIP $BonusVIP)
    {
        abort_if(Gate::denies('bonus_vip_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return redirect()->route('admin.bonus-settings.index')->with('tab', 'bonus6');
    }

    public function update(UpdateBonusVIPRequest $request, BonusVIP $bonusVIP, $id)
    {
        $bonusVIP = BonusVIP::find($id);
        $bonusVIP->update($request->all());
        
        return redirect()->route('admin.bonus-settings.index')->with('tab', 'bonus6');
    }

    public function show(BonusVIP $BonusVIP)
    {
        abort_if(Gate::denies('bonus_vip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusVIP.show', compact('BonusVIP'));
    }

    public function destroy(BonusVIP $BonusVIP)
    {
        abort_if(Gate::denies('bonus_vip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $BonusVIP->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusVIPRequest $request)
    {
        BonusVIP::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
