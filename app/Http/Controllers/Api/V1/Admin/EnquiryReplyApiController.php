<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryReplyRequest;
use App\Http\Requests\UpdateEnquiryReplyRequest;
use App\Http\Resources\Admin\EnquiryReplyResource;
use App\Models\EnquiryReply;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnquiryReplyApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('enquiry_reply_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EnquiryReplyResource(EnquiryReply::with(['enquiry', 'admin'])->get());
    }

    public function store(StoreEnquiryReplyRequest $request)
    {
        $enquiryReply = EnquiryReply::create($request->all());

        return (new EnquiryReplyResource($enquiryReply))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EnquiryReply $enquiryReply)
    {
        abort_if(Gate::denies('enquiry_reply_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EnquiryReplyResource($enquiryReply->load(['enquiry', 'admin']));
    }

    public function update(UpdateEnquiryReplyRequest $request, EnquiryReply $enquiryReply)
    {
        $enquiryReply->update($request->all());

        return (new EnquiryReplyResource($enquiryReply))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EnquiryReply $enquiryReply)
    {
        abort_if(Gate::denies('enquiry_reply_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiryReply->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
