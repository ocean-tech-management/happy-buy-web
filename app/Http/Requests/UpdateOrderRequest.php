<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'cart_id' => [
                'required',
                'integer',
            ],
            'order_number' => [
                'string',
                'nullable',
                'max:125',
            ],
            'amount' => [
                'string',
                'nullable',
                'max:125',
            ],
        ];
    }
}
