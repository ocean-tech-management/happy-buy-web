@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productQuantity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-quantities.update", [$productQuantity->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.productQuantity.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $productQuantity->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="batch_id">{{ trans('cruds.productQuantity.fields.batch') }}</label>
                <select class="form-control select2 {{ $errors->has('batch') ? 'is-invalid' : '' }}" name="batch_id" id="batch_id">
                    @foreach($batches as $id => $entry)
                        <option value="{{ $id }}" {{ (old('batch_id') ? old('batch_id') : $productQuantity->batch->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('batch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('batch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.batch_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.productQuantity.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductQuantity::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $productQuantity->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transaction">{{ trans('cruds.productQuantity.fields.transaction') }}</label>
                <input class="form-control {{ $errors->has('transaction') ? 'is-invalid' : '' }}" type="text" name="transaction" id="transaction" value="{{ old('transaction', $productQuantity->transaction) }}">
                @if($errors->has('transaction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transaction') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sold_to_user_id">{{ trans('cruds.productQuantity.fields.sold_to_user') }}</label>
                <select class="form-control select2 {{ $errors->has('sold_to_user') ? 'is-invalid' : '' }}" name="sold_to_user_id" id="sold_to_user_id">
                    @foreach($sold_to_users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sold_to_user_id') ? old('sold_to_user_id') : $productQuantity->sold_to_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sold_to_user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sold_to_user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.sold_to_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qr_code">{{ trans('cruds.productQuantity.fields.qr_code') }}</label>
                <input class="form-control {{ $errors->has('qr_code') ? 'is-invalid' : '' }}" type="text" name="qr_code" id="qr_code" value="{{ old('qr_code', $productQuantity->qr_code) }}">
                @if($errors->has('qr_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qr_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.qr_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qr_generate_at">{{ trans('cruds.productQuantity.fields.qr_generate_at') }}</label>
                <input class="form-control datetime {{ $errors->has('qr_generate_at') ? 'is-invalid' : '' }}" type="text" name="qr_generate_at" id="qr_generate_at" value="{{ old('qr_generate_at', $productQuantity->qr_generate_at) }}">
                @if($errors->has('qr_generate_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qr_generate_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.qr_generate_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="in_stock_at">{{ trans('cruds.productQuantity.fields.in_stock_at') }}</label>
                <input class="form-control datetime {{ $errors->has('in_stock_at') ? 'is-invalid' : '' }}" type="text" name="in_stock_at" id="in_stock_at" value="{{ old('in_stock_at', $productQuantity->in_stock_at) }}">
                @if($errors->has('in_stock_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('in_stock_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.in_stock_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sold_at">{{ trans('cruds.productQuantity.fields.sold_at') }}</label>
                <input class="form-control datetime {{ $errors->has('sold_at') ? 'is-invalid' : '' }}" type="text" name="sold_at" id="sold_at" value="{{ old('sold_at', $productQuantity->sold_at) }}">
                @if($errors->has('sold_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sold_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.sold_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="first_scan_at">{{ trans('cruds.productQuantity.fields.first_scan_at') }}</label>
                <input class="form-control timepicker {{ $errors->has('first_scan_at') ? 'is-invalid' : '' }}" type="text" name="first_scan_at" id="first_scan_at" value="{{ old('first_scan_at', $productQuantity->first_scan_at) }}">
                @if($errors->has('first_scan_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_scan_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productQuantity.fields.first_scan_at_helper') }}</span>
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