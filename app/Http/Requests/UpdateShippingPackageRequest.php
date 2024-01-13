<?php

namespace App\Http\Requests;

use App\Models\ShippingPackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShippingPackageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipping_package_edit');
    }

    public function rules()
    {
        return [
            'price' => [
                'string',
                'required',
                'max:125',
            ],
            'point' => [
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
