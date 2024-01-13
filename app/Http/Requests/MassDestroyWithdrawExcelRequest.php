<?php

namespace App\Http\Requests;

use App\Models\WithdrawExcel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWithdrawExcelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('withdraw_excel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:withdraw_excels,id',
        ];
    }
}
