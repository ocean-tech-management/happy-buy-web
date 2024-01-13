<?php

namespace App\Http\Requests;

use App\Models\BonusGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBonusGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bonus_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bonus_groups,id',
        ];
    }
}
