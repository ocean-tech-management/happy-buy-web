@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.productBatch.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.product-batches.update", [$productBatch->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.productBatch.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $productBatch->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="remark">{{ trans('cruds.productBatch.fields.remark') }}</label>
                    <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark', $productBatch->remark) }}</textarea>
                    @if($errors->has('remark'))
                        <div class="invalid-feedback">
                            {{ $errors->first('remark') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.remark_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.productBatch.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\ProductBatch::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $productBatch->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                    <label class="required" for="product_id">{{ trans('cruds.productBatch.fields.product') }}</label>
                    <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                        @foreach($products as $id => $entry)
                            <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $productBatch->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('product'))
                        <div class="invalid-feedback">
                            {{ $errors->first('product') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.product_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="product_variant_id">{{ trans('cruds.productBatch.fields.product_variant') }}</label>
                    <select class="form-control select2 {{ $errors->has('product_variant') ? 'is-invalid' : '' }}" name="product_variant_id" id="product_variant_id" required>
                        @foreach($product_variants as $id => $entry)
                            <option value="{{ $id }}" {{ (old('product_variant_id') ? old('product_variant_id') : $productBatch->product_variant->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                    <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', $productBatch->quantity) }}" required>
                    @if($errors->has('quantity'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.quantity_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="generated_at">{{ trans('cruds.productBatch.fields.generated_at') }}</label>
                    <input class="form-control datetime {{ $errors->has('generated_at') ? 'is-invalid' : '' }}" type="text" name="generated_at" id="generated_at" value="{{ old('generated_at', $productBatch->generated_at) }}">
                    @if($errors->has('generated_at'))
                        <div class="invalid-feedback">
                            {{ $errors->first('generated_at') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.generated_at_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="in_stock_at">{{ trans('cruds.productBatch.fields.in_stock_at') }}</label>
                    <input class="form-control datetime {{ $errors->has('in_stock_at') ? 'is-invalid' : '' }}" type="text" name="in_stock_at" id="in_stock_at" value="{{ old('in_stock_at', $productBatch->in_stock_at) }}">
                    @if($errors->has('in_stock_at'))
                        <div class="invalid-feedback">
                            {{ $errors->first('in_stock_at') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productBatch.fields.in_stock_at_helper') }}</span>
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
