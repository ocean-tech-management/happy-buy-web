<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules(Request $request)
    {

        $ruleArr = [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'password' => [
                'required',
                'max:125'
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
                'unique:users',
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'bank_list_id' => [
                'required',
                'integer',
                'exists:bank_lists,id'
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
            'direct_upline_id' => [
                'required',
                'max:125',
                'exists:users,id',
            ],
//            'roles.*' => [
//                'integer',
//            ],
//            'roles' => [
//                'required',
//                'array',
//            ],
        ];

        if(Route::is('admin.users.vips.store')) {
            $ruleArr['address_1'] = [
                'required',
                'string',
                'max:125',
            ];
            $ruleArr['address_2'] = [
                'nullable',
                'string',
                'max:125',
            ];
            $ruleArr['country'] = [
                'nullable',
                'exists:countries,id',
            ];
            $ruleArr['state'] = [
                'required',
                'exists:states,id',
            ];
            $ruleArr['postcode'] = [
                'required',
                'string',
                'max:125',
            ];
            $ruleArr['city'] = [
                'required',
                'string',
                'max:125',
            ];
        }
        return $ruleArr;
    }
}
