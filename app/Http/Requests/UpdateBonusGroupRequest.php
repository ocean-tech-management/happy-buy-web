<?php

namespace App\Http\Requests;

use App\Models\BonusGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBonusGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bonus_group_edit');
    }

    public function rules()
    {
        return [
            'point' => [
                'string',
                'required',
                'max:125',
            ],
            'percent' => [
                'string',
                'required',
                'max:125',
            ],
            'after_point' => [
                'string',
                'required',
                'max:125',
            ],
            'after_percent' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
