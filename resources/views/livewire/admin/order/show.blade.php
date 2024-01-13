<div class="col-3">
    <div class="card">
        <div class="card-body">
            @if($order->order_type == 2)
                <h4 class="card-title mb-3">{{ trans('global.customer') }}</h4>
                <h6 class="mb-1">{{ $order->billing_name ?? '-' }}</h6>
                <h6 class="mb-1">{{ $order->billing_phone ?? '-' }}</h6>
                <h6 class="mb-4">{{ $order->billing_address ?? '-' }}</h6>
            @else
                <h4 class="card-title mb-3">{{ trans('global.customer') }}</h4>
                <h6 class="mb-1">{{ $order->user->name ?? '-' }}</h6>
                <h6 class="mb-1">{{ $order->user->phone ?? '-' }}</h6>
                <h6 class="mb-4">{{ $order->user->email ?? '-' }}</h6>
            @endif

            <hr>
            @if($order->order_type == 2)
                    @if($order->collect_type == 1)
                        <h4 class="card-title mb-3 mt-4">{{ trans('cruds.order.fields.pickup_location') }}</h4>
                        @if($this->order->collect_type != 2 && ($this->order->status == 1 || $this->order->status == 5))
                            <button class="btn btn-sm btn-secondary" wire:click="shippingInputToggle()">Update Shipping Price</button>
                        @endif


                        @if($this->showShippingInput == true)
                            <input class="form-control" type="number" wire:model="shippingFee" value="" placeholder="Enter shipping price">
                            <input class="form-control" type="text" wire:model="shippingName" value="" placeholder="Enter receiver name">
                            <input class="form-control" type="text" wire:model="shippingPhone" value="" placeholder="Enter receiver phone">
                            <input class="form-control" type="text" wire:model="shippingAddress" value="" placeholder="Enter receiver address 1">
                            <input class="form-control" type="text" wire:model="shippingAddress2" value="" placeholder="Enter receiver address 2">
                            <input class="form-control" type="text" wire:model="shippingPostcode" value="" placeholder="Enter receiver postcode">
                            <input class="form-control" type="text" wire:model="shippingCity" value="" placeholder="Enter receiver city">
                            <select class="form-control select2" wire:model="shippingState" required>
                                @foreach($states as $id => $entry)
                                    <option value="{{ $entry->name }}" >{{ $entry->name }}</option>
                                @endforeach
                            </select>

                            @if($message)
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                            @endif

                            <button class="btn btn-sm btn-success" wire:click="submit()">Submit</button>
                        @endif

                        <h6 class="mb-1">{{ $order->pickup_location->name ?? '-' }}</h6>
                        <h6 class="mb-1">{{ $order->pickup_location->person_in_charge ?? '-' }} {{ $order->pickup_location->phone ?? '-' }}</h6>
                        <h6 class="mb-1">{{ $order->pickup_location->address ?? '-' }}</h6>
                        <h6 class="mb-3">{{ $order->pickup_location->country->name  ?? '-'}}</h6>
                    @else
                        <h4 class="card-title mb-3 mt-4">{{ trans('cruds.order.fields.shipping_details') }}</h4>
                        <h6 class="mb-1">{{ $order->receiver_name ?? '-' }}</h6>
                        <h6 class="mb-1">{{ $order->receiver_phone ?? '-' }}</h6>
                        <h6 class="mb-1">{{ $order->receiver_address_1 }} {{ $order->receiver_address_2 ?? '' }} {{ $order->receiver_postcode }}</h6>
                        <h6 class="mb-1">{{ $order->receiver_city }}</h6>
                        <h6 class="mb-3">{{ $order->receiver_state }}</h6>
                    @endif
                        <hr>
                @else
                    @if($order->collect_type == 1)
                        <h4 class="card-title mb-3 mt-4">{{ trans('cruds.order.fields.pickup_location') }}</h4>
                        <h6 class="mb-1">{{ $order->pickup_location->name ?? '-' }}</h6>
                        <h6 class="mb-1">{{ $order->pickup_location->person_in_charge ?? '-' }} {{ $order->pickup_location->phone ?? '-' }}</h6>
                        <h6 class="mb-1">{{ $order->pickup_location->address ?? '-' }}</h6>
                        <h6 class="mb-3">{{ $order->pickup_location->country->name  ?? '-'}}</h6>
                    @else
                        <h4 class="card-title mb-3 mt-4">{{ trans('cruds.order.fields.shipping_details') }}</h4>
                        <h6 class="mb-1">{{ $order->receiver_name ?? '-' }}</h6>
                        <h6 class="mb-1">{{ $order->receiver_phone ?? '-' }}</h6>
                        <h6 class="mb-1">{{ $order->receiver_address_1 }} {{ $order->receiver_address_2 ?? '' }} {{ $order->receiver_postcode }}</h6>
                        <h6 class="mb-1">{{ $order->receiver_city }}</h6>
                        <h6 class="mb-3">{{ $order->receiver_state }}</h6>
                    @endif

            @endif

            <h4 class="card-title mb-3 mt-4">{{ trans('cruds.order.fields.remark') }}</h4>
            <h6 class="mb-3">{{ $order->remark ?? '-' }}</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">{{ trans('cruds.order.fields.payment_detail') }}</h4>
            <h6 class="mb-1">{{ trans('cruds.order.fields.user_name') }}: {{ $order->user->name ?? '-' }}</h6>
            @if($order->wallet_type != 5)
                <h6 class="mb-1">{{ trans('cruds.order.fields.user_pv') }}: {{ $order->amount }}</h6>
            @else
                <h6 class="mb-1">{{ trans('cruds.order.fields.user_pv') }}: 0</h6>
            @endif
            <h6 class="mb-1">{{ trans('cruds.order.fields.user_shipping_point') }}: {{ $order->total_shipping ?? '-' }}</h6>
            <hr>
            @if($order->user_id != $order->order_user_id)
                <h6 class="mb-1">{{ trans('cruds.order.fields.is_vip_order') }}: {{ trans('cruds.order.fields.yes') }}</h6>
                <h6 class="mb-1">{{ trans('cruds.order.fields.vip_name') }}: {{ $order->order_user->name ?? '-' }}</h6>
                @if($order->wallet_type == 5)
                    <h6 class="mb-1">{{ trans('cruds.order.fields.vip_point') }}: {{ $order->amount ?? '0' }}</h6>
                @else
                    <h6 class="mb-1">{{ trans('cruds.order.fields.vip_point') }}: 0</h6>
                @endif
                <h6 class="mb-1">{{ trans('cruds.order.fields.vip_cash_amount') }}: {{ $order->cash_voucher_amount ?? '0' }}</h6>
            @else
                <h6 class="mb-1">{{ trans('cruds.order.fields.is_vip_order') }}: {{ trans('cruds.order.fields.no') }}</h6>
                <h6 class="mb-1">{{ trans('cruds.order.fields.vip_name') }}: -</h6>
                <h6 class="mb-1">{{ trans('cruds.order.fields.vip_point') }}: -</h6>
                <h6 class="mb-1">{{ trans('cruds.order.fields.vip_cash_amount') }}: -</h6>
            @endif
        </div>
    </div>
</div>
