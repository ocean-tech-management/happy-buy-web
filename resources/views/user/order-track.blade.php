@extends('landing.app')

@section('content')
    @include('user.user-header')
    <div class="cover-background"
         style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 text-center margin-1-half-rem-bottom">
                        <h5 class="title-small dark-gold alt-font font-weight-300">
                            {{ __('user-portal.tracking_order') }}
                        </h5>
                        <span class="alt-font margin-10px-bottom d-block  text-medium font-weight-300">{{ __('user-portal.order_id') }} {{ $order->order_number }}</span>
{{--                        <span class="alt-font margin-10px-bottom d-block  text-medium font-weight-300">{{ $order->created_at->format('d M Y H:i a') }}</span>--}}
                        <span class="alt-font margin-10px-bottom d-block  text-medium font-weight-300">{{ $order->created_at }}</span>

                    </div>
                </div>
                <div class="bg-white shadow border-radius-5px padding-20px-all mx-auto justify-content-start text-start" style="width: 377px">
                    <div class="col-12 ">
                        <span class="alt-font margin-10px-bottom d-block text-medium dark-gold ">{{ __('user-portal.order_confirmed')  }}</span>
{{--                        <span class="alt-font margin-20px-bottom d-block  text-medium font-weight-300">{{ $order->created_at->format('d M Y H:i a') }}</span>--}}
                        <span class="alt-font margin-20px-bottom d-block  text-medium font-weight-300">{{ $order->created_at }}</span>
                        <span class="alt-font margin-20px-bottom d-block text-small font-weight-300">{{ __('user-portal.redemption_is_confirmed_and_the_parcel_is_processed') }}</span>
                    </div>
                </div>
                @if($order->shipout_at != NULL)
                    <div class="row justify-content-center">
                        <div class="bg-dark-gold" style="width: 2px; height: 40px; "></div>
                    </div>
                    <div class="bg-dark-gold shadow border-radius-5px padding-20px-all mx-auto justify-content-start text-start " style="width: 377px">
                        <div class="col-12 ">
                            <span class="alt-font margin-10px-bottom d-block text-medium text-white ">{{ __('user-portal.order_shipped')  }}</span>
                            <span class="alt-font margin-20px-bottom d-block text-medium text-white font-weight-300">{{ $order->shipout_at }}</span>
                            <span class="alt-font margin-20px-bottom d-block text-small text-white font-weight-300">{{ __('user-portal.your_order_has_been_shipped_out') }}</span>
                            <div class="line-height-20px">
                                <div class="alt-font d-block text-small text-white font-weight-300">{{ __('user-portal.shipping_company') }} {{ $order->shipping_company->name }}</div>
                                <div class="alt-font d-block text-small text-white font-weight-300">{{ __('user-portal.tracking_code') }} {{ $order->tracking_code }}</div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($order->pickup_at != NULL)
                    <div class="row justify-content-center">
                        <div class="bg-dark-gold" style="width: 2px; height: 40px; "></div>
                    </div>
                    <div class="bg-dark-gold shadow border-radius-5px padding-20px-all mx-auto justify-content-start text-start " style="width: 377px">
                        <div class="col-12 ">
                            <span class="alt-font margin-10px-bottom d-block text-medium text-white ">{{ __('user-portal.order_picked_up')  }}</span>
{{--                            <span class="alt-font margin-20px-bottom d-block text-medium text-white font-weight-300">{{ \Carbon\Carbon::parse($order->pickup_at)->format('d M Y H:i a') }}</span>--}}
                            <span class="alt-font margin-20px-bottom d-block text-medium text-white font-weight-300">{{ $order->pickup_at }}</span>
                            <span class="alt-font margin-20px-bottom d-block text-small text-white font-weight-300">{{ __('user-portal.your_order_has_been_picked_up') }}</span>
                        </div>
                    </div>
                @endif
                @if($order->completed_at != NULL)
                    <div class="row justify-content-center">
                        <div class="bg-dark-gold" style="width: 2px; height: 40px; "></div>
                    </div>
                    <div class="bg-dark-gold shadow border-radius-5px padding-20px-all mx-auto justify-content-start text-start " style="width: 377px">
                        <div class="col-12 ">
                            <span class="alt-font margin-10px-bottom d-block text-medium text-white ">{{ __('user-portal.order_completed')  }}</span>
{{--                            <span class="alt-font margin-20px-bottom d-block text-medium text-white font-weight-300">{{  \Carbon\Carbon::parse($order->completed_at)->format('d M Y H:i a') }}</span>--}}
                            <span class="alt-font margin-20px-bottom d-block text-medium text-white font-weight-300">{{  $order->completed_at }}</span>
                            <span class="alt-font margin-20px-bottom d-block text-small text-white font-weight-300">{{ __('user-portal.your_order_is_completed') }}</span>
                        </div>
                    </div>
                @endif
                <div class="row justify-content-center margin-3-half-rem-top">
                    <a href="{{ route('user.order-details', ['id'=> $order->id]) }}" class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px">
                        {{ __('global.back')  }}
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
