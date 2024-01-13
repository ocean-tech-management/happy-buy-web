<?php

namespace App\Http\Requests;

use App\Models\ProductColor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductColorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_color_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'color' => [
                'string',
                'required',
                'max:125',
            ],
            'status' => [
                'required',
                'max:125',
            ],
        ];
    }
}
