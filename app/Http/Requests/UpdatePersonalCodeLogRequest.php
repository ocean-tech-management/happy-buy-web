<?php

namespace App\Http\Requests;

use App\Models\PersonalCodeLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePersonalCodeLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('personal_code_log_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
