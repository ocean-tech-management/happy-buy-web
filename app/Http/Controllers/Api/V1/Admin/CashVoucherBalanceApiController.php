<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCashVoucherBalanceRequest;
use App\Http\Requests\UpdateCashVoucherBalanceRequest;
use App\Http\Resources\Admin\CashVoucherBalanceResource;
use App\Models\CashVoucherBalance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashVoucherBalanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cash_voucher_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashVoucherBalanceResource(CashVoucherBalance::with(['user'])->get());
    }

    public function store(StoreCashVoucherBalanceRequest $request)
    {
        $cashVoucherBalance = CashVoucherBalance::create($request->all());

        return (new CashVoucherBalanceResource($cashVoucherBalance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CashVoucherBalance $cashVoucherBalance)
    {
        abort_if(Gate::denies('cash_voucher_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashVoucherBalanceResource($cashVoucherBalance->load(['user']));
    }

    public function update(UpdateCashVoucherBalanceRequest $request, CashVoucherBalance $cashVoucherBalance)
    {
        $cashVoucherBalance->update($request->all());

        return (new CashVoucherBalanceResource($cashVoucherBalance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CashVoucherBalance $cashVoucherBalance)
    {
        abort_if(Gate::denies('cash_voucher_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashVoucherBalance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
