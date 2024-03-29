@extends('landing.app')

@section('css')
<style>
    .top-banner{
        background-image: url('{{__('landing/images/Group 1@2x.png')}}');
        height: 840px;
        background-position: left center;
        background-size:cover;
        position:relative
    }
    .top-banner::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgb(0, 0, 0);
        background: linear-gradient(
            180deg,
            rgba(0, 0, 0, 0.3255427170868347) 0%,
            rgba(0, 0, 0, 0.75) 100%
        );
        top: 0;
        left: 0;
        z-index: 0;
    }

    .text-primary {
        color: #ee9134 !important;
    }

    .one-line {
        white-space: nowrap;overflow: hidden;display: block;text-overflow: ellipsis;
    }

     @media (max-width: 1200px) {
        .top-banner{
            height: 600px;
        }

    }

    @media(max-width:762px){
        /* .overlay::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgb(0, 0, 0);
            background: linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.3255427170868347) 0%,
                rgba(0, 0, 0, 0.75) 100%
            );
            top: 0;
            left: 0;
            z-index: 0;
        } */

        .overlay {
            background-position:top right;
        }
    }

    .custom-text-1{
            color:#ee9134;
        }
    .custom-text-2{
        color:#444;
    }

    @media (max-width: 600px) {
        .top-banner{
            height: 400px;
        }

        .custom-text-1{
            color:#000;
        }
        .custom-text-2{
            color:#000;
        }

        .custom-background-position {
            background-position: top center !important;
        }

        .custom-line::before{
            left: 10% !important;
        }
    }

    .custom-line {
        position:relative;
    }

    .custom-line::before{
        content: '';
        width: 1px;
        height:90%;
        position: absolute;
        background: #aaa;
        left: 11.5%;
        top:5%;
    }

    .primary-gradient {
        background: rgb(243,112,33);
        background: linear-gradient(180deg, rgba(243,112,33,1) 0%, rgba(252,159,85,1) 86%);
    }

    .custom-title{
        white-space: nowrap;
        overflow: hidden;
        display: block;
        text-overflow: ellipsis;
    }
