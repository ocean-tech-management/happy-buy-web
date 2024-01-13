<?php

namespace App\Http\Requests;

use App\Models\TransactionShippingPurchase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTransactionShippingPurchaseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transaction_shipping_purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:transaction_shipping_purchases,id',
        ];
    }
}
