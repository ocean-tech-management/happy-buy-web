<?php

namespace App\Http\Requests;

use App\Models\TransactionPointPurchase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionPointPurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_point_purchase_edit');
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
            'payment_verified_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'gateway_transaction' => [
                'string',
                'nullable',
            ],
        ];
    }
}
