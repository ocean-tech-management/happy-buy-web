<?php

namespace App\Http\Requests;

use App\Models\BonusPersonal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBonusPersonalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bonus_personal_create');
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
                'numeric',
                'required',
                'min:0',
                'max:100',
            ],
            'after_point' => [
                'string',
                'required',
                'max:125',
            ],
            'after_percent' => [
                'numeric',
                'required',
                'min:0',
                'max:100',
            ],
        ];
    }
}
