@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.pointConvert.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.point-converts.update", [$pointConvert->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="transaction">{{ trans('cruds.pointConvert.fields.transaction') }}</label>
                    <input class="form-control {{ $errors->has('transaction') ? 'is-invalid' : '' }}" type="text" name="transaction" id="transaction" value="{{ old('transaction', $pointConvert->transaction) }}">
                    @if($errors->has('transaction'))
                        <div class="invalid-feedback">
                            {{ $errors->first('transaction') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointConvert.fields.transaction_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="user_id">{{ trans('cruds.pointConvert.fields.user') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                        @foreach($users as $id => $entry)
                            <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $pointConvert->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointConvert.fields.user_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="amount">{{ trans('cruds.pointConvert.fields.amount') }}</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $pointConvert->amount) }}" step="1" required>
                    @if($errors->has('amount'))
                        <div class="invalid-feedback">
                            {{ $errors->first('amount') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointConvert.fields.amount_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="pre_cp_bonus_balance">{{ trans('cruds.pointConvert.fields.pre_cp_bonus_balance') }}</label>
                    <input class="form-control {{ $errors->has('pre_cp_bonus_balance') ? 'is-invalid' : '' }}" type="text" name="pre_cp_bonus_balance" id="pre_cp_bonus_balance" value="{{ old('pre_cp_bonus_balance', $pointConvert->pre_cp_bonus_balance) }}">
                    @if($errors->has('pre_cp_bonus_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('pre_cp_bonus_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointConvert.fields.pre_cp_bonus_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="post_cp_bonus_balance">{{ trans('cruds.pointConvert.fields.post_cp_bonus_balance') }}</label>
                    <input class="form-control {{ $errors->has('post_cp_bonus_balance') ? 'is-invalid' : '' }}" type="text" name="post_cp_bonus_balance" id="post_cp_bonus_balance" value="{{ old('post_cp_bonus_balance', $pointConvert->post_cp_bonus_balance) }}">
                    @if($errors->has('post_cp_bonus_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('post_cp_bonus_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointConvert.fields.post_cp_bonus_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="pre_cp_balance">{{ trans('cruds.pointConvert.fields.pre_cp_balance') }}</label>
                    <input class="form-control {{ $errors->has('pre_cp_balance') ? 'is-invalid' : '' }}" type="text" name="pre_cp_balance" id="pre_cp_balance" value="{{ old('pre_cp_balance', $pointConvert->pre_cp_balance) }}">
                    @if($errors->has('pre_cp_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('pre_cp_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointConvert.fields.pre_cp_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="post_cp_balance">{{ trans('cruds.pointConvert.fields.post_cp_balance') }}</label>
                    <input class="form-control {{ $errors->has('post_cp_balance') ? 'is-invalid' : '' }}" type="text" name="post_cp_balance" id="post_cp_balance" value="{{ old('post_cp_balance', $pointConvert->post_cp_balance) }}">
                    @if($errors->has('post_cp_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('post_cp_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointConvert.fields.post_cp_balance_helper') }}</span>
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
