<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'identity_no' => [
                'string',
                'nullable',
                'max:125',
            ],
            'phone' => [
                'string',
                'nullable',
                'max:125',
            ],
            'email' => [
                'required',
                'max:125',
                'unique:users,email,' . request()->route('user')->id,
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'bank_list_id' => [
                'required',
                'integer',
                'exists:bank_lists,id',
            ],
//            'bank_name' => [
//                'string',
//                'required',
//            ],
            'bank_account_name' => [
                'string',
                'required',
                'max:125',
            ],
            'bank_account_number' => [
                'string',
                'required',
                'max:125',
            ],
            'personal_code' => [
                'string',
                'nullable',
                'max:125',
            ],
//            'roles.*' => [
//                'integer',
//            ],
//            'roles' => [
//                'required',
//                'array',
//            ],
        ];
    }
}
