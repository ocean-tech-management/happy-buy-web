@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.toShip') }} {{ trans('cruds.transactionRedeemProduct.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-redeem-products.confirm-ship") }}" enctype="multipart/form-data">
            @csrf
            <input class="form-control" type="hidden" name="id" id="id" value="{{ $transactionRedeemProduct->id }}" step="1">
            <div class="card">
                <h4 class="card-title">{{ trans('cruds.productVariant.fields.product_detail') }}</h4>
                <table class=" table table-bordered table-striped table-hover">
                    <tr>
                        <td width="20%"><strong>{{ trans('cruds.product.fields.name_en') }}</strong></td>
                        <td><a href="{{ route('admin.products.show', $transactionRedeemProduct->product->id) }}">{{ $transactionRedeemProduct->product->name_en }}</a></td>
                        <td width="20%"><strong>{{ trans('cruds.product.fields.category') }}</strong></td>
                        <td>{{ $transactionRedeemProduct->product->category->name_en }} ({{ $transactionRedeemProduct->product->category->name_zh }})</td>
                    </tr>
                    <tr>
                        <td><strong>{{ trans('cruds.productVariant.fields.color') }}</strong></td>
                        <td>{{ $transactionRedeemProduct->variant->color->name }}</td>
                        <td><strong>{{ trans('cruds.productVariant.fields.size') }}</strong></td>
                        <td>{{ $transactionRedeemProduct->variant->size->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ trans('cruds.productVariant.fields.quantity') }}</strong></td>
                        <td>{{ $transactionRedeemProduct->variant->quantity }}</td>
                        <td><strong>{{ trans('cruds.transactionRedeemProduct.fields.collect_type') }}</strong></td>
                        <td>{{ App\Models\TransactionRedeemProduct::COLLECT_TYPE_SELECT[$transactionRedeemProduct->collect_type] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ trans('cruds.transactionRedeemProduct.fields.address') }}</strong></td>
                        <td colspan="3">{{ $transactionRedeemProduct->address->user ?? '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <label class="required" for="shipping_company_id">{{ trans('cruds.transactionRedeemProduct.fields.shipping_company') }}</label>&nbsp;<small><a href="{{route('admin.shipping-companies.create')}}">{{ trans('global.create') }} {{ trans('cruds.transactionRedeemProduct.fields.shipping_company') }}</a></small>
                <select class="form-control select2 {{ $errors->has('shipping_company') ? 'is-invalid' : '' }}" name="shipping_company_id" id="shipping_company_id" required>
                    @foreach($shipping_companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('shipping_company_id') ? old('shipping_company_id') : $transactionRedeemProduct->shipping_company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipping_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.shipping_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tracking_code">{{ trans('cruds.transactionRedeemProduct.fields.tracking_code') }}</label>
                <input class="form-control {{ $errors->has('tracking_code') ? 'is-invalid' : '' }}" type="text" name="tracking_code" id="tracking_code" value="{{ old('tracking_code', $transactionRedeemProduct->tracking_code) }}" required>
                @if($errors->has('tracking_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tracking_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.tracking_code_helper') }}</span>
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
