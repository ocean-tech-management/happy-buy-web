<div>
    <style>
        .modal {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1050;
            display: none;
            overflow: hidden;
            outline: 0;
        }
    </style>
    <section class="wow animate__fadeIn">
        <form wire:submit.prevent="checkOut" method="post" {{--  action="{{ route('user.cart.checkout') }}" --}}
        class="container">
            @csrf
            <input type="hidden" value="{{$selected_user_id}}" name="selected_user_id"/>
            <div class="row">
                <div class="col-lg-8 padding-70px-right lg-padding-30px-right md-padding-15px-right">
                    <div class="row">
                        <div class="col-12">
                            <span class="text-extra-dark-gray alt-font text-extra-large">{{ __('user-portal.confirm_order') }}</span>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-12">
                            <table class="table cart-products margin-60px-bottom md-margin-40px-bottom sm-no-margin-bottom">
                                <thead>
                                <tr>
                                    <th scope="col" class="alt-font"></th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.product') }}</th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.price') }}</th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.quantity') }}</th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.price') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $key => $cart)
                                    <tr class="cart-cart-item">
                                        @if($cart->product_variant != NULL && $cart->is_package == 2)
                                            <td class="hidden product-price-add-on">{{ $cart->product_variant->price_add_on }}</td>
                                            <td class="hidden product-variant-id">{{ $cart->product_variant->id }}</td>
                                            <td class="hidden product-id">{{ $cart->product->id }}</td>
                                            <td class="hidden product-category-id">{{ $cart->product->category_id }}</td>
                                            <td class="product-thumbnail">
                                                @if($cart->product_variant->photo != NULL)
                                                    <img class="cart-product-image" src="{{$cart->product_variant->photo->url}}" alt="">
                                                @endif

                                            </td>
                                            <td class="product-name">
                                                {{ $cart->product->name }}
                                                <div>
                                                    <ul class="alt-font shop-color">
                                                        <li>
                                                            <input class="d-none disabled" type="radio"
                                                                   name="color"/>
                                                            <label title="{{$cart->product_variant->color->name}}"><span
                                                                    style="background-color: {{ $cart->product_variant->color->color }};border: 2px solid #ddd;"></span></label>
                                                        </li>
                                                    </ul>
                                                    <span>{{$cart->product_variant->color->name." ".$cart->product_variant->size->name}}</span>
                                                </div>
                                            </td>
                                            <td class="product-price" data-title="Price"
                                                value1="{{ $cart->product_variant->agent_executive_price }}"
                                                value2="{{ $cart->product_variant->agent_director_price }}"
                                                value3="{{ $cart->product_variant->merchant_president_price }}">
                                                {{ $cart->product_variant->price }} pv
                                            </td>
                                            <td class="product-quantity" data-title="Quantity">
                                                <div class="qty-text">  {{ $cart->quantity }}</div>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">{{ $cart->quantity * $cart->product_variant->price}} PV</td>
                                        @elseif($cart->product_variant == NULL)
                                            <td class="product-thumbnail">
                                                @if($cart->product->photo != NULL)
                                                    <img class="cart-product-image" src="{{$cart->product->photo->url}}" alt="">
                                                @endif
                                            </td>
                                            <td class="product-name">
                                                {{ $cart->product->name }} {{ $cart->product->parent_product->name_en }}
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                                @php
                                                    $sub_total = 0 ;
                                                @endphp
                                                @foreach($cart->package_item as $item)
                                                    @php
                                                        if($wallet_id == 1){
                                                            $sub_total += $item->product_variant->agent_executive_price;
                                                        }else if($wallet_id == 2){
                                                            $sub_total += $item->product_variant->agent_director_price;
                                                        }else if($wallet_id == 3){
                                                            $sub_total += $item->product_variant->merchant_president_price;
                                                        }

                                                    @endphp
                                                @endforeach
                                                {{ (count($cart->package_item) == 0) ? 0: number_format($sub_total) }} PV

                                            </td>
                                            <td class="product-quantity" data-title="Quantity">
                                                {{ count($cart->package_item) }}
                                            </td>
                                            <td></td>
                                            <tr>
                                        <td colspan="6">
                                            @forelse($cart->package_item as $item)
                                                {{ $item->product->name_en }} -
                                                {{ $item->product_variant->color->name }} -
                                                {{ $item->product_variant->size->name }} -
                                                @if($wallet_id == 1)
                                                    {{ $item->product_variant->agent_executive_price }} PV
                                                @elseif($wallet_id == 2)
                                                    {{ $item->product_variant->agent_director_price }} PV
                                                @else
                                                    {{ $item->product_variant->merchant_president_price }} PV
                                                @endif

                                                <br/>
                                            @empty
                                            @endforelse
                                        </td>
                                    </tr>
                                        @endif

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 margin-10px-bottom">
                            <label class="text-extra-dark-gray alt-font margin-15px-bottom"> {{ __('user-portal.remark') }}  </label>
                            <div class="row">
                                <div class="col-12 col-md-12 ">
                                    <input class="small-input border-all border-radius-5px" wire:model="remark" type="text" name="remark" id="otp_code"
                                           placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.remark')]) }}">
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                    <input type="hidden" name="order_user_id" id="order-user-id" value="{{Auth::user()->id}}"/>
                    <input type="hidden" name="wallet_id" id="wallet_id" value="{{ $wallet_id }}"/>
                    <div class="bg-light-gray padding-50px-all lg-padding-30px-tb lg-padding-20px-lr md-padding-20px-tb">
                        <span class="alt-font text-extra-large text-extra-dark-gray margin-15px-bottom d-inline-block font-weight-500">{{ __('user-portal.checkout') }}</span>
                        <table class="w-100 total-price-table ">
                            <tbody>
                            @if ($errors->any())
                                <div class=" margin-5px-bottom">
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <tr>
                                <th class="w-50 alt-font text-extra-dark-gray">
                                    <div>
                                        @if($wallet_id == 1)
                                            {{ __('user-portal.executive_point') }}
                                        @elseif($wallet_id == 2)
                                            {{ __('user-portal.manager_point') }}
                                        @elseif($wallet_id == 3)
                                            {{ __('user-portal.point') }}
                                        @endif
                                    </div>
                                    @if(Auth::user()->roles[0]->id == 2)
                                        <div>
                                            {{ __('user-portal.voucher_point') }}
                                        </div>
                                    @endif
                                    <div>
                                        {{ __('user-portal.shipping_points') }}
                                    </div>
                                </th>
                                <td class="text-extra-dark-gray text-right">
                                    <div>
                                        @if($wallet_id == 1)
                                            {{ number_format(getUserExecutivePointBalance(Auth::user()->id)) }} PV
                                        @elseif($wallet_id == 2)
                                            {{ number_format(getUserManagerPointBalance(Auth::user()->id)) }} PV
                                        @elseif($wallet_id == 3)
                                            {{ number_format(getUserPointBalance(Auth::user()->id)) }} PV
                                        @endif

                                    </div>
                                    @if(Auth::user()->roles[0]->id == 2)
                                        <div>
                                            {{ number_format(getUserVoucherBalance(Auth::user()->id)) }} PV
                                        </div>
                                    @endif
                                    <div>
                                        {{ number_format(getUserShippingBalance(Auth::user()->id)) }} PV
                                    </div>
                                </td>
                            </tr>
                            <tr class="shipping">
                                <th class="font-weight-500 text-extra-dark-gray">{{ __('user-portal.shipping_method') }}</th>
                                <td data-title="Shipping">
                                    <ul class="float-lg-left float-right text-left line-height-36px">
                                        <li class="d-flex align-items-center md-margin-15px-bottom">
                                            <input wire:model="shipping_method" wire:change="onShippingMethodSelect" id="delivery" type="radio" name="collect_type"
                                                   class="d-block w-auto margin-10px-right mb-0 shipping-method" value="2"
                                                   checked="checked">
                                            <label class="md-line-height-18px" for="delivery">{{ __('user-portal.shipping') }}</label>
                                        </li>
                                        <li class="d-flex align-items-center md-margin-15px-bottom">
                                            <input wire:model="shipping_method" wire:change="onShippingMethodSelect" id="pick-up" type="radio" name="collect_type"
                                                   class="d-block w-auto margin-10px-right mb-0 shipping-method" value="1">
                                            <label class="md-line-height-18px" for="pick-up">{{ __('user-portal.pickup') }}</label>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @if($shipping_method == 2)
                                <tr class="address">
                                    <input type="hidden" name="address_id" id="address-id"/>
                                    <td class="" colspan="2">
                                        <div class="row">
                                            <span class="col-8 font-weight-500 text-extra-dark-gray text-left">{{ __('user-portal.shipping_address') }}</span>
                                            <div class="col-4 text-right">
                                                <a class="text-decoration-underline alt-font" data-toggle="modal" data-target="#modal-popup2">{{ __('user-portal.edit') }}</a>
                                            </div>
                                        </div>
                                        <div class="show-address text-left text-md-right">
                                            <div id="address-name" class="line-height-20px margin-1-rem-bottom ">
                                                <div>{{ $address_name }} </div>
                                                <div>{{ $address_phone }}</div>
                                            </div>
                                            <span id="address-lines" class="line-height-20px">
                                                <div>{{ $address1 }},</div>
                                                <div>{{ $address2 }}</div>
                                                <div>{{ $postcode.", ". $city }}</div>
                                                <div>{{ $state->name }}</div>
                                            </span>
                                        </div>
                                        <div wire:ignore.self id="modal-popup2" class="modal sx-padding-4-half-rem-all">
                                            <div
                                                class="modal-content col-11 col-xl-4 col-lg-8 col-md-8 col-sm-9 mx-auto  padding-4-half-rem-all  bg-white border-radius-6px sm-padding-2-half-rem-lr">
                                                <div class="row" style="text-align:left;">
                                                    <div class="col-5">
                                                        <span class="text-extra-dark-gray text-uppercase alt-font text-extra-large font-weight-600 margin-15px-bottom d-block">Select address</span>
                                                    </div>
                                                    <div class="col-12">
                                                        <select wire:model.lazy="address_target" class="form-control" id="address-target" autocomplete="off">
                                                            <option value="" disabled selected> Please select</option>
                                                            @if($selected_user_id != Auth::guard('user')->user()->id)
                                                                <option value="2" wire:key="2">My Vip Address Book</option>
                                                            @else
                                                                <option value="1" wire:key="1">My Address Book</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    @if($address_target == 1)
                                                        <div class="col-12" id="my-address-container">
                                                            <span class="alt-font text-large margin-15px-bottom d-block">Select my address</span>
                                                            <select wire:model="my_address_target" class="form-control" id="my-adddresses" autocomplete="off">
                                                                <option value="" disabled selected>Select Address</option>
                                                                @foreach($addressBooks as $addressBook)
                                                                    <option wire:key="{{ $addressBook->id }}" value="{{ $addressBook->id }}">
                                                                        <div class="show-address">
                                                                            <div id="address-name" class="line-height-20px margin-1-rem-bottom ">
                                                                                <div>{{ $addressBook->name }} </div>
                                                                                <div>{{ $addressBook->phone }}</div>
                                                                            </div>
                                                                            <span id="address-lines" class="line-height-20px">
                                                                <div>{{ $addressBook->address_1 }},</div>
                                                                <div>{{ $addressBook->address_2 }}</div>
                                                                <div>{{ $addressBook->postcode.", ". $addressBook->city }}</div>
                                                                <div>{{ $addressBook->state->name}}</div>
                                                            </span>
                                                                        </div>
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                        <div class="col-12" id="vip-address-container">
                                                            <span class="alt-font text-large  margin-15px-bottom d-block">Select VIP and address</span>
                                                            <select wire:model="vip_select_vip_address_target" class="form-control" id="vips" autocomplete="off">
                                                                <option value="" disabled selected> Select VIP</option>
                                                                @if($selected_user_id != Auth::guard('user')->user()->id)
                                                                    @foreach($my_vips as $vip)
                                                                        @if($vip->id == $selected_user_id )
                                                                            <option value="{{$vip->id }}"> {{$vip->name}} - {{$vip->email}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    @foreach($my_vips as $vip)
                                                                        <option value="{{$vip->id }}"> {{$vip->name}} - {{$vip->email}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <select wire:model="vip_address_target" class="form-control" id="vips-address" autocomplete="off">
                                                                <option value="" disabled selected> Select VIP Address</option>
                                                                @foreach($addressBooks as $addressBook)
                                                                    <option wire:key="{{ $addressBook->id }}" value="{{ $addressBook->id }}">
                                                                        <div class="show-address">
                                                                            <div id="address-name" class="line-height-20px margin-1-rem-bottom ">
                                                                                <div>{{ $addressBook->name }} </div>
                                                                                <div>{{ $addressBook->phone }}</div>
                                                                            </div>
                                                                            <span id="address-lines" class="line-height-20px">
                                                                <div>{{ $addressBook->address_1 }},</div>
                                                                <div>{{ $addressBook->address_2 }}</div>
                                                                <div>{{ $addressBook->postcode.", ". $addressBook->city }}</div>
                                                                <div>{{ $addressBook->state->name}}</div>
                                                            </span>
                                                                        </div>
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif

                                                    <div class="row" style="margin-left:auto;;margin-right:auto;">
                                                        <div class="col-md-6 margin-10px-bottom">
                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.contact_name') }} <span
                                                                    class="text-radical-red">*</span></label>
                                                            <input wire:model="address_name" class="small-input border-all border-radius-5px" type="text" name="name" id="name"
                                                                   autocomplete="off"
                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.contact_name')]) }}"
                                                                   value="{{ $address_name }}">
                                                        </div>
                                                        <div class="col-md-6 margin-10px-bottom">
                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.phone_number') }} <span
                                                                    class="text-radical-red">*</span></label>
                                                            <input wire:model="address_phone" class="small-input border-all border-radius-5px" type="text" name="phone" id="phone"
                                                                   autocomplete="off"
                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.phone_number')]) }}"
                                                                   value="{{ $address_phone }}">
                                                        </div>
                                                        <div class="col-12 margin-10px-bottom">
                                                            <label class="margin-15px-bottom">{{ __('user-portal.address') }} <span
                                                                    class="text-radical-red">*</span></label>
                                                            <input wire:model="address1" class="small-input border-all border-radius-5px" type="text" name="address_1"
                                                                   id="address_1"
                                                                   autocomplete="off"
                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}"
                                                                   value="{{ $address1 }}">
                                                            <input wire:model="address2" class="small-input border-all border-radius-5px" type="text" name="address_2"
                                                                   id="address_2"
                                                                   autocomplete="off"
                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}2"
                                                                   value="{{ $address2 }}">
                                                        </div>
                                                        <div class="col-md-6 margin-10px-bottom">
                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.country') }} <span
                                                                    class="text-radical-red">*</span></label>
                                                            <select wire:model="country_id" wire:change="onCountryChange" name="country"
                                                                    class="small-input border-all border-radius-5px"
                                                                    autocomplete="off">
                                                                <option value="" disabled selected>{{ __('user-portal.select_' , ['title'=> __('user-portal.country')]) }}</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 margin-10px-bottom">
                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.state') }} <span
                                                                    class="text-radical-red">*</span></label>
                                                            <select wire:model="state_id" wire:change="onStateChange" name="state" class="small-input border-all border-radius-5px"
                                                                    autocomplete="off">
                                                                <option value="" disabled selected>{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>
                                                                @foreach($states as $state)
                                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 margin-10px-bottom">
                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.postcode') }} <span
                                                                    class="text-radical-red">*</span></label>
                                                            <input wire:model="postcode" class="small-input border-all border-radius-5px" type="text" name="postcode" id="postcode"
                                                                   autocomplete="off"
                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.postcode')]) }}"
                                                                   value="{{ $postcode }}">
                                                        </div>
                                                        <div class="col-md-6 margin-10px-bottom">
                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.city') }} <span
                                                                    class="text-radical-red">*</span></label>
                                                            <input wire:model="city" class="small-input border-all border-radius-5px" type="text" name="city" id="city"
                                                                   autocomplete="off"
                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.city')]) }}"
                                                                   value="{{ $city }}">
                                                        </div>

                                                        <div class="col-12 text-center">
                                                            <button wire:click="useAddress" data-dismiss="modal" class="btn bg-dark-gold btn-small text-white popup-modal-dismiss"
                                                                    href="#">Use Address
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr class="pickup-select">
                                    <input type="hidden" name="address_id" id="address-id"/>
                                    <td class="" colspan="2">
                                        <div class="row">
                                            <span class="col-6 font-weight-500 text-extra-dark-gray">{{ __('user-portal.pickup') }}</span>
                                            <div class="col-6 text-right">
                                                <a class="text-decoration-underline alt-font" data-toggle="modal"
                                                   data-target="#modal-select-pickup-location">{{ __('user-portal.select_', ['title' => __('pickup')]) }}</a>
                                                <div wire:ignore.self id="modal-select-pickup-location" class="modal sx-padding-4-half-rem-all">
                                                    <div
                                                        class="modal-content col-11 col-xl-4 col-lg-8 col-md-8 col-sm-9 mx-auto  padding-4-half-rem-all  bg-white border-radius-6px sm-padding-2-half-rem-lr">
                                                        <div class="row text-left">
                                                            <div class="col-5">
                                                                <span
                                                                    class="text-extra-dark-gray text-uppercase alt-font text-extra-large font-weight-600 margin-15px-bottom d-block">Select pick-up location</span>
                                                            </div>
                                                            <div class="col-7 text-right">

                                                            </div>
                                                        </div>
                                                        <div class="padding-1-rem-all margin-1-half-rem-all text-left" style="max-height:500px; overflow-x: hidden">
                                                            @foreach( $pickupLocations as $key => $pickupLocation)
                                                                <div
                                                                    class="form-group shadow border-radius-5px bg-gray-100 row padding-1-rem-all margin-1-half-rem-bottom ">
                                                                    <div class="col-1 text-center align-items-center flex">
                                                                        <input wire:model="pickupLocation_id" class="selection-pickup" type="radio" name="select_pickup"
                                                                               id="pickup_{{$key}}"
                                                                               value="{{ $pickupLocation->id }}"/>
                                                                    </div>
                                                                    <label class="col-11" for="pickup_{{$key}}">
                                                                        <div class="line-height-20px">
                                                                            <div> {{ $pickupLocation->person_in_charge }} </div>
                                                                            <div> {{ $pickupLocation->phone }} </div>
                                                                            <br>
                                                                            <div class="font-weight-700"> {{ $pickupLocation->name }} </div>
                                                                            {!!  $pickupLocation->address !!}
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-12 text-center">
                                                            <button class="btn bg-dark-gold btn-small text-white popup-modal-dismiss" data-dismiss="modal">Select
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                @foreach( $pickupLocations as $pickupLocation)
                                                    @if(!empty($pickupLocation_id))
                                                        @if($pickupLocation->id == $pickupLocation_id)
                                                            <div class="" id="show-pickuplocation-{{$pickupLocation->id}}">
                                                                <div class="line-height-20px margin-1-rem-bottom ">
                                                                    <div>{{ $pickupLocation->person_in_charge }} </div>
                                                                    <div>{{ $pickupLocation->phone }}</div>
                                                                </div>
                                                                <span class="line-height-20px">
                                                                    <div class="font-weight-700">{{ $pickupLocation->name }},</div>
                                                                    <div>{{ $pickupLocation->address }},</div>
                                                                </span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="col-12">
                                                <label for="vips-pickup" class="pt-2 text-extra-dark-gray">Pick Up Person </label>
                                                <select wire:model="vips_pickup" class="form-control" id="vips-pickup" autocomplete="off">
                                                    <option value="{{Auth::user()->id}}">Self Pick Up</option>
                                                    @foreach($my_vips as $vip)
                                                        @if($selected_user_id == $vip->id)
                                                            <option value="{{$vip->id }}"> {{$vip->name}} - {{$vip->email}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endif


                            <tr>
                                <th class="w-50 alt-font text-extra-dark-gray">
                                    <div>{{ __('user-portal.product_subtotal') }}</div>
                                    <div id="shipping_text">{{ __('user-portal.shipping') }}</div>
                                </th>
                                <td class="text-extra-dark-gray text-right">
                                    <div id="subtotal"> {{ $product_subtotal }} PV</div>
                                    <div id="shipping"> {{ $shipping_fee }} PV</div>
                                </td>
                            </tr>
                            <tr class="total-amount">
                                <th class="font-weight-500 text-extra-dark-gray">{{ __('user-portal.total') }}</th>
                                <td class="text-right" data-title="Total">
                                    <h6 class="d-block font-weight-500 mb-0 text-extra-dark-gray" id="total"> {{ $total_price }} PV</h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <button type="submit"
                                    class="btn btn-large d-block btn-fancy margin-15px-top bg-dark-gold text-white w-100">{{ __('global.confirm') }} {{ __('user-portal.checkout') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script>
        document.addEventListener('livewire:load', function () {
            $('.shipping-method').first().click();
        });

    </script>
</div>
