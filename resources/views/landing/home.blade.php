@extends('landing.app')

@section('css')
    <style>
        .top-banner {
            background-image: url('{{ __('landing/images/adomas-aleno-gQuiE815FMc-unsplash.png') }}');
            height: 950px;
            background-position: right center;
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
                                                                                                                            rgba(0, 0, 0, 0.75) 100%
                                                                                                                        );
                                                                                                                        top: 0;
                                                                                                                        left: 0;
                                                                                                                        z-index: 0;
                                                                                                                    } */

        .second-banner {
            background-image: url('{{ __('landing/images/Mesa de trabajo 1.png') }}');
            height: 500px;
            background-size: cover;
            position: relative;
        }

        .text-primary {
            color: #ee9134 !important;
        }

        .one-line {
            white-space: nowrap;
            overflow: hidden;
            display: block;
            text-overflow: ellipsis;
        }

        @media (max-width: 1200px) {
            .top-banner {
                height: 600px;
            }

        }

        @media(max-width:762px) {
            /* .overlay::after {
                                                                                                                            content: "";
                                                                                                                            position: absolute;
                                                                                                                            width: 100%;
                                                                                                                            height: 100%;
                                                                                                                            background: rgb(0, 0, 0);
                                                                                                                            background: linear-gradient(
                                                                                                                                180deg,
                                                                                                                                rgba(0, 0, 0, 0.3255427170868347) 0%,
                                                                                                                                rgba(0, 0, 0, 0.75) 100%
                                                                                                                            );
                                                                                                                            top: 0;
                                                                                                                            left: 0;
                                                                                                                            z-index: 0;
                                                                                                                        } */

            .overlay {
                background-position: top right;
            }
        }

        .custom-text-1 {
            color: #ee9134;
        }

        .custom-text-2 {
            color: #444;
        }

        @media (max-width: 600px) {
            .top-banner {
                height: 400px;
            }

            .custom-text-1 {
                color: #000;
            }

            .custom-text-2 {
                color: #000;
            }

            .custom-background-position {
                background-position: top center !important;
            }

            .custom-line::before {
                left: 10% !important;
            }
        }

        .custom-line {
            position: relative;
        }

        .custom-line::before {
            content: '';
            width: 1px;
            height: 90%;
            position: absolute;
            background: #aaa;
            left: 11.5%;
            top: 5%;
        }

        .primary-gradient {
            background: rgb(243, 112, 33);
            background: linear-gradient(180deg, rgba(243, 112, 33, 1) 0%, rgba(252, 159, 85, 1) 86%);
        }

        .custom-title {
            white-space: nowrap;
            overflow: hidden;
            display: block;
            text-overflow: ellipsis;
        }

        .aboutUs1 {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            position: relative;
        }

        .img-container {
            position: relative;
            z-index: 2;
            margin-right: -20px;
        }

        .img-container2 {
            position: relative;
        }

        .text-container {
            background: transparent linear-gradient(360deg, #FE9900 0%, #F26711 100%) 0% 0% no-repeat padding-box;
            display: flex;
            width: 300px;
            height: 280px;
            color: white;
            padding: 30px;
            text-align: start;
            font-size: 30px;
            z-index: 1;
            position: relative;
            justify-content: center;
            align-items: center;
            line-height: 1.5
        }

        .custom-banner-wrapper {
            position: relative;
            text-align: center;
            overflow: hidden;
            display: inline-block;
        }

        .custom-banner {
            max-width: 100%;
            width: 700px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .custom-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(254, 153, 0, 0) 0%, rgba(242, 103, 17, 1) 100%);
            pointer-events: none;
        }


        .product-grid {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            margin-top: 20px;
        }

        .product-item {
            background: #fff;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }

        .product-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-name {
            font-size: 16px;
            margin: 10px 0;
        }

        .product-price {
            color: #ee9134;
            font-size: 14px;
        }

        .view-more-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: white;
            color: #ee9134;
            border: none;
            border-radius: 999px;
            /* Makes the button pill-shaped */
            cursor: pointer;
            text-transform: uppercase;
            /* Makes the text uppercase */
            font-weight: bold;
            letter-spacing: 1px;
            /* Adds some spacing between letters */
        }

        /* Media Queries for responsiveness */
        @media (max-width: 1200px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            }
        }

        @media (max-width: 992px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }

        @media (max-width: 576px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }
        }

        .tabs {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: transparent;
            color: white;
            position: relative;
        }

        .tab::after {
            content: '';
            display: block;
            height: 2px;
            width: 0;
            background: white;
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            transition: width 0.3s;
        }

        .tab.active::after {
            width: 100%;
        }

        .submit-button {
            background: linear-gradient(0deg, rgba(242, 103, 17, 1) 17%, rgba(254, 153, 0, 1) 59%);
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 10px 30px;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            font-size: 14px;
            justify-content: center;
            align-items: center;
        }

        .submit-button i {
            margin-left: 5px;
        }

        /* Adjust hover and focus styles as needed */
        .submit-button:hover,
        .submit-button:focus {
            background: linear-gradient(0deg, rgba(242, 103, 17, 1) 17%, rgba(254, 153, 0, 1) 59%);
            outline: none;
        }
    </style>
