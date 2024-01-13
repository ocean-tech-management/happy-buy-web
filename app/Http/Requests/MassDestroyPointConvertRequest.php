<?php

namespace App\Http\Requests;

use App\Models\PointConvert;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPointConvertRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('point_convert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:point_converts,id',
        ];
    }
}
