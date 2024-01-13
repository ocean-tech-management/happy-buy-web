<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMerchantAgreementRequest;
use App\Http\Requests\StoreMerchantAgreementRequest;
use App\Http\Requests\UpdateMerchantAgreementRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MerchantAgreementController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('merchant_agreement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merchantAgreements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('merchant_agreement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merchantAgreements.create');
    }

    public function store(StoreMerchantAgreementRequest $request)
    {
        $merchantAgreement = MerchantAgreement::create($request->all());

        return redirect()->route('admin.merchant-agreements.index');
    }

    public function edit(MerchantAgreement $merchantAgreement)
    {
        abort_if(Gate::denies('merchant_agreement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merchantAgreements.edit', compact('merchantAgreement'));
    }

    public function update(UpdateMerchantAgreementRequest $request, MerchantAgreement $merchantAgreement)
    {
        $merchantAgreement->update($request->all());

        return redirect()->route('admin.merchant-agreements.index');
    }

    public function show(MerchantAgreement $merchantAgreement)
    {
        abort_if(Gate::denies('merchant_agreement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merchantAgreements.show', compact('merchantAgreement'));
    }

    public function destroy(MerchantAgreement $merchantAgreement)
    {
        abort_if(Gate::denies('merchant_agreement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchantAgreement->delete();

        return back();
    }

    public function massDestroy(MassDestroyMerchantAgreementRequest $request)
    {
        MerchantAgreement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
