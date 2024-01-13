<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCommissionReportRequest;
use App\Http\Requests\StoreCommissionReportRequest;
use App\Http\Requests\UpdateCommissionReportRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommissionReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('commission_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.commissionReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('commission_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.commissionReports.create');
    }

    public function store(StoreCommissionReportRequest $request)
    {
        $commissionReport = CommissionReport::create($request->all());

        return redirect()->route('admin.commission-reports.index');
    }

    public function edit(CommissionReport $commissionReport)
    {
        abort_if(Gate::denies('commission_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.commissionReports.edit', compact('commissionReport'));
    }

    public function update(UpdateCommissionReportRequest $request, CommissionReport $commissionReport)
    {
        $commissionReport->update($request->all());

        return redirect()->route('admin.commission-reports.index');
    }

    public function show(CommissionReport $commissionReport)
    {
        abort_if(Gate::denies('commission_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.commissionReports.show', compact('commissionReport'));
    }

    public function destroy(CommissionReport $commissionReport)
    {
        abort_if(Gate::denies('commission_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commissionReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommissionReportRequest $request)
    {
        CommissionReport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
