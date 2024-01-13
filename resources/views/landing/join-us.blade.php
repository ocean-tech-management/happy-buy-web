@extends('landing.app')

@section('css')
    <style>
        .top-banner{
            background-image: url('{{__('landing/images/Group 4@2x.png')}}');
            height: 840px;
        }

        @media (max-width: 991px) {
            .top-banner{
                background-image: url('{{__('landing/images/mobile_04_banner.png')}}');
                height: 640px;
            }
        }
    </style>
@endsection
@section('content')
    <!-- start banner section -->
    <section class="d-flex flex-column justify-content-end justify-content-lg-center cover-background top-banner">
        <div class="container" style="max-width: 1400px ">
            <div class="row align-items-center justify-content-center">
                <div class="col-9 col-lg-5 col-sm-5 text-center xs-margin-30px-bottom">
{{--                    <img src="{{asset('')}}" alt=""/>--}}
                </div>
                <div class="col-10 col-lg-7 col-sm-7">
                    <div class="position-relative ">
                        <span
                            class=" text-extra-large alt-font line-height-20px z-index-9 position-relative d-inline-block letter-spacing-4px">{{ __('landing.become_part_of_the_family') }}</span>
                    </div>
                    <div class="position-relative ">
                        <span
                            class="dark-gold title-large alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px">{{ __('landing.join_us_as') }} <br> {{ __('landing.partners') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner section -->

    <!-- start section -->
    <section class="overlap-height wow animate__fadeIn">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-12 col-lg-7 col-sm-8 text-center ">
                    <span
                        class="title-small alt-font dark-gold font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.creating_a_new_alliance') }}</span>
                    <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300  mb-0"
                        style="line-height: 42px">{{ __('landing.to_effectively_penetrate_the_market,_we_know_we_cannot_rely_on_ourselves._this_is_why_we_wish_to_forge_an_alliance_that_allows_all_of_us_to_flourish.') }}</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="bg-dark-gold overlap-height wow animate__fadeIn">
        <div class="pt-0 padding-five-lr xs-no-padding-lr">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-12 col-lg-7 col-sm-8 text-center ">
                    <span
                        class="title-small alt-font text-white font-weight-300 d-block margin-50px-bottom letter-spacing-4px">{{ __('landing.why_join_us') }}</span>
                        <div class="col px-md-0">
                            <ul class="portfolio-overlay portfolio-wrapper grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large text-center"
                                style="position: relative; height: 524.6px;">
                                <li class="grid-sizer"></li>
                                <!-- start lightbox gallery item -->
                                <li class="grid-item wow animate__fadeInUp"
                                    style="visibility: visible; position: absolute; left: 0%; top: 0px; animation-name: fadeInUp;">
                                    <div class="portfolio-box">
                                        <img class="margin-50px-bottom" src="{{ asset('landing/images/joinusicon01.svg') }}" style="width: 60px;height: 60px"/>
                                        <span
                                            class="title-extra-small alt-font text-white font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.supoprt') }}</span>
                                        <span
                                            class="text-extra-medium alt-font text-white font-weight-300 d-block margin-15px-bottom ">{{ __('landing.we_support_our_agents_by_giving_them_training_about_the_products_and_how_to_raise_the_success_rates_of_closing_deals.') }}</span>
                                    </div>

                                </li>
                                <!-- end lightbox gallery item -->
                                <!-- start lightbox gallery item -->
                                <li class="grid-item wow animate__fadeInUp" data-wow-delay="0.2s"
                                    style="visibility: visible; position: absolute; left: 25%; top: 0px; animation-delay: 0.2s; animation-name: fadeInUp;">
                                    <div class="portfolio-box">
                                        <img class="margin-50px-bottom" src="{{ asset('landing/images/joinusicon03.svg') }}" style="width: 60px;height: 60px"/>
                                        <span
                                            class="title-extra-small alt-font text-white font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.bonus') }}</span>
                                        <span
                                            class="text-extra-medium alt-font text-white font-weight-300 d-block margin-15px-bottom">{{ __('landing.our_bonus_system_is_structured_in_such_a_way_that_each_agent_can_get_their_bonus_as_well_as_earning_a_group_bonus.') }}</span>
                                    </div>
                                </li>
                                <!-- end lightbox gallery item -->
                                <!-- start lightbox gallery item -->
                                <li class="grid-item wow animate__fadeInUp" data-wow-delay="0.4s"
                                    style="visibility: visible; position: absolute; left: 50.0001%; top: 0px; animation-delay: 0.4s; animation-name: fadeInUp;">
                                    <div class="portfolio-box">
                                        <img class="margin-50px-bottom" src="{{ asset('landing/images/joinusicon02.svg') }}" style="width: 60px;height: 60px"/>
                                        <span
                                            class="title-extra-small alt-font text-white font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.warehousing') }}</span>
                                        <span
                                            class="text-extra-medium alt-font text-white font-weight-300 d-block margin-15px-bottom">{{ __('landing.you_do_not_have_to_worry_about_warehousing_and_logistics_because_we_can_send_your_orders_directly_to_your_customers.') }}</span>
                                    </div>
                                </li>
                                <!-- end lightbox gallery item -->
                                <!-- start lightbox gallery item -->
                                <li class="grid-item wow animate__fadeInUp" data-wow-delay="0.6s"
                                    style="visibility: visible; position: absolute; left: 75.0001%; top: 0px; animation-delay: 0.6s; animation-name: fadeInUp;">
                                    <div class="portfolio-box">
                                        <img class="margin-50px-bottom" src="{{ asset('landing/images/joinusicon04.svg') }}" style="width: 60px;height: 60px"/>
                                        <span
                                            class="title-extra-small alt-font text-white font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.unique_business') }}</span>
                                        <span
                                            class="text-extra-medium alt-font text-white font-weight-300 d-block margin-15px-bottom">{{ __('landing.our_business_has_a_unique_proposition_that_enables_erya,_the_agents,_and_users_to_get_their_respective_benefits._it’s_a_win-win-win_business_model!') }}</span>
                                    </div>
                                </li>
                                <!-- end lightbox gallery item -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- end section -->

    <!-- start banner section -->
    <section class="d-flex flex-column justify-content-center cover-background"
             style="background-image: url('{{asset('landing/images/WhatsApp Image 2021-07-31 at 5.36.43 PM@2x.png')}}');height: 840px">

    </section>
    <!-- end banner section -->

    <!-- start section -->
    <section class="position-relative" style="padding:0px;height: 600px">
        <div class="section-bg-image-blur"></div>
        <div class="container absolute-middle-center">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-9 col-lg-8 col-sm-8 text-center">
                    <span
                        class="title-small alt-font dark-gold font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.join_us_today') }}</span>
                    <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px margin-50px-bottom"
                        style="line-height: 42px">{{ __('landing.join_us_and_together_we_can_spread_the_greatness_of_health_and_wellness._let_us_create_a_new_landscape_and_blue_ocean_in_this_market_together.') }}</h5>
                    <button
                        class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-1-half-rem-lr">
                        {{ __('landing.join_us_now') }}
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

@endsection
