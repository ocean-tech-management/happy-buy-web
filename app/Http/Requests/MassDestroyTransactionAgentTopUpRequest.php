<?php

namespace App\Http\Requests;

use App\Models\TransactionAgentTopUp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTransactionAgentTopUpRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transaction_agent_top_up_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:transaction_agent_top_ups,id',
        ];
    }
}
