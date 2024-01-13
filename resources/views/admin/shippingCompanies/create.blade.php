@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.shippingCompany.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shipping-companies.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.shippingCompany.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingCompany.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="api_name">{{ trans('cruds.shippingCompany.fields.api_name') }}</label>
                <input class="form-control {{ $errors->has('api_name') ? 'is-invalid' : '' }}" type="text" name="api_name" id="api_name" value="{{ old('api_name', '') }}">
                @if($errors->has('api_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('api_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingCompany.fields.api_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.shippingCompany.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ShippingCompany::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingCompany.fields.status_helper') }}</span>
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
