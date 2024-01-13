<?php

namespace App\Http\Requests;

use App\Models\TransactionBonu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionBonuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_bonu_create');
    }

    public function rules()
    {
        return [
            'transaction' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'nullable',
            ],
            'remark' => [
                'string',
                'nullable',
            ],
            'amount' => [
                'numeric',
            ],
            'given_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
