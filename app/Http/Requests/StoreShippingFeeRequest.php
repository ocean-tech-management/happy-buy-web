<?php

namespace App\Http\Requests;

use App\Models\ShippingFee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreShippingFeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipping_fee_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'quantity' => [
                'string',
                'nullable',
                'max:125',
            ],
            'price' => [
                'string',
                'required',
                'max:125',
            ],
            'add_on' => [
                'string',
                'nullable',
                'max:125',
            ],
            'states.*' => [
                'integer',
            ],
            'states' => [   
                'required',
                'array',
            ],
        ];
    }
}
