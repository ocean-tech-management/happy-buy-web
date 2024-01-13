<?php

namespace App\Http\Requests;

use App\Models\OrderItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_item_create');
    }

    public function rules()
    {
        return [
            'order_id' => [
                'required',
                'integer',
                'exists:orders,id'
            ],
            'product_name_en' => [
                'string',
                'nullable',
                'max:125',
            ],
            'product_name_zh' => [
                'string',
                'nullable',
                'max:125',
            ],
            'product_desc_en' => [
                'string',
                'nullable',
                'max:4294967295',
            ],
            'product_desc_zh' => [
                'string',
                'nullable',
                'max:4294967295',
            ],
            'product_quantity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'product_color' => [
                'string',
                'nullable',
                'max:125',
            ],
            'product_size' => [
                'string',
                'nullable',
                'max:125',
            ],
            'product_sku' => [
                'string',
                'nullable',
                'max:125',
            ],
            'sales_price' => [
                'string',
                'nullable',
                'max:125',
            ],
            'merchant_president_price' => [
                'string',
                'nullable',
                'max:125',
            ],
            'agent_director_price' => [
                'string',
                'nullable',
                'max:125',
            ],
            'agent_executive_price' => [
                'string',
                'nullable',
                'max:125',
            ],
            'price_add_on' => [
                'string',
                'nullable',
                'max:125',
            ],
        ];
    }
}
