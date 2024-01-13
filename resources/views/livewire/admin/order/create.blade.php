<div>
    <div class="form-group">
        <label for="wallet_id">Agent/Non Agent</label>
        <select class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}" wire:model="agentType" >
            <option value="1">Agent</option>
            <option value="2" >Non Agent</option>
        </select>
    </div>

    @if($publicOrder)
        <div class="form-group">
            <label class="required" for="user_id">{{ trans('cruds.order.fields.user') }}</label>
            <select class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}" wire:model="user" name="user_id" id="user_id" required>
                <option value="">{{ trans('global.pleaseSelect') }}</option>
                @foreach($users as $id => $entry)
                    <option value="{{ $entry->id }}" >{{ $entry->name }} - {{ $entry->email }} - {{ $entry->personal_code }}</option>
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
            <label>{{ trans('cruds.order.fields.collect_type') }}</label>
            <select class="form-control {{ $errors->has('collect_type') ? 'is-invalid' : '' }}" name="collect_type" id="collect_type">
                <option value disabled {{ old('collect_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                @foreach(App\Models\Order::COLLECT_TYPE_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('collect_type', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
            <label for="wallet_id">From Wallet</label>
            <select class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}" wire:model="wallet" >
{{--                <option value="">Default</option>--}}


                @if($userInfo != null)
                    @if($userInfo->roles[0]->id == 4 || $userInfo->roles[0]->id == 3 )
                        <option value="1" >Executive</option>
                    @endif

                    @if($userInfo->roles[0]->id == 4 || $userInfo->roles[0]->id == 2 )
                        <option value="2" >Manager</option>
                    @endif

                    @if($userInfo->roles[0]->id == 2)
                        <option value="3" >Millionaire</option>
                    @endif

                    @if($userInfo->roles[0]->id == 8)
                        <option value="5" >VIP PV</option>
                    @endif
                @endif
            </select>
        </div>
    @else
        <div class="form-group">
            <label for="billing_name">Billing Name</label>
            <input class="form-control" text="text" wire:model="billingName">
        </div>
        <div class="form-group">
            <label for="billing_phone">Billing Phone</label>
            <input class="form-control" text="text" wire:model="billingPhone">
        </div>
        <div class="form-group">
            <label for="billing_address">Billing Address</label>
            <input class="form-control" text="text" wire:model="billingAddress">
        </div>
    @endif



    <hr/>
    @if($publicOrder)
        <h6>Wallet Balance: {{ $balance }}</h6>
    @endif
    @if($message != "")
        <span style="color:red;">{{ $message }}</span>
    @endif
    <h6>Order Item</h6>

    <div class="tw-justify-end tw-my-5 tw-space-x-3" style="text-align: right;">
        <button type="button" class="btn btn-success btn-sm" wire:click="addItem()">Add Item</button>
    </div>

    <table class="table">
        <thead>
            <td>Product</td>
            <td>Sales Price</td>
            <td>Millionaire Price</td>
            <td>Manager Price</td>
            <td>Executive Price</td>
            <td>VIP Redeem PV</td>
            <td>Quantity</td>
            @if($orderType == 2)
                <td>Selling Price</td>
                <td>Discount</td>
            @endif
            <td>Sub Total</td>
            <td>Action</td>
        </thead>
        <tbody>
            @foreach($orderItemId as $key => $item)
                <tr>
                    <td>
                        <select class="form-control select2 dynamic{{ $errors->has('user') ? 'is-invalid' : '' }}"
                                wire:model="orderProductVariant.{{$key}}"
                                wire:change="updateProductVariant({{$key}})" required>
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($productVariant as $id => $entry)
                                <option value="{{ $entry->id }}">{{ $entry->sku }} - {{ $entry->color->name }} - {{ $entry->size->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" wire:model="orderPrice4.{{$key}}" >
                    </td>
                    <td>
                        <input class="form-control" wire:model="orderPrice1.{{$key}}" readonly>
                    </td>
                    <td>
                        <input class="form-control" wire:model="orderPrice2.{{$key}}" readonly>
                    </td>
                    <td>
                        <input class="form-control" wire:model="orderPrice3.{{$key}}" readonly>
                    </td>
                    <td>
                        <input class="form-control" wire:model="orderPrice7.{{$key}}" readonly>
                    </td>
                    <td>
                        <input class="form-control" wire:model="orderQuantity.{{$key}}" wire:change="updateQuantity({{$key}})" text="number">
                    </td>
                    @if($orderType == 2)
                        <td>
                            <input class="form-control" wire:model="orderPrice5.{{$key}}" >
                        </td>
                        <td>
                            <input class="form-control" wire:model="orderPrice6.{{$key}}" >
                        </td>
                    @endif
                    <td>
                        <input class="form-control" wire:model="orderSubTotal.{{$key}}" text="number" value="{{ $orderSubTotal[$key] }}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" wire:click="removeItem({{ $item }})">Remove</button>
                    </td>
                </tr>

            @endforeach

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                @if($orderType == 2)
                    <td></td>
                @endif
                <td>
                    <strong>Discount</strong>
                </td>
                <td>
                    {{ $discount }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                @if($orderType == 2)
                    <td></td>
                @endif
                <td>
                    <strong>Total Amount</strong>
                </td>
                <td>
                    {{ $orderTotalAmount }}
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>



    <div class="form-group">
        <button class="btn btn-danger" type="button" wire:click="saveOrder()">
            {{ trans('global.save') }}
        </button>
    </div>
</div>
