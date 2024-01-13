@extends('landing.app')

@section('css')
<style>
    .top-banner{
        background-image: url('{{__('landing/images/about_us.png')}}');
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
        background: rgb(30,30,30);
        background: linear-gradient(
            180deg,
            rgba(30,30,30, 0.3255427170868347) 0%,
            rgba(30,30,30, 0.6) 100%
        );
        top: 0;
        left: 0;
        z-index: 0;
    }

    .text-primary {
        color: #ee9134 !important;
    }

    @media (max-width: 1200px) {
        .top-banner{
            height: 600px;
        }

    }

    @media (max-width: 600px) {
        .top-banner{
            height: 400px;
        }

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
                <div class="col-10 col-lg-7 col-sm-7">
                    <div class="position-relative ">
                        <span
                            class=" text-extra-large alt-font line-height-20px z-index-9 position-relative d-inline-block letter-spacing-4px text-white">{{ __('landing.self_love_and_confidence') }}</span>
                    </div>
                    <div class="position-relative ">
                        <span
                            class=" title-large alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px text-white">{{ __('landing.about_us') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner section -->
    <!-- start section -->
    <section class=" overlap-height wow animate__fadeIn">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-9 col-lg-7 col-sm-8 text-center ">
                    <span
                        class="title-small alt-font text-primary font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.about_happy_buy_') }}</span>
                    <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px mb-0"
                        style="line-height: 42px">{{ __('landing.about_happy_buy_description') }}</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="bg-light-yellow overlap-height wow animate__fadeIn" style="background: #fff5ef;">
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
                        <div class="title-extra-small2" style="color:#707070">{{ __('landing.about_below_three_description') }}</div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wow animate__fadeIn">
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
    </section>
@endsection
