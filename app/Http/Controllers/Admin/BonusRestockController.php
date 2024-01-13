<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusRestockRequest;
use App\Http\Requests\StoreBonusRestockRequest;
use App\Http\Requests\UpdateBonusRestockRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusRestockController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_restock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusRestocks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_restock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusRestocks.create');
    }

    public function store(StoreBonusRestockRequest $request)
    {
        $bonusRestock = BonusRestock::create($request->all());

        return redirect()->route('admin.bonus-restocks.index');
    }

    public function edit(BonusRestock $bonusRestock)
    {
        abort_if(Gate::denies('bonus_restock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusRestocks.edit', compact('bonusRestock'));
    }

    public function update(UpdateBonusRestockRequest $request, BonusRestock $bonusRestock)
    {
        $bonusRestock->update($request->all());

        return redirect()->route('admin.bonus-restocks.index');
    }

    public function show(BonusRestock $bonusRestock)
    {
        abort_if(Gate::denies('bonus_restock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusRestocks.show', compact('bonusRestock'));
    }

    public function destroy(BonusRestock $bonusRestock)
    {
        abort_if(Gate::denies('bonus_restock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusRestock->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusRestockRequest $request)
    {
        BonusRestock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
