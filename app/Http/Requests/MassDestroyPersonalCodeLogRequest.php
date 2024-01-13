<?php

namespace App\Http\Requests;

use App\Models\PersonalCodeLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPersonalCodeLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('personal_code_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:personal_code_logs,id',
        ];
    }
}
