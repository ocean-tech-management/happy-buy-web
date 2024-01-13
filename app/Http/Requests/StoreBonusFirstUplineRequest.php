<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreBonusFirstUplineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('bonus_join_create'); // Same with Bonus Join Section
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'referral_count' => [
                'required',
                'integer',
                'between:0,999999',
                'unique:App\Models\BonusFirstUpline,referral_count',
            ],
            'bonus_amount' => [
                'required',
                'numeric',
                'between:0,9999999999999.99',
            ],
            'top_up_count' => [
                'nullable',
                'integer',
                'between:0,999999',
            ],
            'extra_top_up_bonus' => [
                'nullable',
                'numeric',
                'between:0,9999999999999.99',
            ],
            'days' => [
                'nullable',
                'integer',
                'between:0,999999',
            ],
            'status' => [
                'required',
                'integer',
            ],
        ];
    }
}
