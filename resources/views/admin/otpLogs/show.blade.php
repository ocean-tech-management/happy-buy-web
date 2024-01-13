@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.otpLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.otp-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.otpLog.fields.id') }}
                        </th>
                        <td>
                            {{ $otpLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otpLog.fields.user') }}
                        </th>
                        <td>
                            {{ $otpLog->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otpLog.fields.phone') }}
                        </th>
                        <td>
                            {{ $otpLog->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otpLog.fields.code') }}
                        </th>
                        <td>
                            {{ $otpLog->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otpLog.fields.content') }}
                        </th>
                        <td>
                            {{ $otpLog->content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otpLog.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\OtpLog::STATUS_SELECT[$otpLog->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otpLog.fields.api_responose') }}
                        </th>
                        <td>
                            {{ $otpLog->api_responose }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otpLog.fields.used_at') }}
                        </th>
                        <td>
                            {{ $otpLog->used_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.otp-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection