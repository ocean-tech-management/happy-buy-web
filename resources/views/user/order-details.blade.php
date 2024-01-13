@extends('landing.app')

@section('content')
    @include('user.user-header')
    <div class="cover-background"
         style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">
        <section>
            <div class="container">
                <div class="row">
                    @component('user.components.left-aside-bar')
                    @endcomponent
                    <div
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom">
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-20px-bottom padding-2-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-6">
                                        <span class="text-gray alt-font text-small">{{ __('user-portal.order_id') }} {{ $order->order_number }}   </span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <spam
                                            class="pl-4">{{ $order->created_at->format('d M Y H:i a') }}</spam>
                                        {{--                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"--}}
                                        {{--                                           style="padding: 3px 10px;min-width: 90px"--}}
                                        {{--                                           href="{{ route('user.point-requests') }}">--}}
                                        {{--                                            REORDER--}}
                                        {{--                                        </a>--}}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12  padding-30px-left md-padding-15px-left padding-40px-lr">
                                <div class="row">
                                    <div class="col-6"><span>{{ __('user-portal.status') }} </span></div>
                                    <div class="col-6 text-right">
                                        @if($order->collect_type == 1)
                                            @if($order->status == 1)
                                                {{ getOrderReadyForPickup($order->id) == 0 ? "Preparing" : "Ready to Pick Up" }}
                                            @else
                                                <span>{{ \App\Models\Order::STATUS_SELECT[$order->status] }}</span>
                                            @endif
                                        @else
                                            <span>{{ \App\Models\Order::STATUS_SELECT[$order->status] }}</span>
                                        @endif
                                        <div class="row text-right">
                                            @if($order->status == 2 || $order->status == 3 || $order->status == 5)
                                                <div class="col-6">
                                                    <a class="text-extra-small w-100 alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                       style="padding: 3px 10px;" target="_blank"
                                                       href="{{ route('user.order-invoice-print', ['id' => $order->id]) }}">
                                                        {{ __('user-portal.invoice') }}
                                                    </a>
                                                </div>
                                            @else
                                                <div class="col-6">
                                                </div>
                                            @endif
                                            <div class="col-6">
                                                <a class="text-extra-small w-100 alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                   style="padding: 3px 10px;"
                                                   href="{{ route('user.order-tracking', ['id' => $order->id]) }}">
                                                    {{ __('user-portal.track_items') }}
                                                </a>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-6"><span>{{ __('user-portal.order_user') }} </span></div>
                                    <div class="col-6 text-right">
                                        <span>{{($order->order_user_id == null || $order->order_user_id == Auth::user()->id)?  __('user-portal.self_order') : \App\Models\User::where('id', $order->order_user_id)->first()->name }} </span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if($order->collect_type == 2)
                                <div class="col-12  padding-30px-left md-padding-15px-left padding-40px-lr">
                                    <div class="row">
                                        <div class="col-12"><span class="text-uppercase"> {{ __('user-portal.shipping_address') }}</span></div>

                                        <div class="col-12 col-md-6">
                                            <p class="margin-5px-tb">
                                            <div class="alt-font text-extra-dark-gray text-small line-height-20px">
                                                <div>{{ $order->receiver_name }}</div>
                                                <div>{{ $order->receiver_phone }}</div>
                                            </div>

                                            </p>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <p class="margin-5px-tb">
                                            <div class="alt-font text-gray text-extra-medium line-height-20px">
                                                <div>{{ $order->receiver_address_1 }}</div>
                                                <div>{{ $order->receiver_address_2 }}</div>
                                                <div>{{ $order->receiver_city }} - {{ $order->receiver_postcode }} - {{ $order->receiver_state }}</div>
                                            </div>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            @elseif($order->collect_type == 1)
                                <div class="col-12  padding-30px-left md-padding-15px-left padding-40px-lr">
                                    <div class="row">
                                        <div class="col-12"><span class="text-uppercase"> {{ __('user-portal.pickup') }}</span></div>
                                        <div class="col-12 col-md-6">

                                            <p class="margin-5px-tb">
                                            <div class="alt-font text-extra-dark-gray text-small line-height-20px">
                                                <div>{{ $order->pickup_location->person_in_charge ?? 'N/A' }}</div>
                                                <div>{{ $order->pickup_location->phone ?? 'N/A' }}</div>
                                            </div>

                                            </p>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <p class="margin-5px-tb">
                                            <div class="alt-font text-gray text-extra-medium line-height-20px">
                                                <div>{{ $order->pickup_location->name ?? 'N/A' }}</div>
                                                <div>{{ $order->pickup_location->address ?? 'N/A' }}</div>
                                            </div>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            @endif
                            <hr>

                            @foreach( $order->order_item as $order_item)

                                <div class="col-12 padding-50px-lr margin-20px-bottom">
                                    <div class="row align-items-center">
                                        @if($order_item->is_new == null)
                                            <div class="col-6">

                                                <div class="row align-items-center">
                                                    @if($order_item->product_variant->photo != null)
                                                        <img class="" style="height: 85px;width:85px"
                                                             src="{{ $order_item->product_variant->photo->url }}"/>
                                                    @endif
                                                    <div class="pl-3">
                                                        <div class="line-height-16px">
                                                            <div class="alt-font text-extra-dark-gray text-small"> {{ $order_item->name }} </div>
                                                            <div>
                                                                <ul class="alt-font shop-color">
                                                                    <li>
                                                                        <input class="d-none disabled" type="radio"
                                                                               name="color"/>
                                                                        <label title="{{$order_item->product_variant->color->name}}"><span
                                                                                style="background-color: {{ $order_item->product_variant->color->color }};border: 2px solid #ddd;"></span></label>
                                                                    </li>
                                                                </ul>
                                                                <span>{{$order_item->product_color." ".$order_item->product_size}}</span>
                                                            </div>
                                                            {{--                                                        <div class="alt-font text-extra-dark-gray text-small"> {{ $order_item->product_color }}--}}
                                                            {{--                                                            - {{ $order_item->product_size }}</div>--}}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            {{--                                    <div class="col-3">--}}
                                            {{--                                        <div class="row" style="display: grid">--}}
                                            {{--                                            <div class="line-height-16px row justify-content-center">--}}
                                            {{--                                                <span--}}
                                            {{--                                                    class="alt-font text-gray text-small font-weight-300">{{ number_format() }} PTS</span>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}
                                            {{--                                    </div>--}}
                                            <div class="col-3">
                                                <div class="row justify-content-center">
                                                    <div class="line-height-16px">
                                                        <span class="alt-font text-gray text-small font-weight-300">{{ $order_item->product_quantity}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="row justify-content-end">
                                                    <div class="line-height-16px">
                                                        @if($order_item->parent_id != null)
                                                            <span
                                                                class="alt-font text-gray text-small font-weight-300">
                                                    @if(Auth::guard('user')->user()->user_type == 4 && $order->wallet_type != 5)
                                                                    {{ number_format($order_item->sales_price * $order_item->product_quantity) }} PV
                                                                @elseif($order->wallet_type == 5)
                                                                    {{ number_format($order_item->vip_redeem_pv *  $order_item->product_quantity) }} PV
                                                                @else
                                                                    {{ number_format($order_item->price *  $order_item->product_quantity) }} PV
                                                                @endif
                                                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            @if($order_item->product_variant == null)
                                                <div class="col-6">
                                                    {{ $order_item->product_name_en }}
                                                </div>
                                                <div class="col-3"></div>
                                                <div class="col-3"></div>
                                            @endif
                                            @foreach( $order_item->child_list as $order_item2)
                                                <div class="col-6">

                                                    <div class="row align-items-center">
                                                        @if($order_item2->product_variant->photo != null)
                                                            <img class="" style="height: 85px;width:85px"
                                                                 src="{{ $order_item2->product_variant->photo->url }}"/>
                                                        @endif
                                                        <div class="pl-3">
                                                            <div class="line-height-16px">
                                                                <div class="alt-font text-extra-dark-gray text-small"> {{ $order_item2->name }} </div>
                                                                <div>
                                                                    <ul class="alt-font shop-color">
                                                                        <li>
                                                                            <input class="d-none disabled" type="radio"
                                                                                   name="color"/>
                                                                            <label title="{{$order_item2->product_variant->color->name}}"><span
                                                                                    style="background-color: {{ $order_item2->product_variant->color->color }};border: 2px solid #ddd;"></span></label>
                                                                        </li>
                                                                    </ul>
                                                                    <span>{{$order_item2->product_color." ".$order_item2->product_size}}</span>
                                                                </div>
                                                                {{--                                                        <div class="alt-font text-extra-dark-gray text-small"> {{ $order_item->product_color }}--}}
                                                                {{--                                                            - {{ $order_item->product_size }}</div>--}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                {{--                                    <div class="col-3">--}}
                                                {{--                                        <div class="row" style="display: grid">--}}
                                                {{--                                            <div class="line-height-16px row justify-content-center">--}}
                                                {{--                                                <span--}}
                                                {{--                                                    class="alt-font text-gray text-small font-weight-300">{{ number_format() }} PTS</span>--}}
                                                {{--                                            </div>--}}
                                                {{--                                        </div>--}}
                                                {{--                                    </div>--}}
                                                <div class="col-3">
                                                    <div class="row justify-content-center">
                                                        <div class="line-height-16px">
                                                            <span class="alt-font text-gray text-small font-weight-300">{{ $order_item2->product_quantity}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="row justify-content-end">
                                                        <div class="line-height-16px">
                                                            @if($order_item2->parent_id != null)
                                                                <span
                                                                    class="alt-font text-gray text-small font-weight-300">
                                                    @if(Auth::guard('user')->user()->user_type == 4 && $order->wallet_type != 5)
                                                                        {{ number_format($order_item2->sales_price * $order_item2->product_quantity) }} PV
                                                                    @elseif($order->wallet_type == 5)
                                                                        {{ number_format($order_item2->vip_redeem_pv *  $order_item2->product_quantity) }} PV
                                                                    @else
                                                                        {{ number_format($order_item2->price *  $order_item2->product_quantity) }} PV
                                                                    @endif
                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                @php
                                    if(empty($add_on)){$add_on = 0 ;}
                                    if(empty($subtotal)){$subtotal = 0 ;}
                                    if(empty($total)){$total = 0 ;}

                                    if($order_item->product_variant != NULL){
                                        $add_on += $order_item->price_add_on;
                                        if(Auth::guard('user')->user()->user_type == 4 && $order->wallet_type != 5){
                                        $subtotal += $order_item->sales_price * $order_item->product_quantity;
                                        }else if($order->wallet_type == 5){
                                            $subtotal += $order_item->vip_redeem_pv * $order_item->product_quantity;
                                        }else{
                                            $subtotal += $order_item->price * $order_item->product_quantity;
                                        }
                                    }
                                        $total = $add_on + $subtotal;
                                @endphp
                            @endforeach
                            <hr>
                            <div class="col-12  padding-50px-lr margin-20px-bottom">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-7">

                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="row" style="display: grid">
                                            <div class=" row justify-content-between text-right">
                                                <span class="col-4 alt-font text-extra-dark-gray text-small">{{ __('user-portal.subtotal') }}</span>
                                                <span class="col-8 alt-font text-gray text-small font-weight-300">{{ number_format($subtotal) }} PV</span>
                                            </div>
                                            <div class=" row justify-content-between text-right">
                                                <span class="col-4 alt-font text-extra-dark-gray text-small">{{ __('user-portal.shipping_fee') }}</span>
                                                <span class="col-8 alt-font text-gray text-small font-weight-300">{{ number_format($order->total_add_on + $order->total_shipping) }} PV</span>
                                            </div>

                                            <div class=" row justify-content-between padding-20px-top text-right">
                                                <span class="col-4 alt-font text-extra-dark-gray text-extra-medium ">{{ __('user-portal.total') }}</span>
                                                <span class="col-8 alt-font text-extra-dark-gray text-extra-large2 font-weight-300">{{ number_format($subtotal ) }} PV</span>
                                            </div>
                                            @if(Auth::guard('user')->user()->user_type == 4 && $order->wallet_type != 5)
                                                @php
                                                    $cashVoucherBalance = \App\Models\CashVoucherBalance::where('remark', 'like' ,'%'.$order->order_number.'%')->first();
                                                @endphp
                                                <div class=" row justify-content-between padding-20px-top text-right">
                                                    <span class="col-4 alt-font text-extra-dark-gray text-extra-medium ">Total Payable</span>
                                                    <span class="col-8 alt-font text-extra-dark-gray text-extra-large2 font-weight-300">
                                                         {{ number_format($subtotal + $order->total_add_on + $order->total_shipping) }}  {{ $cashVoucherBalance->amount }} =
                                                         {{ number_format($subtotal + $order->total_add_on + $order->total_shipping + $cashVoucherBalance->amount) }} PV

                                                    </span>
                                                </div>
                                            @elseif($order->wallet_type == 5)
                                                <div class=" row justify-content-between padding-20px-top text-right">
                                                    <span class="col-4 alt-font text-extra-dark-gray text-extra-medium ">Total Shipping</span>
                                                    <span class="col-8 alt-font text-extra-dark-gray text-extra-large2 font-weight-300">
                                                         {{ number_format( $order->total_add_on + $order->total_shipping ) }} PV
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </section>
    </div>
@endsection
