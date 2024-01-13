@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ trans('cruds.order.fields.order_information') }} #{{ $order->order_number }}</h4>
                    <h6 class="mb-2"><i class="fas fa-shopping-bag fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ App\Models\Order::STATUS_SELECT[$order->status] ?? '' }}</h6>
                    <h6 class="mb-2"><i class="fas fa-calendar fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ $order->created_at ?? '' }}</h6>
                    <hr>
                    <table width="100%" cellspacing="5" cellpadding="10">
                        <th>{{ trans('cruds.order.fields.image') }}</th>
                        <th>{{ trans('cruds.order.fields.item_descriptions') }}</th>
                        <th style="text-align: right">{{ trans('cruds.order.fields.unit_points') }}</th>
                        <th style="text-align: right">{{ trans('cruds.order.fields.quantity') }}</th>
                        <th style="text-align: right">{{ trans('cruds.order.fields.sub_total_points') }}</th>
                        <tbody>
                        @forelse($order->order_item as $item)
                            <tr class="border-top">
                                <td width="7%">
                                    @if($item->product_variant != NULL)
                                        @if($item->product_variant->photo)
                                            <img src="{{ $item->product_variant->photo->getUrl('') }}" style="width:50px;height:auto;">
                                        @else
                                            @if($item->product->image_1)
                                                <img src="{{ $item->product->image_1->getUrl('') }}" style="width:50px;height:auto;">
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                <td width="55%">
                                    {{ $item->product_name_en }} (SKU: <strong>{{ $item->product_sku }}</strong>)

                                    @if($order->status == 1)
                                        @if($item->product_variant_id != null)
                                            @if(count($item->product_detail) == 0)
                                                <form action="{{ route('admin.orders.remove-product') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="order_item_id" value="{{ $item->id }}">
                                                    <button type="submit" style="border: none;background-color: transparent;outline: none;"><i class="fas fa-trash fa-lg text-danger"></i></button>
                                                </form>
                                            @endif
                                        @endif
                                    @endif


                                    <br/>↳
                                    <span class="text-muted">({{ trans('global.size') }}: {{ $item->product_size }}, {{ trans('global.color') }}: {{ $item->product_color }})</span>
                                    @if(count($item->product_detail) > 0)
                                        <br/>
                                        {{ trans('cruds.order.fields.product_details') }}
                                        @forelse($item->product_detail as $product)
                                            <br/>↳<span class="text-muted p-1">
                                                @if($product->status == 6)
                                                    <span style="text-decoration: line-through;color:red;">{{ $product->qr_code}}</span>
                                                @else
                                                    <span>{{ $product->qr_code}}</span>
                                                @endif
                                            </span>
                                            &nbsp;
                                            @if($product->status == 6)
                                            @else
                                                @if($order->status == 1)
                                                    <form action="{{ route('admin.orders.release-product') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="product_quantity_id" value="{{ $product->id }}">
                                                        <button type="submit" style="border: none;background-color: transparent;outline: none;"><i class="fas fa-times fa-lg text-danger"></i></button>
                                                    </form>
                                                @endif

                                                @if($order->status == 2 || $order->status == 3 || $order->status == 5)
                                                    <form action="{{ route('admin.orders.damage-product') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="product_quantity_id" value="{{ $product->id }}">
                                                        <button type="submit" style="border: none;background-color: transparent;outline: none;"><i class="fas fa-house-damage fa-lg text-warning"></i></button>
                                                    </form>
                                                @endif
                                            @endif


                                        @empty
                                        @endforelse
                                    @endif

                                    @if($item->product_quantity == count($item->product_detail))

                                    @else
                                        <br/>
                                        @if (session('error-'.$item->id))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error-'.$item->id) ?? '-' }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if($order->status == 1)
                                            <form action="{{ route('admin.orders.add-product') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">

                                            @if(($item->is_new == 1 && $item->product_variant_id != null) || ($item->is_new == 1 && $item->product_variant_id != null && $item->admin_id != null) || ($item->is_new == NULL && $item->parent_id == null && $item->product_variant_id != null))
                                                    <div class="form-group pt-3">
                                                        <label class="required" for="tracking_code">{{ trans('cruds.order.fields.add_product_qr') }}</label>
                                                        <input class="form-control {{ $errors->has('product_qr') ? 'is-invalid' : '' }}" type="text" name="product_qr" id="product_qr" value="{{ old('product_qr', '') }}" placeholder="{{ trans('cruds.order.fields.product_qr') }}" required>
                                                        @if($errors->has('product_qr'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('product_qr') }}
                                                            </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.order.fields.tracking_code_helper') }}</span>
                                                    </div>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="order_item_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="product_variant_id" value="{{ $item->product_variant_id }}">
                                                    <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.add') }}">
                                            @elseif($item->is_new == 1 && $item->parent_id == null && $item->admin_id == null)

                                            @endif

                                        </form>
                                        @else
                                            <form action="{{ route('admin.orders.add-product') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">

                                                @if(($item->is_new == 1 && $item->product_variant_id != null) || ($item->is_new == 1 && $item->product_variant_id != null && $item->admin_id != null) || ($item->is_new == NULL && $item->parent_id == null && $item->product_variant_id != null))
                                                    <div class="form-group pt-3">
                                                        <label class="required" for="tracking_code">{{ trans('cruds.order.fields.add_product_qr') }}</label>
                                                        <input class="form-control {{ $errors->has('product_qr') ? 'is-invalid' : '' }}" type="text" name="product_qr" id="product_qr" value="{{ old('product_qr', '') }}" placeholder="{{ trans('cruds.order.fields.product_qr') }}" required>
                                                        @if($errors->has('product_qr'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('product_qr') }}
                                                            </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.order.fields.tracking_code_helper') }}</span>
                                                    </div>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="order_item_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="product_variant_id" value="{{ $item->product_variant_id }}">
                                                    <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.add') }}">
                                                @elseif($item->is_new == 1 && $item->parent_id == null && $item->admin_id == null)

                                                @endif

                                            </form>
                                        @endif
                                    @endif

                                </td>
                                <td style="text-align: right">
                                    @if($item->order->order_type == 2)
                                        {{ $item->purchase_price }} {{ trans('global.points') }}
                                    @else
                                        @if($item->order->user_id == 1 && $is_vip)
                                            {{ $item->sales_price }} {{ trans('global.points') }}
                                        @else
                                            @if($item->is_new == 1 && $item->parent_id == null && $item->admin_id == null)
                                                <div>-</div>
                                            @else
                                                {{ $item->purchase_price ?? '0' }} {{ trans('global.points') }}
                                            @endif
                                        @endif
                                    @endif

                                </td>
                                <td width="5%" style="text-align: right">
                                    @if($item->is_new == 1 && $item->parent_id == null && $item->admin_id == null)
                                        <div>-</div>
                                    @else
                                        x {{ $item->product_quantity }}
                                    @endif
                                </td>
                                <td style="text-align: right">
                                    @if($item->order->order_type == 2)
                                        {{ $item->product_quantity * $item->purchase_price }} {{ trans('global.points') }}
                                    @else
                                        @if($item->order->user_id == 1 && $is_vip)
                                            {{ $item->product_quantity * $item->sales_price }} {{ trans('global.points') }}
                                        @else
                                            @if($item->is_new == 1 && $item->parent_id == null && $item->admin_id == null)
                                                <div>-</div>
                                            @else
                                                {{ $item->product_quantity * ($item->purchase_price ?? 0) }} {{ trans('global.points') }}
                                            @endif
                                        @endif
                                    @endif
                                </td>

                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                    </table>
                    <div class="row pb-5">
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                            <table width="100%" cellspacing="5" cellpadding="5" class="mt-2" style="text-align: right">
                                <tr>
                                    <td width="10%">
                                        <span class="text-muted">{{ trans('cruds.order.fields.sub_total') }}</span>
                                    </td>
                                    <td width="10%">
                                        {{ $order->sub_total }} {{ trans('global.points') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="10%">
                                        <span class="text-muted">{{ trans('cruds.order.fields.total_add_on') }}</span>
                                    </td>
                                    <td width="10%">
                                        {{ $order->total_add_on }} {{ trans('global.points') }}
                                    </td>
                                </tr>
                                <tr>

                                    <td width="10%">
                                        <span class="text-muted">{{ trans('cruds.order.fields.shipping_fee') }}</span>
                                    </td>
                                    <td width="10%">
                                        {{ $order->total_shipping }} {{ trans('global.points') }}
                                    </td>
                                </tr>
                                <tr>

                                    <td width="10%">
                                        <span class="text-muted">{{ trans('cruds.order.fields.voucher_amount') }}</span>
                                    </td>
                                    <td width="10%">
                                        {{ $order->voucher_amount }} {{ trans('global.points') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom"></td>
                                    <td class="border-bottom"></td>
                                </tr>
                                <tr>
                                    <td width="10%">
                                        <span class="text-muted">{{ trans('cruds.order.fields.paid_amount') }}</span>
                                    </td>
                                    <td width="10%">
                                        @if($order->order_type == 2)
                                            <strong>{{ $order->amount + $order->total_shipping + $order->total_add_on }} {{ trans('global.points') }}</strong>
                                        @else
                                            <strong>{{ $order->amount + $order->voucher_amount + $order->total_shipping + $order->total_add_on }} {{ trans('global.points') }}</strong>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            @if($order->status == 1)
                                <i class="fas fa-question-circle fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.order.fields.add_promotion_item') }}</span>
                            @endif
                        </div>
                        <div class="ms-auto">
                            @can('order_edit')
{{--                                @if($order->status == 1 || $order->status == 2 || $order->status == 3)--}}
                                    <a href="{{ route('admin.orders.add-order-item', ['id' => $order->id]) }}"><button class="btn btn-sm btn-primary">{{ trans('global.add_item') }}</button></a>
{{--                                @endif--}}
                            @endcan
                        </div>

                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            @if($order->status == 4)
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.order.fields.order_was_cancelled') }}</span>
                            @else
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.order.fields.order_was_confirm') }}</span>
                            @endif
                        </div>
                        <div class="ms-auto">
                            @can('order_cancel')
                                @if($order->status == 1)
                                    <form action="{{ route('admin.orders.to-cancel') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.cancel') }}">
                                    </form>
                                @endif
                            @endcan
                        </div>

                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            @if($order->status == 4)
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.order.fields.payment_point_has_been_refunded', ['value' =>  $order->amount]) }}</span>
                            @else
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.order.fields.payment_point_was_accepted', ['value' =>  ($order->amount + $order->voucher_amount + $order->total_shipping + $order->total_add_on)]) }}</span>
                            @endif
                        </div>
                    </div>
                    @if($order->status != 4)
                        @if($order->collect_type == 1)
                            <div class="border-top d-flex align-items-center">
                                <div class="p-3">
                                    @if($product_count != $quantity_count)
                                        <i class="fas fa-truck-pickup fa-2x text-success"></i>
                                        &nbsp;
                                        <span>{{ trans('cruds.order.fields.insert_all_the_product_for_pickup') }}</span>
                                    @else
                                        @if($order->status == 1)
                                            <i class="fas fa-truck-pickup fa-2x text-success"></i>
                                            &nbsp;
                                            <span>{{ trans('cruds.order.fields.order_already_pick_up') }}</span>
                                        @else
                                            <i class="fas fa-check fa-2x text-success"></i>
                                            &nbsp;
                                            <span>{{ trans('cruds.order.fields.order_picked_up', ['value' => $order->pickup_at]) }}</span>
                                        @endif
                                    @endif
                                </div>
                                <div class="ms-auto">
                                    @if($order->status == 1 && $product_count == $quantity_count)
                                        <form action="{{ route('admin.orders.to-pick-up') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                            <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.pick_up') }}">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="border-top d-flex align-items-center">
                                <div class="p-3">
                                    @if($product_count != $quantity_count)
                                        <i class="fas fa-truck  fa-2x text-success"></i>
                                        &nbsp;
                                        <span>{{ trans('cruds.order.fields.insert_all_the_product_to_shipping') }}</span>
                                    @elseif($order->tracking_code != "")
                                        <i class="fas fa-check fa-2x text-success"></i>
                                        &nbsp;
                                        <span>{{ trans('cruds.order.fields.delivery', ['value' => $order->shipout_at]) }}</span>
                                    @else
                                        <i class="fas fa-truck  fa-2x text-success"></i>
                                        &nbsp;
                                        <span>{{ trans('cruds.order.fields.order_ready_for_shipping') }}</span>
                                    @endif
                                </div>
                                @if ($order->tracking_code != "" && $product_count == $quantity_count)
                                    <a class="ms-auto btn btn-sm btn-info show-tracking">{{ trans('global.show_tracking') }}</a>
                                    <a class="ms-auto btn btn-sm btn-info hide-tracking" style="display: none">{{ trans('global.hide_tracking') }}</a>
                                @endif
                            </div>
                            @if ($order->tracking_code != "")
                                <div id="embedTrack" style="display: none"></div>
                            @elseif($product_count == $quantity_count)
                                @can('order_to_ship')
                                    <form method="POST" action="{{ route("admin.orders.confirm-ship") }}" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $order->id }}" step="1">
                                    <div class="row p-3">
                                        <div class="form-group col-6">
                                            X<label class="required" for="shipping_company_id">{{ trans('cruds.order.fields.shipping_company') }}</label>&nbsp;<small><a href="{{route('admin.shipping-companies.create')}}">{{ trans('global.create') }} {{ trans('cruds.order.fields.shipping_company') }}</a></small>
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
                                        <div class="form-group col-6">
                                            <label class="required" for="tracking_code">{{ trans('cruds.order.fields.tracking_code') }}</label>
                                            <input class="form-control {{ $errors->has('tracking_code') ? 'is-invalid' : '' }}" type="text" name="tracking_code" id="tracking_code" value="{{ old('tracking_code', $order->tracking_code) }}" required>
                                            @if($errors->has('tracking_code'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('tracking_code') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.order.fields.tracking_code_helper') }}</span>
                                        </div>
                                    </div>
                                    <div class="border-top d-flex align-items-center pt-3">
                                        <div class="p-3">
                                        </div>
                                        <div class="ms-auto">
                                            <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.delivery') }}">
                                        </div>
                                    </div>
                                </form>
                                @endcan
                            @endif
                        @endif
                    @endif
                    @if($order->status == 3 || $order->status == 2)
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                <i class="fas fa-question fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.order.fields.order_complete') }}</span>
                            </div>
                            <div class="ms-auto">
                                @can('order_complete')
                                    <form action="{{ route('admin.orders.to-complete') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <input type="submit" class="btn btn-sm btn-success" value="{{ trans('global.complete') }}">
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endif
                    @if($order->status == 5)
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.order.fields.order_completed', ['value' => $order->completed_at]) }}</span>
                            </div>
                        </div>
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.order.fields.order_invoice', ['value' => ($order->invoice_number ?? '')]) }}</span>
                            </div>
                            <div class="ms-auto">
                                <a href="{{ route('admin.orders.invoice-pdf', ['id' => $order->id]) }}" target="_blank"><input type="button" class="btn btn-sm btn-primary" value="{{ trans('global.invoice') }}"></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <livewire:admin.order.show :order="$order"/>

{{--        <div class="col-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title mb-3">{{ trans('global.customer') }}</h4>--}}
{{--                    <h6 class="mb-1">{{ $order->user->name ?? '-' }}</h6>--}}
{{--                    <h6 class="mb-1">{{ $order->user->phone ?? '-' }}</h6>--}}
{{--                    <h6 class="mb-4">{{ $order->user->email ?? '-' }}</h6>--}}
{{--                    <hr>--}}
{{--                    @if($order->collect_type == 1)--}}
{{--                        <h4 class="card-title mb-3 mt-4">{{ trans('cruds.order.fields.pickup_location') }}</h4>--}}
{{--                        <h6 class="mb-1">{{ $order->pickup_location->name ?? '-' }}</h6>--}}
{{--                        <h6 class="mb-1">{{ $order->pickup_location->person_in_charge ?? '-' }} {{ $order->pickup_location->phone ?? '-' }}</h6>--}}
{{--                        <h6 class="mb-1">{{ $order->pickup_location->address ?? '-' }}</h6>--}}
{{--                        <h6 class="mb-3">{{ $order->pickup_location->country->name  ?? '-'}}</h6>--}}
{{--                    @else--}}
{{--                        <h4 class="card-title mb-3 mt-4">{{ trans('cruds.order.fields.shipping_details') }}</h4>--}}
{{--                        <h6 class="mb-1">{{ $order->receiver_name ?? '-' }}</h6>--}}
{{--                        <h6 class="mb-1">{{ $order->receiver_phone ?? '-' }}</h6>--}}
{{--                        <h6 class="mb-1">{{ $order->receiver_address_1 }} {{ $order->receiver_address_2 ?? '' }} {{ $order->receiver_postcode }}</h6>--}}
{{--                        <h6 class="mb-1">{{ $order->receiver_city }}</h6>--}}
{{--                        <h6 class="mb-3">{{ $order->receiver_state }}</h6>--}}
{{--                    @endif--}}
{{--                    <hr>--}}
{{--                    <h4 class="card-title mb-3 mt-4">{{ trans('cruds.order.fields.remark') }}</h4>--}}
{{--                    <h6 class="mb-3">{{ $order->remark ?? '-' }}</h6>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title mb-3">{{ trans('cruds.order.fields.payment_detail') }}</h4>--}}
{{--                    <h6 class="mb-1">{{ trans('cruds.order.fields.user_name') }}: {{ $order->user->name ?? '-' }}</h6>--}}
{{--                    @if($order->wallet_type != 5)--}}
{{--                        <h6 class="mb-1">{{ trans('cruds.order.fields.user_pv') }}: {{ $order->amount }}</h6>--}}
{{--                    @else--}}
{{--                        <h6 class="mb-1">{{ trans('cruds.order.fields.user_pv') }}: 0</h6>--}}
{{--                    @endif--}}
{{--                    <h6 class="mb-1">{{ trans('cruds.order.fields.user_shipping_point') }}: {{ $order->total_shipping ?? '-' }}</h6>--}}
{{--                    <hr>--}}
{{--                    @if($order->user_id != $order->order_user_id)--}}
{{--                        <h6 class="mb-1">{{ trans('cruds.order.fields.is_vip_order') }}: {{ trans('cruds.order.fields.yes') }}</h6>--}}
{{--                        <h6 class="mb-1">{{ trans('cruds.order.fields.vip_name') }}: {{ $order->order_user->name ?? '-' }}</h6>--}}
{{--                        @if($order->wallet_type == 5)--}}
{{--                            <h6 class="mb-1">{{ trans('cruds.order.fields.vip_point') }}: {{ $order->amount ?? '0' }}</h6>--}}
{{--                        @else--}}
{{--                            <h6 class="mb-1">{{ trans('cruds.order.fields.vip_point') }}: 0</h6>--}}
{{--                        @endif--}}
{{--                        <h6 class="mb-1">{{ trans('cruds.order.fields.vip_cash_amount') }}: {{ $order->cash_voucher_amount ?? '0' }}</h6>--}}
{{--                    @else--}}
{{--                        <h6 class="mb-1">{{ trans('cruds.order.fields.is_vip_order') }}: {{ trans('cruds.order.fields.no') }}</h6>--}}
{{--                        <h6 class="mb-1">{{ trans('cruds.order.fields.vip_name') }}: -</h6>--}}
{{--                        <h6 class="mb-1">{{ trans('cruds.order.fields.vip_point') }}: -</h6>--}}
{{--                        <h6 class="mb-1">{{ trans('cruds.order.fields.vip_cash_amount') }}: -</h6>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-1"></div>
    </div>





@endsection

@section('scripts')
    <script src="//www.tracking.my/track-button.js"></script>
    <script>
        TrackButton.embed({
            selector: "#embedTrack",
            courier: "{{ $order->shipping_company->api_name ?? '' }}",
            tracking_no: "{{ $order->tracking_code }}"
        });
    </script>
    <script>
        $('.show-tracking').click(function() {
            $("#embedTrack").css("display", "block");
            $(".hide-tracking").css("display", "block");
            $(".show-tracking").css("display", "none");
        });
        $('.hide-tracking').click(function() {
            $("#embedTrack").css("display", "none");
            $(".hide-tracking").css("display", "none");
            $(".show-tracking").css("display", "block");
        });
    </script>
@endsection
