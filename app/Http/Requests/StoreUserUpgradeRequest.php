<?php

namespace App\Http\Requests;

use App\Models\UserUpgrade;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserUpgradeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_upgrade_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'amount' => [
                'string',
                'required',
                'max:125',
            ],
            'receipt' => [
                'required',
            ],
            'status' => [
                'required',
                'max:125',
            ],
            'gateway_transaction' => [
                'string',
                'nullable',
                'max:125',
            ],
            'gateway_response' => [
                'string',
                'nullable',
                'max:4294967295',
            ],
            'approve_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
