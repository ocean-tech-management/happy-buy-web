@extends('landing.app')

@section('content')
    <!-- start section -->
    <section class=" wow animate__fadeIn cover-background"
             style="background-image: url('{{asset('landing/images/product-details_banner.png')}}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row  col-12  justify-content-center" style="max-width: 935px;">
                    <h6 class="col-12 title-small alt-font font-weight-300 dark-gold text-center">{{ __('user-portal.upgrade_account') }}</h6>
                    @if ($errors->any())
                        <div class=" margin-5px-bottom ">
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($transactionagentTopup_pending || $transactionagentTopupExecutive_pending || $userEntryMillionaire_pending)
                        <div class="bg-white padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-alls shadow">
                            <div class="row">
                                <div class="col-md-12">
                                     <span class="text-extra-dark-gray text-uppercase text-extra-medium alt-font">
                                            {{ __('user-portal.upgrade_in_progress') }}
                                    </span>
                                    <br>
                                    <div class="">
                                        <span class=" alt-font">
                                            {{ __('user-portal.your_upgrade_is_processing_please_wait_for_3_to_5_wokring_days_for_approval') }}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-12 margin-5px-bottom">
                                    <hr>
                                </div>



                                @if($transactionagentTopupExecutive_pending)
                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ __('user-portal.upgrade_to_executive') }}
                                    </div>

                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ $transactionagentTopupExecutive_pending->created_at }}
                                    </div>

                                    <div class="col-md-4 margin-10px-bottom text-right">
                                        <div
                                            class="text-extra-small w-100 alt-font font-weight-500 text-warning text-uppercase mr-1"
                                            style="padding: 3px 10px;">

                                            {{__('user-portal.pending') }}<br>
                                        </div>
                                    </div>
                                @endif

                                @if($transactionagentTopup_pending)
                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ __('user-portal.upgrade_to_manager') }}
                                    </div>

                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ $transactionagentTopup_pending->created_at }}
                                    </div>

                                    <div class="col-md-4 margin-10px-bottom text-right">
                                        <div
                                            class="text-extra-small w-100 alt-font font-weight-500 text-warning text-uppercase mr-1"
                                            style="padding: 3px 10px;">

                                            {{__('user-portal.pending') }}<br>
                                        </div>
                                    </div>
                                @endif
                                @if($userEntryMillionaire_pending)
                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ __('user-portal.upgrade_to_millionaire') }} <br>
                                        @if($userEntryMillionaire_pending->receipt)
                                        <a class="modal-popup alt-font" href="#modal-popup"><i class="fa fa-receipt"></i>  {{__('user-portal.view_receipt')}}</a>
                                        <div id="modal-popup"
                                             class="col-11 col-xl-6 col-lg-6 col-md-8 col-sm-9 mx-auto bg-white text-center modal-popup-main padding-2-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">
                                            <img class="w-100 margin-1-half-rem-bottom" src="{{ $userEntryMillionaire_pending->receipt->url }}"/>
                                            <a class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px popup-modal-dismiss"
                                               href="#">{{ __('user-portal.dismiss') }}</a>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ $userEntryMillionaire_pending->created_at }}
                                    </div>

                                    <div class="col-md-4 margin-10px-bottom text-right">
                                        <div
                                            class="text-extra-small w-100 alt-font font-weight-500  text-warning  text-uppercase mr-1"
                                            style="padding: 3px 10px;">

                                            {{__('user-portal.pending') }}<br>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12 margin-10px-bottom text-center">
                                    <a href="{{ route('user.home') }}"
                                            class=" text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-2-half-rem-lr "
                                            style="margin-top: 3.5rem!important;">
                                        {{ __('global.back') }}
                                    </a>
                                </div>

                            </div>
                        </div>
                    @else

                        @if($userEntryManager || $userEntryMillionaire)
                        <div class="col-12 bg-gray-100 padding-4-rem-lr padding-2-rem-tb lg-margin-35px-top md-padding-2-half-rem-alls ">

                            <div class="row">
                                <div class="col-md-12">
                                     <span class="text-red text-uppercase text-extra-medium alt-font">
                                            {{ __('user-portal.upgrade_rejected') }}
                                    </span>
                                    <br>
                                    <div class="row">
                                    </div>
                                </div>
                                <div class="col-md-12 margin-5px-bottom">
                                     <span class="text-gray text-extra-medium alt-font">
                                            {{ __('user-portal.your_upgrade_has_been_rejected_kindly_contact_your_upline_for_clarification_thank_you') }}
                                    </span>
                                    <br>
                                    <div class="row">
                                    </div>
                                </div>
                                <div class="col-md-12 margin-5px-bottom">
                                    <hr>
                                </div>

                                @if($userEntryManager)
                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ __('user-portal.upgrade_to_manager') }}
                                    </div>

                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ $userEntryManager->created_at }}
                                    </div>

                                    <div class="col-md-4 margin-10px-bottom text-right">
                                        <div
                                            class="text-extra-small w-100 alt-font font-weight-500  {{($userEntryManager->status == 3) ?"text-success" : "text-red" }}  text-uppercase mr-1"
                                            style="padding: 3px 10px;">

                                            {{($userEntryManager->status == 3) ? __('user-portal.completed'): __('global.reject') }}<br>
                                            <span
                                                class="text-medium-gray"> {{ ($userEntryManager->status == 3) ? $userEntryManager->payment_verified_at : $userEntryManager->updated_at}} </span>
                                        </div>
                                    </div>
                                @endif
                                @if($userEntryMillionaire)
                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ __('user-portal.upgrade_to_millionaire') }}
                                    </div>

                                    <div class="col-md-4 margin-5px-bottom">
                                        {{ $userEntryMillionaire->created_at }}
                                    </div>

                                    <div class="col-md-4 margin-10px-bottom text-center">
                                        <div
                                            class="text-extra-small w-100 alt-font font-weight-500  {{($userEntryMillionaire->status == 3) ?"text-success" : "text-red" }}  text-uppercase mr-1"
                                            style="padding: 3px 10px;">

                                            {{($userEntryMillionaire->status == 3) ? __('user-portal.completed'): __('global.reject') }}<br>
                                            <span
                                                class="text-medium-gray"> {{ ($userEntryMillionaire->status == 2) ? $userEntryMillionaire->payment_verified_at : $userEntryMillionaire->updated_at}} </span>
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    @endif

                        <div class="bg-white padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-alls shadow">

                        <div class="row">
{{--                            @if ($errors->any())--}}
{{--                                <div class="col-md-12 margin-5px-bottom">--}}
{{--                                    <div class="alert alert-danger">--}}
{{--                                        <ul>--}}
{{--                                            @foreach ($errors->all() as $error)--}}
{{--                                                <li>{{ $error }}</li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                            <div class="col-md-12 margin-5px-bottom">
                                 <span class="text-extra-dark-gray text-extra-medium alt-font">
                                        {{ __('user-portal.please_select_upgrade_account') }}
                                </span>
                                <br>
                                <div class="row">
                                </div>
                            </div>
                            <div class="col-md-12 margin-5px-bottom">
                                <div class="row">
                                    <ul class="col-12 row line-height-36px">
                                        @if(Auth::user()->roles[0]->id != 4)
                                        <li class="col-6 d-flex align-items-center md-margin-15px-bottom mx-auto">
                                            <input id="manager" type="radio" name="type" class="d-block w-auto margin-10px-right mb-0 upgrade-select" value="manager" checked>
                                            <label class="md-line-height-18px" for="manager"> {{ __('user-portal.upgrade_to_manager') }}</label>
                                        </li>
                                        @endif
                                        <li class="col-6 d-flex align-items-center md-margin-15px-bottom ">
                                            <input id="million" type="radio" name="type" class="d-block w-auto margin-10px-right mb-0 upgrade-select" value="million">
                                            <label class="md-line-height-18px" for="million"> {{ __('user-portal.upgrade_to_millionaire') }}</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{--                            <div class="col-md-12 margin-5px-bottom">--}}
                            {{--                                <hr>--}}
                            {{--                            </div>--}}

                            <div class="col-md-12 margin-10px-bottom text-center">
                                <button id="submit-btn" type="submit"
                                        class=" text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-2-half-rem-lr "
                                        style="margin-top: 3.5rem!important;">
                                    {{ __('user-portal.upgrade_account') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>


            </div>
        </div>
    </section>
    <!-- end section -->
@endsection

@section('js')
    @include('user.components.otp-handle')
    <script>
        // $('input[name="type"]:checked').on('change', function () {
        //     $('#submit-btn').attr('disabled', false);
        // });
        $('#submit-btn').on('click', function () {
            var url = "{{ route('user.upgrade-account', ['type' => ':type']) }}";
            url = url.replace(':type', $('input[name="type"]:checked').val());
            // console.log($('input[name="type"]:checked').val());
            window.location.href = url;
        });
    </script>
@endsection
