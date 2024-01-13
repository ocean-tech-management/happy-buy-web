@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.addressBook.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.address-books.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.addressBook.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.addressBook.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.addressBook.fields.remark') }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', '') }}">
                @if($errors->has('remark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.remark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.addressBook.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.addressBook.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_1">{{ trans('cruds.addressBook.fields.address_1') }}</label>
                <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', '') }}">
                @if($errors->has('address_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.address_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_2">{{ trans('cruds.addressBook.fields.address_2') }}</label>
                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                @if($errors->has('address_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.addressBook.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state">{{ trans('cruds.addressBook.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}">
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="postcode">{{ trans('cruds.addressBook.fields.postcode') }}</label>
                <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="text" name="postcode" id="postcode" value="{{ old('postcode', '') }}">
                @if($errors->has('postcode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('postcode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.postcode_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.addressBook.fields.set_default') }}</label>
                <select class="form-control {{ $errors->has('set_default') ? 'is-invalid' : '' }}" name="set_default" id="set_default">
                    <option value disabled {{ old('set_default', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AddressBook::SET_DEFAULT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('set_default', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('set_default'))
                    <div class="invalid-feedback">
                        {{ $errors->first('set_default') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.set_default_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.addressBook.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AddressBook::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addressBook.fields.status_helper') }}</span>
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