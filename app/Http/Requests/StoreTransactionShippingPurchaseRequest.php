<?php

namespace App\Http\Requests;

use App\Models\TransactionShippingPurchase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionShippingPurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_shipping_purchase_create');
    }

    public function rules()
    {
        return [
            'transaction' => [
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
                'max:125',
            ],
            'receipt' => [
                'required',
            ],
        ];
    }
}
