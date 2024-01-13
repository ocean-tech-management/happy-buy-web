<?php

namespace App\Http\Requests;

use App\Models\WithdrawExcel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWithdrawExcelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('withdraw_excel_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
                'max:125',
            ],
            'file' => [
                'nullable'
            ],
        ];
    }
}
