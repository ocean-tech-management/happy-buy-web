<?php

namespace App\Http\Requests;

use App\Models\BonusJoin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBonusJoinRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bonus_join_create');
    }

    public function rules()
    {
        return [
            'first_upline_bonus' => [
                'numeric',
                'required',
                'between:0,9999999999999.99'
            ],
            'second_upline_bonus' => [
                'numeric',
                'required',
                'between:0,9999999999999.99'
            ],
        ];
    }
}
