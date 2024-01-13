<?php

namespace App\Http\Requests;

use App\Models\Enquiry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('enquiry_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'message' => [
                'required',
                'max:4294967295',
            ],
            'status' => [
                'required',
                'max:125',
            ],
        ];
    }
}
