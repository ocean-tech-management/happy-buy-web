<?php

namespace App\Http\Requests;

use App\Models\TransactionBonu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTransactionBonuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transaction_bonu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:transaction_bonus,id',
        ];
    }
}
