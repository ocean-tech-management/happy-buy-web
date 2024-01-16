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
             style="background-image: url('landing/images/orange_pink.png');height: 570px">
        <div class="container" style="max-width: 1400px ">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-xl-8 col-lg-7 col-sm-8 text-center">
                    <span
                        class="text-white title-large alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px">{{ __('landing.investment_relation') }}</span>
                </div>
            </div>
        </div>
    </section>
    
    <section class="p-5 container my-5">
        @for($i = 1; $i <= 3; $i++)
            <div class="card px-5 py-4 bg-white shadow mb-5">
                <span class="mt-4 text-primary fw-bold one-line mb-4" style="font-size:1.8rem;">{{ __("landing.faq_$i") }}</span>
                <div class="mb-4 @if(!(app()->getLocale() == 'en')) letter-spacing-2px @endif" style="font-size:1.4rem; font-weight:300;">{!! __("landing.faq_description_$i") !!}</div>
            </div>
        @endfor
    </section>

@endsection
