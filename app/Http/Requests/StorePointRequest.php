<?php

namespace App\Http\Requests;

use App\Models\Point;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'point_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'point_manager_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'point_executive_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'point_bonus_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'voucher_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'shipping_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'cash_voucher_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'pv_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
        ];
    }
}
