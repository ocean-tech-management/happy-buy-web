<?php

namespace App\Http\Requests;

use App\Models\UserAgreement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserAgreementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_agreement_edit');
    }

    public function rules()
    {
        return [
            'agreement_content' => [
                'required',
                'max:4294967295',
            ],
            'name' => [
                'string',
                'required',
                'max:125'
            ],
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id'
            ],
        ];
    }
}
