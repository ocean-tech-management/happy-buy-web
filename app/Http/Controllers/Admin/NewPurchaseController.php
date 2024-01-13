<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNewPurchaseRequest;
use App\Http\Requests\StoreNewPurchaseRequest;
use App\Http\Requests\UpdateNewPurchaseRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewPurchaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('new_purchase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newPurchases.index');
    }

    public function create()
    {
        abort_if(Gate::denies('new_purchase_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newPurchases.create');
    }

    public function store(StoreNewPurchaseRequest $request)
    {
        $newPurchase = NewPurchase::create($request->all());

        return redirect()->route('admin.new-purchases.index');
    }

    public function edit(NewPurchase $newPurchase)
    {
        abort_if(Gate::denies('new_purchase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newPurchases.edit', compact('newPurchase'));
    }

    public function update(UpdateNewPurchaseRequest $request, NewPurchase $newPurchase)
    {
        $newPurchase->update($request->all());

        return redirect()->route('admin.new-purchases.index');
    }

    public function show(NewPurchase $newPurchase)
    {
        abort_if(Gate::denies('new_purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newPurchases.show', compact('newPurchase'));
    }

    public function destroy(NewPurchase $newPurchase)
    {
        abort_if(Gate::denies('new_purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newPurchase->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewPurchaseRequest $request)
    {
        NewPurchase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
