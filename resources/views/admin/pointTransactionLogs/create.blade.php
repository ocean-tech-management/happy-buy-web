@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pointTransactionLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.point-transaction-logs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.pointTransactionLog.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTransactionLog.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.pointTransactionLog.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTransactionLog.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="top_up">{{ trans('cruds.pointTransactionLog.fields.top_up') }}</label>
                <input class="form-control {{ $errors->has('top_up') ? 'is-invalid' : '' }}" type="text" name="top_up" id="top_up" value="{{ old('top_up', '') }}" required>
                @if($errors->has('top_up'))
                    <div class="invalid-feedback">
                        {{ $errors->first('top_up') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTransactionLog.fields.top_up_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="point_convert">{{ trans('cruds.pointTransactionLog.fields.point_convert') }}</label>
                <input class="form-control {{ $errors->has('point_convert') ? 'is-invalid' : '' }}" type="text" name="point_convert" id="point_convert" value="{{ old('point_convert', '') }}" required>
                @if($errors->has('point_convert'))
                    <div class="invalid-feedback">
                        {{ $errors->first('point_convert') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTransactionLog.fields.point_convert_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="redemption">{{ trans('cruds.pointTransactionLog.fields.redemption') }}</label>
                <input class="form-control {{ $errors->has('redemption') ? 'is-invalid' : '' }}" type="text" name="redemption" id="redemption" value="{{ old('redemption', '') }}" required>
                @if($errors->has('redemption'))
                    <div class="invalid-feedback">
                        {{ $errors->first('redemption') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTransactionLog.fields.redemption_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shipping">{{ trans('cruds.pointTransactionLog.fields.shipping') }}</label>
                <input class="form-control {{ $errors->has('shipping') ? 'is-invalid' : '' }}" type="text" name="shipping" id="shipping" value="{{ old('shipping', '') }}" required>
                @if($errors->has('shipping'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTransactionLog.fields.shipping_helper') }}</span>
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
