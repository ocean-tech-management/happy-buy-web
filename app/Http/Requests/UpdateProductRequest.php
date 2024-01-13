<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'required',
                'max:125',
            ],
            'name_zh' => [
                'string',
                'nullable',
                'max:125',
            ],
            'short_desc_en' => [
                'required',
                'max:4294967295',
            ],
            'short_desc_zh' => [
                'nullable',
                'max:4294967295',
            ],
            'desc_en' => [
                'required',
                'max:4294967295',
            ],
            'desc_zh' => [
                'nullable',
                'max:4294967295',
            ],
            'image_1' => [
                'required',
            ],
            'image_2' => [
                'nullable',
            ],
            'image_3' => [
                'nullable',
            ],
            'image_4' => [
                'nullable',
            ],
            'image_5' => [
                'nullable',
            ],
            'category_id' => [
                'required',
                'integer',
                'exists:product_categories,id'
            ],
            'type' => [
                'required',
                'max:125',
            ],
            'product_variant_quantity' => [
                'nullable',
                'required_if:type,2',
                'integer',
            ],
            'product_variant_item_quantity' => [
                'nullable',
                'required_if:type,2',
                'integer',
            ],
            'product_list.*' => [
                'nullable',
                'required_if:type,2',
                'integer',
                'exists:products,id',
            ],
            'product_list' => [
                'array',
            ],
        ];
    }
}
