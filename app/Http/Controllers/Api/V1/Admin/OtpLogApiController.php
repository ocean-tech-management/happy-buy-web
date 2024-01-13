<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOtpLogRequest;
use App\Http\Requests\UpdateOtpLogRequest;
use App\Http\Resources\Admin\OtpLogResource;
use App\Models\OtpLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtpLogApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('otp_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OtpLogResource(OtpLog::with(['user'])->get());
    }

    public function store(StoreOtpLogRequest $request)
    {
        $otpLog = OtpLog::create($request->all());

        return (new OtpLogResource($otpLog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OtpLog $otpLog)
    {
        abort_if(Gate::denies('otp_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OtpLogResource($otpLog->load(['user']));
    }

    public function update(UpdateOtpLogRequest $request, OtpLog $otpLog)
    {
        $otpLog->update($request->all());

        return (new OtpLogResource($otpLog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OtpLog $otpLog)
    {
        abort_if(Gate::denies('otp_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otpLog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
