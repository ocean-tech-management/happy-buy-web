@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.pickUpLocation.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.pick-up-locations.update", [$pickUpLocation->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.pickUpLocation.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $pickUpLocation->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pickUpLocation.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="person_in_charge">{{ trans('cruds.pickUpLocation.fields.person_in_charge') }}</label>
                    <input class="form-control {{ $errors->has('person_in_charge') ? 'is-invalid' : '' }}" type="text" name="person_in_charge" id="person_in_charge" value="{{ old('person_in_charge', $pickUpLocation->person_in_charge) }}" required>
                    @if($errors->has('person_in_charge'))
                        <div class="invalid-feedback">
                            {{ $errors->first('person_in_charge') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pickUpLocation.fields.person_in_charge_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="phone">{{ trans('cruds.pickUpLocation.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $pickUpLocation->phone) }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pickUpLocation.fields.phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="address">{{ trans('cruds.pickUpLocation.fields.address') }}</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $pickUpLocation->address) }}" required>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pickUpLocation.fields.address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="country_id">{{ trans('cruds.pickUpLocation.fields.country') }}</label>
                    <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                        @foreach($countries as $id => $entry)
                            <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $pickUpLocation->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('country'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pickUpLocation.fields.country_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.pickUpLocation.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\PickUpLocation::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $pickUpLocation->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pickUpLocation.fields.status_helper') }}</span>
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
