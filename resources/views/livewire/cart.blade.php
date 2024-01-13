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
        <div class="container">
            <div class="row">
                <div class="col-lg-8 padding-70px-right lg-padding-30px-right md-padding-15px-right">
                    <div class="row">
                        <div class="col-12">
                            <span class="text-extra-dark-gray alt-font text-extra-large">{{ __('user-portal.cart') }}</span>
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
                            <option value="{{ route('user.cart2') }}">Myself</option>
                            @foreach($my_vips as $vip)
                                <option value="{{ route('user.cart2' , ['vip_id'=>$vip->id]) }}" {{ $selected_user_id==$vip->id? "selected": ""  }}> {{$vip->name}}
                                    - {{$vip->email}}</option>
                            @endforeach
                        </select>

                        @if($selected_user_id != Auth::guard('user')->user()->id)
                            <div>
                                <strong>Vip Voucher Balance: </strong> {{ getCashVoucherBalance($selected_user_id) }} <br>
                                <strong>Vip PV: </strong>{{ getPvBalance($selected_user_id) }}
                            </div>
                        @endif


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
                                            @if($cart->is_package == 2)
                                                <td class="product-remove">
                                                <button wire:click="removeCart({{ $cart->id }})"
                                                        class="btn text-large {{ ($cart->product->status != 1 || $cart->type != 1)? "invisible" : "" }}">
                                                    &times;
                                                </button>
                                            </td>
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
                                                    value3="{{ $cart->product_variant->merchant_president_price }}"
                                                    value4="{{ $cart->product_variant->sales_price }}"
                                                >{{ number_format($cart->product_variant->price) }} pts
                                                </td>
                                                <td class="product-quantity" data-title="Quantity">
                                                    <div class="quantity text-right" style="display: inline-block;">
                                                        <label class="screen-reader-text">Quantity</label>
                                                        <div class="row">
                                                            <input type="button" value="-"
                                                                   class="col-2 col-md-3 bg-white {{ ($cart->product->status != 1 || $cart->type != 1)? "invisible" : "" }}"
                                                                   data-quantity="minus" data-field="quantity" style="padding: 10px 20px 10px 15px; border-radius: 0px"
                                                                   @if($cart->quantity > 1)
                                                                   wire:click="updateQtyCart({{$cart->id}}, {{ -1 }})"
                                                                   @else
                                                                   wire:click="removeCart({{ $cart->id }})"
                                                                @endif
                                                            >

                                                            <input class="input-text qty-text col-5 col-md-4 text-extra-dark-gray" type="number" name="quantity"
                                                                   value="{{ $cart->quantity }}" autocomplete="off" style="padding-right:0px" disabled>

                                                            <input type="button" value="+"
                                                                   class="col-2 col-md-3 bg-white {{ ($cart->product->status != 1 || $cart->type != 1)? "invisible" : "" }}"
                                                                   data-quantity="plus" data-field="quantity" style="padding: 10px 20px 10px 12px;border-radius: 0px"
                                                                   @if($cart->product->status = 1 && $cart->type = 1) wire:click="updateQtyCart({{$cart->id}}, {{ +1 }})" @endif>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td class="product-subtotal" data-title="Total">{{ number_format($cart->quantity * $cart->product_variant->price) }} PV</td>
                                            @elseif($cart->is_package == 1)
                                                <td class="product-remove">
                                                    <button wire:click="removePackageCart({{ $cart->id }})"
                                                            class="btn text-large {{ ($cart->product->status != 1 || $cart->type != 1)? "invisible" : "" }}">
                                                        &times;
                                                    </button>
                                                </td>
                                                <td class="product-thumbnail">
                                                    @if($cart->product->photo != NULL)
                                                        <img class="cart-product-image" src="{{$cart->product->photo->url}}" alt="">
                                                    @endif
                                                </td>
                                                <td class="product-name">
                                                    {{ $cart->product->name }}
                                                </td>
                                                <td class="product-price" data-title="Price">
                                                    <a wire:click="showModal({{$cart->id}})"class="text-decoration-underline alt-font" data-toggle="modal" data-target="#modal-popup2">Add Item</a>
                                                </td>
                                                <td class="product-quantity" data-title="Quantity">
                                                    @php
                                                        $total_quantity = 0 ;
                                                    @endphp
                                                    @foreach($cart->package_item as $item)
                                                        @php
                                                            $total_quantity += $item->quantity;
                                                        @endphp
                                                    @endforeach
                                                    {{ $total_quantity }}
                                                </td>
                                                <td class="product-subtotal" data-title="Total">
                                                    @php
                                                        $sub_total = 0 ;
                                                    @endphp
                                                    @foreach($cart->package_item as $item)
                                                        @php
                                                                $sub_total += $item->product_variant->price;
                                                        @endphp
                                                    @endforeach
                                                    {{ (count($cart->package_item) == 0) ? 0: number_format($sub_total) }} PV

                                                </td>
                                                <tr>
                                                    <td colspan="6">
                                                    @forelse($cart->package_item as $item)
                                                        <div class="row">
                                                            <button wire:click="removeCart({{ $item->id }})"
                                                                    class="btn text-large {{ ($item->product->status != 1 || $item->type != 1)? "invisible" : "" }}">
                                                                &times;
                                                            </button>
                                                            {{ $item->product->name_en }} -
                                                            {{ $item->product_variant->color->name }} -
                                                            {{ $item->product_variant->size->name }} -
                                                            {{ $item->product_variant->price }} PV


                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                            <div class="row">
                                                                <input type="button" value="-"
                                                                       class="col-2 col-md-3 bg-white {{ ($item->product->status != 1 || $item->type != 1)? "invisible" : "" }}"
                                                                       data-quantity="minus" data-field="quantity" style="padding: 10px 20px 10px 15px; border-radius: 0px"
                                                                       @if($item->quantity > 1)
                                                                       wire:click="updateQtyCart({{$item->id}}, {{ -1 }})"
                                                                       @else
                                                                       wire:click="removeCart({{ $item->id }})"
                                                                    @endif
                                                                >
                                                                <input class="input-text qty-text col-5 col-md-4 text-extra-dark-gray" type="number" name="quantity"
                                                                       value="{{ $item->quantity }}" autocomplete="off" style="padding-right:0px" disabled>

                                                                <input type="button" value="+"
                                                                       class="col-2 col-md-3 bg-white {{ ($item->product->status != 1 || $item->type != 1)? "invisible" : "" }}"
                                                                       data-quantity="plus" data-field="quantity" style="padding: 10px 20px 10px 12px;border-radius: 0px"
                                                                       @if($item->product->status = 1 && $item->type = 1) wire:click="addToCart({{ $item->product_variant_id }}, {{ $item->package_id }}, {{ $cart->product_id }})" @endif>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        No item added yet
                                                    @endforelse
                                                    </td>
                                                </tr>
                                            @endif

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
                            <livewire:cart-vip-pv-summary :carts="$carts" :selected_user_id="$selected_user_id"/>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-light-gray padding-50px-all lg-padding-30px-tb lg-padding-20px-lr md-padding-20px-tb">
                        <span
                            class="alt-font text-extra-large text-extra-dark-gray margin-15px-bottom d-inline-block font-weight-500">{{ __('user-portal.cart_summary') }} {{ count($carts) }}</span>
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
                                    Check out with Wallet
                                    <ul class="col-12 line-height-36px">
                                        @if(Auth::user()->roles[0]->id == 3)
                                            <li class="d-flex align-items-center margin-15px-bottom">
                                                <input wire:model="wallet" wire:change="onWalletSelect" id="wallet1" type="radio" name="wallet"
                                                       class="d-block w-auto margin-10px-right mb-0 wallet-select" value="1" checked>
                                                <label class="line-height-18px" for="wallet1">
                                                    <div>Executive Point</div>
                                                    @if(env('SHOW_PV') == 1)
                                                        {{number_format(getUserExecutivePointBalance(Auth::user()->id))}} PV
                                                    @else
                                                        - PV
                                                    @endif

                                                </label>
                                            </li>
                                        @endif
                                        @if(Auth::user()->roles[0]->id == 4)
                                            @if(getUserExecutivePointBalance(Auth::user()->id) != 0)
                                                <li class="d-flex align-items-center margin-15px-bottom">
                                                    <input wire:model="wallet" wire:change="onWalletSelect" id="wallet1" type="radio" name="wallet"
                                                           class="d-block w-auto margin-10px-right mb-0 wallet-select" value="1"
                                                           checked>
                                                    <label class="line-height-18px" for="wallet1">
                                                        <div>Executive Point</div>
                                                        @if(env('SHOW_PV') == 1)
                                                            {{number_format(getUserExecutivePointBalance(Auth::user()->id))}} PV
                                                        @else
                                                            - PV
                                                        @endif

                                                    </label>
                                                </li>
                                            @endif
                                            <li class="d-flex align-items-center margin-15px-bottom ">
                                                <input wire:model="wallet" wire:change="onWalletSelect" id="wallet2" type="radio" name="wallet"
                                                       class="d-block w-auto margin-10px-right mb-0 wallet-select" value="2">
                                                <label class="line-height-18px" for="wallet2">
                                                    <div>Manager Point</div>
                                                    @if(env('SHOW_PV') == 1)
                                                        {{number_format(getUserManagerPointBalance(Auth::user()->id))}} PV
                                                    @else
                                                        - PV
                                                    @endif
                                                </label>
                                            </li>

                                        @endif
                                        @if(Auth::user()->roles[0]->id == 2)
                                            @if(getUserManagerPointBalance(Auth::user()->id) == 0 && getUserExecutivePointBalance(Auth::user()->id) == 0)
                                            @elseif( getUserManagerPointBalance(Auth::user()->id) != 0 || getUserExecutivePointBalance(Auth::user()->id) != 0)
                                                @if(getUserManagerPointBalance(Auth::user()->id) != 0 && getUserExecutivePointBalance(Auth::user()->id) == 0)
                                                    <li class="d-flex align-items-center margin-15px-bottom ">
                                                        <input wire:model="wallet" wire:change="onWalletSelect" id="wallet2" type="radio" name="wallet"
                                                               class="d-block w-auto margin-10px-right mb-0 wallet-select" value="2">
                                                        <label class="line-height-18px" for="wallet2">
                                                            <div>Manager Point</div>
                                                            @if(env('SHOW_PV') == 1)
                                                                {{number_format(getUserManagerPointBalance(Auth::user()->id))}} PV
                                                            @else
                                                                - PV
                                                            @endif
                                                        </label>
                                                    </li>
                                                @elseif(getUserManagerPointBalance(Auth::user()->id) == 0 && getUserExecutivePointBalance(Auth::user()->id) != 0)
                                                    <li class="d-flex align-items-center margin-15px-bottom">
                                                        <input wire:model="wallet" wire:change="onWalletSelect" id="wallet1" type="radio" name="wallet"
                                                               class="d-block w-auto margin-10px-right mb-0 wallet-select" value="1"
                                                               checked>
                                                        <label class="line-height-18px" for="wallet1">
                                                            <div>Executive Point</div>
                                                            @if(env('SHOW_PV') == 1)
                                                                {{number_format(getUserExecutivePointBalance(Auth::user()->id))}} PV
                                                            @else
                                                                - PV
                                                            @endif

                                                        </label>
                                                    </li>
                                                @elseif(getUserManagerPointBalance(Auth::user()->id) != 0 && getUserExecutivePointBalance(Auth::user()->id) != 0)
                                                    <li class="d-flex align-items-center margin-15px-bottom">
                                                        <input wire:model="wallet" wire:change="onWalletSelect" id="wallet1" type="radio" name="wallet"
                                                               class="d-block w-auto margin-10px-right mb-0 wallet-select" value="1"
                                                               checked>
                                                        <label class="line-height-18px" for="wallet1">
                                                            <div>Executive Point</div>
                                                            @if(env('SHOW_PV') == 1)
                                                                {{number_format(getUserExecutivePointBalance(Auth::user()->id))}} PV
                                                            @else
                                                                - PV
                                                            @endif
                                                            </label>
                                                    </li>

                                                    <li class="d-flex align-items-center margin-15px-bottom ">
                                                        <input wire:model="wallet" wire:change="onWalletSelect" id="wallet2" type="radio" name="wallet"
                                                               class="d-block w-auto margin-10px-right mb-0 wallet-select" value="2">
                                                        <label class="line-height-18px" for="wallet2">
                                                            <div>Manager Point</div>
                                                            @if(env('SHOW_PV') == 1)
                                                                {{number_format(getUserManagerPointBalance(Auth::user()->id))}} PV
                                                            @else
                                                                - PV
                                                            @endif
                                                            </label>
                                                    </li>
                                                @endif
                                            @endif
                                            <li class="d-flex align-items-center margin-15px-bottom ">
                                                <input wire:model="wallet" wire:change="onWalletSelect" id="wallet3" type="radio" name="wallet"
                                                       class="d-block w-auto margin-10px-right mb-0 wallet-select" value="3">
                                                <label class="line-height-18px" for="wallet3">
                                                    <div>Point</div>
                                                    @if(env('SHOW_PV') == 1)
                                                        {{number_format(getUserPointBalance(Auth::user()->id))}} PV
                                                    @else
                                                        - PV
                                                    @endif
                                                    </label>
                                            </li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-50 alt-font text-extra-dark-gray">
                                    {{--                                    <div>--}}
                                    {{--                                        {{ __('user-portal.point_balance') }}--}}
                                    {{--                                    </div>--}}
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
                                    {{--                                    <div>--}}
                                    {{--                                        {{ number_format(getUserPointBalance(Auth::user()->id)) }} PV--}}
                                    {{--                                    </div>--}}
                                    @if(Auth::user()->roles[0]->id == 2)
                                        <div>
                                            @if(env('SHOW_PV') == 1)
                                                {{ number_format(getUserVoucherBalance(Auth::user()->id)) }} PV
                                            @else
                                                - PV
                                            @endif

                                        </div>
                                    @endif
                                    <div>
                                        @if(env('SHOW_PV') == 1)
                                            {{ number_format(getUserShippingBalance(Auth::user()->id)) }} PV
                                        @else
                                            - PV
                                        @endif

                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <th class="w-50 alt-font text-extra-dark-gray">
                                    <span>{{ __('user-portal.product_subtotal') }}</span>
                                </th>
                                <td class="text-extra-dark-gray text-right">
                                    <span>{{ number_format($productSubtotal) }} PV</span>
                                </td>
                            </tr>
                            <tr class="total-amount">
                                <th class="font-weight-500 text-extra-dark-gray">{{ __('user-portal.total') }}</th>
                                <td class="text-right" data-title="Total">
                                    <h6 class="d-block font-weight-500 mb-0 text-extra-dark-gray" id="total">{{number_format($productSubtotal) }} PV</h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            @if(Auth::guard('user')->user()->allow_order_status != 2)
                            <button wire:click="checkout"
                                    class="btn btn-large d-block btn-fancy margin-15px-top bg-dark-gold text-white w-100 {{ (count($carts) == 0)? "disabled" : "" }}" {{ (count($carts) == 0)? "disabled" : "" }} {{ (!$can_check_out)? "disabled" : "" }}>{{ __('user-portal.proceed_to_checkout') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self wire:model="modal_product_id" id="modal-popup2" class="modal sx-padding-4-half-rem-all">
            <div class="modal-content col-11 col-xl-4 col-lg-8 col-md-8 col-sm-9 mx-auto  padding-4-half-rem-all  bg-white border-radius-6px sm-padding-2-half-rem-lr">
                <div class="row" style="text-align:left;">
                    <div class="col-5">
                        <span class="text-extra-dark-gray text-uppercase alt-font text-extra-large font-weight-600 margin-15px-bottom d-block">Select Item</span>
                    </div>
                    <div class="col-12">

                        <div class="row">
                            @forelse($modal_product as $item)
                                <div class="col-4" wire:click="addToCart({{ $item->id }}, {{ $modal_cart_id }}, {{ $modal_product_id }})" data-dismiss="modal">
                                    <div class="product-image border-radius-6px">
                                        <img class="default-image" src="{{ ($item->photo != NULL)? $item->photo->url:"" }}" alt=""/>
                                        <img class="hover-image" src="{{ ($item->image_2 != NULL)?  ($item->image_2 ? $item->image_2->url : $item->image_1->url) : "" }}" alt=""/>
                                    </div>

                                    <div class="product-footer text-center padding-25px-top xs-padding-10px-top">
                                        {{ $item->product->name_en }}-
                                        {{ $item->color->name }}-
                                        {{ $item->size->name }}-
                                        {{ $item->price }} PV
                                    </div>
                                </div>
                            @empty
                                No selectable item found
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('livewire:load', function () {
            $('.wallet-select').first().click();
        });

    </script>
</div>
