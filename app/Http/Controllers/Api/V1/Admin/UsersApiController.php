<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['bank_list', 'country', 'upline_user', 'upline_user_1', 'roles'])->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('profile_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_photo'))))->toMediaCollection('profile_photo');
        }

        if ($request->input('ssm_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ssm_photo'))))->toMediaCollection('ssm_photo');
        }

        if ($request->input('ic_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ic_photo'))))->toMediaCollection('ic_photo');
        }

        if ($request->input('first_payment_receipt_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('first_payment_receipt_photo'))))->toMediaCollection('first_payment_receipt_photo');
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['bank_list', 'country', 'upline_user', 'upline_user_1', 'roles']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('profile_photo', false)) {
            if (!$user->profile_photo || $request->input('profile_photo') !== $user->profile_photo->file_name) {
                if ($user->profile_photo) {
                    $user->profile_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_photo'))))->toMediaCollection('profile_photo');
            }
        } elseif ($user->profile_photo) {
            $user->profile_photo->delete();
        }

        if ($request->input('ssm_photo', false)) {
            if (!$user->ssm_photo || $request->input('ssm_photo') !== $user->ssm_photo->file_name) {
                if ($user->ssm_photo) {
                    $user->ssm_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ssm_photo'))))->toMediaCollection('ssm_photo');
            }
        } elseif ($user->ssm_photo) {
            $user->ssm_photo->delete();
        }

        if ($request->input('ic_photo', false)) {
            if (!$user->ic_photo || $request->input('ic_photo') !== $user->ic_photo->file_name) {
                if ($user->ic_photo) {
                    $user->ic_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ic_photo'))))->toMediaCollection('ic_photo');
            }
        } elseif ($user->ic_photo) {
            $user->ic_photo->delete();
        }

        if ($request->input('first_payment_receipt_photo', false)) {
            if (!$user->first_payment_receipt_photo || $request->input('first_payment_receipt_photo') !== $user->first_payment_receipt_photo->file_name) {
                if ($user->first_payment_receipt_photo) {
                    $user->first_payment_receipt_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('first_payment_receipt_photo'))))->toMediaCollection('first_payment_receipt_photo');
            }
        } elseif ($user->first_payment_receipt_photo) {
            $user->first_payment_receipt_photo->delete();
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
