@extends('landing.app')

@section('content')
    @if(Route::currentRouteName() == 'user.product-details')
        @include('user.user-header')
    @endif
    <div class="bg-white">
        <!-- start section -->
        <section class="big-section wow animate__fadeIn cover-background" style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">


            <div class="container">
                <div class="row">
                    <div class="col-12 shopping-content d-flex flex-column flex-lg-row align-items-md-center">
                        <div class="w-60 md-w-100">
                            <div class="product-images-box lightbox-portfolio row">
                                <div class="col-12 col-lg-9 px-lg-0 order-lg-2 product-image md-margin-10px-bottom">
                                    <div class="swiper-container product-image-slider"
                                         data-slider-options='{ "spaceBetween": 10, "watchOverflow": true, "navigation": { "nextEl": ".slider-product-next", "prevEl": ".slider-product-prev" }, "thumbs": { "swiper": { "el": ".product-image-thumb", "slidesPerView": "auto", "spaceBetween": 15, "direction": "vertical", "navigation": { "nextEl": ".swiper-thumb-next", "prevEl": ".swiper-thumb-prev" } } } }'
                                         data-thumb-slider-md-direction="horizontal">
                                        <div class="swiper-wrapper">
                                        @if($product->image_1)
                                            <!-- start slider item -->
                                                <div class="swiper-slide">
                                                    <a class="gallery-link" href="{{$product->image_1->url}}"><img class="w-100" src="{{$product->image_1->url}}" alt=""></a>
                                                </div>
                                                <!-- end slider item -->
                                        @endif
                                        @if($product->image_2)
                                            <!-- start slider item -->
                                                <div class="swiper-slide">
                                                    <a class="gallery-link" href="{{$product->image_2->url}}"><img class="w-100" src="{{$product->image_2->url}}" alt=""></a>
                                                </div>
                                                <!-- end slider item -->
                                        @endif
                                        @if($product->image_3)
                                            <!-- start slider item -->
                                                <div class="swiper-slide">
                                                    <a class="gallery-link" href="{{$product->image_3->url}}"><img class="w-100" src="{{$product->image_3->url}}" alt=""></a>
                                                </div>
                                                <!-- end slider item -->
                                        @endif
                                        @if($product->image_4)
                                            <!-- start slider item -->
                                                <div class="swiper-slide">
                                                    <a class="gallery-link" href="{{$product->image_4->url}}"><img class="w-100" src="{{$product->image_4->url}}" alt=""></a>
                                                </div>
                                                <!-- end slider item -->
                                        @endif
                                        @if($product->image_5)
                                            <!-- start slider item -->
                                                <div class="swiper-slide">
                                                    <a class="gallery-link" href="{{$product->image_5->url}}"><img class="w-100" src="{{$product->image_5->url}}" alt=""></a>
                                                </div>
                                                <!-- end slider item -->
                                        @endif
                                        @foreach($product->color_variances as $product_color_variance)
                                            @if($product_color_variance->photo != null )
                                                <!-- start slider item -->
                                                    <div class="swiper-slide">
                                                        <a class="gallery-link" href="{{$product_color_variance->photo->url}}"><img class="w-100"
                                                                                                                                    src="{{$product_color_variance->photo->url}}"
                                                                                                                                    alt=""></a>
                                                    </div>
                                                    <!-- end slider item -->
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="slider-product-next swiper-button-next text-extra-dark-gray"><i class="fa fa-chevron-right"></i></div>
                                    <div class="slider-product-prev swiper-button-prev text-extra-dark-gray"><i class="fa fa-chevron-left"></i></div>
                                </div>
                                <div class="col-12 col-lg-3 order-lg-1 single-product-thumb md-margin-50px-bottom sm-margin-40px-bottom">
                                    <div class="swiper-container product-image-thumb slider-vertical padding-15px-lr padding-45px-bottom md-no-padding left-0px">
                                        <div class="swiper-wrapper">
                                            @if($product->image_1)
                                                <div class="swiper-slide"><img class="w-100" src="{{$product->image_1->url}}" alt=""></div>
                                            @endif
                                            @if($product->image_2)
                                                <div class="swiper-slide"><img class="w-100" src="{{$product->image_2->url}}" alt=""></div>
                                            @endif
                                            @if($product->image_3)
                                                <div class="swiper-slide"><img class="w-100" src="{{$product->image_3->url}}" alt=""></div>
                                            @endif
                                            @if($product->image_4)
                                                <div class="swiper-slide"><img class="w-100" src="{{$product->image_4->url}}" alt=""></div>
                                            @endif
                                            @if($product->image_5)
                                                <div class="swiper-slide"><img class="w-100" src="{{$product->image_5->url}}" alt=""></div>
                                            @endif
                                            @foreach($product->color_variances as $product_color_variance)
                                                @if($product_color_variance->photo != null )
                                                    <div class="swiper-slide"><img class="w-100" src="{{$product_color_variance->photo->url}}"
                                                                                   gallery="{{$product_color_variance->photo->url}}" alt=""></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="swiper-thumb-next-prev text-center">
                                        <div class="swiper-button-prev swiper-thumb-prev"><i class="fa fa-chevron-up"></i></div>
                                        <div class="swiper-button-next swiper-thumb-next"><i class="fa fa-chevron-down"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-40 md-w-100 product-summary padding-7-rem-left lg-padding-5-rem-left md-no-padding-left h-100">
                            <div class="d-flex align-items-center margin-3-half-rem-bottom md-margin-1-half-rem-bottom ">
                                <div class="flex-grow-1">
                                    <div class="text-extra-dark-gray font-weight-500 text-extra-large alt-font margin-5px-bottom">{{ $product->name }}</div>
                                    <div class="row">
                                        @if(Auth::guard('user')->check())
                                            <div class="col-6">
                                            <span id="price">
                                                 PTS
                                            </span>
                                            </div>
                                        @endif
                                        <div class="col-6">
                                            <span class="alt-font font-weight-300 text-small text-black">{{ __('landing.product_code') }} </span> <span
                                                class="text-small text-medium-gray"> {{ $product->name }} </span>
                                        </div>

                                    </div>

                                </div>
                                {{--                                <div class="text-right line-height-30px">--}}
                                {{--                                    <div><a href="single-product.html#" class="letter-spacing-3px"><i class="fas fa-star text-very-small text-golden-yellow"></i><i--}}
                                {{--                                                class="fas fa-star text-very-small text-golden-yellow"></i><i class="fas fa-star text-very-small text-golden-yellow"></i><i--}}
                                {{--                                                class="fas fa-star text-very-small text-golden-yellow"></i><i class="fas fa-star text-very-small text-golden-yellow"></i></a></div>--}}
                                {{--                                    <span class="text-small invisible"><span class="text-extra-dark-gray">SKU: </span>8552635</span>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="alt-font font-weight-300 text-small margin-100px-tb">
                                <p> {!! App::isLocale('en') ? $product->short_desc_en: $product->short_desc_zh !!}</p>
                            </div>

                            @if($product->type == 1)
                                @if(sizeof($product->child_list) == 0)
                                <div class="margin-4-rem-top">
                                    <div class="margin-20px-bottom">
                                        <label class="text-extra-dark-gray text-small font-weight-300 alt-font w-100px">{{ __('landing.available_color') }}</label>
                                        <ul class="alt-font shop-color">
                                            @php $count = 0; @endphp
                                            @foreach($product->color_variances as $variance)
                                                <li>
                                                    <input class="d-none color-selection" type="radio" id="color-{{ $variance->color->id }}" value="{{ $variance->color->id }}"
                                                           name="color" slide-id="{{ $product->total_images + $count }}" checked/>
                                                    <label for="color-{{ $variance->color->id }}"><span
                                                            style="background-color: {{ $variance->color->color }};border: 2px solid #ddd;"></span></label>

                                                </li>
                                                @php $count += 1; @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="margin-2-rem-bottom">
                                        <label class="text-extra-dark-gray text-small font-weight-300 alt-font w-100px"> {{ __('user-portal.available_size') }}</label>
                                        <ul class="text-extra-small shop-size" id="variance-sizes">
{{--                                                                                    <li>--}}
{{--                                                                                        <input class="d-none" type="radio" id="size-1" name="size" checked/>--}}
{{--                                                                                        <label for="size-1" class="width-80"><span>S</span></label>--}}
{{--                                                                                    </li>--}}
{{--                                                                                    <li>--}}
{{--                                                                                        <input class="d-none" type="radio" id="size-2" name="size"/>--}}
{{--                                                                                        <label for="size-2" class="width-80"><span>M</span></label>--}}
{{--                                                                                    </li>--}}
{{--                                                                                    <li>--}}
{{--                                                                                        <input class="d-none" type="radio" id="size-3" name="size"/>--}}
{{--                                                                                        <label for="size-3" class="width-80"><span>L</span></label>--}}
{{--                                                                                    </li>--}}
                                        </ul>
                                    </div>

{{--                                    --}}{{--                                <div class="margin-4-rem-bottom">--}}
{{--                                    --}}{{--                                    <label class="text-extra-dark-gray text-small font-weight-300 alt-font w-100px">Quantity</label>--}}
{{--                                    --}}{{--                                    <ul class="text-extra-small shop-size" id="variance-quantities">--}}
{{--                                    --}}{{--                                        <li>--}}
{{--                                    --}}{{--                                            <input class="d-none" type="radio" id="size-1" name="size" checked/>--}}
{{--                                    --}}{{--                                            <label for="size-1" class="width-80"><span>S</span></label>--}}
{{--                                    --}}{{--                                        </li>--}}
{{--                                    --}}{{--                                        <li>--}}
{{--                                    --}}{{--                                            <input class="d-none" type="radio" id="size-2" name="size"/>--}}
{{--                                    --}}{{--                                            <label for="size-2" class="width-80"><span>M</span></label>--}}
{{--                                    --}}{{--                                        </li>--}}
{{--                                    --}}{{--                                        <li>--}}
{{--                                    --}}{{--                                            <input class="d-none" type="radio" id="size-3" name="size"/>--}}
{{--                                    --}}{{--                                            <label for="size-3" class="width-80"><span>L</span></label>--}}
{{--                                    --}}{{--                                        </li>--}}
{{--                                    --}}{{--                                    </ul>--}}
{{--                                    --}}{{--                                </div>--}}
                                </div>

                                @endif

                            @else
                                @foreach($product->product_list as $item)
                                    <span>{{ $item->name_en }}</span><br/>
                                @endforeach
                            @endif

                            @if(Auth::user() == NULL)
                                <div>
                                    <span class="alt-font dark-gold text-small text-uppercase font-weight-500">{{ __('user-portal.in_stock') }}</span>
                                </div>
                            @else
                                @if(Auth::guard('user')->user()->user_type != 4)
                                <div>
                                    @if(Auth::guard('user')->user()->allow_order_status != 2)
                                    <label class="text-extra-dark-gray text-small font-weight-300 alt-font w-100px">{{ __('user-portal.quantity') }}</label>
                                    <div class="quantity margin-15px-right">
                                        <label class="screen-reader-text">Quantity</label>

                                        @if(request()->route()->getName() == 'user.product-details')


                                                @if(sizeof($product->child_list) > 0)
                                                <ul class="alt-font shop-color">
                                                    @foreach($product->child_list as $item)

                                                        <li>
                                                            <input class="d-none quantity-selection" type="radio" id="color-{{ $item->id }}" value="{{ $item->id }}" name="color" slide-id="{{ $item->id }}" checked/>
                                                            <label for="color-{{ $item->id }}"><span
                                                                    style="background-color: #fdfdfd;border: 2px solid #ddd;"></span>{{ $item->name_en }}</label>

                                                        </li>

                                                        <input class="input-text qty-text" type="hidden" name="product_id" id="product_id" value="">
                                                    @endforeach
                                                </ul>
                                                <input class="input-text qty-text" type="hidden" name="quantity" id="quantity" value="1">
                                                <input class="input-text qty-text" type="hidden" name="product_type" id="product_type" value="1">
                                                @else
                                                    <input class="input-text qty-text" type="hidden" name="product_type" id="product_type" value="2">
                                                    <input type="button" value="-" class="qty-minus qty-btn" data-quantity="minus" data-field="quantity">
                                                    <input class="input-text qty-text" type="number" name="quantity" id="quantity" value="1">
                                                    <input type="button" value="+" class="qty-plus qty-btn" data-quantity="plus" data-field="quantity">
                                                @endif




{{--                                                <li>--}}
{{--                                                    <input class="d-none quantity-selection" type="radio" id="color-20" value="20" name="color" slide-id="20" checked/>--}}
{{--                                                    <label for="color-20"><span--}}
{{--                                                            style="background-color: #fdfdfd;border: 2px solid #ddd;"></span>20</label>--}}

{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <input class="d-none quantity-selection" type="radio" id="color-30" value="30" name="color" slide-id="30" checked/>--}}
{{--                                                    <label for="color-30"><span--}}
{{--                                                            style="background-color: #fdfdfd;border: 2px solid #ddd;"></span>30</label>--}}

{{--                                                </li>--}}


                                        @else
                                            <input type="button" value="-" class="qty-minus qty-btn" data-quantity="minus" data-field="quantity">
                                            <input class="input-text qty-text" type="number" name="quantity" id="quantity" value="1">
                                            <input type="button" value="+" class="qty-plus qty-btn" data-quantity="plus" data-field="quantity">
                                        @endif

                                    </div>
                                    @endif
                                    @if($type != 2)

                                            <br/><br/>
                                    @if(Auth::guard('user')->user()->allow_order_status != 2)
                                    <a href="#select-user-cart-form"
                                       class="popup-with-form btn bg-dark-gold text-white btn-medium"> {{__('user-portal.add_to_cart')}}</a>
                                    @endif
                                    <!-- start select user cart form -->

                                    <div id="select-user-cart-form" class="white-popup-block col-xl-3 col-lg-7 col-sm-9  p-0 mx-auto mfp-hide">
                                        <div class="padding-ten-all bg-white border-radius-6px xs-padding-six-all">
                                            <h6 class="text-extra-dark-gray alt-font font-weight-500 margin-35px-bottom xs-margin-15px-bottom">
                                                {{ __('user-portal.add_to_cart') }}
                                            </h6>
                                            <div>
                                                <label class="text-extra-dark-gray alt-font margin-15px-bottom"
                                                       >{{ __('user-portal.select_', ['title' => __('user-portal.user')]) }} <span
                                                        class="text-radical-red">*</span></label>
                                                <select class="form-control" id="select-add-to-cart-user">
                                                    <option value="{{ Auth::guard('user')->user()->id }}">Myself</option>
                                                    @foreach($my_vips as $vip)
                                                        <option value="{{$vip->id }}"> {{$vip->name}} - {{$vip->email}}</option>
                                                    @endforeach
                                                </select>

                                                @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                <button onclick="addToCart()"
                                                        class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px margin-1-half-rem-top w-100"
                                                        type="submit">
                                                    {{__('user-portal.add_to_cart')}}</button>
                                                @endif
                                                <div class="form-results d-none"></div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <a href="#select-user-cart-form"
                                           class="popup-with-form btn bg-dark-gold text-white btn-medium"> {{__('user-portal.redeem')}}</a>

                                        <!-- start select user cart form -->
                                        <div id="select-user-cart-form" class="white-popup-block col-xl-3 col-lg-7 col-sm-9  p-0 mx-auto mfp-hide">
                                            <div class="padding-ten-all bg-white border-radius-6px xs-padding-six-all">
                                                <h6 class="text-extra-dark-gray alt-font font-weight-500 margin-35px-bottom xs-margin-15px-bottom">
                                                    {{ __('user-portal.redeem') }}
                                                </h6>
                                                <div>
                                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom"  for="select-add-to-cart-user">
                                                        {{ __('user-portal.select_', ['title' => 'VIP']) }} <span
                                                            class="text-radical-red">*</span></label>
                                                    <select class="form-control" id="select-add-to-cart-user">
{{--                                                        <option value="{{ Auth::guard('user')->user()->id }}">Myself</option>--}}
                                                        @foreach($my_vips as $vip)
                                                            <option value="{{$vip->id }}"> {{$vip->name}} - {{$vip->email}} (PV: {{ getPvBalance($vip->id) }})</option>
                                                        @endforeach
                                                    </select>

                                                    @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                    <button onclick="addToCart()"
                                                            class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px margin-1-half-rem-top w-100"
                                                            type="submit">
                                                        {{__('user-portal.add_to_cart')}}</button>
                                                    @endif
                                                    <div class="form-results d-none"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                    <!-- end select user cart form -->

                                    {{--                                    <div class="margin-25px-top">--}}
                                    {{--                                        <a href="single-product.html#" class="text-uppercase text-extra-small alt-font margin-20px-right font-weight-500 "><i--}}
                                    {{--                                                class="feather icon-feather-heart align-middle margin-5px-right"></i>Add to wishlist</a>--}}
                                    {{--                                        <a href="single-product.html#" class="text-uppercase text-extra-small alt-font margin-20px-right font-weight-500 "><i--}}
                                    {{--                                                class="feather icon-feather-shuffle align-middle margin-5px-right"></i>Add to compare</a>--}}
                                    {{--                                    </div>--}}
                                </div>

                            @endif
                            <div class="d-flex alt-font margin-4-rem-top align-items-center">
                                {{--                                <div class="flex-grow-1">--}}
                                {{--                                    <span class="text-uppercase text-extra-small font-weight-500 text-extra-dark-gray d-block">Tags: <a href="shop-wide.html" class="font-weight-400">Lather bag</a></span>--}}
                                {{--                                </div>--}}
                                {{--                                <div class=" social-icon-style-02 w-50" style="margin-left: -10px">--}}
                                {{--                                    <ul class="extra-small-icon">--}}
                                {{--                                        <li><a class="text-extra-dark-gray facebook" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>--}}
                                {{--                                        <li><a class="text-extra-dark-gray twitter" href="http://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>--}}
                                {{--                                        <li><a class="text-extra-dark-gray linkedin" href="http://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>--}}
                                {{--                                    </ul>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="border-top border-width-1px border-color-medium-gray pt-0 wow animate__fadeIn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 p-0 tab-style-07">
                        <ul class="nav nav-tabs justify-content-center text-center alt-font font-weight-500 text-uppercase margin-9-rem-bottom border-bottom border-color-medium-gray md-margin-50px-bottom sm-margin-35px-bottom">
                            <li class="nav-item"><a data-toggle="tab" href="single-product.html#description" class="nav-link active">{{ __('landing.description') }}</a></li>
                            {{--                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="single-product.html#additionalinformation">Additional information</a></li>--}}
                            {{--                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="single-product.html#reviews">Reviews (2)</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="tab-content">
                    <!-- start tab item -->
                    <div id="description" class="tab-pane fade in active show">
                        {{--                        <div class="row align-items-center">--}}
                        {{--                            <div class="col-12 col-xl-5 col-lg-6 md-margin-50px-bottom">--}}
                        {{--                                <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the ‘s standard dummy text. Lorem ipsum has been--}}
                        {{--                                    the industry’s standard dummy text ever since. Lorem ipsum is simply dummy text. Lorem ipsum is simply dummy text of the printing and--}}
                        {{--                                    typesetting industry.</p>--}}
                        {{--                                <ul class="list-style-03">--}}
                        {{--                                    <li>Made from soft yet durable 100% organic cotton twill</li>--}}
                        {{--                                    <li>Front and back yoke seams allow a full range of motion</li>--}}
                        {{--                                    <li>Comfortable nylon-bound elastic cuffs seal in warmth</li>--}}
                        {{--                                    <li>Hem adjusts by pulling cord in handwarmer pockets</li>--}}
                        {{--                                    <li>Interior storm flap and zipper garage at chin for comfort</li>--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="col-12 col-lg-6 offset-xl-1">--}}
                        {{--                                <img src="{{asset('landing/images/product-details05.png')}}" alt="">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {!! App::isLocale('en') ? $product->desc_en: $product->desc_zh !!}
                    </div>
                    <!-- end tab item -->
                    <!-- start tab item -->
                    <div id="additionalinformation" class="tab-pane fade">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <table class="table-style-02">
                                    <tbody>
                                    <tr>
                                        <th class="text-extra-dark-gray font-weight-500">Color</th>
                                        <td>Black, Blue, Brown, Red, Silver</td>
                                    </tr>
                                    <tr class="bg-light-gray">
                                        <th class="text-extra-dark-gray font-weight-500">Size</th>
                                        <td>L, M, S, XL</td>
                                    </tr>
                                    <tr>
                                        <th class="text-extra-dark-gray font-weight-500">Style/Type</th>
                                        <td>Sports, Formal</td>
                                    </tr>
                                    <tr class="bg-light-gray">
                                        <th class="text-extra-dark-gray font-weight-500">Lining</th>
                                        <td>100% polyester taffeta with a DWR finish</td>
                                    </tr>
                                    <tr>
                                        <th class="text-extra-dark-gray font-weight-500">Material</th>
                                        <td>Lather, Cotton, Silk</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end tab item -->
                    <!-- start tab item -->
                    <div id="reviews" class="tab-pane fade">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-12 col-lg-10">
                                <ul class="blog-comment margin-5-half-rem-bottom">
                                    <li>
                                        <div class="d-block d-md-flex w-100 align-items-center align-items-md-start">
                                            <div class="w-75px sm-w-50px sm-margin-10px-bottom">
                                                <img src="landing/images/avtar27.jpg" class="rounded-circle w-95 sm-w-100" alt=""/>
                                            </div>
                                            <div class="w-100 padding-25px-left last-paragraph-no-margin sm-no-padding-left">
                                                <a href="single-product.html#" class="text-extra-dark-gray text-fast-blue-hover alt-font font-weight-500 text-medium">Herman
                                                    Miller</a>
                                                <span class="text-orange text-extra-small float-right letter-spacing-2px"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>
                                                <div class="text-medium text-medium-gray margin-15px-bottom">17 July 2020, 6:05 PM</div>
                                                <p class="w-85">Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's
                                                    standard dummy text ever since the make a type specimen book.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-10 margin-4-rem-bottom ">
                                <h6 class="alt-font text-extra-dark-gray font-weight-500 margin-5px-bottom">Add a review</h6>
                                <div class="margin-5px-bottom">Your email address will not be published. Required fields are marked <span class="text-radical-red">*</span></div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-10">
                                <form action="single-product.html#" method="post">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label class="margin-15px-bottom" for="basic-name">Your name <span class="text-radical-red">*</span></label>
                                            <input id="basic-name" class="medium-input border-radius-4px bg-white margin-30px-bottom" type="text" name="name"
                                                   placeholder="Enter your name">
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label class="margin-15px-bottom">Your email address <span class="text-radical-red">*</span></label>
                                            <input class="medium-input border-radius-4px bg-white margin-30px-bottom" type="text" name="email" placeholder="Enter your email">
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 margin-30px-bottom">
                                            <label class="margin-15px-bottom">Your rating <span class="text-radical-red">*</span></label>
                                            <span class="text-orange text-extra-small d-block"><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i
                                                    class="far fa-star"></i><i class="far fa-star"></i></span>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="margin-15px-bottom">Your comment</div>
                                            <textarea class="medium-textarea border-radius-4px bg-white h-120px margin-2-half-rem-bottom" rows="6" name="comment"
                                                      placeholder="Enter your comment"></textarea>
                                        </div>
                                        <div class="col-12 sm-margin-20px-bottom">
                                            <input class="btn btn-medium btn-dark-gray mb-0 btn-round-edge-small" type="button" name="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end tab item -->
                </div>
            </div>
        </section>
        <!-- end section -->
    </div>


@endsection

@section('js')
    <script>

    </script>
    <script>
        var color_id = 0;
        var size_id = 0;
        var variant_id = 0;
        @if(Auth::guard('user')->check())
        //show if user login
        function addToCart() {
            var user_id = $('#select-add-to-cart-user').val();
            var product_type = $('#product_type').val();
            console.log(product_type);
            console.log("color: " + color_id + " size: " + size_id + " variant: " + variant_id);
            console.log("user id: " + user_id);
            var type = "POST";
            var ajaxurl = '{{ route('user.product-add-to-cart')}}';
            var formData = {
                "_token": "{{ csrf_token() }}",
                user_id: '{{Auth::guard('user')->user()->id}}',
                to_user_id: user_id,
                product_variant_id: (product_type == 1) ? "" : variant_id,
                status: '1',
                quantity: (product_type == 1) ? "1" : $('#quantity').val(),
                product_id:  (product_type == 1) ? $('#product_id').val() : "{{ $product->id }}" ,
            };

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                success: function (data) {
                    var decoded = JSON.parse(data);
                    console.log(data);
                    if (decoded.success) {
                        alert('{{ __('user-portal.product_added_to_cart') }}');
                        location.reload();
                    } else {
                        alert('Some error occur');
                    }
                },
                error: function (data) {
                    alert('Some error occur.');
                    console.log(data);
                }
            });

        }
        @endif

        function onSizeSelect(variant_id_select, price) {
            variant_id = variant_id_select;

            $('#price').html(price + " PTS");
        }

        // function onQtySelect(variant_id_select, price){
        //     variant_id = variant_id_select;
        //
        //     $('#price').html( price + " PTS");
        // }

        // $(".size-selection").on('click',
        {{--function sizeVarianceClick(size_idid) {--}}
        {{--    //get qty variant--}}
        {{--    size_id = size_idid;--}}
        {{--    var type = "POST";--}}
        {{--    @if(Auth::user())--}}
        {{--    var ajaxurl = '{{ route('user.product-qty-variant')}}';--}}
        {{--    @else--}}
        {{--    var ajaxurl = '{{ route('landing.product-qty-variant')}}';--}}
        {{--    @endif--}}
        {{--    var formData = {--}}
        {{--        "_token": "{{ csrf_token() }}",--}}
        {{--        color_id: color_id,--}}
        {{--        size_id: size_id,--}}
        {{--        product_id: '{{ $product->id }}',--}}
        {{--    };--}}
        {{--    $.ajax({--}}
        {{--        type: type,--}}
        {{--        url: ajaxurl,--}}
        {{--        data: formData,--}}
        {{--        success: function (data) {--}}
        {{--            var decoded = JSON.parse(data);--}}
        {{--            $('#variance-quantities').empty();--}}
        {{--            var htmlcode = "";--}}

        {{--            $.each(decoded.variances, function (key, value) {--}}
        {{--                if(key == 0){--}}
        {{--                    variant_id = value.id;--}}
        {{--                    $('#price').html( value.price + " PTS");--}}
        {{--                }--}}
        {{--                htmlcode = htmlcode + '<li> <input class="d-none qty-selection" type="radio" id="qty-'+ value.quantity +'" name="quantity"/> <label for="qty-'+ value.quantity + '" onclick="onQtySelect('+value.id+', ' +value.price + ' )" class="width-80">' +--}}
        {{--                    '<span>' + value.quantity + '</span></label></li>';--}}
        {{--            });--}}
        {{--            $('#variance-quantities').html(htmlcode);--}}
        {{--            $(".qty-selection").first().click();--}}
        {{--        },--}}
        {{--        error: function (data) {--}}
        {{--            console.log(data);--}}
        {{--        }--}}
        {{--    });--}}

        {{--}--}}
        // );

        $(".color-selection").on('click', function () {
            //get size variant
            color_id = $(this).attr('value');
            // gallery_href = $(this).attr('gallery');

            // console.log(gallery_href);
            // $("img[gallery='" + gallery_href +"']").parent()[0].click();
            // $('.gallery-link').find("[href='" + gallery_href + "']").click();
            // console.log($("img[gallery='" + gallery_href +"']").parent()[0]);

            const swiper = document.querySelector('.swiper-container').swiper;
            swiper.slideTo($(this).attr('slide-id'));

            var type = "POST";
            @if(Auth::user())
            var ajaxurl = '{{ route('user.product-size-variant')}}';
            @else
            var ajaxurl = '{{ route('landing.product-size-variant')}}';
            @endif
            var formData = {
                "_token": "{{ csrf_token() }}",
                color_id: color_id,
                type: {{ $type ?? '' }},
                product_id: '{{ $product->id }}',
            };
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                success: function (data) {
                    console.log('type: ' + '{{ $type ?? '' }}');
                    // console.log(data);
                    //id="variant-sizes">
                    var decoded = JSON.parse(data);
                    $('#variance-sizes').empty();
                    var htmlcode = "";

                    $.each(decoded.variances, function (key, value) {
                        htmlcode = htmlcode + '<li> <input class="d-none size-selection" type="radio" onclick="onSizeSelect(' + value.id + ', ' + ((value.type == 3) ? value.vip_redeem_pv : value.price) + ')" id="size-' + value.size.id + '" name="size"/> <label for="size-' + value.size.id + '" class="width-80">' +
                            '<span>' + value.size.name + '</span></label></li>';
                    });
                    $('#variance-sizes').html(htmlcode);
                    $(".size-selection").first().click();
                },
                error: function (data) {
                    console.log(data);
                }
            });

        });

        $(".quantity-selection").on('click', function () {
            //get size variant
            quantity_id = $(this).attr('value');
            $('#quantity').val(quantity_id);
            $('#product_id').val(quantity_id);
            console.log(quantity_id);
        });

        $(document).ready(function () {
            $(".color-selection").first().click();
            $(".quantity-selection").first().click();
        });

    </script>


@endsection
