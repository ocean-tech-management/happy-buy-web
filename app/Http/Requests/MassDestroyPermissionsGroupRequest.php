<?php

namespace App\Http\Requests;

use App\Models\PermissionsGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPermissionsGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('permissions_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:permissions_groups,id',
        ];
    }
}
