<?php

namespace App\Http\Requests;

use App\Models\TransactionRedeemProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionRedeemProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_redeem_product_create');
    }

    public function rules()
    {
        return [
            'variant_id' => [
                'required',
                'integer',
                'exists:product_variants,id'
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'collect_type' => [
                'required',
                'integer',
            ],
            'tracking_code' => [
                'string',
                'nullable',
                'max:125',
            ],

        ];
    }
}
