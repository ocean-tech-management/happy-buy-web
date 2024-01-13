<?php

namespace App\Http\Requests;

use App\Models\PointTransactionLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePointTransactionLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_transaction_log_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'top_up' => [
                'string',
                'required',
                'max:125',
            ],
            'point_convert' => [
                'string',
                'required',
                'max:125',
            ],
            'redemption' => [
                'string',
                'required',
                'max:125',
            ],
            'shipping' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
