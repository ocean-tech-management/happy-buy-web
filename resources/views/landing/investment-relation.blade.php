@extends('landing.app')

@section('css')
<style>
    .top-banner{
        background-image: url('{{__('landing/images/investment_relation.png')}}');
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
            rgba(0, 0, 0, 0.60) 100%
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

    .custom-line {
        position:relative;
    }

    .custom-line::before{
        content: '';
        width: 1px;
        height:70%;
        position: absolute;
        background: #bbb;
        left: -50px;
        top:15%;
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
    <section class="d-flex flex-column justify-content-center cover-background"
             style="background-image: url('landing/images/investment_relation.png');height: 570px">
        <div class="container" style="max-width: 1400px ">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-xl-8 col-lg-7 col-sm-8 text-center">
                    <span
                        class="text-white title-large alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px">{{ __('landing.investment_relation') }}</span>
                </div>
            </div>
        </div>
    </section>
    
    <section class="p-5" style="background:#F3F7F9;">
        <div class="d-flex justify-content-center text-primary mb-4 pt-md-5" style="font-size:30px;font-weight:300;">{{ __('landing.strategic_partner') }}</div>
        <div class="container mb-md-5">
            <div class="row align-items-center justify-content-center py-5">
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                    <img src="{{ asset('landing/images/partner_1.png') }}" alt="" style="width:auto;">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                    <img src="{{ asset('landing/images/partner_2.png') }}" alt="" style="width:auto;">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                    <img src="{{ asset('landing/images/partner_3.png') }}" alt="" style="width:auto;">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                    <img src="{{ asset('landing/images/partner_4.png') }}" alt="" style="width:auto;">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                    <img src="{{ asset('landing/images/partner_5.png') }}" alt="" style="width:auto;">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                    <img src="{{ asset('landing/images/partner_6.png') }}" alt="" style="width:auto;">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light-yellow overlap-height wow animate__fadeIn" style="background: #fff5ef;">
        <span class="col-9 mx-auto text-center title-small alt-font text-primary font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.ghc_partners') }}</span>
        <div class="padding-twelve-lr xl-padding-five-lr lg-padding-two-lr xs-no-padding-lr">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    @for($i = 1; $i <= 9; $i++)
                        <div class="col-md-4 col-4 p-3 d-flex align-items-center flex-column mb-md-0 mb-5 text-center px-4 px-md-0">
                            @if($i <= 7)
                                <img src='{{ asset("landing/images/ghc_partner_$i.png") }}' alt="" style="margin-top:40px;">
                            @else
                                <img src='{{ asset("landing/images/ghc_partner_$i.svg") }}' alt="" style="margin-top:40px;">
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>  


@endsection
