@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transactionRedeemProduct.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-redeem-products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" hidden>
                <label for="transaction">{{ trans('cruds.transactionRedeemProduct.fields.transaction') }}</label>
                <input class="form-control {{ $errors->has('transaction') ? 'is-invalid' : '' }}" type="text" name="transaction" id="transaction" value="{{ old('transaction', '') }}">
                @if($errors->has('transaction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transaction') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label class="required" for="product_id">{{ trans('cruds.transactionRedeemProduct.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="variant_id">{{ trans('cruds.transactionRedeemProduct.fields.variant') }}</label>
                <select class="form-control select2 {{ $errors->has('variant') ? 'is-invalid' : '' }}" name="variant_id" id="variant_id" required>
                    @foreach($variants as $id => $entry)
                        <option value="{{ $id }}" {{ old('variant_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('variant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('variant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.variant_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.transactionRedeemProduct.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.user_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="purchase_price">{{ trans('cruds.transactionRedeemProduct.fields.purchase_price') }}</label>
                <input class="form-control {{ $errors->has('purchase_price') ? 'is-invalid' : '' }}" type="number" name="purchase_price" id="purchase_price" value="{{ old('purchase_price', '') }}" step="0.01">
                @if($errors->has('purchase_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('purchase_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.purchase_price_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="purchase_quantity">{{ trans('cruds.transactionRedeemProduct.fields.purchase_quantity') }}</label>
                <input class="form-control {{ $errors->has('purchase_quantity') ? 'is-invalid' : '' }}" type="text" name="purchase_quantity" id="purchase_quantity" value="{{ old('purchase_quantity', '') }}">
                @if($errors->has('purchase_quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('purchase_quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.purchase_quantity_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="pre_point_balance">{{ trans('cruds.transactionRedeemProduct.fields.pre_point_balance') }}</label>
                <input class="form-control {{ $errors->has('pre_point_balance') ? 'is-invalid' : '' }}" type="number" name="pre_point_balance" id="pre_point_balance" value="{{ old('pre_point_balance', '') }}" step="0.01">
                @if($errors->has('pre_point_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pre_point_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.pre_point_balance_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="post_point_balance">{{ trans('cruds.transactionRedeemProduct.fields.post_point_balance') }}</label>
                <input class="form-control {{ $errors->has('post_point_balance') ? 'is-invalid' : '' }}" type="text" name="post_point_balance" id="post_point_balance" value="{{ old('post_point_balance', '') }}">
                @if($errors->has('post_point_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_point_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.post_point_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.transactionRedeemProduct.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TransactionRedeemProduct::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.transactionRedeemProduct.fields.collect_type') }}</label>
                <select class="form-control {{ $errors->has('collect_type') ? 'is-invalid' : '' }}" name="collect_type" id="collect_type">
                    <option value disabled {{ old('collect_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TransactionRedeemProduct::COLLECT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('collect_type', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('collect_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('collect_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.collect_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_id">{{ trans('cruds.transactionRedeemProduct.fields.address') }}</label>
                <select class="form-control select2 {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address_id" id="address_id">
                    @foreach($addresses as $id => $entry)
                        <option value="{{ $id }}" {{ old('address_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.address_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="shipped_by_id">{{ trans('cruds.transactionRedeemProduct.fields.shipped_by') }}</label>
                <select class="form-control select2 {{ $errors->has('shipped_by') ? 'is-invalid' : '' }}" name="shipped_by_id" id="shipped_by_id">
                    @foreach($shipped_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('shipped_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipped_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipped_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.shipped_by_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="completed_by_id">{{ trans('cruds.transactionRedeemProduct.fields.completed_by') }}</label>
                <select class="form-control select2 {{ $errors->has('completed_by') ? 'is-invalid' : '' }}" name="completed_by_id" id="completed_by_id">
                    @foreach($completed_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('completed_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('completed_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('completed_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.completed_by_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="refund_by_id">{{ trans('cruds.transactionRedeemProduct.fields.refund_by') }}</label>
                <select class="form-control select2 {{ $errors->has('refund_by') ? 'is-invalid' : '' }}" name="refund_by_id" id="refund_by_id">
                    @foreach($refund_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('refund_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('refund_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refund_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.refund_by_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="shipping_company_id">{{ trans('cruds.transactionRedeemProduct.fields.shipping_company') }}</label>
                <select class="form-control select2 {{ $errors->has('shipping_company') ? 'is-invalid' : '' }}" name="shipping_company_id" id="shipping_company_id">
                    @foreach($shipping_companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('shipping_company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipping_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.shipping_company_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="tracking_code">{{ trans('cruds.transactionRedeemProduct.fields.tracking_code') }}</label>
                <input class="form-control {{ $errors->has('tracking_code') ? 'is-invalid' : '' }}" type="text" name="tracking_code" id="tracking_code" value="{{ old('tracking_code', '') }}">
                @if($errors->has('tracking_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tracking_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.tracking_code_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="refund_at">{{ trans('cruds.transactionRedeemProduct.fields.refund_at') }}</label>
                <input class="form-control datetime {{ $errors->has('refund_at') ? 'is-invalid' : '' }}" type="text" name="refund_at" id="refund_at" value="{{ old('refund_at') }}">
                @if($errors->has('refund_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refund_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.refund_at_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="pickup_at">{{ trans('cruds.transactionRedeemProduct.fields.pickup_at') }}</label>
                <input class="form-control datetime {{ $errors->has('pickup_at') ? 'is-invalid' : '' }}" type="text" name="pickup_at" id="pickup_at" value="{{ old('pickup_at') }}">
                @if($errors->has('pickup_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pickup_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.pickup_at_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="shipout_at">{{ trans('cruds.transactionRedeemProduct.fields.shipout_at') }}</label>
                <input class="form-control datetime {{ $errors->has('shipout_at') ? 'is-invalid' : '' }}" type="text" name="shipout_at" id="shipout_at" value="{{ old('shipout_at') }}">
                @if($errors->has('shipout_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipout_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.shipout_at_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="completed_at">{{ trans('cruds.transactionRedeemProduct.fields.completed_at') }}</label>
                <input class="form-control datetime {{ $errors->has('completed_at') ? 'is-invalid' : '' }}" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at') }}">
                @if($errors->has('completed_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('completed_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionRedeemProduct.fields.completed_at_helper') }}</span>
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
