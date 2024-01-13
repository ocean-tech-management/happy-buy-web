@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.orderItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-items.update", [$orderItem->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="order_id">{{ trans('cruds.orderItem.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id" required>
                    @foreach($orders as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_id') ? old('order_id') : $orderItem->order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_name_en">{{ trans('cruds.orderItem.fields.product_name_en') }}</label>
                <input class="form-control {{ $errors->has('product_name_en') ? 'is-invalid' : '' }}" type="text" name="product_name_en" id="product_name_en" value="{{ old('product_name_en', $orderItem->product_name_en) }}">
                @if($errors->has('product_name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_name_zh">{{ trans('cruds.orderItem.fields.product_name_zh') }}</label>
                <input class="form-control {{ $errors->has('product_name_zh') ? 'is-invalid' : '' }}" type="text" name="product_name_zh" id="product_name_zh" value="{{ old('product_name_zh', $orderItem->product_name_zh) }}">
                @if($errors->has('product_name_zh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_name_zh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_name_zh_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_desc_en">{{ trans('cruds.orderItem.fields.product_desc_en') }}</label>
                <textarea class="form-control {{ $errors->has('product_desc_en') ? 'is-invalid' : '' }}" name="product_desc_en" id="product_desc_en">{{ old('product_desc_en', $orderItem->product_desc_en) }}</textarea>
                @if($errors->has('product_desc_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_desc_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_desc_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_desc_zh">{{ trans('cruds.orderItem.fields.product_desc_zh') }}</label>
                <input class="form-control {{ $errors->has('product_desc_zh') ? 'is-invalid' : '' }}" type="text" name="product_desc_zh" id="product_desc_zh" value="{{ old('product_desc_zh', $orderItem->product_desc_zh) }}">
                @if($errors->has('product_desc_zh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_desc_zh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_desc_zh_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_quantity">{{ trans('cruds.orderItem.fields.product_quantity') }}</label>
                <input class="form-control {{ $errors->has('product_quantity') ? 'is-invalid' : '' }}" type="number" name="product_quantity" id="product_quantity" value="{{ old('product_quantity', $orderItem->product_quantity) }}" step="1">
                @if($errors->has('product_quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_color">{{ trans('cruds.orderItem.fields.product_color') }}</label>
                <input class="form-control {{ $errors->has('product_color') ? 'is-invalid' : '' }}" type="text" name="product_color" id="product_color" value="{{ old('product_color', $orderItem->product_color) }}">
                @if($errors->has('product_color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_size">{{ trans('cruds.orderItem.fields.product_size') }}</label>
                <input class="form-control {{ $errors->has('product_size') ? 'is-invalid' : '' }}" type="text" name="product_size" id="product_size" value="{{ old('product_size', $orderItem->product_size) }}">
                @if($errors->has('product_size'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_size') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_size_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_sku">{{ trans('cruds.orderItem.fields.product_sku') }}</label>
                <input class="form-control {{ $errors->has('product_sku') ? 'is-invalid' : '' }}" type="text" name="product_sku" id="product_sku" value="{{ old('product_sku', $orderItem->product_sku) }}">
                @if($errors->has('product_sku'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_sku') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sales_price">{{ trans('cruds.orderItem.fields.sales_price') }}</label>
                <input class="form-control {{ $errors->has('sales_price') ? 'is-invalid' : '' }}" type="text" name="sales_price" id="sales_price" value="{{ old('sales_price', $orderItem->sales_price) }}">
                @if($errors->has('sales_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sales_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.sales_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="merchant_president_price">{{ trans('cruds.orderItem.fields.merchant_president_price') }}</label>
                <input class="form-control {{ $errors->has('merchant_president_price') ? 'is-invalid' : '' }}" type="text" name="merchant_president_price" id="merchant_president_price" value="{{ old('merchant_president_price', $orderItem->merchant_president_price) }}">
                @if($errors->has('merchant_president_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('merchant_president_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.merchant_president_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agent_director_price">{{ trans('cruds.orderItem.fields.agent_director_price') }}</label>
                <input class="form-control {{ $errors->has('agent_director_price') ? 'is-invalid' : '' }}" type="text" name="agent_director_price" id="agent_director_price" value="{{ old('agent_director_price', $orderItem->agent_director_price) }}">
                @if($errors->has('agent_director_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agent_director_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.agent_director_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agent_executive_price">{{ trans('cruds.orderItem.fields.agent_executive_price') }}</label>
                <input class="form-control {{ $errors->has('agent_executive_price') ? 'is-invalid' : '' }}" type="text" name="agent_executive_price" id="agent_executive_price" value="{{ old('agent_executive_price', $orderItem->agent_executive_price) }}">
                @if($errors->has('agent_executive_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agent_executive_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.agent_executive_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price_add_on">{{ trans('cruds.orderItem.fields.price_add_on') }}</label>
                <input class="form-control {{ $errors->has('price_add_on') ? 'is-invalid' : '' }}" type="text" name="price_add_on" id="price_add_on" value="{{ old('price_add_on', $orderItem->price_add_on) }}">
                @if($errors->has('price_add_on'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_add_on') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.price_add_on_helper') }}</span>
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
