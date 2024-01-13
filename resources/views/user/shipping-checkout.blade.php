@extends('landing.app')



@section('content')
    @include('user.user-header')

    <section class="wow animate__fadeIn animate__animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <form method="post" action="{{ route('user.shipping.payment') }}" class="row" id="top-up-payment-form">
                @csrf
                <input type="hidden" value="{{ $shipping_package->id }}" name="shipping_package_id">
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
                                    {{ __('user-portal.top_up_amount_rm', ['title' => number_format($shipping_package->price,2)]) }}
                                </div>
                                <div class="col-4 text-right">
                                    RM {{ number_format($shipping_package->price,2) }}
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
{{--                    <div class=" padding-5-rem-bottom">--}}
{{--                        <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom"> {{ __('user-portal.otp_code') }} <span--}}
{{--                                class="required-error text-radical-red">*</span></label>--}}
{{--                        <div class="input-group">--}}
{{--                            <input class="small-input bg-white margin-5px-bottom required form-control"--}}
{{--                                   type="text" name="otp_code" id="otp_code" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.otp_code')]) }}"--}}
{{--                                   style="padding: 13px 15px;height: auto" required>--}}
{{--                            <button id="request-btn" type="button"--}}
{{--                                    class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  ml-5"--}}
{{--                                    onclick="requestOTP('top-up')">--}}
{{--                                {{__('user-portal.request_otp')}}--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="col-lg-4">
                    <div class="bg-light-gray padding-50px-all lg-padding-30px-tb lg-padding-20px-lr md-padding-20px-tb">
                        <span class="alt-font text-large text-extra-dark-gray margin-15px-bottom d-inline-block font-weight-500">{{ __('user-portal.cart_totals') }}</span>
                        <table class="w-100 total-price-table">
                            <tbody>
                            <tr>
                                <th class="alt-font w-50 font-weight-700 text-extra-dark-gray">{{ __('user-portal.subtotal') }}</th>
                                <td class="alt-font text-extra-dark-gray">RM {{ number_format( $shipping_package->price ,2) }}</td>
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
                                    <h6 class="d-block alt-font font-weight-500 mb-0 text-extra-dark-gray">RM {{ number_format($shipping_package->price,2) }}</h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <button type="button" onclick="submitTopUpConfirm()"
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
            var file_data = $('#receipt').prop('files')[0];
            var form_data = new FormData();

            form_data.append('size', 2);
            form_data.append('width', 4096);
            form_data.append('height', 4096);
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
            {{--$('#submit-btn').prop("disabled", true);--}}
            {{--$('#submit-btn').html('<i class="fa fa-spinner fa-spin mr-2"></i>{{__('user-portal.loading')}}');--}}
            {{--var formData = {--}}
            {{--    "_token": "{{ csrf_token() }}",--}}
            {{--    'type': 'bank-setting',--}}
            {{--    'otp_code': $('#otp_code').val(),--}}
            {{--};--}}
            {{--var type = "POST";--}}
            {{--var ajaxurl = '{{ route('user.verifyOTP')}}';--}}
            {{--$.ajax({--}}
            {{--    type: type,--}}
            {{--    url: ajaxurl,--}}
            {{--    data: formData,--}}
            {{--    success: function (data) {--}}
            {{--        // console.log(data);--}}
            {{--        var decoded = JSON.parse(data);--}}
            {{--        if (decoded.success) {--}}
            {{--            localStorage['OTPTimeOut'] = 0;--}}
            {{--            console.log('success');--}}
                        $('#top-up-payment-form').submit();
            {{--        } else {--}}
            {{--            $('#submit-btn').prop("disabled", false);--}}
            {{--            $('#submit-btn').html('{{ __('user-portal.request_otp') }}');--}}
            {{--            alert('Wrong OTP code');--}}
            {{--        }--}}
            {{--    },--}}
            {{--    error: function (data) {--}}
            {{--        $('#submit-btn').prop("disabled", false);--}}
            {{--        $('#submit-btn').html('{{ __('user-portal.request_otp') }}');--}}
            {{--        console.log(data);--}}
            {{--    }--}}
            {{--});--}}
        }


    </script>
@endsection
