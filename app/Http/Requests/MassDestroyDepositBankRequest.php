<?php

namespace App\Http\Requests;

use App\Models\DepositBank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDepositBankRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('deposit_bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:deposit_banks,id',
        ];
    }
}
