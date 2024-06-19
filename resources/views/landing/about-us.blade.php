@extends('landing.app')

@section('css')
    <style>
        .top-banner {
            background-image: url('{{ __('landing/images/Group 3590.png') }}');
            height: 100vh;
            background-position: left center;
            background-size: cover;
            position: relative
        }

        .top-banner::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgb(30, 30, 30);
            background: linear-gradient(180deg,
                    rgba(30, 30, 30, 0.3255427170868347) 0%,
                    rgba(30, 30, 30, 0.6) 100%);
            top: 0;
            left: 0;
            z-index: 0;
        }

        .text-primary {
            color: #ee9134 !important;
        }

        @media (max-width: 1200px) {
            .top-banner {
                height: 600px;
            }

        }

        @media (max-width: 600px) {
            .top-banner {
                height: 400px;
            }

        }
    </style>
@endsection
@section('content')
    <!-- start banner section -->
    <section class="d-flex flex-column justify-content-end justify-content-lg-center top-banner">
        <div class="container" style="max-width: 1400px ">
            <div class="row align-items-center justify-content-center mt-5">
                <div class="col-10 col-lg-7 col-sm-7">
                    <div class="text-center">
                        <span
                            class=" title-large-4 alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px text-white">{{ __('landing.about_us') }}</span>
                    </div>
                    <div class="text-center">
                        <span
                            class=" text-extra-large3 alt-font line-height-20px z-index-9 position-relative d-inline-block letter-spacing-4px text-white">{{ __('landing.self_love_and_confidence') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner section -->
    <!-- start section -->
    <section class="overlap-height wow animate__fadeIn p-0 !important">
        <div class="container" style="max-width: 1400px;">
            <div class="row justify-content-center">
                {{-- <div class="col-12"> --}}
                <div class="row">
                    <div class="col-md-6 col-sm-12 p-0" style="height: 400px;">
                        <img src="landing/images/GC_office.png" alt="GC Office"
                            style="width: 100%; height: 100%; object-fit: cover;" />
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center text-start">
                        <div class="p-5">
                            <span
                                class="title-small alt-font text-primary font-weight-300 d-block margin-30px-bottom letter-spacing-3px">
                                GLOBALCARE
                            </span>
                            <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px mb-0"
                                style="line-height: 42px">
                                {{ __('landing.about_happy_buy_description') }}
                            </h5>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="bg-light-yellow overlap-height wow animate__fadeIn pb-0 pt-2 !important"
        style="background: linear-gradient(0deg, rgba(242,103,17,1) 28%, rgba(254,153,0,1) 81%);">
        {{-- <div class="padding-twelve-lr xl-padding-five-lr lg-padding-two-lr xs-no-padding-lr"> --}}
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 text-start">
                        <div class="d-flex flex-column justify-content-center p-5">
                            <span class="alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px"
                                style="line-height: 42px; color: #FFFFFF; font-size: 20px;">
                                {{ __('landing.about_happy_buy_line1') }}
                            </span>
                            <span class="alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px"
                                style="line-height: 42px; color: #FFFFFF; font-size: 20px">
                                {{ __('landing.about_happy_buy_line2') }}
                            </span>
                            <span class="alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px"
                                style="line-height: 42px; color: #FFFFFF; font-size: 20px">
                                {{ __('landing.about_happy_buy_line3') }}
                            </span>
                            <span class="alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px"
                                style="line-height: 42px; color: #FFFFFF; font-size: 20px">
                                {{ __('landing.about_happy_buy_line4') }}
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 pr-0" style="height: 400px;">
                        <img src="landing/images/iPhone 14 Pro Mockup copy.png" alt="GC Office"
                            style="width: 100%; height: 100%; object-fit: cover;" />
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </section>

    {{-- <section class="wow animate__fadeIn">
        <div class="container p-5 text-center" style="color:black;">
            <div class="text-primary mb-5" style="font-size:2rem;font-weight:300;">{{ __('landing.investor_relation') }}</div>
            <div class="text-primary mb-4" style="font-weight:700;font-size:2.4rem;">{{ __('landing.global_hot_chain') }}</div>
            <div class="d-flex justify-content-center">
                <div class="col-12 col-lg-8 col-md-9">
                    <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px mb-0"
                        style="line-height: 42px">{{ __('landing.investor_relation_description_one') }}</h5>
                    <br><br>
                    <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px mb-0"
                        style="line-height: 42px">{{ __('landing.investor_relation_description_two') }}</h5>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
