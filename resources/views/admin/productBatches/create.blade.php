@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.productBatch.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.product-batches.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.productBatch.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="remark">{{ trans('cruds.productBatch.fields.remark') }}</label>
                    <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark') }}</textarea>
                    @if($errors->has('remark'))
                        <div class="invalid-feedback">
                            {{ $errors->first('remark') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.remark_helper') }}</span>
                </div>
                <div class="form-group" hidden>
                    <label>{{ trans('cruds.productBatch.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\ProductBatch::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.status_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="product_variant_id">{{ trans('cruds.productBatch.fields.product_variant') }}</label>
                    <select class="form-control select2 {{ $errors->has('product_variant') ? 'is-invalid' : '' }}" name="product_variant_id" id="product_variant_id" required>
                        @foreach($product_variants as $id => $entry)
                            <option value="{{ $entry->id }}" {{ old('product_variant_id') == $entry->id ? 'selected' : '' }}>{{ $entry->product->name_en }} ({{ $entry->product->name_zh }}) {{trans('global.sku')}}: {{ $entry->sku }} {{trans('global.color')}}: {{ $entry->color->name }} {{trans('global.size')}}: {{ $entry->size->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('product_variant'))
                        <div class="invalid-feedback">
                            {{ $errors->first('product_variant') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.product_variant_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="quantity">{{ trans('cruds.productBatch.fields.quantity') }}</label>
                    <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', '') }}" required>
                    @if($errors->has('quantity'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.quantity_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="cost_price">{{ trans('cruds.productBatch.fields.cost_price') }}</label>
                    <input class="form-control {{ $errors->has('cost_price') ? 'is-invalid' : '' }}" type="text" name="cost_price" id="cost_price" value="{{ old('cost_price', '') }}" required>
                    @if($errors->has('cost_price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cost_price') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.cost_price_helper') }}</span>
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
