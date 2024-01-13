<?php

namespace App\Http\Requests;

use App\Models\EnquiryReply;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEnquiryReplyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('enquiry_reply_edit');
    }

    public function rules()
    {
        return [
            'enquiry_id' => [
                'required',
                'integer',
                'exists:enquiries,id',
            ],
            'admin_id' => [
                'required',
                'integer',
                'exists:admins,id',
            ],
            'message' => [
                'string',
                'required',
                'max:125',
            ],
        ];
    }
}