@endsection
@section('content')
    <!-- start banner section -->
    <section class="d-flex flex-column justify-content-end justify-content-lg-center top-banner">
        <div class="container" style="max-width: 1400px ">
            <div class="row align-items-center justify-content-center">
                <div class="col-10 col-lg-5 col-sm-7">
                    <div class="position-relative ">
                        <span
                            class=" text-extra-large alt-font line-height-20px z-index-9 position-relative d-inline-block letter-spacing-4px text-white">{{ __('landing.self_love_and_confidence') }}</span>
                    </div>
                    <div class="position-relative ">
                        <span
                            class="@if (app()->getLocale() == 'en') title-small pr-md-5 @else title-large @endif alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px text-white">{{ __('landing.starts_from') }}<br>{{ __('landing.the_innerself') }}</span>
                    </div>
                </div>
                <div class="col-9 col-lg-5 col-sm-5 text-center xs-margin-30px-bottom">
                    <img src="landing/images/Group 200.png" alt="" />
                </div>
            </div>
        </div>
    </section>

    <section class="overlap-height wow animate__fadeIn second-banner pt-5">
        <div class="container" style="max-width: 1400px;">
            <div class="row justify-content-center">
                <span
                    class="title-small alt-font text-primary font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.about_us') }}</span>
            </div>
            <div class="row">
                <div class="col-6 col-xl-6 col-lg-6 col-sm-12">
                    <div class="aboutUs1">
                        <div class="img-container">
                            <img src="landing/images/Group 3586.png" alt="" style="height: 320px; width: 350px" />
                        </div>
                        <div class="text-container text-start">
                            <span>{!! __('landing.home_about_us_desc_line') !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-6 col-lg-6 col-sm-12 text-start d-flex">
                    <div class="aboutUs2" style="font-size: 24px; justify-content: center;">
                        <div class="home-abt-desc py-3">
                            <span
                                class="alt-font text-primary font-weight-300 d-block margin-30px-bottom letter-spacing-3px">
                                {!! __('landing.home_about_us_desc_line1') !!}
                            </span>
                            <span class="alt-font font-weight-300 d-block letter-spacing-3px">{!! __('landing.home_about_us_desc_line2') !!} <br>
                                {!! __('landing.home_about_us_desc_line3') !!}</span>
                        </div>
                        <div class="home-abt-btn py-3">
                            <a href="{{ route('landing.aboutUs') }}" class="submit-button">
                                {{ __('landing.about_us') }} <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="overlap-height wow animate__fadeIn py-3 !important"
        style="background: linear-gradient(0deg, rgba(254,153,0,1) 0%, rgba(242,103,17,1) 58%);">
        <div class="container" style="max-width: 1400px;">
            <div class="row justify-content-center">
                <div class="text-center">
                    <div class="custom-banner-wrapper">
                        <img src="{{ asset('https://api2.happybuy.asia/storage/uploads/20240305101346465183.jpg?x-oss-process=image/format,webp') }}"
                            alt="Banner Image 2" class="custom-banner">
                    </div>
                </div>
            </div>
            <!-- Product Section -->
            <div class="row justify-content-center mt-4">
                <div class="col-12">
                    <div class="tabs">
                        <div class="tab active" data-category="health">{!! __('landing.product_tab_health') !!}</div>
                        <div class="tab" data-category="beauty">{!! __('landing.product_tab_beauty') !!}</div>
                        <div class="tab" data-category="personal-care">{!! __('landing.product_tab_personal_care') !!}</div>
                    </div>
                    <div class="product-grid" id="productGrid">
                    </div>
                    <div class="py-3">
                        <button class="view-more-btn" id="viewMoreBtn">{!! __('landing.view_more') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="overlap-height wow animate__fadeIn" style="background: #FDF3EA">
        <div class="container" style="max-width: 1400px;">
            <div class="row justify-content-center">
                <span
                    class="title-small alt-font text-primary font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.happbuy_reward_pathway') }}</span>
            </div>
            <div class="row">
                <div class="col-6 col-xl-6 col-lg-6 col-sm-12">
                    <div class="aboutUs1">
                        <div class="img-container2">
                            <img src="landing/images/Group 3584.png" alt="" style="height: 450px; width: 550px" />
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-6 col-lg-6 col-sm-12 text-start">
                    <div class="aboutUs2" style="font-size: 24px">
                        <div class="home-abt-desc py-3">
                            <span
                                class="alt-font text-primary font-weight-300 d-block margin-30px-bottom letter-spacing-3px">{!! __('landing.happybuy_reward_pathway_desc_line1') !!}</span>
                            <span class="alt-font font-weight-300 d-block letter-spacing-3px">{!! __('landing.happybuy_reward_pathway_desc_line2') !!}</span>
                        </div>
                        <div class="home-abt-btn py-3">
                            <a href="{{ route('landing.reward') }}" class="submit-button">
                                {{ __('landing.reward') }} <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class=" overlap-height wow animate__fadeIn"
        style="background: linear-gradient(0deg, rgba(242,103,17,1) 28%, rgba(254,153,0,1) 81%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-8 col-lg-7 col-sm-8 text-center ">
                    <span class="title-small alt-font dark-gold font-weight-300 d-block letter-spacing-3px"
                        style="color: white">{{ __('landing.contact_us') }}</span>
                </div>
                <div class="lg-padding-30px-lr md-padding-15px-lr sm-margin-40px-bottom ">
                    <form class="row padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-all justify-content-center">
                        <div class="col-12 col-xl-6 col-lg-12">
                            <div class="p-3">
                                <input class="small-input bg-white margin-30px-bottom required error rounded-input"
                                    type="text" name="name" placeholder="{{ __('landing.enter_your_name') }}">
                                <input class="small-input bg-white margin-30px-bottom required error rounded-input"
                                    type="text" name="name" placeholder="{{ __('landing.enter_your_contact') }}">
                                <input class="small-input bg-white margin-30px-bottom required rounded-input"
                                    type="email" name="email"
                                    placeholder="{{ __('landing.enter_your_email_address') }}">
                                <textarea class="small-input bg-white margin-30px-bottom required rounded-input" rows="8" name="password"
                                    placeholder="{{ __('landing.type_in_your_message') }}"></textarea>
                                <button type="submit"
                                    class="text-medium alt-font font-weight-300 btn bg-white text-uppercase text-orange letter-spacing-2px padding-1-half-rem-lr rounded pb-3">
                                    {{ __('landing.submit') }}
                                </button>
                            </div>
                        </div>

                        <div class="col-12 col-xl-6 col-lg-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="p-3">
                                        <div class="map-style-3 h-200px xs-h-200px">
                                            <iframe class="w-400 h-100"
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.749589750438!2d101.72092417537621!3d3.160567453081512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc37a11e1cdecf%3A0x8f5a81cdf3e9a2d7!2sG-Vestor%20Tower!5e0!3m2!1sen!2smy!4v1703069879964!5m2!1sen!2smy"
                                                width="500" height="350" style="border:0; border-radius: 20px"
                                                allowfullscreen="" loading="lazy"
                                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                        <div class="py-3">
                                            <div class="d-flex align-items-start" style="color: white">
                                                <div class="me-3 px-2">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </div>
                                                <div class="px-3">
                                                    <ul class="list-unstyled mb-0">
                                                        <li>HappyBuy</li>
                                                        <li>
                                                            <a href="{{ route('landing.contactUs') }}"
                                                                style="color: white">
                                                                23A Floor, Menara Keck Seng,<br>
                                                                203 Jalan Bukit Bintang,<br>
                                                                55100 Kuala Lumpur, Malaysia
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="py-3">
                                            <div class="d-flex align-items-start" style="color: white">
                                                <div class="me-3 px-2">
                                                    <i class="fa fa-link"></i>
                                                </div>
                                                <div class="px-3">
                                                    <span><a href="http://happybuy.asia" target="_blank"
                                                            style="color: white">http://happybuy.asia</a></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="bg-light-yellow overlap-height wow animate__fadeIn" style="background: #fff5ef;">
        <span class="text-center alt-font text-primary d-block margin-50px-bottom letter-spacing-3px px-5"
            style="font-size:30px;">{{ __('landing.2024_plan') }}</span>
        <div
            class="padding-twelve-lr xl-padding-five-lr lg-padding-two-lr xs-no-padding-lr d-flex flex-column align-items-center mx-auto">
            @foreach (__('landing.plans') as $plan)
                <div class="d-flex flex-column">
                    <div class="d-flex my-4 px-4" style="max-width:375px;">
                        <div class="mr-4 primary-gradient p-3 text-white"
                            style="border-radius:50%;@if (app()->getLocale() == 'en') letter-spacing:3px; @endif">
                            {!! $plan['month'] !!}</div>
                        <div class="primary-gradient p-3 text-white custom-title" style="border-radius:12px;flex:1;">
                            {{ $plan['title'] }}</div>
                    </div>
                    <div class="@if (!$loop->last) custom-line @endif d-flex flex-column">
                        @foreach ($plan['schedules'] as $schedule)
                            <div class="d-flex">
                                <div class="mr-4 primary-gradient p-3 text-white" style="border-radius:50%;opacity:0;">
                                    {{ $plan['month'] }}</div>
                                <div class="px-3 mb-3 ml-4">
                                    <div class="text-primary" style="border-radius:12px;width:70vw;font-weight:600;">
                                        {{ $schedule['date'] }}</div>
                                    <div class="" style="color:#707070;border-radius:12px;width:70vw;">
                                        {{ $schedule['event'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let productData = [];
            let currentIndex = 0; 
            const productsPerPage = 6;
            const maxProductsToShow = 18; 
            let currentCategory = 'health';

            // Function to fetch banner data
            function fetchBanners() {
                return fetch('https://api2.happybuy.asia/api/v1/home/top?lang=zh-cn&uid=')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Banners data:', data);
                        const bannerData = data.data.banner;

                        // Generate HTML for each banner image
                        const bannerSection = document.getElementById('bannerSection');
                        bannerData.forEach(banner => {
                            const img = document.createElement('img');
                            img.src = banner.image;
                            img.alt = banner.title;
                            img.style.maxWidth = '100%';
                            img.style.height = 'auto';
                            bannerSection.appendChild(img);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching banner images:', error);
                    });
            }

            function fetchProducts(category, limit, offset) {
                return fetch(
                        `https://api2.happybuy.asia/api/v1/goods/list?lang=zh-cn&uid=&keyword=&page=1&category=${category}`
                    )
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        return data.data.list.slice(offset, offset +
                            limit);
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
                        return [];
                    });
            }

            // Function to display products in the product grid
            function displayProducts(products) {
                const productGrid = document.getElementById('productGrid');

                if (currentIndex === 0) {
                    productGrid.innerHTML = '';
                }

                products.forEach(product => {
                    const productItem = document.createElement('div');
                    productItem.classList.add('product-item');
                    productItem.innerHTML = `
                        <img src="${product.main_image}" alt="${product.title}">
                        <div class="product-name">${product.title}</div>
                        <div class="product-price">$${product.market_price_min}</div>
                    `;
                    productGrid.appendChild(productItem);
                });

                currentIndex += products.length;
            }

            function loadInitialProducts(category) {
                currentIndex = 0;
                fetchProducts(category, productsPerPage, currentIndex)
                    .then(products => {
                        displayProducts(products);
                    })
                    .catch(error => {
                        console.error('Error loading initial products:', error);
                    });
            }

            // Event listener for category tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    currentCategory = this.getAttribute('data-category');
                    loadInitialProducts(currentCategory);
                });
            });

            document.getElementById('viewMoreBtn').addEventListener('click', function() {
                fetchProducts(currentCategory, productsPerPage, currentIndex)
                    .then(products => {
                        displayProducts(products);
                    })
                    .catch(error => {
                        console.error('Error loading more products:', error);
                    });
            });

            // Call both fetch functions
            fetchBanners();
            loadInitialProducts(currentCategory);
        });
    </script>
@endsection
