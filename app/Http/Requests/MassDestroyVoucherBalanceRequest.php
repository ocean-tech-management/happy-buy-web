<?php

namespace App\Http\Requests;

use App\Models\VoucherBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVoucherBalanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('voucher_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:voucher_balances,id',
        ];
    }
}
