<?php

namespace App\Http\Requests;

use App\Models\PayoutLimit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePayoutLimitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payout_limit_edit');
    }

    public function rules()
    {
        return [
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id',
            ],
            'min_amount' => [
                'numeric',
                'required',
                'between:0,9999999999999.99',
            ],
            'max_amount' => [
                'numeric',
                'required',
                'between:0,9999999999999.99',
            ],
        ];
    }
}
