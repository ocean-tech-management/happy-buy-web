@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.toShip') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.confirm-ship") }}" enctype="multipart/form-data">
            @csrf
            <input class="form-control" type="hidden" name="id" id="id" value="{{ $order->id }}" step="1">
            <div class="card">
                <h4 class="card-title">{{ trans('cruds.order.fields.shipping_detail') }}</h4>
                <table class=" table table-bordered table-striped table-hover">
                    <tr>
                        <td width="20%"><strong>{{ trans('cruds.order.fields.order_number') }}</strong></td>
                        <td>{{ $order->order_number }}</td>
                        <td width="20%"><strong>{{ trans('cruds.order.fields.address') }}</strong></td>
                        <td>{{ $order->receiver_address_1 }} {{ $order->receiver_address_2 ?? '' }} {{ $order->receiver_city }} {{ $order->receiver_state }} {{ $order->receiver_postcode }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><strong>{{ trans('cruds.order.fields.receiver_name') }}</strong></td>
                        <td>{{ $order->receiver_name }}</td>
                        <td width="20%"><strong>{{ trans('cruds.order.fields.receiver_phone') }}</strong></td>
                        <td>{{ $order->receiver_phone }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><strong>{{ trans('cruds.orderItem.title') }}</strong></td>
                        <td colspan="3">
                            @foreach($order->order_item as $item)
                                {{ $item->product_name_en }} {{ $item->product_size }} {{ $item->product_color }} x {{ $item->product_quantity }}<br/>
                            @endforeach

                        </td>
                    </tr>
{{--                    <tr>--}}
{{--                        <td><strong>{{ trans('cruds.productVariant.fields.color') }}</strong></td>--}}
{{--                        <td>{{ $order->variant->color->name }}</td>--}}
{{--                        <td><strong>{{ trans('cruds.productVariant.fields.size') }}</strong></td>--}}
{{--                        <td>{{ $order->variant->size->name }}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td><strong>{{ trans('cruds.productVariant.fields.quantity') }}</strong></td>--}}
{{--                        <td>{{ $order->variant->quantity }}</td>--}}
{{--                        <td><strong>{{ trans('cruds.transactionRedeemProduct.fields.collect_type') }}</strong></td>--}}
{{--                        <td>{{ App\Models\Order::COLLECT_TYPE_SELECT[$order->collect_type] ?? '' }}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td><strong>{{ trans('cruds.transactionRedeemProduct.fields.address') }}</strong></td>--}}
{{--                        <td colspan="3">{{ $order->address->user ?? '' }}</td>--}}
{{--                    </tr>--}}
                </table>
            </div>
            <div class="form-group">
                <label class="required" for="shipping_company_id">{{ trans('cruds.order.fields.shipping_company') }}</label>&nbsp;<small><a href="{{route('admin.shipping-companies.create')}}">{{ trans('global.create') }} {{ trans('cruds.order.fields.shipping_company') }}</a></small>
                <select class="form-control select2 {{ $errors->has('shipping_company') ? 'is-invalid' : '' }}" name="shipping_company_id" id="shipping_company_id" required>
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
                <label class="required" for="tracking_code">{{ trans('cruds.order.fields.tracking_code') }}</label>
                <input class="form-control {{ $errors->has('tracking_code') ? 'is-invalid' : '' }}" type="text" name="tracking_code" id="tracking_code" value="{{ old('tracking_code', $order->tracking_code) }}" required>
                @if($errors->has('tracking_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tracking_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.tracking_code_helper') }}</span>
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
