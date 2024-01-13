<?php

namespace App\Http\Requests;

use App\Models\DepositBank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDepositBankRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('deposit_bank_edit');
    }

    public function rules()
    {
        return [
            'bank_id' => [
                'required',
                'integer',
                'exists:bank_lists,id'
            ],
            'bank_account_name' => [
                'string',
                'required',
                'max:125',
            ],
            'bank_account_number' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
