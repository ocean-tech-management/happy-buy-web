@extends('landing.app')

@section('content')
    <!-- start banner section -->
    <section class="top-banner">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-lg-8 col-md-8">
                                        <div class="top-banner-content-wrapper">
                                            <div class="top-banner-textWrapper row line-height-20px z-index-9 text-white">
                                                {{ __('landing.happy_buy_at_happyBuy_mobile') }}
                                            </div>
                                            <div class="top-banner-iconWrapper row line-height-20px z-index-9 text-white">
                                                <div class="icon-group">
                                                    <div><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                                                    <div>{{ __('landing.buy') }}</div>
                                                    <div>{{ __('landing.a_product') }}</div>
                                                </div>
                                                <div class="icon-group">
                                                    <div><i class="fa fa-share-alt" aria-hidden="true"></i></div>
                                                    <div>{{ __('landing.share') }}</div>
                                                    <div>{{ __('landing.user_experience') }}</div>
                                                </div>
                                                <div class="icon-group">
                                                    <div><i class="fa fa-gift" aria-hidden="true"></i></div>
                                                    <div>{{ __('landing.earn') }}</div>
                                                    <div>{{ __('landing.reward_105') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 xs-margin-20px-bottom">
                                        <img src="landing/images/this_is_a_phone.png" alt="Phone Image"
                                            class="phone-image" />
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-lg-8 col-md-8">
                                        <div class="top-banner-content-wrapper">
                                            <div class="top-banner-textWrapper row line-height-20px z-index-9 text-white">
                                                {{ __('landing.happy_buy_at_happyBuy_mobile') }}
                                            </div>
                                            <div class="top-banner-iconWrapper row line-height-20px z-index-9 text-white">
                                                <div class="icon-group">
                                                    <div><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                                                    <div>{{ __('landing.buy') }}</div>
                                                    <div>{{ __('landing.a_product') }}</div>
                                                </div>
                                                <div class="icon-group">
                                                    <div><i class="fa fa-share-alt" aria-hidden="true"></i></div>
                                                    <div>{{ __('landing.share') }}</div>
                                                    <div>{{ __('landing.user_experience') }}</div>
                                                </div>
                                                <div class="icon-group">
                                                    <div><i class="fa fa-gift" aria-hidden="true"></i></div>
                                                    <div>{{ __('landing.earn') }}</div>
                                                    <div>{{ __('landing.reward_105') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 xs-margin-20px-bottom">
                                        <img src="landing/images/this_is_a_phone.png" alt="Phone Image"
                                            class="phone-image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleControls" data-slide-to="1"></li>
                        </ol>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="overlap-height second-banner pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <span class="title-small font-weight-300 d-block margin-50px-bottom"
                    style="color: #ff6600">{{ __('landing.about_us') }}</span>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 text-center text-lg-start">
                    <div class="aboutUs1">
                        <div class="d-flex">
                            <div class="img-container">
                                <img src="landing/images/Group 3586.png" alt="">
                            </div>
                            <div class="text-container text-start"
                                style="width: 50%; color:white; background: linear-gradient(0deg, rgba(242,103,17,1) 17%, rgba(254,153,0,1) 59%); border-radius: 20px">
                                <span>{!! __('landing.home_about_us_desc_line') !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-center text-lg-start d-flex">
                    <div class="aboutUs2" style="font-size: 24px; justify-content: center;">
                        <div class="home-abt-desc py-3 text-start">
                            <span class="home_about_us_desc_line1 d-block margin-30px-bottom letter-spacing-3px"
                                style="color: #ff6600">{!! __('landing.home_about_us_desc_line1') !!}</span>
                            <span
                                class="home_about_us_desc_line3 d-block letter-spacing-3px line-height-2px">{!! __('landing.home_about_us_desc_line2') !!}<br>{!! __('landing.home_about_us_desc_line3') !!}</span>
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
            <div class="row justify-content-center mt-4">
                <div class="col-12 justify-item-center text-center">
                    <div class="tabs">
                        <div class="tab active" data-category="health">{!! __('landing.product_tab_health') !!}</div>
                        <div class="tab" data-category="beauty">{!! __('landing.product_tab_beauty') !!}</div>
                        <div class="tab" data-category="personal-care">{!! __('landing.product_tab_personal_care') !!}</div>
                    </div>
                    <div class="product-grid" id="productGrid">
                    </div>
                    <div class="py-3 justify-item-center">
                        <button class="view-more-btn rounded-pill" id="viewMoreBtn">{!! __('landing.view_more') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="overlap-height" style="background: #FDF3EA">
        <div class="container">
            <div class="row justify-content-center">
                <span class="title-small font-weight-300 d-block margin-50px-bottom"
                    style="color: #ff6600">{{ __('landing.happbuy_reward_pathway') }}</span>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 text-center text-lg-start">
                    <div class="aboutUs1">
                        <div class="img-container2">
                            <img src="landing/images/Group 3584.png" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-center text-lg-start">
                    <div class="aboutUs2" style="font-size: 24px">
                        <div class="home-abt-desc py-3 text-start">
                            <span class="d-block margin-30px-bottom letter-spacing-3px"
                                style="color: #ff6600">{!! __('landing.happybuy_reward_pathway_desc_line1') !!}</span>
                            <span class="d-block letter-spacing-3px" style="color: #7A7A7A">{!! __('landing.happybuy_reward_pathway_desc_line2') !!}</span>
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

    <section class="overlap-height"
        style="background: linear-gradient(0deg, rgba(242,103,17,1) 28%, rgba(254,153,0,1) 81%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-8 col-lg-7 col-sm-8 text-center pb-3">
                    <span class="title-small dark-gold font-weight-300 d-block"
                        style="color: white">{{ __('landing.contact_us') }}</span>
                </div>
                <div class="col-12 lg-padding-30px-lr md-padding-15px-lr sm-margin-40px-bottom">
                    <form class="row contact-form">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="contact-us-section p-3">
                                <input class="small-input bg-white margin-30px-bottom required rounded-input"
                                    type="text" name="name" placeholder="{{ __('landing.enter_your_name') }}">
                                <input class="small-input bg-white margin-30px-bottom required rounded-input"
                                    type="text" name="contact" placeholder="{{ __('landing.enter_your_contact') }}">
                                <input class="small-input bg-white margin-30px-bottom required rounded-input"
                                    type="email" name="email"
                                    placeholder="{{ __('landing.enter_your_email_address') }}">
                                <textarea class="small-input bg-white margin-30px-bottom required rounded-input" rows="8" name="message"
                                    placeholder="{{ __('landing.type_in_your_message') }}"></textarea>
                                <button type="submit"
                                    class="text-medium rounded-pill font-weight-300 btn bg-white text-uppercase text-orange letter-spacing-2px padding-1-half-rem-lr rounded">
                                    {{ __('landing.submit') }}
                                </button>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="p-3">
                                <div class="map-style-3 h-200px xs-h-200px">
                                    <iframe class="w-100 h-100"
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
                                                    <a href="{{ route('landing.contactUs') }}" style="color: white">
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
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let productData = [];
            let currentIndex = 0;
            const productsPerPage = 4;
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
                        // console.log('Banners data:', data);
                        const bannerData = data.data.banner;

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
                // console.log('my product', products)
                const productGrid = document.getElementById('productGrid');

                if (currentIndex === 0) {
                    productGrid.innerHTML = '';
                }

                products.forEach(product => {
                    const productItem = document.createElement('div');
                    productItem.classList.add('col-6', 'col-sm-6', 'col-md-4', 'col-lg-3', 'mb-4');
                    let langTitle = '';
                    let locale = `{{ app()->getLocale() }}`;
                    try {
                        const titleObj = JSON.parse(product.title);
                        langTitle = titleObj.en;
                        switch (locale) {
                            case 'en':
                                langTitle = titleObj.en;
                                break;
                            case 'zh-Hans':
                                langTitle = titleObj.zh;
                                break;
                        }
                    } catch (e) {
                        console.error('Failed to parse product title:', e);
                    }
                    productItem.innerHTML = `
                        <div class="card border-none h-100 product-item">
                            <a href="{{ route('landing.selectedProductDetails', ['goods_sn' => '${product.goods_sn}']) }}">
                                <img src="${product.main_image}" class="card-img-top" alt="${product.title}">
                                    <div class="card-title">${langTitle}</div>
                                    <div class="card-price">${'RM' + product.market_price_min}</div>
                            </a>
                        </div>
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
            fetchBanners();
            loadInitialProducts(currentCategory);
        });

        $(document).ready(function() {
            $('#carouselExampleControls').carousel({
                interval: 4000
            });
        });
    </script>


    <style>
        /* Utility classes */
        .text-center {
            text-align: center;
        }

        .text-start {
            text-align: start;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        .flex-column {
            flex-direction: column;
        }

        /* Container styles */
        .container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Banner section styles */
        .top-banner {
            background-image: url('{{ __('landing/images/adomas-aleno-gQuiE815FMc-unsplash.png') }}');
            background-size: cover;
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .phone-image {
            max-width: 70%;
            height: auto;
            display: block;
            margin: 0 auto;
            max-height: 100%;
        }

        .text-container {
            text-align: start;
            align-content: center;
            font-size: 2rem;
            font-weight: 300;
            line-height: 1;
            padding: 4rem;
        }

        .title-small {
            font-size: 1.5rem;
            line-height: 1.5;
        }

        /* Second banner section styles */
        .second-banner {
            background-color: #FDF3EA;
            background-image: url('{{ __('landing/images/Mesa de trabajo 1.png') }}');
            background-size: cover;
            background-position: center;
            padding-top: 5rem;
        }


        .aboutUs1 .img-container img,
        .aboutUs2 .img-container img {
            max-width: 100%;
            height: auto;
        }

        .aboutUs2 {
            font-size: 24px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-left: 15px;
        }

        .home-abt-desc {
            padding-right: 15px;
        }

        .home-abt-btn {
            margin-top: 20px;
        }

        .submit-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: orange;
            color: white;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: darkorange;
            /* Darker shade of orange on hover */
        }

        .custom-banner-wrapper {
            text-align: center;
        }

        .custom-banner {
            max-width: 100%;
            height: 200px;
            width: auto;
        }

        /* Product section styles */
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .product-item {
            flex: 1 1 calc(33.333% - 20px);
            /* margin: 10px; */
            text-align: center;
            padding: 0.8rem;
            border-radius: 10px;
        }

        .product-item img {
            max-height: 300px;
            object-fit: cover;
            width: 100%;
            height: auto;
        }

        .card-title {
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: start;
            margin-bottom: 0px;
        }

        .card-price {
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #ff6600;
            font-weight: 700;
            text-align: start;
        }

        /* Tabs styling */
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tab {
            background-color: transparent;
            color: white;
            padding: 10px 20px;
            margin: 0 5px;
            cursor: pointer;
            position: relative;
            font-size: 18px;
        }

        .tab.active {
            font-weight: bold;
        }

        .tab::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: orange;
            transition: width 0.3s;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .tab.active::after {
            width: 100%;
        }


        /* View more button */
        .view-more-btn {
            background-color: white;
            color: orange;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Contact form styles */
        .contact-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .contact-form .col {
            flex: 1 1 100%;
            padding: 15px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .contact-form button {
            padding: 10px 20px;
            background-color: #ff6600;
            border: none;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #e65c00;
        }

        .top-banner-content-wrapper {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .top-banner-iconWrapper {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 10px;
        }

        .top-banner-iconWrapper>div {
            text-align: center;
            margin: 0 10px;
        }

        .top-banner-iconWrapper .fa {
            font-size: 4rem;
        }

        .top-banner-textWrapper {
            /* width: 70%; */
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .icon-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .icon-group div {
            margin: 5px 0;
        }

        /* Responsive typography */
        @media (max-width: 1200px) {
            .title-small {
                font-size: 1.2rem;
            }

            .text-container {
                text-align: start;
                align-content: center;
                font-size: 1.5rem;
                font-weight: 300;
                line-height: 1.5;
                padding: 2rem;
            }

            .home-abt-desc {
                font-size: 1.5rem;
            }

            .second-banner .aboutUs1,
            .second-banner .aboutUs2 {
                text-align: center;
            }

            .product-item {
                flex: 1 1 calc(50% - 20px);
            }

            .product-item img {
                max-height: 250px;
            }
        }

        @media (max-width: 992px) {
            .second-banner {
                padding-top: 10%;
                padding-bottom: 10%;
            }

            .aboutUs2 {
                font-size: 20px;
            }

            .text-container {
                text-align: start;
                /* align-content: center; */
                font-size: 1.2rem;
                font-weight: 300;
                line-height: 1.5;
            }

            .top-banner-content-wrapper {
                align-items: center;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .top-banner {
                height: 50vh;
            }

            .phone-image {
                max-width: 30%;
                height: auto;
                display: block;
                margin: 0 auto;
                max-height: 30%;
            }

            .title-small {
                font-size: 2rem;
            }

            .product-item {
                flex: 1 1 calc(100% - 20px);
            }

            .contact-form .col {
                flex: 1 1 100%;
            }

            .card-title {
                font-size: 0.9rem;
            }

            .product-item img {
                max-height: 180px;
            }

            .tabs {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }

            .tab {
                flex: 1 0 auto;
                max-width: calc(33.33% - 10px);
                text-align: center;
                padding: 10px;
                background-color: transparent;
                color: white;
                cursor: pointer;
                border-bottom: 3px solid transparent;
                transition: border-color 0.3s ease;
            }

            .tab.active {
                border-color: white;
            }

            .product-grid {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }

            .view-more-btn {
                display: block;
                margin: 20px auto;
                background-color: white;
                color: orange;
                border: none;
                padding: 10px 20px;
                border-radius: 30px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .aboutUs2 {
                font-size: 18px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: left;
            }

            .text-container {
                /* height: 350px; */
                text-align: start;
                align-content: center;
                font-size: 1.5rem;
                font-weight: 300;
                line-height: 1.5;
            }

            .home-abt-desc {
                /* padding-right: 15px; */
                text-align: center
            }

            .home-abt-btn {
                margin-top: 20px;
                text-align: center;
            }

            .submit-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: orange;
                color: white;
                border-radius: 30px;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .submit-button:hover {
                background-color: darkorange;
            }
        }

        @media (max-width: 576px) {
            .top-banner {
                height: 50vh;
            }

            .phone-image {
                padding-top: 1.1rem;
                max-width: 30%;
                height: auto;
                display: block;
                margin: 0 auto;
                max-height: 40%;
            }

            .aboutUs1 {
                justify-content: center;
                text-align: center;
                align-items: center;
            }

            .text-container {
                height: 170px;
                text-align: start;
                align-content: center;
                font-size: 1.2rem;
                font-weight: 300;
                line-height: 1.5;
            }

            .home-abt-desc {
                /* padding-right: 15px; */
                text-align: center;
                font-size: 16px;
            }

            .tabs {
                flex-direction: flex;
            }

            .tab {
                margin: 10px 0;
            }

            .aboutUs2 {
                font-size: 16px;
            }

            .product-item img {
                max-height: 180px;
            }

            .custom-banner {
                /* max-width: 100%; */
                height: auto;
                /* width: auto; */
            }

            .contact-us-section {
                text-align: center;
            }

            .home_about_us_desc_line1 {
                font-size: 16px;
            }

            .home_about_us_desc_line3 {
                font-size: 16px;
            }

            .top-banner-content-wrapper {
                align-items: center;
                text-align: center;
            }

            .top-banner-textWrapper {
                font-size: 1.5rem;
            }

            .top-banner-iconWrapper .fa {
                font-size: 2rem;
            }
        }

        /* corousel */

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-image: none;
            background-color: transparent;
            border: none;
            padding: 0;
            font-size: 30px;
            line-height: 1;
            color: #fff;
            opacity: 0.5;
            filter: alpha(opacity=50);
            cursor: pointer;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background-color: transparent;
            /* border-radius: 50%; */
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-control-prev {
            left: 20px;
        }

        .carousel-control-next {
            right: 20px;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: transparent;
        }

        .carousel-control-prev:hover .carousel-control-prev-icon,
        .carousel-control-next:hover .carousel-control-next-icon {
            color: #333;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {

            .carousel-control-prev,
            .carousel-control-next {
                width: 40px;
                height: 40px;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {

            .carousel-control-prev,
            .carousel-control-next {
                width: 30px;
                height: 30px;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                font-size: 18px;
            }
        }
    </style>
@endsection
