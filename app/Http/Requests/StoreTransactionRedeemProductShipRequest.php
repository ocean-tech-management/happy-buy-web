<?php

namespace App\Http\Requests;

use App\Models\TransactionRedeemProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionRedeemProductShipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_redeem_product_to_ship');
    }

    public function rules()
    {
        return [
            'shipping_company_id' => [
                'required',
                'integer',
                'exists:shipping_companies,id',
            ],
            'tracking_code' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
