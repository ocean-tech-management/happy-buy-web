<?php

namespace App\Http\Requests;

use App\Models\ProductSize;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductSizeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_size_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'status' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
