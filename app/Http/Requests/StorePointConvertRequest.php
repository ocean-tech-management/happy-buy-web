<?php

namespace App\Http\Requests;

use App\Models\PointConvert;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePointConvertRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_convert_create');
    }

    public function rules()
    {
        return [
            'transaction' => [
                'string',
                'nullable',
                'max:125',
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'amount' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'pre_cp_bonus_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'post_cp_bonus_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'pre_cp_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
            'post_cp_balance' => [
                'string',
                'nullable',
                'max:125',
            ],
        ];
    }
}
