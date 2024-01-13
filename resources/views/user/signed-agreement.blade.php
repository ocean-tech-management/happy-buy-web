@extends('landing.app')

@section('css')
    <style>
        h2{
            font-size: 1.25rem!important;
        }
        p{
            margin-bottom: 1rem!important;
        }
    </style>
@endsection
@section('content')
    @include('user.user-header')

    <!-- start section -->
    <section class=" wow animate__fadeIn cover-background"
             style="background-image: url('{{asset('landing/images/product-details_banner.png')}}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row col-12  justify-content-center" style="max-width: 935px;">
                    <h6 class="title-small alt-font font-weight-300 dark-gold">{{ __('user-portal.agreement') }}</h6>
                    <div class="bg-white padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-alls shadow">
                        <div class="row">
                            <div>
                                {!!
                                $user_agreement_log->user_agreement->agreement_content;
                             !!}
                            </div>
                            <div class="col-12 margin-10px-bottom padding-4-half-rem-top row justify-content-center">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="alt-font font-weight-700"> {{ __('user-portal.signature_information') }}</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="alt-font"> {{ __('user-portal.full_name') }}: {{ $user_agreement_log->signature_name }}</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="alt-font">{{ __('user-portal.identity_card_passport_number') }}: {{ $user_agreement_log->signature_ic }}</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="alt-font">{{ __('user-portal.date') }}: {{ $user_agreement_log->signature_at }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

{{--                <!-- start contact form -->--}}
{{--                <form id="signing-form" action="{{ route('user.register-agreement-action') }}" method="post" class="white-popup-block col-xl-3 col-lg-7 col-sm-9  p-0 mx-auto mfp-hide">--}}
{{--                    @csrf--}}
{{--                    <div class="padding-ten-all bg-white border-radius-6px xs-padding-six-all">--}}
{{--                        <h6 class="text-extra-dark-gray alt-font font-weight-500 margin-35px-bottom xs-margin-15px-bottom">--}}
{{--                            {{ __('user-portal.confirmation') }}--}}
{{--                        <p  class="text-text-dark-gray alt-font text-extra-medium margin-35px-bottom xs-margin-15px-bottom line-height-18px"> {{ __('user-portal.confirmation_msg') }}</p>--}}
{{--                        </h6>--}}
{{--                        <div>--}}
{{--                            <label class="text-extra-dark-gray alt-font margin-15px-bottom" for="birthday">{{ __('user-portal.full_name') }} <span--}}
{{--                                    class="text-radical-red">*</span></label>--}}
{{--                            <input class="medium-input margin-25px-bottom xs-margin-10px-bottom required" type="text" name="fullname" placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.full_name')]) }}" required>--}}
{{--                            <label class="text-extra-dark-gray alt-font margin-15px-bottom" for="birthday">{{ __('user-portal.identity_card_passport_number') }} <span--}}
{{--                                    class="text-radical-red">*</span></label>--}}
{{--                            <input class="medium-input margin-25px-bottom xs-margin-10px-bottom required" type="text" name="identity_id" placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.identity_card_passport_number')]) }}" required>--}}

{{--                            <button class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px margin-1-half-rem-top w-100" type="submit">--}}
{{--                                {{__('global.submit')}}</button>--}}
{{--                            <div class="form-results d-none"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                <!-- end contact form -->--}}

            </div>
        </div>
    </section>
    <!-- end section -->
@endsection
