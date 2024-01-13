<?php

namespace App\Http\Requests;

use App\Models\TransactionPointPurchase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionPointPurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_point_purchase_create');
    }

    public function rules()
    {
        return [
            'transaction' => [
                'string',
                'nullable',
                'max:125',
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'point_package_id' => [
                'required',
                'integer',
                'exists:point_packages,id'
            ],
            'payment_method_id' => [
                'required',
                'integer',
                'exists:payment_methods,id'
            ],
            'receipt' => [
                'required',
            ],
//            'point' => [
//                'numeric',
//            ],
//            'price' => [
//                'numeric',
//            ],
            'payment_verified_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'gateway_transaction' => [
                'string',
                'nullable',
                'max:125',
            ],
        ];
    }
}
