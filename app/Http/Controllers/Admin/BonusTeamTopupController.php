<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusTeamTopupRequest;
use App\Http\Requests\StoreBonusTeamTopupRequest;
use App\Http\Requests\UpdateBonusTeamTopupRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusTeamTopupController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_team_topup_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusTeamTopups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_team_topup_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusTeamTopups.create');
    }

    public function store(StoreBonusTeamTopupRequest $request)
    {
        $bonusTeamTopup = BonusTeamTopup::create($request->all());

        return redirect()->route('admin.bonus-team-topups.index');
    }

    public function edit(BonusTeamTopup $bonusTeamTopup)
    {
        abort_if(Gate::denies('bonus_team_topup_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusTeamTopups.edit', compact('bonusTeamTopup'));
    }

    public function update(UpdateBonusTeamTopupRequest $request, BonusTeamTopup $bonusTeamTopup)
    {
        $bonusTeamTopup->update($request->all());

        return redirect()->route('admin.bonus-team-topups.index');
    }

    public function show(BonusTeamTopup $bonusTeamTopup)
    {
        abort_if(Gate::denies('bonus_team_topup_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusTeamTopups.show', compact('bonusTeamTopup'));
    }

    public function destroy(BonusTeamTopup $bonusTeamTopup)
    {
        abort_if(Gate::denies('bonus_team_topup_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusTeamTopup->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusTeamTopupRequest $request)
    {
        BonusTeamTopup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
