@extends('landing.app')



@section('content')
    @include('user.user-header')

    <section class="wow animate__fadeIn animate__animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <form method="post" action="{{ route('user.top-up.payment') }}" class="row" id="top-up-payment-form">
                @csrf
                <input type="hidden" value="{{ $point_package->id }}" name="point_package_id">
                <div class="col-lg-8 padding-70px-right lg-padding-30px-right md-padding-15px-right">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="alt-font text-large text-extra-dark-gray font-weight-700">{{ __('user-portal.payment') }}</span>
                            @if ($errors->any())
                                <div class="col-md-12 margin-5px-bottom">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->getMessages() as $key => $error)
                                                <li>{{ $error[0] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <hr>
                            <div class="margin-3-half-rem-tb row">
                                <div class="col-8">
                                    @if($point_package->id != 99)
                                        {{ __('user-portal.top_up_amount_rm', ['title' => number_format($point_package->price,2)]) }}
                                    @else
                                        @if(Request::is('user/top-up-checkout-executive/*'))
                                            {{ __('user-portal.top_up_amount_rm', ['title' => number_format(110 - (getUserExecutivePointBalance(Auth::user()->id) % 110),2)]) }}
                                        @elseif(Request::is('user/top-up-checkout-manager/*'))
                                            {{ __('user-portal.top_up_amount_rm', ['title' =>  number_format(100 - (getUserManagerPointBalance(Auth::user()->id) % 100),2)]) }}
                                        @endif
                                    @endif


                                </div>
                                <div class="col-4 text-right">

                                    @if($point_package->id != 99)
                                        RM {{ number_format($point_package->price,2) }}
                                    @else
                                        @if(Request::is('user/top-up-checkout-executive/*'))
                                            RM {{ number_format(110 - (getUserExecutivePointBalance(Auth::user()->id) % 110),2) }}
                                        @elseif(Request::is('user/top-up-checkout-manager/*'))
                                            RM {{ number_format(100 - (getUserManagerPointBalance(Auth::user()->id) % 100),2) }}
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    @if(Auth::user()->roles[0]->id == '2')
                        <div class="row align-items-center" id="payable-info">
                            <div class="col-12">
                                <span class="alt-font text-large text-extra-dark-gray">{{ __('user-portal.payments_are_payable_to') }}</span>

                            </div>
                            <div class="col-6 margin-1-half-rem-bottom">
                                <span class="alt-font text-medium dark-gold">{{ __('user-portal.bank_name') }}</span>
                                <div>
                                    <span class="alt-font text-medium text-extra-dark-gray">{{ $deposit_bank->bank->bank_name }}</span>
                                </div>
                            </div>
                            <div class="col-6 margin-1-half-rem-bottom">
                                <span class="alt-font text-medium dark-gold">{{ __('user-portal.bank_account') }}</span>
                                <div>
                                    <span class="alt-font text-medium text-extra-dark-gray">{{$deposit_bank->bank_account_number}}</span>
                                </div>
                            </div>
                            <div class="col-6 margin-1-half-rem-bottom">
                                <span class="alt-font text-medium dark-gold">{{ __('user-portal.beneficiary_name') }}</span>
                                <div>
                                    <span class="alt-font text-medium text-extra-dark-gray">{{$deposit_bank->bank_account_name}}</span>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.upload_proof_of_payment') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px bg-white" type="file" name="file" id="receipt" accept="image/*"
                                       placeholder="{{ __('user-portal.select_file_to_upload') }}" required>
                            </div>
                            <div class="col-md-6 md-margin-50px-bottom sm-margin-20px-bottom">

                            </div>
                        </div>
                    @else
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="alt-font text-large text-extra-dark-gray">{{ __('user-portal.please_upload_receipt_for_your_upline_to_verify') }}</span>
                            </div>
                            <div class="col-6 margin-1-half-rem-bottom">
                                <span class="alt-font text-medium dark-gold">{{ __('user-portal.bank_name') }}</span>
                                <div>
                                    <span class="alt-font text-medium text-extra-dark-gray">{{ $direct_upline->bank_name }}</span>
                                </div>
                            </div>
                            <div class="col-6 margin-1-half-rem-bottom">
                                <span class="alt-font text-medium dark-gold">{{ __('user-portal.bank_account') }}</span>
                                <div>
                                    <span class="alt-font text-medium text-extra-dark-gray">{{$direct_upline->bank_account_number}}</span>
                                </div>
                            </div>
                            <div class="col-6 margin-1-half-rem-bottom">
                                <span class="alt-font text-medium dark-gold">{{ __('user-portal.beneficiary_name') }}</span>
                                <div>
                                    <span class="alt-font text-medium text-extra-dark-gray">{{$direct_upline->bank_account_name}}</span>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.upload_proof_of_payment') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px bg-white" type="file" name="file" id="receipt" accept="image/*"
                                       placeholder="{{ __('user-portal.select_file_to_upload') }}" required>
                            </div>
                            <div class="col-md-6 md-margin-50px-bottom sm-margin-20px-bottom">

                            </div>
                        </div>
                    @endif
                    <hr>
                    <div class=" padding-5-rem-bottom">
                        <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom"> {{ __('user-portal.otp_code') }} <span
                                class="required-error text-radical-red">*</span></label>
                        <div class="input-group">
                            <input class="small-input bg-white margin-5px-bottom required form-control"
                                   type="text" name="otp_code" id="otp_code" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.otp_code')]) }}"
                                   style="padding: 13px 15px;height: auto" required>
                            <button id="request-btn" type="button"
                                    class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  ml-5"
                                    onclick="requestOTP('top-up')">
                                {{__('user-portal.request_otp')}}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-light-gray padding-50px-all lg-padding-30px-tb lg-padding-20px-lr md-padding-20px-tb">
                        <span class="alt-font text-large text-extra-dark-gray margin-15px-bottom d-inline-block font-weight-500">{{ __('user-portal.cart_totals') }}</span>
                        <table class="w-100 total-price-table">
                            <tbody>
                            <tr>
                                <th class="alt-font w-50 font-weight-700 text-extra-dark-gray">{{ __('user-portal.subtotal') }}</th>
                                <td class="alt-font text-extra-dark-gray">
                                    @if($point_package->id != 99)
                                        RM {{ number_format($point_package->price,2) }}
                                    @else
                                        @if(Request::is('user/top-up-checkout-executive/*'))
                                            RM {{ number_format(110 - (getUserExecutivePointBalance(Auth::user()->id) % 110),2) }}
                                        @elseif(Request::is('user/top-up-checkout-manager/*'))
                                            RM {{ number_format(100 - (getUserManagerPointBalance(Auth::user()->id) % 100),2) }}
                                        @endif
                                    @endif

                                </td>
                            </tr>
                            <tr class="shipping">
                                <th class="font-weight-500 text-extra-dark-gray">{{ __('user-portal.payment_method') }}</th>
                                <td data-title="Shipping">
                                    <ul class="float-lg-left float-right text-left line-height-36px">
                                        @foreach($payment_methods as $id => $payment_method)
                                            <li class="d-flex align-items-center md-margin-15px-bottom">
                                                <input id="payment_method{{$id}}" type="radio" name="payment_method" value="{{ $id }}"
                                                       class="d-block w-auto margin-10px-right mb-0 payment_method"
                                                       checked="checked">
                                                <label class="md-line-height-18px" for="payment_method{{$id}}">{{ $payment_method  }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr class="total-amount">
                                <th class="font-weight-500 text-extra-dark-gray">{{ __('user-portal.total') }}</th>
                                <td data-title="Total">
                                    <h6 class="d-block alt-font font-weight-500 mb-0 text-extra-dark-gray">
                                        @if($point_package->id != 99)
                                            RM {{ number_format($point_package->price,2) }}
                                        @else
                                            @if(Request::is('user/top-up-checkout-executive/*'))
                                                RM {{ number_format(110 - (getUserExecutivePointBalance(Auth::user()->id) % 110),2) }}
                                            @elseif(Request::is('user/top-up-checkout-manager/*'))
                                                RM {{ number_format(100 - (getUserManagerPointBalance(Auth::user()->id) % 100),2) }}
                                            @endif
                                        @endif

                                    </h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <button type="button" onclick="submitTopUpConfirm()" id="submit-btn"
                                    class="btn bg-dark-gold text-white btn-large d-block btn-fancy margin-15px-top w-100">{{ __('user-portal.proceed_to_payment') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection


@section('js')
    <script>
        $(document).ready(function () {
            $("input[type=radio]").first().click();
            //follow seeder id 1 equals upload receipt
            if ($('#payment_method1').is(':checked')) {
                $("#payable-info").removeClass('d-none');
                $("input").prop('required', true);
            } else {
                $("#payable-info").addClass('d-none');
                $("input").prop('required', false);
            }
            $('.payment_method').click(function () {
                if ($('#payment_method1').is(':checked')) {
                    $("#payable-info").removeClass('d-none');
                    $("input").prop('required', true);
                } else {
                    $("#payable-info").addClass('d-none');
                    $("input").prop('required', false);
                }
            });
        });

        $('#receipt').change(function () {
            $('#submit-btn').prop("disabled", true);
            var file_data = $('#receipt').prop('files')[0];
            var form_data = new FormData();

            form_data.append('size', 10);
            form_data.append('width', 10096);
            form_data.append('height', 10096);
            form_data.append('file', file_data);
            form_data.append('_token', '{{ csrf_token() }}')
            $.ajax({
                url: "{{route('user.storeMedia')}}",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    $('#submit-btn').prop("disabled", false);
                    $('#top-up-payment-form').append('<input type="hidden" name="receipt" value="' + data.name + '">');
                    // $('#profile_upload_form').submit();
                }
            });
        });

    </script>

    @include('user.components.otp-handle')
    <script>
        function submitTopUpConfirm() {
            //verify otp
            $('#submit-btn').prop("disabled", true);
            $('#submit-btn').html('<i class="fa fa-spinner fa-spin mr-2"></i>{{__('user-portal.loading')}}');
            var formData = {
                "_token": "{{ csrf_token() }}",
                'type': 'bank-setting',
                'otp_code': $('#otp_code').val(),
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
                    if (decoded.success) {
                        localStorage['OTPTimeOut'] = 0;
                        console.log('success');
                        $('#top-up-payment-form').submit();
                    } else {
                        $('#submit-btn').prop("disabled", false);
                        $('#submit-btn').html('{{ __('user-portal.request_otp') }}');
                        alert('Wrong OTP code');
                    }
                },
                error: function (data) {
                    $('#submit-btn').prop("disabled", false);
                    $('#submit-btn').html('{{ __('user-portal.request_otp') }}');
                    console.log(data);
                }
            });
        }


    </script>
@endsection
