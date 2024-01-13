<?php

namespace App\Http\Requests;

use App\Models\TransactionBonusGiven;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionBonusGivenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_bonus_given_edit');
    }

    public function rules()
    {
        return [
            'transaction' => [
                'string',
                'nullable',
                'max:125',
            ],
            'admin_id' => [
                'nullable',
                'integer',
                'exists:admins,id',
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'title' => [
                'string',
                'nullable',
                'max:125',
            ],
            'remark' => [
                'string',
                'nullable',
                'max:125',
            ],
            'amount' => [
                'numeric',
                'between:0,9999999999999.99',
            ],
            'type' => [
                'required',
                'max:125',
            ],
            'status' => [
                'required',
                'max:125',
            ],
            'given_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
