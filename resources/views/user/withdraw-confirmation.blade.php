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
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom">

                        <form method="POST" action="{{ route('user.withdraw.confirm') }}"  id="withdraw-confirm-form"
                            class="bg-white shadow wow animate__fadeIn border-radius-5px  padding-20px-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            @csrf
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font "> {{ __('user-portal.withdraw') }}</span>
                                    </div>
                                    <div class="col-4 row justify-content-end">

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div
                                class="col-12 padding-40px-lr">
                                <span class="alt-font text-extra-dark-gray ">You are withdrawing RM{{ number_format($amount,2) }} by converting it from {{ number_format($amount) }} PV</span></div>
                            <hr>
                            <div class="col-12 padding-40px-lr">
                                <div class="row">
                                    <div class="col-6 margin-1-half-rem-bottom">
                                        <div class="alt-font dark-gold ">{{ __('user-portal.bank_name') }}</div>
                                        <span class="alt-font text-extra-dark-gray"> {{ Auth::user()->bank_name }}</span>
                                    </div>
                                    <div class="col-6">
                                        <div class="alt-font dark-gold ">{{ __('user-portal.bank_account') }}</div>
                                        <span class="alt-font text-extra-dark-gray">{{ Auth::user()->bank_account_number }} </span>
                                    </div>
                                    <div class="col-6">
                                        <div class="alt-font dark-gold ">{{ __('user-portal.beneficiary_name') }}</div>
                                        <span class="alt-font text-extra-dark-gray">{{ Auth::user()->bank_account_name }}</span>
                                    </div>
                                    <div class="col-6">
                                        <div class="alt-font dark-gold ">{{ __('user-portal.withdraw_amount') }}</div>
                                        <span class="alt-font text-extra-dark-gray">{{ Auth::user()->bank_name }}</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 col-xl-10 padding-40px-lr padding-1-half-rem-bottom">
                                <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom"> {{ __('user-portal.otp_code') }} <span class="required-error text-radical-red">*</span></label>
                                <div class="input-group">
                                    <input class="small-input bg-white margin-5px-bottom required form-control"
                                           type="text" name="otp_code" id="otp_code" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.otp_code')]) }}"
                                           style="padding: 13px 15px;height: auto" required>
                                    <button id="request-btn" type="button"
                                            class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  ml-5"
                                            onclick="requestOTP('withdraw')">
                                        {{__('user-portal.request_otp')}}
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-xl-10 padding-40px-lr padding-1-half-rem-bottom text-center text-md-left">
                                <button onclick="submitWithdraw()" type="button"
                                        class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  "
                                        type="submit">
                                    {{__('global.submit')}}
                                </button>
                            </div>
                        </form>

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
                $('#amount').attr('value', $(this).attr('value'))

            });

            $('.payment-item').first().addClass('select');
            $('#amount').attr('value', $('.payment-item').attr('value'))

            $('.submit').on('click', function () {
                var url = '{{ route('user.withdraw.confirmation', [ 'amount' => ':amount']) }}';
                url = url.replace(':amount', $(this).attr('value'));
                window.location.href = url;
            });
        });
    </script>

    @include('user.components.otp-handle')
    <script>
        function submitWithdraw(){
            //verify otp
            $('#submit-btn').prop("disabled",true);
            $('#submit-btn').html('<i class="fa fa-spinner fa-spin mr-2"></i>{{__('user-portal.loading')}}');
            var formData = {
                "_token": "{{ csrf_token() }}",
                'type': 'bank-setting',
                'otp_code' : $('#otp_code').val(),
            };
            var type = "POST";
            var ajaxurl = '{{ route('user.verifyOTP')}}';
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                success: function (data) {
                    // console.log(data);
                    var decoded = JSON.parse(data);
                    if(decoded.success){
                        localStorage['OTPTimeOut'] = 0;
                        console.log('success');
                        $('#withdraw-confirm-form').append('<input type="hidden" name="amount" value="' + {{ $amount }} + '">');
                        $('#withdraw-confirm-form').submit();
                    }else{
                        $('#submit-btn').prop("disabled",false);
                        $('#submit-btn').html('{{ __('global.submit') }}');
                        alert('Wrong OTP code');
                    }
                },
                error: function (data) {
                    $('#submit-btn').prop("disabled",false);
                    $('#submit-btn').html('{{ __('global.submit') }}');
                    console.log(data);
                }
            });
        }


    </script>
@endsection
