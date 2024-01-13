<!-- start header -->
<header>
    <!-- start navigation -->
    <nav class="navbar top-space navbar-expand-lg navbar-light navbar-boxed bg-white header-light fixed-top border-bottom border-color-black-transparent ">
        <div class="container-fluid nav-header-container">
            <div class="col-auto col-sm-6 col-lg-2 mr-auto pl-lg-0">
                <a class="navbar-brand" href="{{ route('landing.home') }}">
                    <img src="{{asset('landing/images/logo.svg')}}"  class="default-logo" alt="">
                    <img src="{{asset('landing/images/logo.svg')}}" class="alt-logo" alt="">
                    <img src="{{asset('landing/images/logo.svg')}}" class="mobile-logo" alt="">
                </a>
            </div>
            <div class="col-auto menu-order px-lg-0">
                <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav alt-font">
                        <li class="nav-item">
                            <a href="{{ route('landing.home') }}" class="nav-link">{{ __('landing.home') }}</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('landing.product') }}" class="nav-link">{{ __('landing.our_product') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('landing.aboutUs') }}" class="nav-link">{{ __('landing.about_erya') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('landing.joinUs') }}" class="nav-link">{{ __('landing.join_us_as_partners') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('landing.productQRCheck') }}" class="nav-link">{{ __('landing.product_qr_check') }}</a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('landing.aboutUs') }}" class="nav-link">{{ __('landing.about_us') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('landing.product-and-services') }}" class="nav-link">{{ __('landing.product_and_services') }}</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-auto text-right hidden-xs pr-0 font-size-0">
{{--                <div class="header-search-icon search-form-wrapper">--}}
{{--                    <a href="javascript:void(0)" class="search-form-icon header-search-form"><i class="feather icon-feather-search"></i></a>--}}
{{--                    <!-- start search input -->--}}
{{--                    <div class="form-wrapper">--}}
{{--                        <button title="Close" type="button" class="search-close alt-font">×</button>--}}
{{--                        <form id="search-form" role="search" method="get" class="search-form text-left" action="search-result.html">--}}
{{--                            <div class="search-form-box">--}}
{{--                                <span class="search-label alt-font text-small text-uppercase text-medium-gray">What are you looking for?</span>--}}
{{--                                <input class="search-input alt-font" id="search-form-input5e219ef164995" placeholder="Enter your keywords..." name="s" value="" type="text" autocomplete="off">--}}
{{--                                <button type="submit" class="search-button">--}}
{{--                                    <i class="feather icon-feather-search" aria-hidden="true"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <!-- end search input -->--}}
{{--                </div>--}}

                @if(!Auth::guard('user')->check())
                    <div class="header-language dropdown d-lg-inline-block">
                        <a href="javascript:void(0);"><i class="feather icon-feather-globe"></i></a>
                        <ul class="dropdown-menu alt-font">
                            {{--                        <li><a href="javascript:void(0);" title="English"><span class="icon-country"><img src="{{asset('landing/images/country-flag-16X16/usa.png')}}" alt=""></span>English</a></li>--}}
                            {{--                        <li><a href="javascript:void(0);" title="Chinese"><span class="icon-country"><img src="{{asset('landing/images/country-flag-16X16/china.png')}}" alt=""></span>Chinese</a></li>--}}
                            @foreach(config('panel.available_languages') as $langLocale => $langName)
                                <li>
                                    <a href="{{ url()->current() }}?change_language={{ $langLocale }}" title="{{ $langName }}">
                                        <span class="icon-country"><img src="{{asset('landing/images/country-flag-16X16/'. $langLocale .'.png')}}" alt=""></span>{{ $langName }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- <a class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-1-half-rem-lr ml-5"
                        href="{{ route('login') }}">
                        {{ __('landing.login') }}
                    </a> --}}
                @else
                    @if(Auth::guard('user')->user()->user_type != 4)
                        <div class="header-cart-icon dropdown">
                            <a href="{{ route('user.cart') }}"><i class="feather icon-feather-shopping-bag"></i>
                                @if(count( getCartItems(Auth::guard('user')->user()->id))!= 0)
                                    <span class="cart-count alt-font bg-dark-red text-white"> {{count( getCartItems(Auth::guard('user')->user()->id))}} </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu cart-item-list">
                                <div class=" d-none d-md-block">


                                    @if(count( getCartItems(Auth::guard('user')->user()->id)) > 0)
                                        @foreach(getCartItems(Auth::guard('user')->user()->id) as $cart)
                                            <li class="cart-item align-items-center">
                                                <div class="product-image">
                                                    @if($cart->product_variant != NULL)
                                                        @if($cart->product_variant->photo != NULL)
                                                            <img src="{{ $cart->product_variant->photo->url }}" class="cart-thumb" alt="" />
                                                        @endif
                                                    @else
                                                        @if($cart->product->photo != NULL)
                                                            <img src="{{ $cart->product->photo->url }}" class="cart-thumb" alt="" />
                                                        @endif
                                                    @endif

                                                </div>
                                                <div class="product-detail alt-font">
                                                    <span>{{$cart->product->name}}</span>
                                                    <div>
                                                        @if($cart->product_variant != NULL)
                                                            <span class="item-ammount">{{$cart->product_variant->color->name." ".$cart->product_variant->size->name ." - Qty: ".$cart->quantity}}</span>
                                                        @endif

                                                    </div>
                                                    @if($cart->product_variant != NULL)
                                                        <span class="item-ammount">{{$cart->product_variant->price}} PV</span>
                                                    @endif

                                                </div>
                                            </li>
                                             @php
                                             if(empty($sub_total)){$sub_total = 0 ;}
                                            if($cart->product_variant != NULL){
                                                $sub_total += $cart->product_variant->price* $cart->quantity;
                                            }
                                             @endphp
                                        @endforeach
                                    @endif

                                    <li class="cart-item cart-total">
                                        <div class="alt-font margin-15px-bottom"><span class="w-50 d-inline-block text-medium text-uppercase">{{ __('user-portal.subtotal') }}:</span><span class="w-50 d-inline-block text-right text-medium font-weight-500">{{empty($sub_total) ? 0 :number_format($sub_total)}} PV</span></div>
                                        <a href="{{ route('user.cart') }}" class="btn btn-small bg-dark-gold text-white">{{ __('user-portal.view_cart') }}</a>
                                    </li>
                                </div>
                            </ul>
                        </div>
                        <div class="header-language d-lg-inline-block">
                            <a href="{{ route('user.redeem-cart') }}"><i class="feather icon-feather-gift"></i></a>
                        </div>
                    @endif

                    <div class="header-language dropdown d-lg-inline-block">
                        <a href="javascript:void(0);"><i class="feather icon-feather-globe"></i></a>
                        <ul class="dropdown-menu alt-font">
                            {{--                        <li><a href="javascript:void(0);" title="English"><span class="icon-country"><img src="{{asset('landing/images/country-flag-16X16/usa.png')}}" alt=""></span>English</a></li>--}}
                            {{--                        <li><a href="javascript:void(0);" title="Chinese"><span class="icon-country"><img src="{{asset('landing/images/country-flag-16X16/china.png')}}" alt=""></span>Chinese</a></li>--}}
                            @foreach(config('panel.available_languages') as $langLocale => $langName)
                                <li>
                                    <a href="{{ url()->current() }}?change_language={{ $langLocale }}" title="{{ $langName }}">
                                        <span class="icon-country"><img src="{{asset('landing/images/country-flag-16X16/'. $langLocale .'.png')}}" alt=""></span>{{ $langName }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="header-language dropdown ml-2">
                        <a href="{{ route('user.home') }}">
{{--                            {{ Auth::guard('user')->user()->name }}--}}
                            <i class="feather icon-feather-user"></i>
                        </a>
                        <ul class="dropdown-menu alt-font text-extra-large">
                            <li><a href="{{ route('user.home') }}" title="English">{{__('user-portal.my_profile')}}</a></li>
                            <li class=" " style="margin-bottom: 4px">
                                <a class=" text-extra-large " href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
                                   style="width: 100%"> {{__('global.logout')}} </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
<!-- end header -->
