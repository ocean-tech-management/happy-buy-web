@extends('landing.app')

@section('content')
    @include('user.user-header')
    <div class="cover-background"
         style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">
        <section class="padding-five-lr xs-no-padding-lr">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ">
                        <!-- start tab navigation -->
                        <ul class="nav nav-pills nav nav-tabs text-uppercase justify-content-center text-center alt-font font-weight-500" id="pills-tab"
                            role="tablist">
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
{{--                    <div class="col-12 ">--}}
{{--                        <ul class="product-listing flex grid grid-5col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large text-center" id="product-items">--}}
{{--                            <li class="grid-sizer"></li>--}}

{{--                        </ul>--}}
{{--                    </div>--}}
                </div>
            </div>
        </section>
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
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.shop-product-category-nav').on('click', function () {

                $('#product-items').addClass('grid-loading');
                var id = $(this).attr('value');

                var type = "POST";
                var ajaxurl = '{{ route('user.product-list')}}';
                var formData = {
                    "_token": "{{ csrf_token() }}",
                    category_id: id,
                    type: "{{ $type }}",
                };
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        // console.log(data);
                        $('#product-items').empty();
                        $('#product-items').removeClass('grid-loading');
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
