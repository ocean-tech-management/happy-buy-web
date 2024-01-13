@extends('landing.app')

@section('css')

@endsection

@section('content')
    @include('user.user-header')
    <!-- start section -->
    <section class="wow animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 padding-70px-right lg-padding-30px-right md-padding-15px-right">
                    <div class="row">
                        <div class="col-12">
                            <span class="text-extra-dark-gray alt-font text-extra-large">{{ __('user-portal.redeem') }} {{ __('user-portal.cart') }}</span>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>

                    <div>
                        <label class="text-extra-dark-gray alt-font margin-15px-bottom">
                            {{ __('user-portal.select_', ['title' => __('user-portal.cart')]) }} <span
                                class="text-radical-red">*</span></label>
                        <select class="form-control" id="select-cart-user" autocomplete="off" onchange="window.location.href=this.options[this.selectedIndex].value;">
                            @foreach($my_vips as $vip)
                                <option value="{{ route('user.redeem-cart' , ['vip_id'=>$vip->id]) }}" {{ $selected_user_id==$vip->id? "selected": ""  }}> {{$vip->name}}
                                    - {{$vip->email}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="row align-items-center">
                        <div class="col-12">
                            <table class="table cart-products margin-60px-bottom md-margin-40px-bottom sm-no-margin-bottom">
                                <thead>
                                <tr>
                                    <th scope="col" class="alt-font"></th>
                                    <th scope="col" class="alt-font"></th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.product') }}</th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.price') }}</th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.quantity') }}</th>
                                    <th scope="col" class="alt-font">{{ __('user-portal.price') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(sizeof($carts) > 0)
                                    @foreach($carts as $key => $cart)
                                        <tr class="cart-cart-item">
                                            <td class="product-remove">
                                                <button onclick="removeItem('{{ $cart->id }}', {{ $key }})"
                                                        class="btn text-large {{ $cart->product->status == 1 ? "" : "invisible" }}">
                                                    &times;
                                                </button>
                                            </td>
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
                                                value4="{{ $cart->product_variant->vip_redeem_pv }}">{{ number_format($cart->product_variant->vip_redeem_pv) }}
                                                pts
                                            </td>
                                            <td class="product-quantity" data-title="Quantity">
                                                {{--                                            <div class="quantity">--}}
                                                {{--                                                <label class="screen-reader-text">Quantity</label>--}}
                                                {{--                                                <input type="button" value="-" class="qty-minus qty-btn bg-white" data-quantity="minus" data-field="quantity"--}}
                                                {{--                                                       onclick="updateQuantity({{$cart->id}},{{$key}}, -1)">--}}
                                                {{--                                                <input class="input-text qty-text" type="number" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" disabled>--}}
                                                {{--                                                <input type="button" value="+" class="qty-plus qty-btn bg-white" data-quantity="plus" data-field="quantity"--}}
                                                {{--                                                       onclick="updateQuantity({{$cart->id}},{{$key}}, +1)">--}}
                                                {{--                                            </div>--}}

                                                <div class="quantity text-right" style="display: inline-block;">
                                                    <label class="screen-reader-text">Quantity</label>
                                                    <div class="row">
                                                        <input type="button" value="-" class="col-2 col-md-3 bg-white {{ $cart->product->status == 1 ? "" : "invisible" }}"
                                                               data-quantity="minus" data-field="quantity" style="padding: 10px 20px 10px 15px; border-radius: 0px"
                                                               onclick="updateQuantity({{$cart->id}},{{$key}}, -1)">

                                                        <input class="input-text qty-text col-5 col-md-4 text-extra-dark-gray" type="number" name="quantity"
                                                               value="{{ $cart->quantity }}" autocomplete="off" style="padding-right:0px" disabled>

                                                        <input type="button" value="+" class="col-2 col-md-3 bg-white {{ $cart->product->status == 1 ? "" : "invisible" }}"
                                                               data-quantity="plus" data-field="quantity" style="padding: 10px 20px 10px 12px;border-radius: 0px"
                                                               @if($cart->product->status == 1) onclick="updateQuantity({{$cart->id}},{{$key}}, +1)" @endif>
                                                    </div>

                                                </div>
                                            </td>

                                            <td class="product-subtotal" data-title="Total">{{ number_format($cart->quantity * $cart->product_variant->price) }} PV</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr style="padding-left:10px;">
                                        <td colspan="6" style="float:left">
                                            <div>
                                                <p> Your cart is empty</p>
                                            </div>
                                        </td>

                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-light-gray padding-50px-all lg-padding-30px-tb lg-padding-20px-lr md-padding-20px-tb">
                        <span class="alt-font text-extra-large text-extra-dark-gray margin-15px-bottom d-inline-block font-weight-500">{{ __('user-portal.redeem') }}</span>
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
                                <td colspan="2" class="text-extra-dark-gray text-left">
                                    Redeem with VIP PV
                                    <ul class="col-12 line-height-36px">
                                        <li class="d-flex align-items-center margin-15px-bottom">
                                            <input id="wallet1" type="radio" name="wallet" class="d-block w-auto margin-10px-right mb-0 wallet-select" value="4" checked>
                                            <label class="line-height-18px" for="wallet1">
                                                <div>VIP Point</div>{{number_format(getPvBalance($selected_user_id))}} PV</label>
                                        </li>
                                        {{--                                        @if(Auth::user()->roles[0]->id == 3)--}}
                                        {{--                                            <li class="d-flex align-items-center margin-15px-bottom">--}}
                                        {{--                                                <input id="wallet1" type="radio" name="wallet" class="d-block w-auto margin-10px-right mb-0 wallet-select" value="1" checked>--}}
                                        {{--                                                <label class="line-height-18px" for="wallet1">--}}
                                        {{--                                                    <div>Exxcutive Point</div>{{number_format(getUserExecutivePointBalance(Auth::user()->id))}} PV</label>--}}
                                        {{--                                            </li>--}}
                                        {{--                                        @endif--}}
                                        {{--                                        @if(Auth::user()->roles[0]->id == 4)--}}
                                        {{--                                            @if(getUserExecutivePointBalance(Auth::user()->id) != 0)--}}
                                        {{--                                                <li class="d-flex align-items-center margin-15px-bottom">--}}
                                        {{--                                                    <input id="wallet1" type="radio" name="wallet" class="d-block w-auto margin-10px-right mb-0 wallet-select" value="1"--}}
                                        {{--                                                           checked>--}}
                                        {{--                                                    <label class="line-height-18px" for="wallet1">--}}
                                        {{--                                                        <div>Exxcutive Point</div>{{number_format(getUserExecutivePointBalance(Auth::user()->id))}} PV</label>--}}
                                        {{--                                                </li>--}}
                                        {{--                                            @endif--}}
                                        {{--                                            <li class="d-flex align-items-center margin-15px-bottom ">--}}
                                        {{--                                                <input id="wallet2" type="radio" name="wallet" class="d-block w-auto margin-10px-right mb-0 wallet-select" value="2">--}}
                                        {{--                                                <label class="line-height-18px" for="wallet2">--}}
                                        {{--                                                    <div>Manager Point</div>{{number_format(getUserManagerPointBalance(Auth::user()->id))}} PV</label>--}}
                                        {{--                                            </li>--}}

                                        {{--                                        @endif--}}
                                        {{--                                        @if(Auth::user()->roles[0]->id == 2)--}}
                                        {{--                                            @if(getUserManagerPointBalance(Auth::user()->id) == 0 && getUserExecutivePointBalance(Auth::user()->id) == 0)--}}
                                        {{--                                            @elseif( getUserManagerPointBalance(Auth::user()->id) != 0 || getUserExecutivePointBalance(Auth::user()->id) != 0)--}}
                                        {{--                                                @if(getUserManagerPointBalance(Auth::user()->id) != 0 && getUserExecutivePointBalance(Auth::user()->id) == 0)--}}
                                        {{--                                                    <li class="d-flex align-items-center margin-15px-bottom ">--}}
                                        {{--                                                        <input id="wallet2" type="radio" name="wallet" class="d-block w-auto margin-10px-right mb-0 wallet-select" value="2">--}}
                                        {{--                                                        <label class="line-height-18px" for="wallet2">--}}
                                        {{--                                                            <div>Manager Point</div>{{number_format(getUserManagerPointBalance(Auth::user()->id))}} PV</label>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                @elseif(getUserManagerPointBalance(Auth::user()->id) == 0 && getUserExecutivePointBalance(Auth::user()->id) != 0)--}}
                                        {{--                                                    <li class="d-flex align-items-center margin-15px-bottom">--}}
                                        {{--                                                        <input id="wallet1" type="radio" name="wallet" class="d-block w-auto margin-10px-right mb-0 wallet-select" value="1"--}}
                                        {{--                                                               checked>--}}
                                        {{--                                                        <label class="line-height-18px" for="wallet1">--}}
                                        {{--                                                            <div>Executive Point</div>{{number_format(getUserExecutivePointBalance(Auth::user()->id))}} PV</label>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                @elseif(getUserManagerPointBalance(Auth::user()->id) != 0 && getUserExecutivePointBalance(Auth::user()->id) != 0)--}}
                                        {{--                                                    <li class="d-flex align-items-center margin-15px-bottom">--}}
                                        {{--                                                        <input id="wallet1" type="radio" name="wallet" class="d-block w-auto margin-10px-right mb-0 wallet-select" value="1"--}}
                                        {{--                                                               checked>--}}
                                        {{--                                                        <label class="line-height-18px" for="wallet1">--}}
                                        {{--                                                            <div>Exxcutive Point</div>{{number_format(getUserExecutivePointBalance(Auth::user()->id))}} PV</label>--}}
                                        {{--                                                    </li>--}}

                                        {{--                                                    <li class="d-flex align-items-center margin-15px-bottom ">--}}
                                        {{--                                                        <input id="wallet2" type="radio" name="wallet" class="d-block w-auto margin-10px-right mb-0 wallet-select" value="2">--}}
                                        {{--                                                        <label class="line-height-18px" for="wallet2">--}}
                                        {{--                                                            <div>Manager Point</div>{{number_format(getUserManagerPointBalance(Auth::user()->id))}} PV</label>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            @endif--}}
                                        {{--                                            <li class="d-flex align-items-center margin-15px-bottom ">--}}
                                        {{--                                                <input id="wallet3" type="radio" name="wallet" class="d-block w-auto margin-10px-right mb-0 wallet-select" value="3">--}}
                                        {{--                                                <label class="line-height-18px" for="wallet3">--}}
                                        {{--                                                    <div>Point</div>{{number_format(getUserPointBalance(Auth::user()->id))}} PV</label>--}}
                                        {{--                                            </li>--}}
                                        {{--                                        @endif--}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-50 alt-font text-extra-dark-gray">
                                    {{--                                    <div>--}}
                                    {{--                                        {{ __('user-portal.point_balance') }}--}}
                                    {{--                                    </div>--}}

{{--                                    <div>--}}
{{--                                       VIP Cash Voucher--}}
{{--                                    </div>--}}
                                    <div>
                                        {{ __('user-portal.shipping_points') }}
                                    </div>

                                </th>
                                <td class="text-extra-dark-gray text-right">
                                    {{--                                    <div>--}}
                                    {{--                                        {{ number_format(getUserPointBalance(Auth::user()->id)) }} PV--}}
                                    {{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        {{ number_format(getCashVoucherBalance($selected_user_id)) }} PV--}}
{{--                                    </div>--}}
                                    <div>
                                        {{ number_format(getUserShippingBalance(Auth::user()->id)) }} PV
                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <th class="w-50 alt-font text-extra-dark-gray">
                                    {{--                                    <span>Add on</span>--}}
                                    <span>{{ __('user-portal.product_subtotal') }}</span>
                                </th>
                                <td class="text-extra-dark-gray text-right">
                                    {{--                                    <span id="shipping"> pts</span><br>--}}
                                    <span id="subtotal"> PV</span>
                                </td>
                            </tr>
                            <tr class="total-amount">
                                <th class="font-weight-500 text-extra-dark-gray">{{ __('user-portal.total') }}</th>
                                <td class="text-right" data-title="Total">
                                    <h6 class="d-block font-weight-500 mb-0 text-extra-dark-gray" id="total"> PV</h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            @if(Auth::guard('user')->user()->allow_order_status != 2)
                            <button onclick="checkout()"
                                    class="btn btn-large d-block btn-fancy margin-15px-top bg-dark-gold text-white w-100 {{ (count($carts) == 0)? "disabled" : "" }}" {{ (count($carts) == 0)? "disabled" : "" }}>{{ __('user-portal.proceed_to_checkout') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
@endsection

@section('js')
    <script>
        var subtotal = 0;
        var shipping_fee = 0;
        var total = 0;

        var wallet_id = 4;

        $(document).ready(function () {
            updateLayout();
        });

        function updateLayout() {
            console.log('wallet_id: ' + wallet_id);
            subtotal = 0;
            $.each($('.cart-cart-item'), function (k, v) {
                var quantity = parseInt($('.qty-text').eq(k).val());
                var unit_price = parseFloat($('.product-price').eq(k).attr('value' + wallet_id));
                var unit_subtotal = quantity * unit_price;
                $('.product-price').eq(k).html(addCommas(unit_price) + ' PV');
                $('.product-subtotal').eq(k).html(addCommas(unit_subtotal) + ' PV');
                $('#subtotal').eq(k).html(addCommas(unit_subtotal) + ' PV');

                subtotal += unit_subtotal;
            });

            total = subtotal + shipping_fee;
            $('#shipping').html(addCommas(shipping_fee) + ' PV');
            $('#subtotal').html(addCommas(subtotal) + ' PV');
            $('#total').html(addCommas(total) + ' PV')
        }

        $('.wallet-select').on('click', function () {
            wallet_id = $(this).attr('value');
            console.log(wallet_id);
            updateLayout();
        });

        $('.wallet-select').first().click();


        function updateQuantity(cart_id, index, quantity) {
            // console.log("cart_id: " + cart_id);
            // console.log("index: " + index);
            // console.log("quantity: " + quantity);
            if ((quantity != -1 && $('.qty-text').eq(index).val() == 1) || $('.qty-text').eq(index).val() > 1) {
                var final_quantity = parseInt($('.qty-text').eq(index).val()) + quantity;

                var formData = {
                    "_token": "{{ csrf_token() }}",
                    index: index,
                    cart_id: cart_id,
                    quantity: final_quantity,
                };
                var type = "POST";
                var ajaxurl = '{{ route('user.cart.update-quantity')}}';

                console.log(formData);
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        console.log(data);
                        var decoded = JSON.parse(data);
                        if (decoded.success) {
                            location.reload();
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


            } else if (quantity == -1 && $('.qty-text').eq(index).val() == 1) {
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
                        console.log(data);
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

        function checkout() {
            var pv_balance = '{{ getPvBalance($selected_user_id) }}';
            if(subtotal > pv_balance){
                console.log('subtotal:' + subtotal);
                alert('not enough pv balance')
            }else{

                var url = "{{ route('user.confirm-order-redeem', ['wallet_id' => ':id', 'vip_id' => ':vip_id']) }}";

                url = url.replace(':vip_id', '{{$selected_user_id}}');
                url = url.replace('%3Avip_id', '{{$selected_user_id}}');
                url = url.replace('&amp;', '&');


                url = url.replace(':id', wallet_id);
                url = url.replace('%3Aid', wallet_id);
                window.location.href = url;
            }

        }

    </script>


@endsection
