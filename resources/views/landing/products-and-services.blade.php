@extends('landing.app')

@section('css')
    <style>
        .top-banner {
            background-image: url('{{ __('landing/images/O4YIHQ0.png') }}');
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
                            rgba(0, 0, 0, 0.65) 100%
                        );
                        top: 0;
                        left: 0;
                        z-index: 0;
                    } */

        .text-primary {
            color: #ee9134 !important;
        }

        .tabs {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-bottom: 20px;
            position: relative;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            color: #050605;
            position: relative;
        }

        .tab::after {
            content: '';
            display: block;
            height: 100%;
            background: #ccc;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .tab:last-child::after {
            display: none;
        }

        .tab.active {
            color: #F37021;
        }

        .product-grid {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
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
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
        }

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
    </style>
@endsection
@section('content')
    <section class="d-flex flex-column justify-content-end justify-content-lg-center top-banner">
        <div class="container" style="max-width: 1400px ">
            <div class="row align-items-center justify-content-center">
                <div class="col-11 col-lg-10 text-center">
                    <div class="position-relative ">
                        <span
                            class="title-small alt-font font-weight-300 z-index-9 d-inline-block letter-spacing-4px text-white"
                            style="line-height:45px;">{!! __('landing.our_product') !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="overlap-height wow animate__fadeIn py-3 !important">
        <div class="container" style="max-width: 1400px;">
            <div class="row justify-content-center mt-4">
                <div class="col-12">
                    <div class="tabs">
                        <div class="tab active" data-category="health">{!! __('landing.product_tab_health') !!}</div>
                        <div class="tab" data-category="beauty">{!! __('landing.product_tab_beauty') !!}</div>
                        <div class="tab" data-category="personal-care">{!! __('landing.product_tab_personal_care') !!}</div>
                    </div>
                    <div class="product-grid" id="productGrid">
                        Here we are showing the list of products we retrieve from database.
                        Now i want to allow user to clicked on the product and it will bring user to the product details page.
                        How should I do it? I am expecting we will pass the product id into the api.
                        Here the api: https://api2.happybuy.asia/api/v1/goods/info?lang=zh-cn&uid=&goods_sn=0046006308986
                        goods_sn is the product id.
                        Also make the product card clickable.
                    </div>
                    <div class="py-3">
                        <button class="view-more-btn" id="viewMoreBtn">{!! __('landing.view_more') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let productData = [];
            let currentIndex = 0;
            const productsPerPage = 6;
            let currentCategory = 'health';

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

            function displayProducts(products) {
                const productGrid = document.getElementById('productGrid');

                if (currentIndex === 0) {
                    productGrid.innerHTML = '';
                }

                products.forEach(product => {
                    const productItem = document.createElement('div');
                    productItem.classList.add('product-item');
                    productItem.innerHTML = `
                        <a href="{{ route('landing.selectedProductDetails')}}">
                        <img src="${product.main_image}" alt="${product.title}">
                        <div class="product-name">${product.title}</div>
                        </a>
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
            loadInitialProducts(currentCategory);
        });
    </script>
@endsection
