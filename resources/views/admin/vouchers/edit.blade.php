@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.voucher.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vouchers.update", [$voucher->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.voucher.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $voucher->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voucher.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.voucher.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $voucher->code) }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voucher.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.voucher.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="number" name="value" id="value" value="{{ old('value', $voucher->value) }}" step="0.01" required>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voucher.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.voucher.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Voucher::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $voucher->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voucher.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="roles">{{ trans('cruds.voucher.fields.role') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $voucher->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voucher.fields.role_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.voucher.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $voucher->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voucher.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="started_at">{{ trans('cruds.voucher.fields.started_at') }}</label>
                <input class="form-control datetime {{ $errors->has('started_at') ? 'is-invalid' : '' }}" type="text" name="started_at" id="started_at" value="{{ old('started_at', $voucher->started_at) }}">
                @if($errors->has('started_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('started_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voucher.fields.started_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ended_at">{{ trans('cruds.voucher.fields.ended_at') }}</label>
                <input class="form-control datetime {{ $errors->has('ended_at') ? 'is-invalid' : '' }}" type="text" name="ended_at" id="ended_at" value="{{ old('ended_at', $voucher->ended_at) }}">
                @if($errors->has('ended_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ended_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voucher.fields.ended_at_helper') }}</span>
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