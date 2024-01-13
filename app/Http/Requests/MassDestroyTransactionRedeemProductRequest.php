<?php

namespace App\Http\Requests;

use App\Models\TransactionRedeemProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTransactionRedeemProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transaction_redeem_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:transaction_redeem_products,id',
        ];
    }
}
