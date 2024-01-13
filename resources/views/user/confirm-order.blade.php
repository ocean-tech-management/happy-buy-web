@extends('landing.app')

@section('content')
    @include('user.user-header')
    <!-- start section -->
    <section class="wow animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 padding-70px-right lg-padding-30px-right md-padding-15px-right">
                    <div class="row">
                        <div class="col-12">
                            <span class="text-extra-dark-gray alt-font text-extra-large">{{ __('user-portal.redeem') }}</span>
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
                                    <th scope="col" class="alt-font"></th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.product') }}</th>
                                    {{--                                    <th scope="col" class="alt-font">{{ __('user-portal.price') }}</th>--}}
                                    <th scope="col" class="alt-font">{{ __('user-portal.quantity') }}</th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.price') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($carts as $cart)
                                    <tr>
                                        <td class="product-remove">
                                            <a href="shopping-cart.html#" class="btn-default text-large">&times;</a>
                                        </td>
                                        <td class="product-thumbnail"><a href="single-product.html"><img class="cart-product-image" src="{{$cart->product->image_1->url}}"
                                                                                                         alt=""></a></td>
                                        <td class="product-name">
                                            <a href="single-product.html">{{ $cart->product->name }}</a>
                                            <span class="variation"> {{$cart->product_variant->color->name." ".$cart->product_variant->size->name}}</span>
                                        </td>
                                        {{--                                        <td class="product-price" data-title="Price">$350.00</td>--}}
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity">
                                                {{ $cart->quantity }}
                                                {{--                                                <label class="screen-reader-text">Quantity</label>--}}
                                                {{--                                                <input type="button" value="-" class="qty-minus qty-btn" data-quantity="minus" data-field="quantity">--}}
                                                {{--                                                <input class="input-text qty-text" type="number" name="quantity" value="1">--}}
                                                {{--                                                <input type="button" value="+" class="qty-plus qty-btn" data-quantity="plus" data-field="quantity">--}}
                                            </div>
                                        </td>
                                        <td class="product-subtotal" data-title="Total">{{$cart->product_variant->price}} PV</td>
                                    </tr>
                                    @php
                                        if(empty($shipping_fee)){$shipping_fee = 0 ;}
                                        if(empty($subtotal)){$subtotal = 0 ;}
                                        if(empty($total)){$total = 0 ;}

                                        $shipping_fee += $cart->product_variant->price_add_on;
                                        $subtotal += $cart->product_variant->price;
                                        $total = $shipping_fee + $subtotal;
                                    @endphp
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{--                        <div class="col-md-6 md-margin-50px-bottom sm-margin-20px-bottom">--}}
                        {{--                            <div class="coupon-code-panel">--}}
                        {{--                                <input type="text" placeholder="Coupon code">--}}
                        {{--                                <a href="shopping-cart.html#" class="btn apply-coupon-btn text-uppercase">Apply</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-md-6 text-center text-md-right md-margin-50px-bottom btn-dual">--}}
                        {{--                            <a href="shopping-cart.html#" class="btn btn-fancy btn-small btn-transparent-light-gray">Empty cart</a>--}}
                        {{--                            <a href="shopping-cart.html#" class="btn btn-fancy btn-small btn-transparent-light-gray mr-0">Update cart</a>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <form action="{{ route('user.cart.checkout') }}" method="post"
                      class="col-lg-4">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                    <div class="bg-light-gray padding-50px-all lg-padding-30px-tb lg-padding-20px-lr md-padding-20px-tb">
                        <span class="alt-font text-extra-large text-extra-dark-gray margin-15px-bottom d-inline-block font-weight-500">Summary</span>
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
                                <th class="w-50 alt-font text-extra-dark-gray">{{ __('user-portal.point_balance') }}</th>
                                <td class="text-extra-dark-gray text-right">{{ getUserPointBalance(Auth::user()->id) }} PV</td>
                            </tr>
                            <tr class="shipping">
                                <th class="font-weight-500 text-extra-dark-gray">Shipping</th>
                                <td data-title="Shipping">
                                    <ul class="float-lg-left float-right text-left line-height-36px">
                                        <li class="d-flex align-items-center md-margin-15px-bottom">
                                            <input id="delivery" type="radio" name="collect_type" class="d-block w-auto margin-10px-right mb-0 shipping-method" value="2"
                                                   checked="checked">
                                            <label class="md-line-height-18px" for="delivery">Delivery</label>
                                        </li>
                                        <li class="d-flex align-items-center md-margin-15px-bottom">
                                            <input id="pick-up" type="radio" name="collect_type" class="d-block w-auto margin-10px-right mb-0 shipping-method" value="1">
                                            <label class="md-line-height-18px" for="pick-up">Pick Up</label>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="address">
                                <input type="hidden" name="address_id" id="address-id"/>
                                <td class="" colspan="2">
                                    <div class="row">
                                        <span class="col-8 font-weight-500 text-extra-dark-gray">Shipping Address</span>
                                        <div class="col-4 text-right">
                                            <a class="text-decoration-underline alt-font modal-popup " href="#modal-popup">Edit</a>
                                        </div>
                                    </div>
                                    @foreach( $addressBooks as $addressBook)
                                        {{  dd($addressBook->state->shippingFees[0]->price); }}
                                        <div class=" d-none {{ ($addressBook->set_default == 1) ? "d-block": "" }} show-address" id="show-address-{{$addressBook->id}}">
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
                                    <div id="modal-popup"
                                         class="col-11 col-xl-4 col-lg-8 col-md-8 col-sm-9 mx-auto bg-white  modal-popup-main padding-4-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">
                                        <span class="text-extra-dark-gray text-uppercase alt-font text-extra-large font-weight-600 margin-15px-bottom d-block">Select address</span>
                                        <div class="padding-1-rem-all margin-1-half-rem-all" style="max-height:500px; overflow-x: hidden">
                                            @foreach( $addressBooks as $key => $addressBook)
                                                <div
                                                    class="form-group shadow border-radius-5px bg-gray-100 row padding-1-rem-all margin-1-half-rem-bottom {{ $addressBook->set_default == 1? "shadow bg-white" : "" }}">
                                                    <div class="col-1 text-center align-items-center flex">
                                                        <input class="selection-address" type="radio" name="select_address" id="address_{{$key}}" value="{{ $addressBook->id }}"/>
                                                    </div>
                                                    <label class="col-11" for="address_{{$key}}">
                                                        <div class="line-height-20px">
                                                            <div> {{ $addressBook->name }} </div>
                                                            <div class="margin-1-rem-bottom">{{ $addressBook->phone }} </div>
                                                            {!!  $addressBook->address_1.", ".$addressBook->address_2. ",<br>".
                                                            $addressBook->postcode.", ". $addressBook->city. ", ".$addressBook->state
                                                                    !!}
                                                        </div>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-12 text-center">
                                            <button onclick="selectAddress()" class="btn bg-dark-gold btn-small text-white popup-modal-dismiss" href="#">Select
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-50 alt-font text-extra-dark-gray">
                                    <span>Shipping Fee</span> <br>
                                    <span>Product Subtotal</span>
                                </th>
                                <td class="text-extra-dark-gray text-right">
                                    <span>{{ number_format($shipping_fee) }} PV</span><br>
                                    <span>{{ number_format($subtotal) }} PV</span>
                                </td>
                            </tr>
                            <tr class="total-amount">
                                <th class="font-weight-500 text-extra-dark-gray">Total</th>
                                <td class="text-right" data-title="Total">
                                    <h6 class="d-block font-weight-500 mb-0 text-extra-dark-gray">{{ number_format($total) }} PV</h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <button type="submit" class="btn btn-large d-block btn-fancy margin-15px-top bg-dark-gold text-white">Proceed to checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- end section -->
@endsection

@section('js')
    <script>
        var addr_id = 0;
        var shipping_method = 0;
        $('.selection-address').on('click', function () {
            $('.selection-address').parent().parent().removeClass('shadow');
            $('.selection-address').parent().parent().removeClass('bg-white');
            $(this).parent().parent().addClass('bg-white');
            $(this).parent().parent().addClass('shadow');
            addr_id = $(this).attr('value');
        });
        $('.selection-address').first().click();

        function selectAddress() {
            console.log('select address: ' + addr_id);
            $('.show-address').removeClass('d-block');
            $('#show-address-' + addr_id).addClass('d-block');
        }

        $('.shipping-method').on('click', function () {
            shipping_method = $(this).attr('value');
            console.log(shipping_method);
            if (shipping_method == 1) {
                $('.address').addClass('d-none');
            } else {
                $('.address').removeClass('d-none');
            }
        });
        $('.shipping-method').first().click();
    </script>


@endsection
