@extends('landing.app')


@section('css')
    <style>
        .top-banner{
            background-image: url('{{__('landing/images/1L4A0632_pp_v2.png')}}');
            height: 570px;
        }

        @media (max-width: 991px) {
            .top-banner{
                background-image: url('{{__('landing/images/mobile_02_banner.png')}}');
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
                <div class="col-12 col-xl-8 col-lg-7 col-sm-8 text-center">
                    <div>
                        <span
                            class="dark-gold text-extra-large alt-font line-height-20px z-index-9 position-relative d-inline-block letter-spacing-4px">{{ __('landing.curated_lineup') }}</span>
                    </div>
                        <span
                            class="dark-gold title-large alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px">{{ __('landing.our_products') }}</span>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner section -->
    <!-- start section -->
    <section style="padding-bottom: 0px">
        <div class="container" >
            <div class="row">
                <div class="col-12 tab-style-01 without-number wow animate__fadeIn" style="visibility: visible; animation-name: fadeIn;">
                    <!-- start tab navigation -->
                    <ul class="nav nav-pills nav nav-tabs text-uppercase justify-content-center text-center alt-font font-weight-500 margin-7-rem-bottom md-margin-5-rem-bottom sm-margin-20px-bottom" id="pills-tab" role="tablist">
                        @foreach($categories as $category)
                            <li class="nav-item ">
                                <a class="nav-link product-nav shop-product-category-nav" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                                   aria-controls="pills-home" aria-selected="true" value="{{ $category->id }}">{{ $category->name }}</a>
                                <span class="tab-border bg-dark-gold"></span>
                            </li>
                        @endforeach
                    </ul>
                    <!-- end tab navigation -->
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="pt-0 padding-five-lr xs-no-padding-lr">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 shopping-content">
                    <ul class="product-listing row grid grid-5col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large text-center"  id="product-items">
{{--                        <li class="grid-sizer"></li>--}}

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class=" wow animate__fadeIn position-relative" style="padding:0px;height: 600px">
        <div class="section-bg-image-blur"></div>
        <div class="container absolute-middle-center">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-9 col-lg-8 col-sm-8 text-center ">
                    <span
                        class="title-small alt-font dark-gold font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.join_us_today') }}</span>
                    <h5 class="text-extra-large2 alt-font text-extra-medium-gray font-weight-300 letter-spacing-minus-1px margin-50px-bottom"
                        style="line-height: 42px">{{ __('landing.join_us_and_together_we_can_spread_the_greatness_of_health_and_wellness._let_us_create_a_new_landscape_and_blue_ocean_in_this_market_together.') }}</h5>
                    <button class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-1-half-rem-lr">
                    {{ __('landing.join_now') }}
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

@endsection


@section('js')
    <script>
        $(document).ready(function () {
            $('.shop-product-category-nav').on('click', function () {

                $('#product-items').addClass('grid-loading');
                var id = $(this).attr('value');

                var type = "POST";
                var ajaxurl = '{{ route('landing.product-list')}}';
                var formData = {
                    "_token": "{{ csrf_token() }}",
                    category_id: id,
                };
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        // console.log(data);
                        $('#product-items').empty();
                        $('#product-items').removeClass('grid-loading');
                        // $('#product-items').append(' <li class="grid-sizer"></li>');
                        $('#product-items').append(data);

                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            $('.shop-product-category-nav').first().click();
        });
    </script>
@endsection
