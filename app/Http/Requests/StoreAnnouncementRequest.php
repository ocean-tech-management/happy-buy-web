<?php

namespace App\Http\Requests;

use App\Models\Announcement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAnnouncementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('announcement_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'max:125',
            ],
            'desc' => [
                'required',
                'max:4294967295',
            ],
            'roles.*' => [
                'integer',
                'exists:roles,id',
            ],
            'roles' => [
                'array',
            ],
            'status' => [
                'required',
                'max:125',
            ],
        ];
    }
}
