@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.userEntry.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.user-entries.update", [$userEntry->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="user_id">{{ trans('cruds.userEntry.fields.user') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required readonly>
                        @foreach($users as $id => $entry)
                            <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userEntry->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userEntry.fields.user_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.userEntry.fields.user_type') }}</label>
                    <select class="form-control {{ $errors->has('user_type') ? 'is-invalid' : '' }}" name="user_type" id="user_type" required>
                        <option value disabled {{ old('user_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\UserEntry::USER_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('user_type', $userEntry->user_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user_type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userEntry.fields.user_type_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="deposit">{{ trans('cruds.userEntry.fields.deposit') }}</label>
                    <input class="form-control {{ $errors->has('deposit') ? 'is-invalid' : '' }}" type="text" name="deposit" id="deposit" value="{{ old('deposit', $userEntry->deposit) }}" required>
                    @if($errors->has('deposit'))
                        <div class="invalid-feedback">
                            {{ $errors->first('deposit') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userEntry.fields.deposit_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="fee">{{ trans('cruds.userEntry.fields.fee') }}</label>
                    <input class="form-control {{ $errors->has('fee') ? 'is-invalid' : '' }}" type="text" name="fee" id="fee" value="{{ old('fee', $userEntry->fee) }}" required>
                    @if($errors->has('fee'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fee') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userEntry.fields.fee_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="top_up">{{ trans('cruds.userEntry.fields.top_up') }}</label>
                    <input class="form-control {{ $errors->has('top_up') ? 'is-invalid' : '' }}" type="text" name="top_up" id="top_up" value="{{ old('top_up', $userEntry->top_up) }}" required>
                    @if($errors->has('top_up'))
                        <div class="invalid-feedback">
                            {{ $errors->first('top_up') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userEntry.fields.top_up_helper') }}</span>
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
