<?php

namespace App\Http\Requests;

use App\Models\UserEntry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserEntryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_entry_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'user_type' => [
                'required',
                'max:125',
            ],
            'deposit' => [
                'string',
                'required',
                'max:125',
            ],
            'fee' => [
                'string',
                'required',
                'max:125',
            ],
            'top_up' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
