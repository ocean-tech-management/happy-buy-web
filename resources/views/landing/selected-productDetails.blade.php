@extends('landing.app')

@section('css')
    <style>
        .mid-banner {
            background-image: url('{{ __('landing/images/Mesa de trabajo 1.png') }}');
            height: 700px;
            background-size: cover;
            position: relative
        }

        .responsive-img {
            width: 100%;
            height: auto;
            max-width: 450px;
            max-height: 450px;
        }

        .product-details-title {
            font-size: 2rem;
            color: #F37021;
            font-weight: bold;
            padding-bottom: 4rem
        }

        .product-details-description {
            font-size: 1.5rem;
            color: #7A7A7A;
            line-height: 1.5
        }

        .detail-text-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        @media (max-width: 768px) {
            .product-details-title {
                font-size: 1.5rem;
            }

            .product-details-description {
                font-size: 0.875rem;
            }
        }

        @media (max-width: 576px) {
            .product-details-title {
                font-size: 20px;
            }

            .product-details-description {
                font-size: 16px;
            }
        }
    </style>
@endsection

@section('content')
    <section class="wow animate__fadeIn mid-banner mb-5">
        <div class="container" style="max-width: 1400px;">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="product-details-image">
                        <img src="landing/images/Group 3588.png" alt="Product Image" class="responsive-img" />
                    </div>
                </div>
                <div class="col-md-6 mb-4 d-flex align-items-center">
                    <div class="detail-text-wrapper" style="width: 60%">
                        <div class="product-details-title">
                            NMNGen (Feel Young Again)
                        </div>
                        <div class="product-details-description">
                            Restore your health, revitalise your skin, achieve anti-ageing results, gain confidence and
                            rejuvenate after exercise or a busy day with the power of NMN. It also has whitening effects
                            and improves skin tone.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
