@extends('landing.app')


@section('css')
    <style>
        .payment-item {
            padding: 10px;
            background-color: #EAD3BF;
            border-radius: 10px;
        }

        .payment-item.select {
            background-color: #877A61 !important;
            border: none;
            color: white !important;
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
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom ">
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px  padding-20px-bottom margin-30px-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font ">{{__('user-portal.shipping_points')}}</span>
                                    </div>
                                    <div class="col-4 row justify-content-end">
                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                           style="padding: 3px 10px;min-width: 90px"
                                           href="{{ route('user.shipping-point-history') }}">
                                            {{ __('user-portal.view_history') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div
                                class="col-12 col-lg-10 col-md-10 mx-auto">
                                @if ($errors->any())
                                    <div class=" margin-5px-bottom ">
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="padding-4-rem-lr padding-4-rem-bottom lg-margin-35px-top md-padding-2-half-rem-alls row justify-content-center">
                                    <label
                                        class="col-12 text-extra-medium text-extra-dark-gray alt-font margin-15px-bottom text-center"> {{ __('user-portal.shipping_point_top_up') }}</label>
                                    <div class="row">
                                        <input id="id" name="id" value="" type="hidden"/>
                                        <div class="col-12 text-medium text-extra-dark-gray alt-font margin-15px-bottom text-center">{{__('user-portal.select_top_up_value')}}</div>
                                        <div class="col-12 ">
                                            <div class="row text-center">
                                                @foreach($shipping_packages as $shipping_package)
                                                    <div class="col-4 margin-1-half-rem-bottom">
                                                        <div class="margin-1-half-rem-lf border-radius-5px payment-item" value="{{ $shipping_package->id }}">
                                                            <div>
                                                                RM {{ $shipping_package->price }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
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
                $('#id').attr('value', $(this).attr('value'))
                console.log('id: ' + $(this).attr('value'));
            });

            $('.payment-item').first().addClass('select');
            $('#id').attr('value', $('.payment-item').attr('value'))

            $('.submit').on('click', function () {
                var url = '{{ route('user.shipping.checkout', [ 'id' => ':id']) }}';
                // url = url.replace(':amount', $('#amount').attr('value'));
                url = url.replace(':id', $('#id').attr('value'));
                window.location.href = url;
            });
        });
    </script>
@endsection
