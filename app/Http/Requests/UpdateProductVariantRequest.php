<?php

namespace App\Http\Requests;

use App\Models\ProductVariant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UpdateProductVariantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_variant_edit');
    }

    public function rules()
    {
        return [
            'color_id' => [
                'required',
                'integer',
                'exists:product_colors,id',
            ],
            'size_id' => [
                'required',
                'integer',
                'exists:product_sizes,id',
            ],
            'photo' => [
                'required',
            ],
            'type' => [
                'required',
                Rule::in([1,2,3])
            ],
            'sku' => [
                'string',
                'required',
                'max:125',
                'unique:product_variants,sku,' . request()->route('product_variant')->id,
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
                'max:125'
            ],
            'agent_executive_price' => [
                'string',
                'nullable',
                'max:125'
            ],
            'vip_redeem_pv' => [
                'string',
                'nullable',
                'max:125',
            ],
            'price_add_on' => [
                'string',
                'nullable',
                'max:125',
            ],
            'qr_quantity' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
