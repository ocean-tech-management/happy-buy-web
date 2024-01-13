<?php

namespace App\Http\Requests;

use App\Models\VoucherLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVoucherLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('voucher_log_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'amount' => [
                'string',
                'required',
                'max:125',
            ],
            'remark' => [
                'string',
                'nullable',
                'max:125',
            ],
        ];
    }
}
