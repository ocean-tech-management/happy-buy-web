<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAdminRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('admin_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
                'unique:admins',
            ],
            'password' => [
                'required',
                'max:125',
            ],
            'phone' => [
                'string',
                'nullable',
                'max:125',
            ],
            'email' => [
                'required',
                'unique:admins',
                'max:125',
            ],
            'roles.*' => [
                'integer',
                'exists:roles,id',
            ],
            'roles' => [
                'required',
                'array',
            ],
        ];
    }
}
