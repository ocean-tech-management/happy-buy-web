<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusRefRequest;
use App\Http\Requests\StoreBonusRefRequest;
use App\Http\Requests\UpdateBonusRefRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonusRefController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonus_ref_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusRefs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_ref_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusRefs.create');
    }

    public function store(StoreBonusRefRequest $request)
    {
        $bonusRef = BonusRef::create($request->all());

        return redirect()->route('admin.bonus-refs.index');
    }

    public function edit(BonusRef $bonusRef)
    {
        abort_if(Gate::denies('bonus_ref_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusRefs.edit', compact('bonusRef'));
    }

    public function update(UpdateBonusRefRequest $request, BonusRef $bonusRef)
    {
        $bonusRef->update($request->all());

        return redirect()->route('admin.bonus-refs.index');
    }

    public function show(BonusRef $bonusRef)
    {
        abort_if(Gate::denies('bonus_ref_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusRefs.show', compact('bonusRef'));
    }

    public function destroy(BonusRef $bonusRef)
    {
        abort_if(Gate::denies('bonus_ref_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusRef->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusRefRequest $request)
    {
        BonusRef::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
