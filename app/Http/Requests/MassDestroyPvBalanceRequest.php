<?php

namespace App\Http\Requests;

use App\Models\PvBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPvBalanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pv_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pv_balances,id',
        ];
    }
}
