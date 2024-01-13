@extends('landing.app')

@section('content')
    <!-- start section -->
    <section class=" wow animate__fadeIn cover-background"
             style="background-image: url('{{asset('landing/images/product-details_banner.png')}}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row col-12  justify-content-center" style="max-width: 535px;">
                    <h6 class="col-12 title-small alt-font font-weight-300 dark-gold text-center">{{ __('user-portal.reset_password') }}</h6>

                    <form method="post" action="{{ route('password.update') }}"
                        class=" bg-white padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-alls shadow">
                        @csrf
                        <div class="row">
                            @if ($errors->any())
                                <div class=" margin-5px-bottom">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                                <input type="hidden" name="email" value="{{ $email }}"/>
                                <input type="hidden" name="token" value="{{ $token }}"/>
                                <div class="col-md-12 margin-10px-bottom">
                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.password') }} <span
                                            class="text-radical-red">*</span></label>
                                    <input class="small-input border-all border-radius-5px" type="password" name="password"
                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.password')]) }}" required>
                                </div>
                                <div class="col-md-12 margin-10px-bottom">
                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.confirm_password') }} <span
                                            class="text-radical-red">*</span></label>
                                    <input class="small-input border-all border-radius-5px" type="password"
                                           name="password_confirmation" placeholder="{{ __('user-portal.reenter_your_password') }}" required>
                                </div>


                            <div class="col-md-12 margin-10px-bottom text-center">
                                <button id="submit-btn" type="submit"
                                        class=" text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-2-half-rem-lr "
                                        style="margin-top: 3.5rem!important;">
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
    {{--    @include('user.components.otp-handle')--}}
    <script>
        {{--function verifyOTP(){--}}
        {{--    $('#submit-btn').prop("disabled",true);--}}
        {{--    $('#submit-btn').html('<i class="fa fa-spinner fa-spin mr-2"></i>{{__('user-portal.loading')}}');--}}
        {{--    var formData = {--}}
        {{--        "_token": "{{ csrf_token() }}",--}}
        {{--        'type': 'register',--}}
        {{--        'otp_code' : $('#otp_code').val(),--}}
        {{--    };--}}
        {{--    var type = "POST";--}}
        {{--    var ajaxurl = '{{ route('user.verifyOTP')}}';--}}
        {{--    $.ajax({--}}
        {{--        type: type,--}}
        {{--        url: ajaxurl,--}}
        {{--        data: formData,--}}
        {{--        success: function (data) {--}}
        {{--            // console.log(data);--}}
        {{--            var decoded = JSON.parse(data);--}}
        {{--            if(decoded.success){--}}
        {{--                localStorage['OTPTimeOut'] = 0;--}}
        {{--                window.location.href= '{{ route('user.registerComplete') }}';--}}
        {{--            }else{--}}
        {{--                $('#submit-btn').prop("disabled",false);--}}
        {{--                $('#submit-btn').html('{{ __('user-portal.request_otp') }}');--}}
        {{--                alert('Wrong OTP code');--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (data) {--}}
        {{--            $('#submit-btn').prop("disabled",false);--}}
        {{--            $('#submit-btn').html('{{ __('user-portal.request_otp') }}');--}}
        {{--            // console.log(data);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

    </script>
@endsection
