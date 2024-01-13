@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pointBalance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.point-balances.update", [$pointBalance->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.pointBalance.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $pointBalance->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointBalance.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.pointBalance.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', $pointBalance->amount) }}" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointBalance.fields.amount_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label>{{ trans('cruds.pointBalance.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PointBalance::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $pointBalance->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointBalance.fields.status_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label>{{ trans('cruds.pointBalance.fields.settlement') }}</label>
                <select class="form-control {{ $errors->has('settlement') ? 'is-invalid' : '' }}" name="settlement" id="settlement">
                    <option value disabled {{ old('settlement', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PointBalance::SETTLEMENT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('settlement', $pointBalance->settlement) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('settlement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('settlement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointBalance.fields.settlement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.pointBalance.fields.remark') }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', $pointBalance->remark) }}">
                @if($errors->has('remark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointBalance.fields.remark_helper') }}</span>
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
