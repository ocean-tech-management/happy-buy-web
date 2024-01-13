<?php

namespace App\Http\Requests;

use App\Models\BankList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBankListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_list_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
                'max:125',
            ],
            'bank_name' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
