<?php

namespace App\Http\Requests;

use App\Models\UserAgreementLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserAgreementLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_agreement_log_create');
    }

    public function rules()
    {
        return [
            'user_agreement_id' => [
                'required',
                'integer',
                'exists:user_agreements,id'
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'signature_name' => [
                'string',
                'required',
                'max:125',
            ],
            'signature_ic' => [
                'string',
                'required',
                'max:125',
            ],
            'signature_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