</style>
@endsection
@section('content')
    <!-- start banner section -->
    <section class="d-flex flex-column justify-content-end justify-content-lg-center top-banner">
        <div class="container" style="max-width: 1400px ">
            <div class="row align-items-center justify-content-center">
                <div class="col-9 col-lg-5 col-sm-5 text-center xs-margin-30px-bottom">
{{--                    <img src="images/single-project-page-03-img01.jpg" alt=""/>--}}
                </div>
                <div class="col-10 col-lg-5 col-sm-7">
                    <div class="position-relative ">
                        <span
                            class=" text-extra-large alt-font line-height-20px z-index-9 position-relative d-inline-block letter-spacing-4px text-white">{{ __('landing.self_love_and_confidence') }}</span>
                    </div>
                    <div class="position-relative ">
                        <span
                            class="@if(app()->getLocale() == 'en') title-small pr-md-5 @else title-large @endif alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px text-white">{{ __('landing.starts_from') }}<br>{{ __('landing.the_innerself') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" overlap-height wow animate__fadeIn">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-9 col-lg-7 col-sm-8 text-center ">
                    <span
                        class="title-small alt-font text-primary font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.about_happy_buy') }}</span>
                    <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px mb-0"
                        style="line-height: 42px">{{ __('landing.about_happy_buy_description') }}</h5>
                </div>
            </div>
        </div>
    </section>
    <section class="overlay position-relative overlap-height wow animate__fadeIn custom-background-position" style="background: url('{{ asset('landing/images/about_global_care.png') }}');background-size:cover;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-9 col-lg-7 col-sm-8 text-center ">
                    <span
                        class="title-small alt-font custom-text-1 text-primary font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.about_global_care') }}</span>
                    <h5 class="text-extra-large2 alt-font custom-text-2 font-weight-300 letter-spacing-minus-1px mb-0"
                        style="line-height: 42px">{{ __('landing.about_global_care_description') }}</h5>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light-yellow overlap-height wow animate__fadeIn px-5" style="background: #fff5ef;">
        <div class="padding-twelve-lr xl-padding-five-lr lg-padding-two-lr xs-no-padding-lr">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-4 px-md-0 d-flex align-items-center flex-column mb-md-0 mb-5 text-center">
                        <div class="title-small text-primary mb-2">{{ __('landing.about_below_one') }}</div>                        
                        <div class="title-extra-small2" style="color:#707070">{{ __('landing.about_below_one_description') }}</div>                        
                    </div>
                    <div class="col-md-4 px-md-0 d-flex align-items-center flex-column mb-md-0 mb-5 text-center">
                        <div class="title-small text-primary mb-2">{{ __('landing.about_below_two') }}</div>                        
                        <div class="title-extra-small2" style="color:#707070">{{ __('landing.about_below_two_description') }}</div>                        
                    </div>
                    <div class="col-md-4 px-md-0 d-flex align-items-center flex-column text-center">
                        <div class="title-small text-primary mb-2">{{ __('landing.about_below_three') }}</div>                        
                        <div class="title-extra-small2" style="color:#707070">{!! __('landing.about_below_three_description') !!}</div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="overlap-height wow animate__fadeIn">
        <div class="container" style="margin-bottom:30px;margin-top:30px;">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-8 col-lg-7 col-sm-8 text-center ">
                    <span
                        class="title-small text-primary alt-font dark-gold font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.brand_special') }}</span>
                </div>
            </div>
        </div>
        <div class="padding-twelve-lr xl-padding-five-lr lg-padding-two-lr xs-no-padding-lr">
            <div class="container-fluid">
                <div class="row">
                    <div class="col px-md-0">
                        <ul class="portfolio-overlay portfolio-wrapper grid grid-3col xl-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large text-center"
                            style="position: relative; height: 524.6px;">
                            <li class="grid-sizer"></li>

                            <li class="grid-item wow animate__fadeInUp"
                                style="visibility: visible; position: absolute; left: 0%; top: 0px; animation-name: fadeInUp;">
                                <div class="portfolio-box">
                                    <img class="margin-50px-bottom" src="{{ asset('landing/images/product_1.jpg') }}" style="width: 280px;height: 280px"/>
                                    {{-- <span
                                        class="text-extra-medium alt-font text-extra-medium-gray font-weight-400 d-block margin-15px-bottom ">Product 1</span> --}}
                                </div>
                            </li>
                            <li class="grid-item wow animate__fadeInUp"
                                style="visibility: visible; position: absolute; left: 0%; top: 0px; animation-name: fadeInUp;">
                                <div class="portfolio-box">
                                    <img class="margin-50px-bottom" src="{{ asset('landing/images/product_2.jpg') }}" style="width: 280px;height: 280px"/>
                                    {{-- <span
                                        class="text-extra-medium alt-font text-extra-medium-gray font-weight-400 d-block margin-15px-bottom ">Product 1</span> --}}
                                </div>
                            </li>
                            <li class="grid-item wow animate__fadeInUp"
                                style="visibility: visible; position: absolute; left: 0%; top: 0px; animation-name: fadeInUp;">
                                <div class="portfolio-box">
                                    <img class="margin-50px-bottom" src="{{ asset('landing/images/product_3.jpg') }}" style="width: 280px;height: 280px"/>
                                    {{-- <span
                                        class="text-extra-medium alt-font text-extra-medium-gray font-weight-400 d-block margin-15px-bottom ">Product 1</span> --}}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="wow animate__fadeIn position-relative" style="padding:0px;height: 400px;background: url('{{ asset('landing/images/Group 200@2x.png') }}');background-size:cover;">
        <div class="container absolute-middle-center">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-9 col-lg-8 col-sm-8 text-center ">
                    <span
                        class="title-small alt-font text-white font-weight-300 d-block letter-spacing-3px" style="font-weight:300;">{{ __('landing.home_blue') }}</span>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="wow animate__fadeIn position-relative p-5">
        <div class="container">
            <div class="row" style="padding:60px 0;">
                <div class="col-md-6">
                    <div class="text-primary mb-4" style="font-size:30px;font-weight:300;">{{ __('landing.our_mission') }}</div>
                    <div style="font-size:18px;">{{ __('landing.our_mission_description') }}</div>
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <div class="text-primary mb-4" style="font-size:30px;font-weight:300;">{{ __('landing.our_vision') }}</div>
                    <div style="font-size:18px;">{{ __('landing.our_vision_description') }}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light-yellow overlap-height wow animate__fadeIn" style="background: #fff5ef;">
        <span class="text-center alt-font text-primary d-block margin-50px-bottom letter-spacing-3px px-5" style="font-size:30px;">{{ __('landing.2024_plan') }}</span>
        <div class="padding-twelve-lr xl-padding-five-lr lg-padding-two-lr xs-no-padding-lr d-flex flex-column align-items-center mx-auto">
            @foreach(__('landing.plans') as $plan)
                <div class="d-flex flex-column">
                    <div class="d-flex my-4 px-4" style="max-width:375px;">
                        <div class="mr-4 primary-gradient p-3 text-white" style="border-radius:50%;@if(app()->getLocale() == 'en') letter-spacing:3px; @endif">{!! $plan['month'] !!}</div>
                        <div class="primary-gradient p-3 text-white custom-title" style="border-radius:12px;flex:1;">{{ $plan['title'] }}</div>
                    </div>
                    <div class="@if(!$loop->last) custom-line @endif d-flex flex-column">
                        @foreach($plan['schedules'] as $schedule)
                            <div class="d-flex">
                                <div class="mr-4 primary-gradient p-3 text-white" style="border-radius:50%;opacity:0;">{{ $plan['month'] }}</div>
                                <div class="px-3 mb-3 ml-4">
                                    <div class="text-primary" style="border-radius:12px;width:320px;font-weight:600;">{{ $schedule['date'] }}</div>
                                    <div class="" style="color:#707070;border-radius:12px;max-width:320px;">{{ $schedule['event'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- <section>
        <div class="d-flex justify-content-center text-primary mb-5" style="font-size:30px;font-weight:300;">{{ __('landing.brand_special') }}</div>
        <div id="accordion" class="col-md-7 mx-auto gap-4 mt-4">
            <div class="card cursor-pointer border-0 shadow" style="margin-bottom:2.2rem;">
                <div class="py-4 px-5" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <div class="gap-3 h-5 mb-0 text-primary-light d-flex justify-content-between align-items-center">
                        <span class="text-primary fw-bold one-line">{{ __('landing.accordion_one') }}</span>
                        <span class="plus"><img src="{{ asset('landing/images/plus.svg') }}" alt="plus"></span>
                    </div>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="py-4 px-5 pt-0 text-muted">
                        {{ __('landing.accordion_one_description') }}
                    </div>
                </div>
            </div>
            <div class="card cursor-pointer border-0 shadow" style="margin-bottom:2.2rem;">
                <div class="py-4 px-5" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <div class="gap-3 h-5 mb-0 text-primary-light d-flex justify-content-between align-items-center">
                        <span class="text-primary fw-bold one-line">{{ __('landing.accordion_two') }}</span>
                        <span class="plus"><img src="{{ asset('landing/images/plus.svg') }}" alt="plus"></span>
                    </div>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="py-4 px-5 pt-0 text-muted">
                        {{ __('landing.accordion_two_description') }}
                    </div>
                </div>
            </div>
            <div class="card cursor-pointer border-0 shadow" style="margin-bottom:2.2rem;">
                <div class="py-4 px-5" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <div class="gap-3 h-5 mb-0 text-primary-light d-flex justify-content-between align-items-center">
                        <span class="text-primary fw-bold one-line">{{ __('landing.accordion_three') }}</span>
                        <span class="plus"><img src="{{ asset('landing/images/plus.svg') }}" alt="plus"></span>
                    </div>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="py-4 px-5 pt-0 text-muted">
                        {{ __('landing.accordion_three_description') }}
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
