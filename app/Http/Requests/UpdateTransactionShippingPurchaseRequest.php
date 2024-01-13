<?php

namespace App\Http\Requests;

use App\Models\TransactionShippingPurchase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionShippingPurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_shipping_purchase_edit');
    }

    public function rules()
    {
        return [
            'transaction' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'nullable',
                'exists:users,id'
            ],
            'payment_method_id' => [
                'nullable',
                'exists:payment_methods,id'
            ],
            'point' => [
                'numeric',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price' => [
                'numeric',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status' => [
                'string',
                'nullable',
                'max:125',
            ],
            'payment_verified_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'gateway_transaction' => [
                'string',
                'nullable',
            ],
            'receipt' => [
                'nullable',
            ],
        ];
    }
}
