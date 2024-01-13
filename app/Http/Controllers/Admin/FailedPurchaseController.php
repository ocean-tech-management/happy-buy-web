<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFailedPurchaseRequest;
use App\Http\Requests\StoreFailedPurchaseRequest;
use App\Http\Requests\UpdateFailedPurchaseRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FailedPurchaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('failed_purchase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.failedPurchases.index');
    }

    public function create()
    {
        abort_if(Gate::denies('failed_purchase_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.failedPurchases.create');
    }

    public function store(StoreFailedPurchaseRequest $request)
    {
        $failedPurchase = FailedPurchase::create($request->all());

        return redirect()->route('admin.failed-purchases.index');
    }

    public function edit(FailedPurchase $failedPurchase)
    {
        abort_if(Gate::denies('failed_purchase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.failedPurchases.edit', compact('failedPurchase'));
    }

    public function update(UpdateFailedPurchaseRequest $request, FailedPurchase $failedPurchase)
    {
        $failedPurchase->update($request->all());

        return redirect()->route('admin.failed-purchases.index');
    }

    public function show(FailedPurchase $failedPurchase)
    {
        abort_if(Gate::denies('failed_purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.failedPurchases.show', compact('failedPurchase'));
    }

    public function destroy(FailedPurchase $failedPurchase)
    {
        abort_if(Gate::denies('failed_purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $failedPurchase->delete();

        return back();
    }

    public function massDestroy(MassDestroyFailedPurchaseRequest $request)
    {
        FailedPurchase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
