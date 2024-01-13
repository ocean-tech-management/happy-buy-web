<?php

namespace App\Http\Requests;

use App\Models\PickUpLocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPickUpLocationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pick_up_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pick_up_locations,id',
        ];
    }
}
