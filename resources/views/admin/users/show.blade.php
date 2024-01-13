@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.identity_type') }}
                        </th>
                        <td>
                            {{ App\Models\User::IDENTITY_TYPE_SELECT[$user->identity_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.identity_no') }}
                        </th>
                        <td>
                            {{ $user->identity_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $user->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\User::GENDER_SELECT[$user->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.bank_list') }}
                        </th>
                        <td>
                            {{ $user->bank_list->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.bank_name') }}
                        </th>
                        <td>
                            {{ $user->bank_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.bank_account_name') }}
                        </th>
                        <td>
                            {{ $user->bank_account_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.bank_account_number') }}
                        </th>
                        <td>
                            {{ $user->bank_account_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.country') }}
                        </th>
                        <td>
                            {{ $user->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.user_type') }}
                        </th>
                        <td>
                            {{ App\Models\User::USER_TYPE_SELECT[$user->user_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.personal_code') }}
                        </th>
                        <td>
                            {{ $user->personal_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.upline_user') }}
                        </th>
                        <td>
                            {{ $user->upline_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.upline_user_1') }}
                        </th>
                        <td>
                            {{ $user->upline_user_1->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.upline_user_2') }}
                        </th>
                        <td>
                            {{ $user->upline_user_2->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\User::STATUS_SELECT[$user->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.account_verify') }}
                        </th>
                        <td>
                            {{ App\Models\User::ACCOUNT_VERIFY_SELECT[$user->account_verify] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.ssm_verify') }}
                        </th>
                        <td>
                            {{ App\Models\User::SSM_VERIFY_SELECT[$user->ssm_verify] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.first_payment') }}
                        </th>
                        <td>
                            {{ App\Models\User::FIRST_PAYMENT_SELECT[$user->first_payment] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.profile_photo') }}
                        </th>
                        <td>
                            @if($user->profile_photo)
                                <a href="{{ $user->profile_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->profile_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.ssm_photo') }}
                        </th>
                        <td>
                            @if($user->ssm_photo)
                                <a href="{{ $user->ssm_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->ssm_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.ic_photo') }}
                        </th>
                        <td>
                            @if($user->ic_photo)
                                <a href="{{ $user->ic_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->ic_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.first_payment_receipt_photo') }}
                        </th>
                        <td>
                            @if($user->first_payment_receipt_photo)
                                <a href="{{ $user->first_payment_receipt_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->first_payment_receipt_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
