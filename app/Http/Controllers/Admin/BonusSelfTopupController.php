<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusSelfTopupRequest;
use App\Http\Requests\StoreBonusSelfTopupRequest;
use App\Http\Requests\UpdateBonusSelfTopupRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusSelfTopupController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_self_topup_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusSelfTopups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_self_topup_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusSelfTopups.create');
    }

    public function store(StoreBonusSelfTopupRequest $request)
    {
        $bonusSelfTopup = BonusSelfTopup::create($request->all());

        return redirect()->route('admin.bonus-self-topups.index');
    }

    public function edit(BonusSelfTopup $bonusSelfTopup)
    {
        abort_if(Gate::denies('bonus_self_topup_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusSelfTopups.edit', compact('bonusSelfTopup'));
    }

    public function update(UpdateBonusSelfTopupRequest $request, BonusSelfTopup $bonusSelfTopup)
    {
        $bonusSelfTopup->update($request->all());

        return redirect()->route('admin.bonus-self-topups.index');
    }

    public function show(BonusSelfTopup $bonusSelfTopup)
    {
        abort_if(Gate::denies('bonus_self_topup_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusSelfTopups.show', compact('bonusSelfTopup'));
    }

    public function destroy(BonusSelfTopup $bonusSelfTopup)
    {
        abort_if(Gate::denies('bonus_self_topup_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusSelfTopup->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusSelfTopupRequest $request)
    {
        BonusSelfTopup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
