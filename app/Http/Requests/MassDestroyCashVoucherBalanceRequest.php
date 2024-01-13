<?php

namespace App\Http\Requests;

use App\Models\CashVoucherBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCashVoucherBalanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cash_voucher_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cash_voucher_balances,id',
        ];
    }
}
