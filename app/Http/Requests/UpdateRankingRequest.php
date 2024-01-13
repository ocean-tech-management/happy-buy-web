<?php

namespace App\Http\Requests;

use App\Models\Ranking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRankingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ranking_edit');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'required',
                'max:125',
            ],
            'name_zh' => [
                'string',
                'nullable',
                'max:125',
            ],
            'point' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
