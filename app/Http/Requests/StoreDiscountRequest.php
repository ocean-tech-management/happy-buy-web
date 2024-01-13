<?php

namespace App\Http\Requests;

use App\Models\Discount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDiscountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('discount_create');
    }

    public function rules()
    {
        return [
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'percent' => [
                'numeric',
                'required',
                'between:0,99.99'
            ],
            'roles.*' => [
                'integer',
                'exists:roles,id',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'status' => [
                'required',
                'max:125',
            ],
        ];
    }
}
