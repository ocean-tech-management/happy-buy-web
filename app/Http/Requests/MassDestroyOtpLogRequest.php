<?php

namespace App\Http\Requests;

use App\Models\OtpLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOtpLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('otp_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:otp_logs,id',
        ];
    }
}
