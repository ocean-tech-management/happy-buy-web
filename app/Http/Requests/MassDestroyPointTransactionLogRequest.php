<?php

namespace App\Http\Requests;

use App\Models\PointTransactionLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPointTransactionLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('point_transaction_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:point_transaction_logs,id',
        ];
    }
}
