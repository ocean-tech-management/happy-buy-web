<?php

namespace App\Http\Requests;

use App\Models\TransactionPointWithdraw;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionPointWithdrawRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_point_withdraw_create');
    }

    public function rules()
    {
        return [
            'transaction' => [
                'string',
                'nullable',
                'max:125',
            ],
            'amount' => [
                'numeric',
                'between:0,9999999999999.99',
            ],
            'bank_name' => [
                'string',
                'nullable',
                'max:125',
            ],
            'bank_account_name' => [
                'string',
                'nullable',
                'max:125',
            ],
            'bank_account_number' => [
                'string',
                'nullable',
                'max:125',
            ],
            'status' => [
                'string',
                'nullable',
                'max:125',
            ],
            'remark' => [
                'string',
                'nullable',
                'max:4294967295',
            ],
            'receipt' => [
                'nullable',
            ],
        ];
    }
}
