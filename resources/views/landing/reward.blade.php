@extends('landing.app')

@section('css')
    <style>
        .top-banner {
            background-image: url('{{ __('landing/images/Group 3592.png') }}');
            height: 350px;
            background-size: cover;
            position: relative
        }

        /* .top-banner::after {
                                                content: "";
                                                position: absolute;
                                                width: 100%;
                                                height: 100%;
                                                background: rgb(0, 0, 0);
                                                background: linear-gradient(
                                                    180deg,
                                                    rgba(0, 0, 0, 0.3255427170868347) 0%,
                                                    rgba(0, 0, 0, 0.65) 100%
                                                );
                                                top: 0;
                                                left: 0;
                                                z-index: 0;
                                            } */

        .mid-banner {
            background-image: url('{{ __('landing/images/Mesa de trabajo 1.png') }}');
            height: 700px;
            background-size: cover;
            position: relative
        }

        .text-primary {
            color: #ee9134 !important;
        }

        .card {
            background-color: #F2E9E0;
            color: #707070;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .unlock-card {
            background-color: #F37021;
            color: white;
        }

        .card-body {
            padding: 50px 50px;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
            text-transform: capitalize;
            padding-top: 0%
        }


        .card-text {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-subtext {
            font-size: 16px;
            font-weight: normal;
        }

        @media (max-width: 768px) {
            .row {
                display: flex;
                flex-wrap: wrap;
                margin-right: -15px;
                margin-left: -15px;
            }

            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
                padding-right: 15px;
                padding-left: 15px;
            }
        }

        @media (max-width: 768px) {

            .card-text,
            .card-subtext {
                font-size: 14px;
            }

            .card-text {
                margin-bottom: 8px;
            }
        }
    </style>
@endsection
@section('content')
    <!-- start banner section -->
    <section class="d-flex flex-column justify-content-end justify-content-lg-center top-banner">
        <div class="container" style="max-width: 1400px ">
            <div class="row align-items-center justify-content-center">
                <div class="col-11 col-lg-10 text-center">
                    <div class="position-relative ">
                        <span
                            class="title-small alt-font font-weight-300 z-index-9 d-inline-block letter-spacing-4px text-white"
                            style="line-height:45px;">{!! __('landing.reward') !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wow animate__fadeIn mid-banner">
        <div class="container" style="max-width: 1400px">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card unlock-card">
                        <div class="card-body">
                            <h5 class="card-title">{!! __('landing.unlocked') !!}</h5>
                            <h3 class="card-title-phase font-weight-100">{!! __('landing.reward_phase') !!} 1</h3>
                            <div>
                                <div class="card-text">{!! __('landing.buy_and_earn_reward') !!}
                                    <div class="card-subtext">{!! __('landing.buy_and_earn_reward_desc') !!}</div>
                                </div>
                                <div class="card-text">{!! __('landing.gratitude_reward') !!}
                                    <div class="card-subtext">{!! __('landing.gratitude_reward_desc') !!}</div>
                                </div>
                                <div class="card-text">{!! __('landing.team_reward') !!}
                                    <div class="card-subtext">{!! __('landing.team_reward_desc') !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card coming-soon-card">
                        <div class="card-body">
                            <h5 class="card-title">{!! __('landing.coming_soon') !!}</h5>
                            <h3 class="card-title-phase font-weight-100">{!! __('landing.reward_phase') !!} 2</h3>
                            <div>
                                <div class="card-text">{!! __('landing.shop_earnings') !!}
                                    <div class="card-subtext">{!! __('landing.shop_earnings_desc') !!}</div>
                                </div>
                                <div class="card-text">{!! __('landing.regional_earnings') !!}
                                    <div class="card-subtext">{!! __('landing.regional_earnings_desc') !!}</div>
                                </div>
                                <div class="card-text">{!! __('landing.agent_earnings') !!}
                                    <div class="card-subtext">{!! __('landing.agent_earnings_desc') !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card coming-soon-card">
                        <div class="card-body">
                            <h5 class="card-title">{!! __('landing.coming_soon') !!}</h5>
                            <h3 class="card-title-phase font-weight-100">{!! __('landing.reward_phase') !!} 3</h3>
                            <div>
                                <div class="card-text">{!! __('landing.investment_dividends') !!}
                                    <div class="card-subtext">{!! __('landing.investment_dividends_desc') !!}</div>
                                </div>
                                <div class="card-text">{!! __('landing.shareholders_dividends') !!}
                                    <div class="card-subtext">{!! __('landing.shareholders_dividends_desc') !!}</div>
                                </div>
                                <div class="card-text">{!! __('landing.subsidiaries_dividends') !!}
                                    <div class="card-subtext">{!! __('landing.subsidiaries_dividends_desc') !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
