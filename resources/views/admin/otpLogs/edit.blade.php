@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.otpLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.otp-logs.update", [$otpLog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.otpLog.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $otpLog->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.otpLog.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.otpLog.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $otpLog->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.otpLog.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.otpLog.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $otpLog->code) }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.otpLog.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="content">{{ trans('cruds.otpLog.fields.content') }}</label>
                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content" required>{{ old('content', $otpLog->content) }}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.otpLog.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.otpLog.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\OtpLog::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $otpLog->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.otpLog.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="api_responose">{{ trans('cruds.otpLog.fields.api_responose') }}</label>
                <textarea class="form-control {{ $errors->has('api_responose') ? 'is-invalid' : '' }}" name="api_responose" id="api_responose">{{ old('api_responose', $otpLog->api_responose) }}</textarea>
                @if($errors->has('api_responose'))
                    <div class="invalid-feedback">
                        {{ $errors->first('api_responose') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.otpLog.fields.api_responose_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="used_at">{{ trans('cruds.otpLog.fields.used_at') }}</label>
                <input class="form-control datetime {{ $errors->has('used_at') ? 'is-invalid' : '' }}" type="text" name="used_at" id="used_at" value="{{ old('used_at', $otpLog->used_at) }}">
                @if($errors->has('used_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('used_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.otpLog.fields.used_at_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection