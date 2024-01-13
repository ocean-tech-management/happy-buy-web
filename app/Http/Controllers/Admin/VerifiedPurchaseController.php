<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVerifiedPurchaseRequest;
use App\Http\Requests\StoreVerifiedPurchaseRequest;
use App\Http\Requests\UpdateVerifiedPurchaseRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedPurchaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('verified_purchase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.verifiedPurchases.index');
    }

    public function create()
    {
        abort_if(Gate::denies('verified_purchase_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.verifiedPurchases.create');
    }

    public function store(StoreVerifiedPurchaseRequest $request)
    {
        $verifiedPurchase = VerifiedPurchase::create($request->all());

        return redirect()->route('admin.verified-purchases.index');
    }

    public function edit(VerifiedPurchase $verifiedPurchase)
    {
        abort_if(Gate::denies('verified_purchase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.verifiedPurchases.edit', compact('verifiedPurchase'));
    }

    public function update(UpdateVerifiedPurchaseRequest $request, VerifiedPurchase $verifiedPurchase)
    {
        $verifiedPurchase->update($request->all());

        return redirect()->route('admin.verified-purchases.index');
    }

    public function show(VerifiedPurchase $verifiedPurchase)
    {
        abort_if(Gate::denies('verified_purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.verifiedPurchases.show', compact('verifiedPurchase'));
    }

    public function destroy(VerifiedPurchase $verifiedPurchase)
    {
        abort_if(Gate::denies('verified_purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verifiedPurchase->delete();

        return back();
    }

    public function massDestroy(MassDestroyVerifiedPurchaseRequest $request)
    {
        VerifiedPurchase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
