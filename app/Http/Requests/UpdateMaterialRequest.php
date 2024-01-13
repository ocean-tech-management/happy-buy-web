<?php

namespace App\Http\Requests;

use App\Models\Material;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMaterialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('material_edit');
    }

    public function rules()
    {
        return [
            'file_title_1' => [
                'string',
                'nullable',
                'max:125',
            ],
            'file_title_2' => [
                'string',
                'nullable',
                'max:125',
            ],
            'file_title_3' => [
                'string',
                'nullable',
                'max:125',
            ],
            'file_title_4' => [
                'string',
                'nullable',
                'max:125',
            ],
            'file_title_5' => [
                'string',
                'nullable',
                'max:125',
            ],
            'publish_year' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'publish_month' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
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
