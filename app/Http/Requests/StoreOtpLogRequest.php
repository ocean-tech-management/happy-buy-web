<?php

namespace App\Http\Requests;

use App\Models\OtpLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOtpLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('otp_log_create');
    }

    public function rules()
    {
        return [
            'phone' => [
                'string',
                'required',
                'max:125',
            ],
            'code' => [
                'string',
                'required',
                'max:125',
            ],
            'content' => [
                'required',
                'max:4294967295',
            ],
            'used_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
