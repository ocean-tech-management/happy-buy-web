<?php

namespace App\Http\Requests;

use App\Models\TransactionRedeemProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionRedeemProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_redeem_product_edit');
    }

    public function rules()
    {
        return [
            'variant_id' => [
                'required',
                'integer',
                'exists:product_variants,id',
            ],
            'address_id' => [
                'nullable',
                'exists:address_books,id',
            ],
            'collect_type' => [
                'string',
                'nullable',
                'max:125',
            ],
            'refund_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'pickup_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'shipout_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'completed_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
