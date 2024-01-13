<?php

namespace App\Http\Requests;

use App\Models\ProductBatch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductBatchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_batch_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'remark' => [
                'string',
                'nullable',
                'max:4294967295',
            ],
            'product_variant_id' => [
                'required',
                'integer',
                'exists:product_variants,id'
            ],
            'quantity' => [
                'string',
                'required',
                'max:125',
            ],
            'cost_price' => [
                'string',
                'required',
                'max:125',
            ],
            'generated_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'in_stock_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
