@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.order.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $order->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_number">{{ trans('cruds.order.fields.order_number') }}</label>
                <input class="form-control {{ $errors->has('order_number') ? 'is-invalid' : '' }}" type="text" name="order_number" id="order_number" value="{{ old('order_number', $order->order_number) }}">
                @if($errors->has('order_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.order.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', $order->amount) }}">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_method_id">{{ trans('cruds.order.fields.payment_method') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method_id" id="payment_method_id">
                    @foreach($payment_methods as $id => $entry)
                        <option value="{{ $id }}" {{ (old('payment_method_id') ? old('payment_method_id') : $order->payment_method->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receiver_name">{{ trans('cruds.order.fields.receiver_name') }}</label>
                <input class="form-control {{ $errors->has('receiver_name') ? 'is-invalid' : '' }}" type="text" name="receiver_name" id="receiver_name" value="{{ old('receiver_name', $order->receiver_name) }}">
                @if($errors->has('receiver_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receiver_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.receiver_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receiver_phone">{{ trans('cruds.order.fields.receiver_phone') }}</label>
                <input class="form-control {{ $errors->has('receiver_phone') ? 'is-invalid' : '' }}" type="text" name="receiver_phone" id="receiver_phone" value="{{ old('receiver_phone', $order->receiver_phone) }}">
                @if($errors->has('receiver_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receiver_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.receiver_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receiver_address_1">{{ trans('cruds.order.fields.receiver_address_1') }}</label>
                <input class="form-control {{ $errors->has('receiver_address_1') ? 'is-invalid' : '' }}" type="text" name="receiver_address_1" id="receiver_address_1" value="{{ old('receiver_address_1', $order->receiver_address_1) }}">
                @if($errors->has('receiver_address_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receiver_address_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.receiver_address_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receiver_address_2">{{ trans('cruds.order.fields.receiver_address_2') }}</label>
                <input class="form-control {{ $errors->has('receiver_address_2') ? 'is-invalid' : '' }}" type="text" name="receiver_address_2" id="receiver_address_2" value="{{ old('receiver_address_2', $order->receiver_address_2) }}">
                @if($errors->has('receiver_address_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receiver_address_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.receiver_address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receiver_city">{{ trans('cruds.order.fields.receiver_city') }}</label>
                <input class="form-control {{ $errors->has('receiver_city') ? 'is-invalid' : '' }}" type="text" name="receiver_city" id="receiver_city" value="{{ old('receiver_city', $order->receiver_city) }}">
                @if($errors->has('receiver_city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receiver_city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.receiver_city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receiver_state">{{ trans('cruds.order.fields.receiver_state') }}</label>
                <input class="form-control {{ $errors->has('receiver_state') ? 'is-invalid' : '' }}" type="text" name="receiver_state" id="receiver_state" value="{{ old('receiver_state', $order->receiver_state) }}">
                @if($errors->has('receiver_state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receiver_state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.receiver_state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receiver_postcode">{{ trans('cruds.order.fields.receiver_postcode') }}</label>
                <input class="form-control {{ $errors->has('receiver_postcode') ? 'is-invalid' : '' }}" type="text" name="receiver_postcode" id="receiver_postcode" value="{{ old('receiver_postcode', $order->receiver_postcode) }}">
                @if($errors->has('receiver_postcode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receiver_postcode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.receiver_postcode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pre_point_balance">{{ trans('cruds.order.fields.pre_point_balance') }}</label>
                <input class="form-control {{ $errors->has('pre_point_balance') ? 'is-invalid' : '' }}" type="text" name="pre_point_balance" id="pre_point_balance" value="{{ old('pre_point_balance', $order->pre_point_balance) }}">
                @if($errors->has('pre_point_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pre_point_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.pre_point_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="post_point_balance">{{ trans('cruds.order.fields.post_point_balance') }}</label>
                <input class="form-control {{ $errors->has('post_point_balance') ? 'is-invalid' : '' }}" type="text" name="post_point_balance" id="post_point_balance" value="{{ old('post_point_balance', $order->post_point_balance) }}">
                @if($errors->has('post_point_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_point_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.post_point_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.collect_type') }}</label>
                <select class="form-control {{ $errors->has('collect_type') ? 'is-invalid' : '' }}" name="collect_type" id="collect_type">
                    <option value disabled {{ old('collect_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Order::COLLECT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('collect_type', $order->collect_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('collect_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('collect_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.collect_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipped_by_id">{{ trans('cruds.order.fields.shipped_by') }}</label>
                <select class="form-control select2 {{ $errors->has('shipped_by') ? 'is-invalid' : '' }}" name="shipped_by_id" id="shipped_by_id">
                    @foreach($shipped_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('shipped_by_id') ? old('shipped_by_id') : $order->shipped_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipped_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipped_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipped_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="picked_up_by_id">{{ trans('cruds.order.fields.picked_up_by') }}</label>
                <select class="form-control select2 {{ $errors->has('picked_up_by') ? 'is-invalid' : '' }}" name="picked_up_by_id" id="picked_up_by_id">
                    @foreach($picked_up_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('picked_up_by_id') ? old('picked_up_by_id') : $order->picked_up_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('picked_up_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('picked_up_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.picked_up_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_by_id">{{ trans('cruds.order.fields.completed_by') }}</label>
                <select class="form-control select2 {{ $errors->has('completed_by') ? 'is-invalid' : '' }}" name="completed_by_id" id="completed_by_id">
                    @foreach($completed_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('completed_by_id') ? old('completed_by_id') : $order->completed_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('completed_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('completed_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.completed_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="refund_by_id">{{ trans('cruds.order.fields.refund_by') }}</label>
                <select class="form-control select2 {{ $errors->has('refund_by') ? 'is-invalid' : '' }}" name="refund_by_id" id="refund_by_id">
                    @foreach($refund_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('refund_by_id') ? old('refund_by_id') : $order->refund_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('refund_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refund_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.refund_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipping_company_id">{{ trans('cruds.order.fields.shipping_company') }}</label>
                <select class="form-control select2 {{ $errors->has('shipping_company') ? 'is-invalid' : '' }}" name="shipping_company_id" id="shipping_company_id">
                    @foreach($shipping_companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('shipping_company_id') ? old('shipping_company_id') : $order->shipping_company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipping_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipping_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tracking_code">{{ trans('cruds.order.fields.tracking_code') }}</label>
                <input class="form-control {{ $errors->has('tracking_code') ? 'is-invalid' : '' }}" type="text" name="tracking_code" id="tracking_code" value="{{ old('tracking_code', $order->tracking_code) }}">
                @if($errors->has('tracking_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tracking_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.tracking_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipout_at">{{ trans('cruds.order.fields.shipout_at') }}</label>
                <input class="form-control datetime {{ $errors->has('shipout_at') ? 'is-invalid' : '' }}" type="text" name="shipout_at" id="shipout_at" value="{{ old('shipout_at', $order->shipout_at) }}">
                @if($errors->has('shipout_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipout_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipout_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pickup_at">{{ trans('cruds.order.fields.pickup_at') }}</label>
                <input class="form-control datetime {{ $errors->has('pickup_at') ? 'is-invalid' : '' }}" type="text" name="pickup_at" id="pickup_at" value="{{ old('pickup_at', $order->pickup_at) }}">
                @if($errors->has('pickup_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pickup_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.pickup_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_at">{{ trans('cruds.order.fields.completed_at') }}</label>
                <input class="form-control datetime {{ $errors->has('completed_at') ? 'is-invalid' : '' }}" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at', $order->completed_at) }}">
                @if($errors->has('completed_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('completed_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.completed_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="refund_at">{{ trans('cruds.order.fields.refund_at') }}</label>
                <input class="form-control datetime {{ $errors->has('refund_at') ? 'is-invalid' : '' }}" type="text" name="refund_at" id="refund_at" value="{{ old('refund_at', $order->refund_at) }}">
                @if($errors->has('refund_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refund_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.refund_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Order::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $order->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
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
