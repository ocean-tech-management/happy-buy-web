<?php

namespace App\Http\Requests;

use App\Models\EnquiryReply;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEnquiryReplyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('enquiry_reply_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:enquiry_replies,id',
        ];
    }
}
