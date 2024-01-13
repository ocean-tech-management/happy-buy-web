@extends('landing.app')

@section('content')
    <!-- start section -->
    <section class=" wow animate__fadeIn cover-background"
             style="background-image: url('{{asset('landing/images/product-details_banner.png')}}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row col-12  justify-content-center" style="max-width: 935px;">
                    <h6 class="title-small alt-font font-weight-300 dark-gold">{{ __('user-portal.upgrade_account') }}</h6>
                    <form method="post" action="{{ ($type == 'million') ? route('user.upgrade-account-millionaire') : (($type == 'manager') ? route('user.upgrade-account-manager'):route('user.upgrade-account-executive2')) }}"
                          id="payment-info-form" enctype="multipart/form-data"
                          class="bg-white padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-alls shadow">
                        @csrf
{{--                        <input name="point_package" value="{{ $point_package->id }}" type="hidden"/> --}}
                        <div class="row">
                            @if ($errors->any())
                                <div class="col-md-12 margin-5px-bottom">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12 margin-5px-bottom">
                                 <span class="text-extra-dark-gray text-extra-medium alt-font">
                                        {{ __('user-portal.payment') }}
                                </span>
                                <br>
                                @if($type == 'million')
                                    <span class="text-extra-medium text-dark-gray ">
                                        {{ __('user-portal.you_are_required_to_pay_a_fee_of_to_upgrade_to_merchant', ['amount' => number_format(15000+3000)]) }}
                                    </span>

                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-6 col-md-2">
                                            <span> {{ __('user-portal.deposit') }}:  </span>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            RM 3,000
                                            <input name="deposit" value="3000" type="hidden"/>
                                        </div>
                                        <div class="col-6 col-md-2">
                                            <span> {{ __('cruds.userEntry.fields.fee') }}: </span>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            RM {{number_format(15000)}}
                                            <input name="fee" value="15000" type="hidden"/>
                                        </div>

{{--                                        <div class="col-6 col-md-2">--}}
{{--                                            <span>{{ __('user-portal.top_up') }}: </span>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-6 col-md-4">--}}
{{--                                            RM {{ number_format($point_package->price,2) }}--}}
{{--                                        </div>--}}

                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-6 col-md-2">

                                        </div>
                                        <div class="col-6 col-md-4">

                                        </div>
                                        <div class="col-6 col-md-2">
                                            <span>  Total: </span>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            RM {{number_format(15000+3000)}}
                                        </div>
                                    </div>
                                @elseif($type == 'manager')
                                    <span class="text-extra-medium text-dark-gray ">
                                    {{ __('user-portal.you_are_required_to_pay_a_fee_of_to_your_upline_to_upgrade_to_manager', ['amount' => 0]) }}
                                </span>
                                @else
                                    <span class="text-extra-medium text-dark-gray ">
                                    {{ __('user-portal.you_are_required_to_pay_a_fee_of_to_your_upline_to_upgrade_to_executive', ['amount' => 0]) }}
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12 margin-5px-bottom">
                                <hr>
                            </div>
                            <div class="col-md-12 margin-5px-bottom">
                                <div class="row">
                                <div class="col-12">
                                    <span class="alt-font text-large text-extra-dark-gray">{{ __('user-portal.payment_method') }}</span>
                                </div>
                                </div>
                                <ul class="line-height-36px">

                                    @foreach($payment_methods as $id => $payment_method)
                                        <li class="d-flex align-items-center md-margin-15px-bottom">
                                            <input id="payment_method{{$id}}" type="radio" name="payment_method" value="{{ $id }}"
                                                   class="d-block w-auto margin-10px-right mb-0 payment_method"
                                                   checked="checked">
                                            <label class="md-line-height-18px" for="payment_method{{$id}}">{{ $payment_method  }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-12 margin-5px-bottom">
                                <hr>
                            </div>
                            @if($type == 'million')
                                <div class="col-md-12 align-items-center" id="payable-info">
                                    <div class="row">
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
                                            <input class="small-input border-all border-radius-5px bg-white" type="file" name="receipt" id="receipt" accept="image/*"
                                                   placeholder="{{ __('user-portal.select_file_to_upload') }}">
                                        </div>
                                        <div class="col-md-6 md-margin-50px-bottom sm-margin-20px-bottom"></div>
                                    </div>
                                </div>
                            @elseif($type='manager' || $type='executive')
                                <div class="col-md-12 align-items-center" id="payable-info">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="alt-font text-large text-extra-dark-gray">{{ __('user-portal.payments_are_payable_to') }}</span>

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
                                            <input class="small-input border-all border-radius-5px bg-white" type="file" name="receipt" id="receipt" accept="image/*"
                                                   placeholder="{{ __('user-portal.select_file_to_upload') }}" required>
                                        </div>
                                        <div class="col-md-6 md-margin-50px-bottom sm-margin-20px-bottom"></div>
                                    </div>
                                </div>

                            @endif

                            <div class="col-md-12 margin-10px-bottom text-center">
                                <button id="submit-btn" type="submit"
                                        class=" text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-2-half-rem-lr "
                                        style="margin-top: 3.5rem!important;" disabled>
                                    {{ __('global.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </section>
    <!-- end section -->
@endsection

@section('js')
    @include('user.components.otp-handle')
    <script>


        $('#receipt').change(function () {
            $('#submit-btn').attr('disabled', true);
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
                    // $('#submit-btn').attr('disabled', false);
                    $('#payable-info').append('<input type="hidden" name="receipt" value="' + data.name + '">');
                    //upload second time for another upload
                    upload_second_time();

                }
            });
        });

        function upload_second_time(){
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
                    $('#submit-btn').attr('disabled', false);
                    $('#payable-info').append('<input type="hidden" name="receipt_photo" value="' + data.name + '">');

                }
            });
        }

        // $('#submit-btn').on('click', function(){
        //     console.log("aa");
        //     $('#payment-info-form').submit();
        // });

        $('.payment_method').on('click', function () {
            payment_method = $(this).attr('value');
            console.log(payment_method);
            if (payment_method == 2) {
                $('#submit-btn').attr('disabled', false);
                $('#payable-info').addClass('d-none');
            } else {
                $('#submit-btn').attr('disabled', true);
                $('#payable-info').removeClass('d-none');
            }
        });
        $('.payment_method').first().click();


    </script>
@endsection
