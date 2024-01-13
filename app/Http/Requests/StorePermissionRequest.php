<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('permission_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'guard_name' => [
                'string',
                'required',
                'max:125',
            ],
            'group_id' => [
                'required',
                'integer',
                'exists:permissions_groups,id'
            ]
        ];
    }
}
