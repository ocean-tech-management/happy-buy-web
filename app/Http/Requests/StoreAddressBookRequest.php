<?php

namespace App\Http\Requests;

use App\Models\AddressBook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddressBookRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('address_book_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'name' => [
                'string',
                'nullable',
                'max:125',
            ],
            'phone' => [
                'string',
                'nullable',
                'max:125',
            ],
            'address_1' => [
                'string',
                'nullable',
                'max:125',
            ],
            'address_2' => [
                'string',
                'nullable',
                'max:125',
            ],
            'city' => [
                'string',
                'nullable',
                'max:125',
            ],
            'state' => [
                'string',
                'nullable',
                'exists:states,id'
            ],
            'postcode' => [
                'string',
                'nullable',
                'max:125',
            ],
        ];
    }
}
