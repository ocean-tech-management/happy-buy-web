<?php

namespace App\Http\Requests;

use App\Models\Cart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCartRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cart_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'to_user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'product_variant_id' => [
                'required',
                'integer',
                'exists:product_variants,id'
            ],
            'quantity' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status' => [
                'required',
                'max:125',
            ],
        ];
    }
}
