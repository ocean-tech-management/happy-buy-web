<?php

namespace App\Http\Requests;

use App\Models\PointPackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePointPackageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_package_create');
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
            'package_photo' => [
                'required',
            ],
            'point' => [
                'numeric',
                'between:0,9999999999999.99',
            ],
            'price' => [
                'numeric',
                'between:0,9999999999999.99',
            ],
            'roles.*' => [
                'integer',
                'exists:roles,id',
            ],
            'roles' => [
                'array',
            ],
        ];
    }
}
