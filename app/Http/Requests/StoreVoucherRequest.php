<?php

namespace App\Http\Requests;

use App\Models\Voucher;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVoucherRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('voucher_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'code' => [
                'string',
                'required',
                'max:125',
            ],
            'value' => [
                'numeric',
                'required',
                'between:0,9999999999999.99',
            ],
            'type' => [
                'required',
                'max:125',
            ],
            'roles.*' => [
                'integer',
                'exists:roles,id',
            ],
            'roles' => [
                'array',
            ],
            'started_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'ended_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
