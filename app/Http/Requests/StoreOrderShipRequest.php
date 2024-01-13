<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderShipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_create');
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
