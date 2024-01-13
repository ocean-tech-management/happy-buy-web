@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.shippingFee.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.shipping-fees.update", [$shippingFee->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.shippingFee.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $shippingFee->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippingFee.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="states">{{ trans('cruds.shippingFee.fields.state') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('states') ? 'is-invalid' : '' }}" name="states[]" id="states" multiple required>
                        @foreach($states as $id => $state)
                            <option value="{{ $id }}" {{ (in_array($id, old('states', [])) || $shippingFee->states->contains($id)) ? 'selected' : '' }}>{{ $state }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('states'))
                        <div class="invalid-feedback">
                            {{ $errors->first('states') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippingFee.fields.state_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="quantity">{{ trans('cruds.shippingFee.fields.quantity') }}</label>
                    <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', $shippingFee->quantity) }}">
                    @if($errors->has('quantity'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippingFee.fields.quantity_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="price">{{ trans('cruds.shippingFee.fields.price') }}</label>
                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', $shippingFee->price) }}" required>
                    @if($errors->has('price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippingFee.fields.price_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="add_on">{{ trans('cruds.shippingFee.fields.add_on') }}</label>
                    <input class="form-control {{ $errors->has('add_on') ? 'is-invalid' : '' }}" type="text" name="add_on" id="add_on" value="{{ old('add_on', $shippingFee->add_on) }}">
                    @if($errors->has('add_on'))
                        <div class="invalid-feedback">
                            {{ $errors->first('add_on') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippingFee.fields.add_on_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.shippingFee.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\ShippingFee::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $shippingFee->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippingFee.fields.status_helper') }}</span>
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
