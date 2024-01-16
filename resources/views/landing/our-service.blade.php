@extends('landing.app')

@section('css')
<style>
    .top-banner{
        background-image: url('{{__('landing/images/our_service.png')}}');
        background-size:cover;
        position:relative
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

    .text-primary {
        color: #ee9134 !important;
    }
/* 
    @media (max-width: 1200px) {
        .top-banner{
            height: 600px;
        }

    }

    @media (max-width: 600px) {
        .top-banner{
            height: 400px;
        }

    } */
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
                <div class="col-11 col-lg-10">
                    <div class="position-relative ">
                        <span
                            class="title-small alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px text-white" style="line-height:45px;">{!! __('landing.our_service_title') !!}</span>
                    </div>
                     <div class="position-relative mt-5">
                        <span
                            class=" text-extra-large2 alt-font z-index-9 position-relative d-inline-block letter-spacing-4px text-white" style="line-heigth:30px;font-weight:300;">{{ __('landing.our_service_subtitle') }}</span>
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
                        class="title-small alt-font text-primary font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.offline_physical_store') }}</span>
                    <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px mb-0"
                        style="line-height: 42px">{{ __('landing.offline_physical_store_description') }}</h5>
                </div>
            </div>
        </div>
    </section>


    <section class="wow animate__fadeIn position-relative" style="padding:0px;height: 400px;background: url('{{ asset('landing/images/revenue.png') }}');background-size:cover;">
        <div class="container absolute-middle-center py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-9 col-lg-8 col-sm-8 text-center">
                    <span
                        class="title-small alt-font text-white font-weight-500 d-block letter-spacing-3px mb-5" style="font-weight:300;">{{ __('landing.online_and_offline_integration_strategy') }}</span>
                    <span style="font-size:1.6rem;" class="text-white alt-font text-extra-medium-gray font-weight-300 letter-spacing-1px mb-0"
                        style="line-height: 42px">{{ __('landing.online_and_offline_integration_strategy_description') }}</span>
                </div>
            </div>
        </div>
    </section>

    <section class=" overlap-height wow animate__fadeIn">
         <div class="padding-twelve-lr xl-padding-five-lr lg-padding-two-lr xs-no-padding-lr">
            <div class="col-12 col-xl-9 col-lg-7 col-sm-8 text-center mx-auto ">
                <span
                    class="title-small alt-font text-primary font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.global_sales_network') }}</span>
            </div>  
            <div class="container-fluid">
                <div class="row justify-content-center">
                    @for($i = 1; $i <= 3; $i++)
                        <div class="col-md-4 px-md-0 d-flex align-items-center flex-column mb-md-0 mb-5 text-center">
                            <div class="title-extra-small2" style="color:#707070">{{ __("landing.offline_physical_store_$i") }}</div>                        
                            <div class="title-small text-primary mt-3">{{ __("landing.offline_physical_store_description_$i") }}</div>                        
                        </div>
                    @endfor
                </div>
            </div>
           <div class="col-12 col-xl-9 col-lg-7 col-sm-8 text-center mx-auto mt-5 pt-5">
                <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px mb-0"
                    style="line-height: 42px">{!! __('landing.offline_physical_store_detail') !!}</h5>
            </div>
        </div>
        
    </section>

    <section class="bg-light-yellow overlap-height wow animate__fadeIn px-4" style="background: #fff5ef;">
        <div class="padding-twelve-lr xl-padding-five-lr lg-padding-two-lr xs-no-padding-lr d-flex flex-column align-items-center">
            @if(app()->getLocale() == 'en')
                <img src="{{ asset('landing/images/model_en.png') }}" alt=""> 
            @else
                <img src="{{ asset('landing/images/model.png') }}" alt=""> 
            @endif
        </div>
    </section>

    {{-- <section style="background:url('{{ asset('landing/images/orange_gradient.png') }}');background-size:cover;">
        <div class="container">
            <div class="p-5 d-flex flex-lg-row flex-column">
                <div class="d-flex justify-content-center mb-lg-0 mb-5 mr-0 mr-lg-4">
                    <img src="{{ asset('landing/images/HB_01.png') }}" alt="" style="max-width:263px;">
                </div>
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('landing/images/HB_QR.png') }}" alt="" style="border-radius:34px;background:white;max-width:263px;">
                </div>
                <div class="p-lg-5 text-lg-left text-center mt-5 mt-lg-0 ml-lg-5 ml-0">
                    <span style="font-size:30px;color:white;font-weight:300;">{{ __('landing.app_download') }}</span>
                    <br><br><br>
                    <span style="font-size:30px;color:white;font-weight:300;">{{ __('landing.download_now_one') }}</span>
                    <br>
                    <span style="font-size:30px;color:white;font-weight:300;">{{ __('landing.download_now_two') }}</span>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
