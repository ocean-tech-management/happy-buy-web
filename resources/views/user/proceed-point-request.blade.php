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
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-5">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.point_request') }}</span>
                                    </div>
                                    <div class="col-7 row justify-content-end">

                                    </div>
                                </div>
                            </div>
                            <hr>
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
                            @if(Auth::user()->roles[0]->id == 2)
                                @if(getUserPointBalance(Auth::user()->id) < $transactionAgentTopUp->amount)
                                    <div class="col-md-12 margin-5px-bottom">
                                        <div class="alert alert-danger">
                                            {{ __('user-portal.insufficient_point_balance') }}
                                        </div>
                                    </div>
                                @endif
                            @elseif(Auth::user()->roles[0]->id == 4)
                                @if(getUserManagerPointBalance(Auth::user()->id) < $transactionAgentTopUp->amount)
                                    <div class="col-md-12 margin-5px-bottom">
                                        <div class="alert alert-danger">
                                            {{ __('user-portal.insufficient_point_balance') }}
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <form method="POST" action="{{route('user.point-transfer', ['id' =>$transactionAgentTopUp->id ])}}" id="point-transfer-form"
                                  class="padding-4-rem-lr padding-4-rem-bottom lg-margin-35px-top md-padding-2-half-rem-alls  row justify-content-center">
                                @csrf
                                <label class="text-extra-medium text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.transfer_amount') }}</label>
                                <div style="width: 100% " class="row justify-content-center">
                                    <input class="small-input bg-white margin-40px-bottom required"
                                           style="max-width: 450px;text-align: center" type="number" name="amount"
                                           placeholder="{{ number_format( $transactionAgentTopUp->amount) }} PV" disabled/>
                                </div>
                                <label class="text-medium text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.to_downline') }}</label>
                                <div class="col-12  margin-20px-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-5">
                                            <div class="row align-items-center">
                                                <img class="rounded-circle h-70px w-70px {{ $transactionAgentTopUp->user->profile_photo ? "cover-img" : ""}} bg-dark-gold"
                                                     src="{{ $transactionAgentTopUp->user->profile_photo ? $transactionAgentTopUp->user->profile_photo->url : asset('landing/images/default_profile.png') }}"/>
                                                <div class="pl-3">
                                                    <div class="line-height-16px">
                                                        <span
                                                            class="alt-font text-extra-dark-gray text-small font-weight-700">{{ $transactionAgentTopUp->user->name }}</span>
                                                    </div>
                                                    <div class="line-height-16px">
                                                        <span class="alt-font text-gray text-small font-weight-300">{{ $transactionAgentTopUp->user->personal_code }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-5">
                                            <div class="row" style="display: grid">
                                                <div class="line-height-16px">
                                                    <span class="alt-font text-gray text-small font-weight-300">{{ $transactionAgentTopUp->user->email }}</span>
                                                </div>
                                                <div class="line-height-16px">
                                                    <span class="alt-font text-gray text-small font-weight-300">{{ $transactionAgentTopUp->user->phone }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-2">
                                            <div class="row align-items-center">
                                                <div class="line-height-16px">
                                                    <span
                                                        class="alt-font text-gray text-small font-weight-300">
                                                        {{ str_replace('Merchant-', '', str_replace('Agent-', '', $transactionAgentTopUp->user->roles[0]->name))  }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="text-medium text-extra-dark-gray alt-font margin-15px-tb">{{ __('user-portal.upload_receipt') }}</label>
                                        @if( $transactionAgentTopUp->receipt_photo)
                                        <div class="col-12">
                                            <a class="modal-popup" href="#modal-popup"><img class="h-100px w-auto" src="{{ $transactionAgentTopUp->receipt_photo->url }}"/></a>
                                            <div id="modal-popup"
                                                 class="col-11 col-xl-6 col-lg-6 col-md-8 col-sm-9 mx-auto bg-white text-center modal-popup-main padding-2-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">
                                                <img class="w-100 margin-1-half-rem-bottom" src="{{ $transactionAgentTopUp->receipt_photo->url }}"/>
                                                <a class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px popup-modal-dismiss"
                                                   href="#">{{ __('user-portal.dismiss') }}</a>
                                            </div>
                                        </div>
                                        @else
                                            <div class="col-12">
                                                No Receipt found. Suggested action: <font class="text-danger">Reject order</font>
                                            </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>

                                @if(Auth::user()->roles[0]->id == 2)
                                    @if(getUserPointBalance(Auth::user()->id) > $transactionAgentTopUp->amount)
                                        <div class="col-12 col-xl-12 padding-5-rem-bottom">
                                            <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom"> {{ __('user-portal.otp_code') }} <span
                                                    class="required-error text-radical-red">*</span></label>
                                            <div class="input-group">
                                                <input class="small-input bg-white margin-5px-bottom required form-control"
                                                       type="text" name="otp_code" id="otp_code" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.otp_code')]) }}"
                                                       style="padding: 13px 15px;height: auto" required>
                                                <button id="request-btn" type="button"
                                                        class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  ml-5"
                                                        onclick="requestOTP('point-transfer')">
                                                    {{__('user-portal.request_otp')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-10 padding-5-rem-top justify-content-sm-center row justify-content-center">
                                            <button type="submit" form="form-delete"
                                                    class="text-medium alt-font font-weight-300 btn btn-shadow btn-danger text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  mr-2">
                                                {{__('global.reject')}}
                                            </button>
                                            <button onclick="submitTransfer()" type="button"
                                                    class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  ">
                                                {{__('user-portal.transfer')}}
                                            </button>
                                        </div>

                                    @endif

                                @elseif(Auth::user()->roles[0]->id == 4)
                                    @if(getUserManagerPointBalance(Auth::user()->id) > $transactionAgentTopUp->amount)
                                        <div class="col-12 col-xl-12 padding-5-rem-bottom">
                                            <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom"> {{ __('user-portal.otp_code') }} <span
                                                    class="required-error text-radical-red">*</span></label>
                                            <div class="input-group">
                                                <input class="small-input bg-white margin-5px-bottom required form-control"
                                                       type="text" name="otp_code" id="otp_code" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.otp_code')]) }}"
                                                       style="padding: 13px 15px;height: auto" required>
                                                <button id="request-btn" type="button"
                                                        class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  ml-5"
                                                        onclick="requestOTP('point-transfer')">
                                                    {{__('user-portal.request_otp')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-10 padding-5-rem-top justify-content-sm-center row justify-content-center">
                                            <button type="submit" form="form-delete"
                                                    class="text-medium alt-font font-weight-300 btn btn-shadow btn-danger text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  mr-2">
                                                {{__('global.reject')}}
                                            </button>
                                            <button onclick="submitTransfer()" type="button"
                                                    class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  ">
                                                {{__('user-portal.transfer')}}
                                            </button>
                                        </div>
                                    @endif
                                @endif


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <form method="post" action="{{route('user.point-transfer-reject', ['id' => $transactionAgentTopUp->id])}}" onsubmit="console.log('1');return confirm('{{ trans('global.areYouSure') }}');" id="form-delete">
        @csrf
    </form>
@endsection

@section('js')
    @include('user.components.otp-handle')
    <script>
        function submitTransfer() {
            //verify otp
            $('#submit-btn').prop("disabled", true);
            $('#submit-btn').html('<i class="fa fa-spinner fa-spin mr-2"></i>{{__('user-portal.loading')}}');
            var formData = {
                "_token": "{{ csrf_token() }}",
                'type': 'point-transfer',
                'otp_code': $('#otp_code').val(),
            };
            var type = "POST";
            var ajaxurl = '{{ route('user.verifyOTP')}}';
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                success: function (data) {
                    console.log(data);
                    var decoded = JSON.parse(data);
                    if (decoded.success) {
                        localStorage['OTPTimeOut'] = 0;
                        console.log('success');
                        $('#point-transfer-form').submit();
                    } else {
                        $('#submit-btn').prop("disabled", false);
                        $('#submit-btn').html('{{ __('user-portal.request_otp') }}');
                        alert('Wrong OTP code');
                    }
                },
                error: function (data) {
                    $('#submit-btn').prop("disabled", false);
                    $('#submit-btn').html('{{ __('user-portal.request_otp') }}');
                    // console.log(data);
                }
            });
        }


    </script>
@endsection

