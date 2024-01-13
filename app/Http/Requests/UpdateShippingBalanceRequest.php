<?php

namespace App\Http\Requests;

use App\Models\ShippingBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShippingBalanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipping_balance_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'amount' => [
                'string',
                'required',
                'max:125',
            ],
            'remark' => [
                'string',
                'nullable',
                'max:125',
            ],
        ];
    }
}
