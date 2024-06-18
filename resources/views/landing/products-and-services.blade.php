@extends('landing.app')

@section('content')
    <section class="d-flex flex-column justify-content-end justify-content-lg-center top-banner">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-11 col-lg-10 text-center">
                    <div class="position-relative">
                        <span
                            class="title-small alt-font font-weight-300 z-index-9 d-inline-block letter-spacing-4px text-white"
                            style="line-height:45px;">
                            {!! __('landing.our_product') !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="overlap-height wow animate__fadeIn py-3">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-12">
                    <div class="tabs">
                        <div class="tab active" data-category="health">{!! __('landing.product_tab_health') !!}</div>
                        <div class="tab" data-category="beauty">{!! __('landing.product_tab_beauty') !!}</div>
                        <div class="tab" data-category="personal-care">{!! __('landing.product_tab_personal_care') !!}</div>
                    </div>
                    <div class="row" id="productGrid">
                        <!-- Products will be displayed here -->
                    </div>
                    <div class="py-3 text-center">
                        <button class="view-more-btn" id="viewMoreBtn">{!! __('landing.view_more') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentIndex = 0;
            const productsPerPage = 6;
            let currentCategory = 'health';

            function fetchProducts(category, limit, offset) {
                return fetch(
                        `https://api2.happybuy.asia/api/v1/goods/list?lang=zh-cn&uid=&keyword=&page=1&category=${category}`
                    )
                    .then(response => response.json())
                    .then(data => data.data.list.slice(offset, offset + limit))
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
                    productItem.classList.add('col-12', 'col-sm-6', 'col-md-4', 'mb-4');
                    productItem.innerHTML = `
                        <div class="card h-100 product-item">
                            <a href="{{ route('landing.selectedProductDetails', ['goods_sn' => '${product.goods_sn}']) }}">
                                <img src="${product.main_image}" class="card-img-top" alt="${product.title}">
                                <div class="card-body">
                                    <h5 class="card-title">${product.title}</h5>
                                </div>
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
                    .then(products => displayProducts(products))
                    .catch(error => console.error('Error loading initial products:', error));
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
                    .then(products => displayProducts(products))
                    .catch(error => console.error('Error loading more products:', error));
            });

            loadInitialProducts(currentCategory);
        });
    </script>

    <style>

        /* Banner section styles */
        .top-banner {
            background-image: url('{{ __('landing/images/O4YIHQ0.png') }}');
            background-size: cover;
            height: 40vh;
            color: white;
        }

        .title-small {
            font-size: 2.5rem;
            line-height: 1.5;
        }

        /* Mid-banner section styles */
        .mid-banner {
            padding: 60px 0;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title-phase {
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .card-text {
            margin-bottom: 15px;
        }

        .card-subtext {
            font-size: 0.9rem;
            color: #555;
        }

        /* Responsive typography */
        @media (max-width: 768px) {

            .top-banner {
                height: 20vh;
            }
            .title-small {
                font-size: 2rem;
            }

            .card-title-phase {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .top-banner {
                height: 20vh;
            }

            .title-small {
                font-size: 2rem;
            }
        }

        /* Additional styling */
        .unlock-card {
            background-color: #f8f9fa;
        }

        .coming-soon-card {
            background-color: #e9ecef;
        }

        /* Utility classes */
        .text-white {
            color: #fff !important;
        }

        .font-weight-100 {
            font-weight: 100 !important;
        }

        .font-weight-300 {
            font-weight: 300 !important;
        }

        /* Tabs styling */
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tab {
            margin: 0 10px;
            padding: 10px 10px;
            cursor: pointer;
            /* border: 1px solid #ddd; */
            border-radius: 5px;
            background: transparent;
            color: #ff6600;
        }

        .tab.active {
            color: white;
            background-color: #ff6600;
        }

        /* Product item styling */
        .product-item img {
            max-height: 200px;
            object-fit: cover;
        }

        .view-more-btn {
            background-color: #ff6600;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }

        .view-more-btn:hover {
            background-color: #e65c00;
        }
    </style>
@endsection
