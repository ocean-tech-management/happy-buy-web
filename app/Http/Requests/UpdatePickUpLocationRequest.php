<?php

namespace App\Http\Requests;

use App\Models\PickUpLocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePickUpLocationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pick_up_location_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:125',
            ],
            'person_in_charge' => [
                'string',
                'required',
                'max:125',
            ],
            'phone' => [
                'string',
                'required',
                'max:125',
            ],
            'address' => [
                'string',
                'required',
                'max:125',
            ],
            'country_id' => [
                'required',
                'integer',
                'exists:countries,id'
            ],
            'status' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
