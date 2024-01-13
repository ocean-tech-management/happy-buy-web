<?php

namespace App\Http\Requests;

use App\Models\TransactionAgentTopUp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionAgentTopUpRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_agent_top_up_edit');
    }

    public function rules()
    {
        return [
            'transaction' => [
                'string',
                'nullable',
                'max:125',
            ],
            'amount' => [
                'string',
                'nullable',
                'max:125',
            ],
            'merchant_pre_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'merchant_post_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'user_pre_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'user_post_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'approved_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'rejected_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
