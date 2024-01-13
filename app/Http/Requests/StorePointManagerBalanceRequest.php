<?php

namespace App\Http\Requests;

use App\Models\PointManagerBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePointManagerBalanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_manager_balance_create');
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
