<?php

namespace App\Http\Requests;

use App\Models\State;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('state_create');
    }

    public function rules()
    {
        return [
            'country_id' => [
                'required',
                'integer',
                'exists:countries,id'
            ],
            'name' => [
                'string',
                'required',
                'max:125'
            ],
            'status' => [
                'required',
                'max:125',
            ],
        ];
    }
}
