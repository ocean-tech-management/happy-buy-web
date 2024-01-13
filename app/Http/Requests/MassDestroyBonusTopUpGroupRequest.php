<?php

namespace App\Http\Requests;

use App\Models\BonusTopUpGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBonusTopUpGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bonus_top_up_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bonus_top_up_groups,id',
        ];
    }
}
