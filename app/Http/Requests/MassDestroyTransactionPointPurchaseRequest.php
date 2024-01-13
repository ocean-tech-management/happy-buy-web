<?php

namespace App\Http\Requests;

use App\Models\TransactionPointPurchase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTransactionPointPurchaseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transaction_point_purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:transaction_point_purchases,id',
        ];
    }
}
