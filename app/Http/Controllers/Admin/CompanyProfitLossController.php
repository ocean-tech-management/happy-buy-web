<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompanyProfitLossRequest;
use App\Http\Requests\StoreCompanyProfitLossRequest;
use App\Http\Requests\UpdateCompanyProfitLossRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyProfitLossController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('company_profit_loss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyProfitLosses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('company_profit_loss_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyProfitLosses.create');
    }

    public function store(StoreCompanyProfitLossRequest $request)
    {
        $companyProfitLoss = CompanyProfitLoss::create($request->all());

        return redirect()->route('admin.company-profit-losses.index');
    }

    public function edit(CompanyProfitLoss $companyProfitLoss)
    {
        abort_if(Gate::denies('company_profit_loss_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyProfitLosses.edit', compact('companyProfitLoss'));
    }

    public function update(UpdateCompanyProfitLossRequest $request, CompanyProfitLoss $companyProfitLoss)
    {
        $companyProfitLoss->update($request->all());

        return redirect()->route('admin.company-profit-losses.index');
    }

    public function show(CompanyProfitLoss $companyProfitLoss)
    {
        abort_if(Gate::denies('company_profit_loss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyProfitLosses.show', compact('companyProfitLoss'));
    }

    public function destroy(CompanyProfitLoss $companyProfitLoss)
    {
        abort_if(Gate::denies('company_profit_loss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyProfitLoss->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyProfitLossRequest $request)
    {
        CompanyProfitLoss::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
