<?php

namespace App\Http\Requests;

use App\Models\PointBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPointBalanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('point_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:point_balances,id',
        ];
    }
}
