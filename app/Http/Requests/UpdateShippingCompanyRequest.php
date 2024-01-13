<?php

namespace App\Http\Requests;

use App\Models\ShippingCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShippingCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipping_company_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'api_name' => [
                'string',
                'nullable',
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
