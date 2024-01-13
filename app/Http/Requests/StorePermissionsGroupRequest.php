<?php

namespace App\Http\Requests;

use App\Models\PermissionsGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePermissionsGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('permissions_group_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'parent_id' => [
                'required',
                'integer',
                'exists:permissions_groups,id'
            ],
        ];
    }
}
