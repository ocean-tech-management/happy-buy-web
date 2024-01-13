@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.shippingPackage.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.shipping-packages.update", [$shippingPackage->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="price">{{ trans('cruds.shippingPackage.fields.price') }}</label>
                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', $shippingPackage->price) }}" required>
                    @if($errors->has('price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippingPackage.fields.price_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="point">{{ trans('cruds.shippingPackage.fields.point') }}</label>
                    <input class="form-control {{ $errors->has('point') ? 'is-invalid' : '' }}" type="text" name="point" id="point" value="{{ old('point', $shippingPackage->point) }}" required>
                    @if($errors->has('point'))
                        <div class="invalid-feedback">
                            {{ $errors->first('point') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippingPackage.fields.point_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.shippingPackage.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\ShippingPackage::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $shippingPackage->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippingPackage.fields.status_helper') }}</span>
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
