<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserAgreementRequest;
use App\Http\Requests\UpdateUserAgreementRequest;
use App\Http\Resources\Admin\UserAgreementResource;
use App\Models\UserAgreement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAgreementApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_agreement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserAgreementResource(UserAgreement::with(['user'])->get());
    }

    public function store(StoreUserAgreementRequest $request)
    {
        $userAgreement = UserAgreement::create($request->all());

        if ($request->input('file', false)) {
            $userAgreement->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        return (new UserAgreementResource($userAgreement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserAgreement $userAgreement)
    {
        abort_if(Gate::denies('user_agreement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserAgreementResource($userAgreement->load(['user']));
    }

    public function update(UpdateUserAgreementRequest $request, UserAgreement $userAgreement)
    {
        $userAgreement->update($request->all());

        if ($request->input('file', false)) {
            if (!$userAgreement->file || $request->input('file') !== $userAgreement->file->file_name) {
                if ($userAgreement->file) {
                    $userAgreement->file->delete();
                }
                $userAgreement->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($userAgreement->file) {
            $userAgreement->file->delete();
        }

        return (new UserAgreementResource($userAgreement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserAgreement $userAgreement)
    {
        abort_if(Gate::denies('user_agreement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAgreement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
