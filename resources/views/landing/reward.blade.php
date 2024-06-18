@extends('landing.app')

@section('content')
    <!-- start banner section -->
    <section class="d-flex flex-column justify-content-end justify-content-lg-center top-banner">
        <div class="container" style="background-color: ">
            <div class="row align-items-center justify-content-center">
                <div class="col-11 col-lg-10 text-center">
                    <div class="position-relative">
                        <span
                            class="title-small alt-font font-weight-300 z-index-9 d-inline-block letter-spacing-4px text-white"
                            style="line-height:45px;">
                            {!! __('landing.reward') !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mid-banner section -->
    <section class="wow animate__fadeIn mid-banner">
        <div class="container">
            <div class="row">
                <!-- Card 1 -->
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card unlock-card" style="background-color: ">
                        <div class="card-body" style="color: #fff">
                            <h5 class="card-title">{!! __('landing.unlocked') !!}</h5>
                            <h3 class="card-title-phase font-weight-100">{!! __('landing.reward_phase') !!} 1</h3>
                            <div>
                                <div class="card-text">
                                    {!! __('landing.buy_and_earn_reward') !!}
                                    <div class="card-subtext" style="color: #fff">{!! __('landing.buy_and_earn_reward_desc') !!}</div>
                                </div>
                                <div class="card-text">
                                    {!! __('landing.gratitude_reward') !!}
                                    <div class="card-subtext" style="color: #fff">{!! __('landing.gratitude_reward_desc') !!}</div>
                                </div>
                                <div class="card-text">
                                    {!! __('landing.team_reward') !!}
                                    <div class="card-subtext" style="color: #fff">{!! __('landing.team_reward_desc') !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card coming-soon-card">
                        <div class="card-body">
                            <h5 class="card-title">{!! __('landing.coming_soon') !!}</h5>
                            <h3 class="card-title-phase font-weight-100">{!! __('landing.reward_phase') !!} 2</h3>
                            <div>
                                <div class="card-text">
                                    {!! __('landing.shop_earnings') !!}
                                    <div class="card-subtext">{!! __('landing.shop_earnings_desc') !!}</div>
                                </div>
                                <div class="card-text">
                                    {!! __('landing.regional_earnings') !!}
                                    <div class="card-subtext">{!! __('landing.regional_earnings_desc') !!}</div>
                                </div>
                                <div class="card-text">
                                    {!! __('landing.agent_earnings') !!}
                                    <div class="card-subtext">{!! __('landing.agent_earnings_desc') !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card coming-soon-card">
                        <div class="card-body">
                            <h5 class="card-title">{!! __('landing.coming_soon') !!}</h5>
                            <h3 class="card-title-phase font-weight-100">{!! __('landing.reward_phase') !!} 3</h3>
                            <div>
                                <div class="card-text">
                                    {!! __('landing.investment_dividends') !!}
                                    <div class="card-subtext">{!! __('landing.investment_dividends_desc') !!}</div>
                                </div>
                                <div class="card-text">
                                    {!! __('landing.shareholders_dividends') !!}
                                    <div class="card-subtext">{!! __('landing.shareholders_dividends_desc') !!}</div>
                                </div>
                                <div class="card-text">
                                    {!! __('landing.subsidiaries_dividends') !!}
                                    <div class="card-subtext">{!! __('landing.subsidiaries_dividends_desc') !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Banner section styles */
        .top-banner {
            background-image: url('{{ __('landing/images/Group 3592.png') }}');
            background-size: cover;
            height: 40vh;
            color: white;
        }

        .title-small {
            font-size: 2.5rem;
            line-height: 1.5;
        }

        /* Mid-banner section styles */
        .mid-banner {
            padding: 60px 0;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1rem;
        }

        .card-title-phase {
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .card-text {
            margin-bottom: 15px;
        }

        .card-subtext {
            font-size: 0.9rem;
            color: #555;
        }

        /* Responsive typography */
        @media (max-width: 768px) {

            .top-banner {
                height: 20vh;
            }

            .title-small {
                font-size: 2rem;
            }

            .card-title-phase {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .top-banner {
                height: 20vh;
            }

            .title-small {
                font-size: 2rem;
            }
        }

        /* Additional styling */
        .unlock-card {
            background-color: #F37021;
            color: white;
        }

        .coming-soon-card {
            background-color: #F2E9E0;
            color: #707070;
        }

        /* Utility classes */
        .text-white {
            color: #fff !important;
        }

        .font-weight-100 {
            font-weight: 100 !important;
        }

        .font-weight-300 {
            font-weight: 300 !important;
        }
    </style>
@endsection
