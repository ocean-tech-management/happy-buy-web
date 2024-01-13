<?php

namespace App\Http\Requests;

use App\Models\TransactionIdLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionIdLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_id_log_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
                'max:125',
            ],
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
        ];
    }
}
