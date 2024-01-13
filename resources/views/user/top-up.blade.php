@extends('landing.app')

@section('css')
    <style>
        .payment-item {
            background-color: #f8f8f8;
            border: 1px solid #d8d8d8;
        }

        .payment-item.select {
            background-color: white !important;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
            border: none;
        }
    </style>
@endsection

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
                            class="bg-white shadow wow animate__fadeIn border-radius-5px  margin-1-half-rem-bottom padding-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.top_up') }}</span>
                                    </div>
                                    <div class="col-4 text-right">

                                        @if( str_contains(url()->current(), "manager"))
                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px"
                                               href="{{ route('user.top-up-history-manager') }}">
                                                {{ __('user-portal.top_up_history') }}
                                            </a>
                                        @elseif( str_contains(url()->current(), "executive"))
                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px"
                                               href="{{ route('user.top-up-history-executive') }}">
                                                {{ __('user-portal.top_up_history') }}
                                            </a>
                                        @else
                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px"
                                               href="{{ route('user.top-up-history') }}">
                                                {{ __('user-portal.top_up_history') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if ($errors->any())
                                <div class="col-md-12 margin-5px-bottom padding-40px-lr">
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div
                                class="col-12 col-lg-10 col-md-10 mx-auto">
                                <div class="padding-4-rem-lr padding-4-rem-bottom lg-margin-35px-top md-padding-2-half-rem-alls row justify-content-center">
                                    <label
                                        class="col-12 text-extra-medium text-extra-dark-gray alt-font margin-15px-bottom text-center">{{ __('user-portal.top_up_amount') }}</label>
                                    <div class="col-12 text-medium text-extra-dark-gray alt-font margin-15px-bottom text-center">{{ __('user-portal.select_top_up_value') }}</div>
                                    <div class="col-12 ">
                                        <div class="row text-center">
                                            @foreach( $point_packages as $point_package)
                                                <div class="col-12 col-md-4 margin-1-half-rem-lf margin-1-rem-tb mx-auto">
                                                    <div class=" border-radius-5px payment-item" value="{{ $point_package->id }}">
                                                        <div class="row align-items-center">
                                                            <div class="col-5 col-md-12">
                                                                <img class="h-18 w-18 margin-1-half-rem-top" src="{{ $point_package->package_photo->url }}"/>
                                                            </div>
                                                            <div class="col-7 col-md-12">
                                                                <div class="row  ">
                                                                    <div class="col-12 text-left text-md-center">
                                                                        {{ $point_package->name }}
                                                                    </div>
                                                                    <div class="col-12 text-left text-md-center">
                                                                        @if($point_package->id != 99)
                                                                            {{ 'RM'.number_format($point_package->price,2) }}
                                                                        @else
                                                                            @if(Request::is('user/top-up-executive'))
                                                                                {{ 'RM'. number_format(110 - (getUserExecutivePointBalance(Auth::user()->id) % 110),2) }}
                                                                            @elseif(Request::is('user/top-up-manager'))
                                                                                {{ 'RM'. number_format(100 - (getUserManagerPointBalance(Auth::user()->id) % 100),2) }}
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <input type="hidden" value="" name="value" id="value"/>
                                    @if(Auth::guard('user')->user()->allow_order_status != 2)
                                    <button
                                        class="submit text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-1-half-rem-lr margin-3-half-rem-top">
                                        {{ __('user-portal.top_up') }}
                                    </button>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.payment-item').on('click', function () {
                $('.payment-item').removeClass('select');
                $(this).addClass('select');
                $('#value').attr('value', $(this).attr('value'))
                $('.submit').attr('value', $(this).attr('value'))
            });

            $('.payment-item').first().addClass('select');
            $('#value').attr('value', $('.payment-item').attr('value'))
            $('.submit').attr('value', $('.payment-item').attr('value'))

            $('.submit').on('click', function () {
                {{--                @if($point_package->id != 99)--}}
                {{--                var url = '{{ route('user.top-up.checkout', ':id') }}';--}}
                {{--                @else--}}
                @if(Request::is('user/top-up-executive'))
                var url = '{{ route('user.top-up.checkout-executive', ':id') }}';
                @elseif(Request::is('user/top-up-manager'))
                var url = '{{ route('user.top-up.checkout-manager', ':id') }}';
                @else
                var url = '{{ route('user.top-up.checkout', ':id') }}';
                @endif
                    {{--                    @endif--}}

                    url = url.replace(':id', $(this).attr('value'));
                window.location.href = url;
            });
        });
    </script>
@endsection
