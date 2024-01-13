<?php

namespace App\Http\Requests;

use App\Models\UserAgreement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserAgreementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_agreement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_agreements,id',
        ];
    }
}
