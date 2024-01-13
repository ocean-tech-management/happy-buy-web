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
                        <span class="dark-gold alt-font ">{{ __('user-portal.my_orders') }}</span>
                        <div class="row padding-1-half-rem-bottom">
                            <div class="col-6 col-md-3 padding-1-rem-bottom">
                                <div class="padding-2-rem-tb shadow"
                                     style="background-color: #F6EDE5;border-radius:10px">
                                    <div class="text-extra-large2 dark-gold alt-font text-center">
                                        {{ $orders->count() }}
                                    </div>
                                    <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                        {{ __('user-portal.all_orders') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="padding-2-rem-tb shadow"
                                     style="background-color: #F0E0D2;border-radius:10px">
                                    <div class="text-extra-large2 dark-gold alt-font text-center">
                                        {{ $to_ship_orders }}
                                    </div>
                                    <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                        {{ __('user-portal.to_ship') }}
                                    </div>
                                </div>

                            </div>
                            <div class="col-6 col-md-3">
                                <div class="padding-2-rem-tb shadow"
                                     style="background-color: #ECD7C5;border-radius:10px">
                                    <div class="text-extra-large2 dark-gold alt-font text-center">
                                        {{ $to_receive_orders }}
                                    </div>
                                    <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                        {{ __('user-portal.to_receive') }}
                                    </div>
                                </div>

                            </div>
                            <div class="col-6 col-md-3">
                                <div class="padding-2-rem-tb shadow"
                                     style="background-color: #dddddd;border-radius:10px">
                                    <div class="text-extra-large2 dark-gold alt-font text-center">
                                        {{ $cancelled_orders }}
                                    </div>
                                    <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                        {{ __('user-portal.cancelled') }}
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-tb padding-20px-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.recent_order') }}</span>
                                    </div>
                                    <div class="col-4 text-right">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if(count($orders) != 0)
                            @foreach($orders as $order)
                                <div class="col-12 padding-20px-lr margin-20px-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-6 d-md-none d-block">
                                             <span
                                                 class="alt-font text-extra-dark-gray text-extra-small font-weight-700">Order ID {{ $order->order_number }}</span>
                                        </div>
                                        <div class="col-6 d-md-none d-block text-right">
                                            <span
                                                class=" alt-font text-extra-dark-gray text-extra-small font-weight-700 text-uppercase">{{ $order->created_at->format('d M Y H:i a') }}</span>
                                        </div>
                                        <div class="col-12 col-md-7">
                                            <div class="row align-items-center">
                                                <div class="col-3">
{{--                                                    @if($order->order_item[1]->product_variant->photo != null)--}}
{{--                                                    <img style="height: 60px;width:60px"--}}
{{--                                                         src="{{ $order->order_item[1]->product_variant->photo->url  }}"/>--}}
{{--                                                    @endif--}}
                                                </div>

                                                <div class="col-9">
                                                    <div class="line-height-16px d-md-block d-none">
                                                        <div
                                                        class="alt-font text-extra-dark-gray text-extra-small font-weight-700">Order ID {{ $order->order_number }}</div>
                                                        <div
                                                            class="alt-font text-extra-dark-gray text-extra-small font-weight-700 text-uppercase">{{ $order->created_at->format('d M Y H:i a') }}</div>
                                                    </div>
                                                    <div class="line-height-16px">
                                                        <span class="alt-font text-gray text-extra-small font-weight-700">{{ $order->order_items }}</span>
                                                        <div class="row d-md-none d-flex ">
                                                            <div class="col-6 line-height-16px">
                                                        <span
                                                            class="alt-font text-success text-extra-small font-weight-700 text-uppercase">{{ \App\Models\Order::STATUS_SELECT[$order->status] }}</span>
                                                            </div>
                                                            <div class="col-6 line-height-16px text-right">
                                                            <span
                                                                class="alt-font text-extra-dark-gray text-extra-small font-weight-700">
                                                                @if(Auth::guard('user')->user()->user_type == 4)
                                                                    {{number_format($order->sub_total + $order->total_shipping + $order->total_add_on)}} PV
                                                                @else
                                                                    {{number_format($order->sub_total + $order->total_shipping + $order->total_add_on)}} PV
                                                                @endif
                                                            </span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-2 text-right d-md-block d-none ">
                                            <div class="line-height-16px">
                                            <span
                                                class="alt-font text-success text-extra-small font-weight-700 text-uppercase ">{{ \App\Models\Order::STATUS_SELECT[$order->status] }}</span>
                                            </div>
                                            <div class="line-height-16px">
                                            <span
                                                class="alt-font text-extra-dark-gray text-extra-small font-weight-700">
                                                @if(Auth::guard('user')->user()->user_type == 4)
                                                    {{number_format($order->sub_total + $order->total_shipping + $order->total_add_on)}} {{$order->wallet_type == 5 ? "VIP PV" : "PV"}}
                                                @else
                                                    {{number_format($order->sub_total + $order->total_shipping + $order->total_add_on)}} {{$order->wallet_type == 5 ? "VIP PV" : "PV"}}
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 text-right padding-1-half-rem-tb ">
                                            <div class="row">
                                                <div class="col-6" style=" padding-right: 5px">
                                                    <a class="text-extra-small w-100 alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gray text-uppercase text-white mr-1"
                                                       style="padding: 3px 10px;"
                                                       href="{{ route('user.order-details', ['id' => $order->id]) }}">
                                                        {{ __('user-portal.view') }}
                                                    </a>
                                                </div>
                                                <div class="col-6" style="padding-left: 5px;">
                                                    <a class="text-extra-small w-100 alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                       style="padding: 3px 10px;"
                                                       href="{{ route('user.order-tracking', ['id' => $order->id]) }}">
                                                        {{ __('user-portal.track_items') }}
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endforeach
                            @else
                                <div class="col-12  padding-40px-lr">
                                    <span class="alt-font text-gray text-medium text-uppercase">{{ __('global.no_results') }}</span>
                                </div>
                            @endif

                        </div>

                    </div>


                </div>
            </div>
        </section>
    </div>
@endsection
