<?php

namespace App\Http\Requests;

use App\Models\BonusJoin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBonusJoinRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bonus_join_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bonus_joins,id',
        ];
    }
}
