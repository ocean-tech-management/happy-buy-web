@extends('landing.app')

@section('content')
    @include('user.user-header')
    <!-- start section -->
    <section class="wow animate__fadeIn">
        <form action="{{ route('user.cart.checkout-redeem') }}" method="post"
              class="container">
            @csrf
            <input type="hidden" value="{{$selected_user_id}}" name="selected_user_id"/>
            <div class="row">
                <div class="col-lg-8 padding-70px-right lg-padding-30px-right md-padding-15px-right">
                    <div class="row">
                        <div class="col-12">
                            <span class="text-extra-dark-gray alt-font text-extra-large">{{ __('user-portal.confirm_order')." ". __('user-portal.redeem') }}</span>
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
                                        <td class="hidden product-price-add-on">{{ $cart->product_variant->price_add_on }}</td>
                                        <td class="product-thumbnail">
                                            <img class="cart-product-image" src="{{$cart->product_variant->photo->url}}" alt="">
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
                                            value3="{{ $cart->product_variant->merchant_president_price }}"
                                            value4="{{ $cart->product_variant->vip_redeem_pv }}">
                                            {{ $cart->product_variant->price }} pv
                                        </td>
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="qty-text">  {{ $cart->quantity }}</div>
                                        </td>
                                        <td class="product-subtotal" data-title="Total">{{ $cart->quantity * $cart->product_variant->vip_redeem_pv}} PV</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 margin-10px-bottom">
                            <label class="text-extra-dark-gray alt-font margin-15px-bottom"> {{ __('user-portal.remark') }}  </label>
                            <div class="row">
                                <div class="col-12 col-md-12 ">
                                    <input class="small-input border-all border-radius-5px" type="text" name="remark" id="otp_code"
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
                                        @else
                                            VIP {{  __('user-portal.point') }}
                                        @endif
                                    </div>
{{--                                    @if(Auth::user()->roles[0]->id == 2)--}}
{{--                                        <div>--}}
{{--                                            {{ __('user-portal.voucher_point') }}--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
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
                                        @else
                                            {{ number_format(getPvBalance($selected_user_id)) }} PV
                                        @endif

                                    </div>
{{--                                    @if(Auth::user()->roles[0]->id == 2)--}}
{{--                                        <div>--}}
{{--                                            {{ number_format(getUserVoucherBalance(Auth::user()->id)) }} PV--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
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
                                            <input id="delivery" type="radio" name="collect_type" class="d-block w-auto margin-10px-right mb-0 shipping-method" value="2"
                                                   checked="checked">
                                            <label class="md-line-height-18px" for="delivery">{{ __('user-portal.shipping') }}</label>
                                        </li>
                                        <li class="d-flex align-items-center md-margin-15px-bottom">
                                            <input id="pick-up" type="radio" name="collect_type" class="d-block w-auto margin-10px-right mb-0 shipping-method" value="1">
                                            <label class="md-line-height-18px" for="pick-up">{{ __('user-portal.pickup') }}</label>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="address">
                                <input type="hidden" name="address_id" id="address-id"/>
                                <td class="" colspan="2">
                                    <div class="row">
                                        <span class="col-8 font-weight-500 text-extra-dark-gray text-left">{{ __('user-portal.shipping_address') }}</span>
                                        <div class="col-4 text-right">
                                            <a class="text-decoration-underline alt-font popup-modal " href="#modal-popup2">{{ __('user-portal.edit') }}</a>
                                        </div>
                                    </div>
                                    @foreach( $addressBooks as $addressBook)
                                        <div class=" d-none {{ ($addressBook->set_default == 1) ? "d-block": "" }} show-address text-left text-md-right" id="show-address-{{$addressBook->id}}"
                                             state="{{$addressBook->state->id}}">
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
                                    @endforeach
                                    <div class=" d-none show-address text-left text-md-right" id="show-address-manual">
                                        <div id="address-name" class="line-height-20px margin-1-rem-bottom ">
                                            <div id="address_manual_name">{{ $addressBook->name }} </div>
                                            <div id="address_manual_phone">{{ $addressBook->phone }}</div>
                                        </div>
                                        <span id="address-lines" class="line-height-20px">
                                            <div id="address_manual_addr1">{{ $addressBook->address_1 }},</div>
                                            <div id="address_manual_addr2">{{ $addressBook->address_2 }}</div>
                                            <div id="address_manual_postcode_city">{{ $addressBook->postcode.", ". $addressBook->city }}</div>
                                            <div id="address_manual_state">{{ $addressBook->state->name}}</div>
                                        </span>
                                    </div>
                                    <div id="modal-popup2"
                                         class="col-11 col-xl-4 col-lg-8 col-md-8 col-sm-9 mx-auto bg-white  modal-popup-main padding-4-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">
                                        <div class="row">
                                            <div class="col-5">
                                                <span class="text-extra-dark-gray text-uppercase alt-font text-extra-large font-weight-600 margin-15px-bottom d-block">Select address</span>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-control" id="address-target" autocomplete="off">
                                                    <option value="" disabled selected> Please select</option>
                                                    @if($selected_user_id != Auth::guard('user')->user()->id)
                                                        <option value="2">My Vip Address Book</option>
                                                    @else
                                                        <option value="1">My Address Book</option>
{{--                                                        <option value="2">My Vip Address Book</option>--}}
                                                    @endif

                                                </select>
                                            </div>
                                            <div class="col-12 d-none" id="my-address-container">
                                                <span class="alt-font text-large margin-15px-bottom d-block">Select my address</span>
                                                <select class="form-control" id="my-adddresses" autocomplete="off">
                                                    <option value="" disabled selected> Select Address</option>
                                                    @foreach( $addressBooks as $addressBook)
                                                        <option addressName="{{ $addressBook->name }}"
                                                                addressPhone="{{ $addressBook->phone }}"
                                                                addressAddr1="{{ $addressBook->address_1 }}"
                                                                addressAddr2="{{ $addressBook->address_2 }}"
                                                                addressPostcode="{{ $addressBook->postcode }}"
                                                                addressCity="{{ $addressBook->city }}"
                                                                addressCountryId="{{ $addressBook->state->country_id }}"
                                                                addressStateId="{{ $addressBook->state->id }}"
                                                        >
                                                            <div class=" d-none {{ ($addressBook->set_default == 1) ? "d-block": "" }} show-address"
                                                                 id="show-address-{{$addressBook->id}}" state="{{$addressBook->state->id}}">
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

                                            <div class="col-12 d-none" id="vip-address-container">
                                                <span class="alt-font text-large  margin-15px-bottom d-block">Select VIP and address</span>
                                                <select class="form-control" id="vips" autocomplete="off">
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
                                                <select class="form-control" id="vips-address" autocomplete="off">
                                                    <option value="" disabled selected> Select VIP Address</option>
                                                </select>
                                            </div>
                                            <div class="row " style="margin-left:auto;;margin-right:auto;">
                                                <div class="col-md-6 margin-10px-bottom">
                                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.contact_name') }} <span
                                                            class="text-radical-red">*</span></label>
                                                    <input class="small-input border-all border-radius-5px" type="text" name="name" id="name" autocomplete="off"
                                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.contact_name')]) }}"
                                                           value="{{ old('name', '') }}">
                                                </div>
                                                <div class="col-md-6 margin-10px-bottom">
                                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.phone_number') }} <span
                                                            class="text-radical-red">*</span></label>
                                                    <input class="small-input border-all border-radius-5px" type="text" name="phone" id="phone" autocomplete="off"
                                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.phone_number')]) }}"
                                                           value="{{ old('phone', '') }}">
                                                </div>
                                                <div class="col-12 margin-10px-bottom">
                                                    <label class="margin-15px-bottom">{{ __('user-portal.address') }} <span
                                                            class="text-radical-red">*</span></label>
                                                    <input class="small-input border-all border-radius-5px" type="text" name="address_1" id="address_1" autocomplete="off"
                                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}"
                                                           value="{{ old('address_1', '') }}">
                                                    <input class="small-input border-all border-radius-5px" type="text" name="address_2" id="address_2" autocomplete="off"
                                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}2"
                                                           value="{{ old('address_1', '') }}">
                                                </div>
                                                <div class="col-md-6 margin-10px-bottom">
                                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.country') }} <span
                                                            class="text-radical-red">*</span></label>
                                                    <select name="country" id="country" class="small-input border-all border-radius-5px" autocomplete="off">
                                                        <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.country')]) }}</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 margin-10px-bottom">
                                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.state') }} <span
                                                            class="text-radical-red">*</span></label>
                                                    <select name="state" id="state" class="small-input border-all border-radius-5px" autocomplete="off">
                                                        <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 margin-10px-bottom">
                                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.postcode') }} <span
                                                            class="text-radical-red">*</span></label>
                                                    <input class="small-input border-all border-radius-5px" type="text" name="postcode" id="postcode" autocomplete="off"
                                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.postcode')]) }}"
                                                           value="{{ old('postcode', '') }}">
                                                </div>
                                                <div class="col-md-6 margin-10px-bottom">
                                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.city') }} <span
                                                            class="text-radical-red">*</span></label>
                                                    <input class="small-input border-all border-radius-5px" type="text" name="city" id="city" autocomplete="off"
                                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.city')]) }}"
                                                           value="{{ old('city', '') }}">
                                                </div>

                                                <div class="col-12 text-center">
                                                    <button onclick="useAddress()" class="btn bg-dark-gold btn-small text-white popup-modal-dismiss" href="#">Use Address
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
{{--                                    <div id="modal-popup"--}}
{{--                                         class="col-11 col-xl-4 col-lg-8 col-md-8 col-sm-9 mx-auto bg-white  modal-popup-main padding-4-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-5">--}}
{{--                                                <span class="text-extra-dark-gray text-uppercase alt-font text-extra-large font-weight-600 margin-15px-bottom d-block">Select address</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-7 text-right">--}}
{{--                                                <a class="text-decoration-underline alt-font popup-modal" href="#modal-popup-manual">Manual Key In </a>--}}
{{--                                                <div id="modal-popup-manual"--}}
{{--                                                     class="col-11 col-xl-4 col-lg-8 col-md-8 col-sm-9 mx-auto bg-white  modal-popup-main padding-4-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-5">--}}
{{--                                                            <a class="text-extra-dark-gray  alt-font margin-15px-bottom d-block popup-modal" href="#modal-popup"><i--}}
{{--                                                                    class="fa fa-arrow-left"></i> Back</a>--}}
{{--                                                            <span class="text-extra-dark-gray text-uppercase alt-font text-extra-large font-weight-600 margin-15px-bottom d-block">Key In address</span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-7 text-right">--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="row " style="margin-left:auto;;margin-right:auto;">--}}
{{--                                                        <div class="col-md-6 margin-10px-bottom">--}}
{{--                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.contact_name') }} <span--}}
{{--                                                                    class="text-radical-red">*</span></label>--}}
{{--                                                            <input class="small-input border-all border-radius-5px" type="text" name="name" id="name"--}}
{{--                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.contact_name')]) }}"--}}
{{--                                                                   value="{{ old('name', '') }}">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 margin-10px-bottom">--}}
{{--                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.phone_number') }} <span--}}
{{--                                                                    class="text-radical-red">*</span></label>--}}
{{--                                                            <input class="small-input border-all border-radius-5px" type="text" name="phone" id="phone"--}}
{{--                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.phone_number')]) }}"--}}
{{--                                                                   value="{{ old('phone', '') }}">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-12 margin-10px-bottom">--}}
{{--                                                            <label class="margin-15px-bottom">{{ __('user-portal.address') }} <span--}}
{{--                                                                    class="text-radical-red">*</span></label>--}}
{{--                                                            <input class="small-input border-all border-radius-5px" type="text" name="address_1" id="address_1"--}}
{{--                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}"--}}
{{--                                                                   value="{{ old('address_1', '') }}">--}}
{{--                                                            <input class="small-input border-all border-radius-5px" type="text" name="address_2" id="address_2"--}}
{{--                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}2"--}}
{{--                                                                   value="{{ old('address_1', '') }}">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 margin-10px-bottom">--}}
{{--                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.country') }} <span--}}
{{--                                                                    class="text-radical-red">*</span></label>--}}
{{--                                                            <select name="country" id="country" class="small-input border-all border-radius-5px">--}}
{{--                                                                <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.country')]) }}</option>--}}
{{--                                                                @foreach($countries as $country)--}}
{{--                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 margin-10px-bottom">--}}
{{--                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.state') }} <span--}}
{{--                                                                    class="text-radical-red">*</span></label>--}}
{{--                                                            <select name="state" id="state" class="small-input border-all border-radius-5px">--}}
{{--                                                                <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>--}}
{{--                                                            </select>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 margin-10px-bottom">--}}
{{--                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.postcode') }} <span--}}
{{--                                                                    class="text-radical-red">*</span></label>--}}
{{--                                                            <input class="small-input border-all border-radius-5px" type="text" name="postcode" id="postcode"--}}
{{--                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.postcode')]) }}"--}}
{{--                                                                   value="{{ old('postcode', '') }}">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 margin-10px-bottom">--}}
{{--                                                            <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.city') }} <span--}}
{{--                                                                    class="text-radical-red">*</span></label>--}}
{{--                                                            <input class="small-input border-all border-radius-5px" type="text" name="city" id="city"--}}
{{--                                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.city')]) }}"--}}
{{--                                                                   value="{{ old('city', '') }}">--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col-12 text-center">--}}
{{--                                                            <button onclick="useAddress()" class="btn bg-dark-gold btn-small text-white popup-modal-dismiss" href="#">Use Address--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="padding-1-rem-all margin-1-half-rem-all" style="max-height:500px; overflow-x: hidden">--}}
{{--                                            @foreach( $addressBooks as $key => $addressBook)--}}
{{--                                                <div--}}
{{--                                                    class="form-group shadow border-radius-5px bg-gray-100 row padding-1-rem-all margin-1-half-rem-bottom {{ $addressBook->set_default == 1? "shadow bg-white" : "" }}">--}}
{{--                                                    <div class="col-1 text-center align-items-center flex">--}}
{{--                                                        <input class="selection-address" type="radio" name="select_address" id="address_{{$key}}" value="{{ $addressBook->id }}"--}}
{{--                                                               shipping_fee="{{ $addressBook->state->shippingFees[0]->price }}"--}}
{{--                                                        />--}}
{{--                                                    </div>--}}
{{--                                                    <label class="col-11" for="address_{{$key}}">--}}
{{--                                                        <div class="line-height-20px">--}}
{{--                                                            <div> {{ $addressBook->name }} </div>--}}
{{--                                                            <div class="margin-1-rem-bottom">{{ $addressBook->phone }} </div>--}}
{{--                                                            {!!  $addressBook->address_1.", ".$addressBook->address_2. ",<br>".--}}
{{--                                                            $addressBook->postcode.", ". $addressBook->city. ", ".$addressBook->state->name--}}
{{--                                                                    !!}--}}
{{--                                                        </div>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                        <div class="col-12 text-center">--}}
{{--                                            <button onclick="selectAddress()" class="btn bg-dark-gold btn-small text-white popup-modal-dismiss" href="#">Select--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </td>
                            </tr>
                            <tr class="pickup-select">
                                <input type="hidden" name="address_id" id="address-id"/>
                                <td class="" colspan="2">
                                    <div class="row">
                                        <span class="col-6 font-weight-500 text-extra-dark-gray">{{ __('user-portal.pickup') }}</span>
                                        <div class="col-6 text-right">
                                            <a class="text-decoration-underline alt-font popup-modal "
                                               href="#modal-select-pickup-location">{{ __('user-portal.select_', ['title' => __('pickup')]) }}</a>

                                            <div id="modal-select-pickup-location"
                                                 class="col-11 col-xl-4 col-lg-8 col-md-8 col-sm-9 mx-auto bg-white  modal-popup-main padding-4-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <span class="text-extra-dark-gray text-uppercase alt-font text-extra-large font-weight-600 margin-15px-bottom d-block">Select pick-up location</span>
                                                    </div>
                                                    <div class="col-7 text-right">

                                                    </div>
                                                </div>
                                                <div class="padding-1-rem-all margin-1-half-rem-all" style="max-height:500px; overflow-x: hidden">
                                                    @foreach( $pickupLocations as $key => $pickupLocation)
                                                        <div
                                                            class="form-group shadow border-radius-5px bg-gray-100 row padding-1-rem-all margin-1-half-rem-bottom ">
                                                            <div class="col-1 text-center align-items-center flex">
                                                                <input class="selection-pickup" type="radio" name="select_pickup" id="pickup_{{$key}}"
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
                                                    <button onclick="selectPickUp()" class="btn bg-dark-gold btn-small text-white popup-modal-dismiss" href="#">Select
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            @foreach( $pickupLocations as $pickupLocation)
                                                <div class=" d-none show-pickuplocation" id="show-pickuplocation-{{$pickupLocation->id}}">
                                                    <div class="line-height-20px margin-1-rem-bottom ">
                                                        <div>{{ $pickupLocation->person_in_charge }} </div>
                                                        <div>{{ $pickupLocation->phone }}</div>
                                                    </div>
                                                    <span class="line-height-20px">
                                                <div class="font-weight-700">{{ $pickupLocation->name }},</div>
                                                <div>{{ $pickupLocation->address }},</div>
                                            </span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-12">
                                            <label for="vips-pickup" class="pt-2 text-extra-dark-gray">Pick Up Person</label>
                                            <select class="form-control" id="vips-pickup" autocomplete="off">
                                                <option value="{{Auth::user()->id}}"> Self Pick Up</option>
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
                            <tr>
                                <th class="w-50 alt-font text-extra-dark-gray">
                                    <div>{{ __('user-portal.product_subtotal') }}</div>
                                    <div id="shipping_text">{{ __('user-portal.shipping') }}</div>
                                </th>
                                <td class="text-extra-dark-gray text-right">
                                    <div id="subtotal"> PV</div>
                                    <div id="shipping"> PV</div>
                                </td>
                            </tr>
                            <tr class="total-amount">
                                <th class="font-weight-500 text-extra-dark-gray">{{ "VIP PV" }} <br> {{ __('user-portal.total') }}</th>
                                <td class="text-right" data-title="Total">
                                    <h6 class="d-block font-weight-500 mb-0 text-extra-dark-gray" id="total_vip_pv"> PV</h6>
                                    <h6 class="d-block font-weight-500 mb-0 text-extra-dark-gray" id="total"> PV</h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <button type="submit"
                                    class="btn btn-large d-block btn-fancy margin-15px-top bg-dark-gold text-white w-100">{{ __('user-portal.confirm_redeem') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- end section -->
@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            $('.popup-modal').magnificPopup({
                type: 'inline',
                preloader: false,
                focus: '#username',
                modal: true
            });
            $(document).on('click', '.popup-modal-dismiss', function (e) {
                e.preventDefault();
                $.magnificPopup.close();
            });
        });
    </script>
    <script>
        var withShipping = true;
        var pickup_location_id = 0;
        var subtotal = 0;
        var shipping_fee = 0;
        var total = 0;
        var total_item_qty = 0;
        var shipping_add_on = 0;
        var max_quantity_b4_shipping_add_on = 0;
        var use_product_add_on = true;

        var wallet_id = 0;

        var addr_id = 0;
        var shipping_method = 0;

        var address_name = "";
        var address_phone = "";
        var address1 = "";
        var address2 = "";
        var country = "";
        var state = "";
        var postcode = "";
        var city = '';

        $(document).ready(function () {
            wallet_id = $('#wallet_id').attr('value');
            console.log("wallet_id" + wallet_id);
            total_item_qty = 0;

            @foreach($carts as $cart)
                total_item_qty += parseInt({{ $cart->quantity }});
            @endforeach


            $('.shipping-method').first().click();

            @foreach( $addressBooks as $addressBook)
            @if($addressBook->set_default == 1)
            $(".selection-address[value='{{ $addressBook->id }}']").click();
            getShippingFee({{ $addressBook->state->id }});
            @endif
            @endforeach

            console.log("state_id: " + addr_id);

            console.log('shippingmethod_click');

            $('#address-target').on('change', function () {
                console.log(this.value);
                if (this.value == 1) {
                    $('#my-address-container').removeClass('d-none');
                    $('#vip-address-container').addClass('d-none');
                    $('#order-user-id').attr('value', {{Auth::user()->id}});
                } else {
                    $('#my-address-container').addClass('d-none');
                    $('#vip-address-container').removeClass('d-none');
                }
            });

            $('#address-target option:eq(1)').prop('selected', 'selected').change();

            $('#my-adddresses').on('change', function () {

                console.log($('option:selected', this).attr('addressName'));

                var selection = $('option:selected', this);

                $('#name').val(selection.attr('addressName'));
                $('#phone').val(selection.attr('addressPhone'));
                $('#address_1').val(selection.attr('addressAddr1'));
                $('#address_2').val(selection.attr('addressAddr2'));
                $('#country option[value="' + selection.attr('addressCountryId') + '"]').attr('selected', 'selected');
                var country_id = selection.attr('addressCountryId');

                var formData = {
                    "_token": "{{ csrf_token() }}",
                    'country_id': country_id,
                };
                var type = "POST";
                var ajaxurl = '{{ route('user.getStates')}}';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        var decoded = JSON.parse(data);
                        if (decoded.success) {
                            var htmlcode = "";
                            htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>';
                            $.each(decoded.states, function (key, value) {
                                htmlcode = htmlcode + ' <option value=' + value.id + '>' + value.name + '</option>';
                            });
                            $('#state').html(htmlcode);

                            $('#state option[value="' + selection.attr('addressStateId') + '"]').attr('selected', 'selected');

                        }
                    },
                    error: function (data) {
                        console.log("Error");
                    }
                });

                $('#postcode').val($('option:selected', this).attr('addressPostcode'));
                $('#city').val($('option:selected', this).attr('addressCity'));


                $('#address_manual_name').html(address_name);
                $('#address_manual_phone').html(address_phone);
                $('#address_manual_addr1').html(address1);
                $('#address_manual_addr2').html(address2);
                $('#address_manual_postcode_city').html(postcode + ", " + city);
                $('#address_manual_state').html(address_name);

            });

            $('#my-adddresses option:eq(1)').prop('selected', 'selected').change();
            useAddress();

            $('#vips').on('change', function () {
                console.log(this.value);
                $('#order-user-id').val(this.value);
                //run ajax retrieve vip address book
                var formData = {
                    "_token": "{{ csrf_token() }}",
                    'user_id': this.value,
                };
                var type = "GET";
                var ajaxurl = '{{ route('user.getAddressBook')}}';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        var decoded = JSON.parse(data);
                        console.log(decoded);
                        if (decoded.success) {
                            var htmlcode = "";
                            htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.address')]) }}</option>';
                            console.log(decoded.address_book);
                            $.each(decoded.address_book, function (key, value) {

                                htmlcode = htmlcode +

                                    '<option addressName="' + value.name + '"' +
                                    ' addressPhone="' + value.phone + '"' +
                                    ' addressAddr1="' + value.address_1 + '"' +
                                    ' addressAddr2="' + value.address_2 + '"' +
                                    ' addressPostcode="' + value.postcode + '"' +
                                    ' addressCity="' + value.city + '"' +
                                    ' addressCountryId="' + value.country_id + '"' +
                                    ' addressStateId="' + value.state_id + '"' +
                                    '>' +
                                    '<div class="show-address" ' +
                                    '  > ' +
                                    '<div id="address-name" class="line-height-20px margin-1-rem-bottom "> ' +
                                    '  <div>' + value.name + ' </div> ' +
                                    '  <div>' + value.phone + ' </div> ' +
                                    ' </div> ' +
                                    ' <span id="address-lines" class="line-height-20px"> ' +
                                    ' <div>' + value.address_1 + ',</div> ' +
                                    ' <div>' + value.address_2 + '</div>' +
                                    ' <div>' + value.postcode + ', ' + value.city + '</div>' +
                                    ' <div>' + value.state_name + '</div>' +
                                    '  </span>' +
                                    '  </div>' +
                                    ' </option>';
                            });
                            $('#vips-address').html(htmlcode);

                            // $('#state option[value="'+ selection.attr('addressStateId') +'"]').attr('selected', 'selected');
                            @if($selected_user_id != Auth::guard('user')->user()->id)
                                $('#vips-address option:eq(1)').prop('selected', 'selected').change();
                            @endif
                        }
                    },
                    error: function (data) {
                        console.log("Error");
                    }
                });
            });

            $('#vips-address').on('change', function () {


                console.log($('option:selected', this).attr('addressName'));

                var selection = $('option:selected', this);

                $('#name').val(selection.attr('addressName'));
                $('#phone').val(selection.attr('addressPhone'));
                $('#address_1').val(selection.attr('addressAddr1'));
                $('#address_2').val(selection.attr('addressAddr2'));
                $('#country option[value="' + selection.attr('addressCountryId') + '"]').attr('selected', 'selected');
                var country_id = selection.attr('addressCountryId');

                var formData = {
                    "_token": "{{ csrf_token() }}",
                    'country_id': country_id,
                };
                var type = "POST";
                var ajaxurl = '{{ route('user.getStates')}}';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        var decoded = JSON.parse(data);
                        if (decoded.success) {
                            var htmlcode = "";
                            htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>';
                            $.each(decoded.states, function (key, value) {
                                htmlcode = htmlcode + ' <option value=' + value.id + '>' + value.name + '</option>';
                            });
                            $('#state').html(htmlcode);

                            $('#state option[value="' + selection.attr('addressStateId') + '"]').attr('selected', 'selected');

                        }
                    },
                    error: function (data) {
                        console.log("Error");
                    }
                });


                console.log("state id " + $('option:selected', this).attr('addressStateId'));
                // $('#state').val( $('option:selected', this).attr('addressName'));
                $('#postcode').val($('option:selected', this).attr('addressPostcode'));
                $('#city').val($('option:selected', this).attr('addressCity'));


                $('#address_manual_name').html(address_name);
                $('#address_manual_phone').html(address_phone);
                $('#address_manual_addr1').html(address1);
                $('#address_manual_addr2').html(address2);
                $('#address_manual_postcode_city').html(postcode + ", " + city);
                $('#address_manual_state').html(address_name);

            });

            @if($selected_user_id != Auth::guard('user')->user()->id)
                $('#vips option:eq(1)').prop('selected', 'selected').change();
            @endif

            $('#vips-pickup').on('change', function () {
                $('#order-user-id').val(this.value);
            });

        });

        function updateLayout() {
            subtotal = 0;
            add_on = 0;
            total_item_qty = 0;
            $.each($('.cart-cart-item'), function (k, v) {
                var quantity = parseInt($('.qty-text').eq(k).html());
                var unit_price = parseFloat($('.product-price').eq(k).attr('value' + wallet_id));
                var unit_subtotal = quantity * unit_price;
                $('.product-price').eq(k).html(addCommas(unit_subtotal) + ' PV');
                $('.product-subtotal').eq(k).html(addCommas(unit_subtotal) + ' PV');
                $('#subtotal').eq(k).html(addCommas(unit_subtotal) + ' PV');
                if (use_product_add_on) {
                    add_on += parseInt($('.product-price-add-on').eq(k).html()) * (quantity);
                }
                total_item_qty += quantity;

                subtotal += unit_subtotal;
            });
            console.log("max_quantity_b4_shipping_add_on: " + max_quantity_b4_shipping_add_on);
            console.log("shipping_fee: " + shipping_fee);
            console.log("total_item_qty: " + total_item_qty);
            console.log("use_product_add_on: " + use_product_add_on);
            if (!use_product_add_on) {
                // console.log("total_item_qty  "+ total_item_qty);
                // console.log("max_quantity_b4_shipping_add_on  "+ max_quantity_b4_shipping_add_on);
                if (total_item_qty > max_quantity_b4_shipping_add_on) {
                    add_on += shipping_add_on * (total_item_qty - max_quantity_b4_shipping_add_on);
                    console.log("add_on  " + add_on);
                } else {
                    add_on += 0;
                }
            } else {
                if (total_item_qty <= max_quantity_b4_shipping_add_on) {
                    add_on = 0;
                }
            }

            if (addr_id == 0) {
                console.log("addr_id == 0");
                $('.show-address').removeClass('d-block');
                $('#show-address-manual').addClass('d-block');
            }

            if (withShipping) {
                sub_shipping_total = shipping_fee + add_on;
                total = subtotal + sub_shipping_total;
                $('#shipping').removeClass('d-none');
                $('#shipping_text').removeClass('d-none');
                $('#shipping').html(addCommas(sub_shipping_total) + ' PV');
                $('#subtotal').html(addCommas(subtotal) + ' PV');
                $('#total_vip_pv').html(addCommas(subtotal) + ' PV')
                $('#total').html(addCommas(sub_shipping_total) + ' PV')
            } else {
                total = subtotal;
                $('#shipping').addClass('d-none');
                $('#shipping_text').addClass('d-none');
                $('#subtotal').html(addCommas(subtotal) + ' PV');
                $('#total_vip_pv').html(addCommas(subtotal) + ' PV')
                $('#total').html(addCommas(0) + ' PV')
            }

        }

        function updateQuantity(cart_id, index, quantity) {
            // console.log("cart_id: " + cart_id);
            // console.log("index: " + index);
            // console.log("quantity: " + quantity);
            if ((quantity != -1 && $('.qty-text').eq(index).html() == 1) || $('.qty-text').eq(index).html() > 1) {
                var final_quantity = parseInt($('.qty-text').eq(index).html()) + quantity;

                var formData = {
                    "_token": "{{ csrf_token() }}",
                    index: index,
                    cart_id: cart_id,
                    quantity: final_quantity,
                };
                var type = "POST";
                var ajaxurl = '{{ route('user.cart.update-quantity')}}';

                // console.log(formData);
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        // console.log(data);
                        var decoded = JSON.parse(data);
                        if (decoded.success) {
                            $('.qty-text').eq(index).val(final_quantity);
                            updateLayout();
                        } else {
                            $('.qty-text').eq(index).val(final_quantity - quantity);
                        }
                    },
                    error: function (data) {
                        $('.qty-text').eq(index).val(final_quantity - quantity);
                        console.log(data);
                    }
                });


            } else if (quantity == -1 && $('.qty-text').eq(index).html() == 1) {
                removeItem(cart_id, index);
            }
        }

        function removeItem(cart_id, index) {
            var r = confirm("Do you want to delete this item?");
            if (r == true) {
                var formData = {
                    "_token": "{{ csrf_token() }}",
                    index: index,
                    cart_id: cart_id,
                    quantity: 0,
                };
                var type = "POST";
                var ajaxurl = '{{ route('user.cart.update-quantity')}}';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        // console.log(data);
                        $('.cart-cart-item').eq(index).remove();
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            } else {
                $('.qty-text').eq(index).val(2);
            }
        }


        $('.selection-address').on('click', function () {
            $('.selection-address').parent().parent().removeClass('shadow');
            $('.selection-address').parent().parent().removeClass('bg-white');
            $(this).parent().parent().addClass('bg-white');
            $(this).parent().parent().addClass('shadow');
            addr_id = $(this).attr('value');
            // console.log('selection-address inside de addr_id: ' + addr_id);
            shipping_fee = parseInt($(this).attr('shipping_fee'));
        });


        $('.selection-pickup').on('click', function () {
            $('.selection-pickup').parent().parent().removeClass('shadow');
            $('.selection-pickup').parent().parent().removeClass('bg-white');
            $(this).parent().parent().addClass('bg-white');
            $(this).parent().parent().addClass('shadow');
            pickup_location_id = $(this).attr('value');
        });
        $('.selection-pickup').first().click();
        $('.show-pickuplocation').removeClass('d-block');
        $('#show-pickuplocation-' + pickup_location_id).addClass('d-block');

        function selectAddress() {
            // console.log('select address: ' + addr_id);
            // console.log('shipping fee: ' + shipping_fee);
            $('.show-address').removeClass('d-block');
            $('#show-address-' + addr_id).addClass('d-block');
            var state = $('#show-address-' + addr_id).attr('state');
            console.log('state' + state);
            getShippingFee(state);
        }

        function selectPickUp() {
            //show-pickup-location
            $('.show-pickuplocation').removeClass('d-block');
            $('#show-pickuplocation-' + pickup_location_id).addClass('d-block');
        }

        function useAddress() {
            address_name = $('#name').val();
            address_phone = $('#phone').val();
            address1 = $('#address_1').val();
            address2 = $('#address_2').val();
            country = $('#country').val();
            state = $('#state').val();
            postcode = $('#postcode').val();
            city = $('#city').val();


            $('#address_manual_name').html(address_name);
            $('#address_manual_phone').html(address_phone);
            $('#address_manual_addr1').html(address1);
            $('#address_manual_addr2').html(address2);
            $('#address_manual_postcode_city').html(postcode + ", " + city);
            $('#address_manual_state').html(address_name);

            $('.selection-address').attr('checked', false);
            $('.selection-address').prop('checked', false);


            // console.log(address_name);
            // console.log(address_phone);
            // console.log(address1);
            // console.log(address2);
            // console.log(country);
            // console.log(state);
            // console.log(postcode);
            // console.log(city);
            addr_id = 0;

            getShippingFee(state);
        }

        function getShippingFee(state) {
            var formData = {
                "_token": "{{ csrf_token() }}",
                'state_id': state,
                'qty': total_item_qty,
            };
            var type = "POST";
            var ajaxurl = '{{ route('user.get-shipping-fee')}}';

            console.log(formData);
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                success: function (data) {
                    console.log(data);
                    var decoded = JSON.parse(data);
                    if (decoded.success) {
                        use_product_add_on = decoded.shipping_fee_add_on == 0 ? true : false;
                        max_quantity_b4_shipping_add_on = decoded.max_quantity;
                        shipping_fee = parseInt(decoded.shipping_fee);
                        shipping_add_on = parseInt(decoded.shipping_fee_add_on);
                        $('#address_manual_state').html(decoded.state_name);
                        updateLayout();
                    }
                },
                error: function (data) {
                    console.log("Error");
                }
            });
        }

        $('.shipping-method').on('click', function () {
            shipping_method = $(this).attr('value');
            console.log(shipping_method);
            if (shipping_method == 1) {
                withShipping = false;
                updateLayout();
                $('.address').addClass('d-none');
                $('.pickup-select').removeClass('d-none');
            } else {
                withShipping = true;
                updateLayout();
                $('.pickup-select').addClass('d-none');
                $('.address').removeClass('d-none');
            }
        });

        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script>

    <script>
        $('#country').change(function () {
            if ($(this).val() !== "") {
                var country_id = $(this).val();

                var formData = {
                    "_token": "{{ csrf_token() }}",
                    'country_id': country_id,
                };
                var type = "POST";
                var ajaxurl = '{{ route('user.getStates')}}';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        var decoded = JSON.parse(data);
                        if (decoded.success) {
                            var htmlcode = "";
                            htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>';
                            $.each(decoded.states, function (key, value) {
                                htmlcode = htmlcode + ' <option value=' + value.id + '>' + value.name + '</option>';
                            });
                            $('#state').html(htmlcode);

                        }
                    },
                    error: function (data) {
                        console.log("Error");
                    }
                });
            }
        });
    </script>


@endsection
