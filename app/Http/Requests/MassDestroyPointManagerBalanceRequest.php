<?php

namespace App\Http\Requests;

use App\Models\PointManagerBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPointManagerBalanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('point_manager_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:point_manager_balances,id',
        ];
    }
}
