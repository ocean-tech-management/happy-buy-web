@extends('landing.app')

@section('content')
    @include('user.user-header')
    <div class="cover-background"
         style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-12 col-lg-4 col-md-4 sm-margin-30px-bottom">
                        <div
                            class="bg-white shadow padding-1-rem-top wow animate__fadeIn border-radius-5px"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="border-radius-5px ">
                                <ul class="col-12 list-style-07" style="line-height: 5px;">
                                    <li class=" border-bottom border-color-medium-dark-gray "
                                        style="margin-bottom: 4px ">
                                        <a class="margin-1-half-rem-lr text-extra-medium {{ Route::current()->getName() == "user.password.edit"? "dark-gold" : "text-gray" }} padding-1-rem-tb "
                                           style="width: 100%;" href="{{ route('user.password.edit') }}"> {{__('user-portal.change_password')}}</a>
                                    </li>
                                    <li class=" @if(getUserSignedQuitAgreement(Auth::user()->id) == 0) border-bottom border-color-medium-dark-gray @endif" style="margin-bottom: 4px">
                                        <a class="margin-1-half-rem-lr text-extra-medium {{ Route::current()->getName() == "user.bank-setting"? "dark-gold" : "text-gray" }} padding-1-rem-tb "
                                           style="width: 100%" href="{{ route('user.bank-setting') }}"> {{ __('user-portal.bank_setting') }}</a>
                                    </li>
                                    @if(Auth::user()->roles[0]->id == 2)
                                        @if(getUserSignedQuitAgreement(Auth::user()->id) == 0)
                                            <li class=" " style="margin-bottom: 4px">
                                                <a class="margin-1-half-rem-lr text-extra-medium {{ Route::current()->getName() == "user.bank-setting"? "dark-gold" : "text-gray" }} padding-1-rem-tb "
                                                   style="width: 100%" href="{{ route('user.quit-agreement-form') }}"> {{ __('user-portal.quit') }}</a>
                                            </li>
                                        @endif
                                    @endif

                                        {{--                                    <li class=" " style="margin-bottom: 4px">--}}
{{--                                        <a class="margin-1-half-rem-lr text-extra-medium text-gray padding-1-rem-tb" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"--}}
{{--                                           style="width: 100%">  {{ trans('global.logout') }} </a>--}}
{{--                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>

                    <form id="bank-setting-form" method="POST" action="{{route('user.bank-setting.submit')}}"
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom">
                        @csrf

                        @if(session('message'))
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="row align-items-center">
                            <div class="col-12 col-xl-7  padding-1-half-rem-bottom">
                                <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom">{{ __('user-portal.bank') }} <span class="required-error text-radical-red">*</span></label>
                                <select name="bank" id="bank"
                                        class="dropdown small-input border-radius-5px">
                                    <option>{{ __('user-portal.select_', ['title'=> __('user-portal.bank')]) }}</option>
                                    @foreach($bank_list as $bank)
                                        <option value="{{$bank->id}}" {{ (Auth::user()->bank_name == $bank->bank_name) ? 'selected' : '' }}>{{$bank->bank_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-12 col-xl-7 padding-1-half-rem-bottom">
                                <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom">{{__('user-portal.bank_account')}}<span class="required-error text-radical-red">*</span></label>
                                <input class="small-input bg-white margin-5px-bottom required" type="text" value="{{ Auth::user()->bank_account_number == NULL ? "" : Auth::user()->bank_account_number }}"
                                       name="bank_account" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.bank_account')]) }}">
                            </div>
                            <div class="col-4"></div>
                            <div class="col-12 col-xl-7 padding-1-half-rem-bottom">
                                <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom">{{__('user-portal.beneficiary_name')}}<span class="required-error text-radical-red">*</span></label>
                                <input class="small-input bg-white margin-5px-bottom required" type="text" value="{{ Auth::user()->bank_account_name == NULL ? "" : Auth::user()->bank_account_name }}"
                                       name="beneficiary_name" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.beneficiary_name')]) }}">
                            </div>
                            <div class="col-4"></div>

                            <div class="col-12 col-xl-10 padding-5-rem-bottom">
                                <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom"> {{ __('user-portal.otp_code') }} <span class="required-error text-radical-red">*</span></label>
                                <div class="input-group">
                                    <input class="small-input bg-white margin-5px-bottom required form-control"
                                           type="text" name="otp_code" id="otp_code" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.otp_code')]) }}"
                                           style="padding: 13px 15px;height: auto" required>
                                    <button id="request-btn" type="button"
                                        class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  ml-5"
                                        onclick="requestOTP('bank-setting')">
                                        {{__('user-portal.request_otp')}}
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 col-xl-10 padding-1-half-rem-bottom text-center text-md-left">
                                <button onclick="submitSettingBank()" type="button"
                                    class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px  "
                                    type="submit">
                                    {{__('global.submit')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    @include('user.components.otp-handle')
    <script>
        function submitSettingBank(){
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
                        $('#bank-setting-form').submit();
                    }else{
                        $('#submit-btn').prop("disabled",false);
                        $('#submit-btn').html('{{ __('global.submit') }}');
                        alert('Wrong OTP code');
                    }
                },
                error: function (data) {
                    $('#submit-btn').prop("disabled",false);
                    $('#submit-btn').html('{{ __('global.submit') }}');
                    // console.log(data);
                }
            });
        }


    </script>
@endsection
