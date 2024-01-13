@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pointManagerBalance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.point-manager-balances.update", [$pointManagerBalance->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.pointManagerBalance.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $pointManagerBalance->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointManagerBalance.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.pointManagerBalance.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', $pointManagerBalance->amount) }}" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointManagerBalance.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.pointManagerBalance.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PointManagerBalance::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $pointManagerBalance->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointManagerBalance.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.pointManagerBalance.fields.settlement') }}</label>
                <select class="form-control {{ $errors->has('settlement') ? 'is-invalid' : '' }}" name="settlement" id="settlement">
                    <option value disabled {{ old('settlement', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PointManagerBalance::SETTLEMENT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('settlement', $pointManagerBalance->settlement) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('settlement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('settlement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointManagerBalance.fields.settlement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.pointManagerBalance.fields.remark') }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', $pointManagerBalance->remark) }}">
                @if($errors->has('remark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointManagerBalance.fields.remark_helper') }}</span>
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