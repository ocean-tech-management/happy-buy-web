<?php

namespace App\Http\Requests;

use App\Models\Ranking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRankingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ranking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rankings,id',
        ];
    }
}
