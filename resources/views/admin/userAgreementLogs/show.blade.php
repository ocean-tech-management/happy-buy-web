@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userAgreementLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.user-agreement-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreementLog.fields.id') }}
                        </th>
                        <td>
                            {{ $userAgreementLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreementLog.fields.user_agreement') }}
                        </th>
                        <td>
                            {{ $userAgreementLog->user_agreement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreementLog.fields.user') }}
                        </th>
                        <td>
                            {{ $userAgreementLog->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreementLog.fields.signature_name') }}
                        </th>
                        <td>
                            {{ $userAgreementLog->signature_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreementLog.fields.signature_ic') }}
                        </th>
                        <td>
                            {{ $userAgreementLog->signature_ic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreementLog.fields.signature_at') }}
                        </th>
                        <td>
                            {{ $userAgreementLog->signature_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.user-agreement-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection