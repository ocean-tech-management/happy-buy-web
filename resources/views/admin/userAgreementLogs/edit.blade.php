@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userAgreementLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-agreement-logs.update", [$userAgreementLog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_agreement_id">{{ trans('cruds.userAgreementLog.fields.user_agreement') }}</label>
                <select class="form-control select2 {{ $errors->has('user_agreement') ? 'is-invalid' : '' }}" name="user_agreement_id" id="user_agreement_id" required>
                    @foreach($user_agreements as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_agreement_id') ? old('user_agreement_id') : $userAgreementLog->user_agreement->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_agreement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_agreement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAgreementLog.fields.user_agreement_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.userAgreementLog.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userAgreementLog->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAgreementLog.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="signature_name">{{ trans('cruds.userAgreementLog.fields.signature_name') }}</label>
                <input class="form-control {{ $errors->has('signature_name') ? 'is-invalid' : '' }}" type="text" name="signature_name" id="signature_name" value="{{ old('signature_name', $userAgreementLog->signature_name) }}" required>
                @if($errors->has('signature_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('signature_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAgreementLog.fields.signature_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="signature_ic">{{ trans('cruds.userAgreementLog.fields.signature_ic') }}</label>
                <input class="form-control {{ $errors->has('signature_ic') ? 'is-invalid' : '' }}" type="text" name="signature_ic" id="signature_ic" value="{{ old('signature_ic', $userAgreementLog->signature_ic) }}" required>
                @if($errors->has('signature_ic'))
                    <div class="invalid-feedback">
                        {{ $errors->first('signature_ic') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAgreementLog.fields.signature_ic_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="signature_at">{{ trans('cruds.userAgreementLog.fields.signature_at') }}</label>
                <input class="form-control datetime {{ $errors->has('signature_at') ? 'is-invalid' : '' }}" type="text" name="signature_at" id="signature_at" value="{{ old('signature_at', $userAgreementLog->signature_at) }}" required>
                @if($errors->has('signature_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('signature_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAgreementLog.fields.signature_at_helper') }}</span>
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