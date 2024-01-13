@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transactionBonu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-bonus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="transaction">{{ trans('cruds.transactionBonu.fields.transaction') }}</label>
                <input class="form-control {{ $errors->has('transaction') ? 'is-invalid' : '' }}" type="text" name="transaction" id="transaction" value="{{ old('transaction', '') }}">
                @if($errors->has('transaction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transaction') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionBonu.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="admin_id">{{ trans('cruds.transactionBonu.fields.admin') }}</label>
                <select class="form-control select2 {{ $errors->has('admin') ? 'is-invalid' : '' }}" name="admin_id" id="admin_id">
                    @foreach($admins as $id => $entry)
                        <option value="{{ $id }}" {{ old('admin_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('admin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('admin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionBonu.fields.admin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.transactionBonu.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.transactionBonu.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title">{{ trans('cruds.transactionBonu.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionBonu.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.transactionBonu.fields.remark') }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', '') }}">
                @if($errors->has('remark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionBonu.fields.remark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.transactionBonu.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionBonu.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.transactionBonu.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TransactionBonu::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionBonu.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.transactionBonu.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TransactionBonu::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionBonu.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="given_at">{{ trans('cruds.transactionBonu.fields.given_at') }}</label>
                <input class="form-control datetime {{ $errors->has('given_at') ? 'is-invalid' : '' }}" type="text" name="given_at" id="given_at" value="{{ old('given_at') }}">
                @if($errors->has('given_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('given_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionBonu.fields.given_at_helper') }}</span>
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