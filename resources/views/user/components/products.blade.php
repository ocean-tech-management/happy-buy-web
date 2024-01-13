@foreach($products as $product)
    <!-- start shop item -->
    <li class="grid-item ">
        <div class="product-box margin-45px-bottom lg-margin-25px-bottom xs-no-margin-bottom">
            <!-- start product image -->

            <a href="{{ (Route::currentRouteName() == 'landing.product-list')? route('landing.product-details', ['id' => $product->id]) : ((count($product->variants) > 0) ? (($product->variants[0]->type != 3) ? route('user.product-details', ['id' => $product->id]) : route('user.redeem-product-details', ['id' => $product->id])) : route('user.product-details', ['id' => $product->id]) ) }}">
                <div class="product-image border-radius-6px">
                    <img class="default-image" src="{{ ($product->image_1 != NULL)? $product->image_1->url:"" }}" alt="" style="max-height: 300px"/>
                    <img class="hover-image" src="{{ ($product->image_2 != NULL)?  ($product->image_2 ? $product->image_2->url : $product->image_1->url) : (($product->image_1 != NULL)? $product->image_1->url:"") }}" alt="" style="max-height: 300px"/>
                    <div class="product-overlay bg-gradient-extra-midium-gray-transparent"></div>
                    {{--                <div class="product-hover-bottom text-center padding-30px-tb">--}}
                    {{--                    <a href="shop-wide.html#" class="product-link-icon move-top-bottom" data-toggle="tooltip" data-placement="top" title=""--}}
                    {{--                       data-original-title="Add to cart"><i class="feather icon-feather-shopping-cart"></i></a>--}}
                    {{--                    <a href="shop-wide.html#" class="product-link-icon move-top-bottom" data-toggle="tooltip" data-placement="top" title=""--}}
                    {{--                       data-original-title="Quick shop"><i class="feather icon-feather-zoom-in"></i></a>--}}
                    {{--                    <a href="shop-wide.html#" class="product-link-icon move-top-bottom" data-toggle="tooltip" data-placement="top" title=""--}}
                    {{--                       data-original-title="Add to wishlist"><i class="feather icon-feather-heart"></i></a>--}}
                    {{--                </div>--}}
                </div>
            </a>
            <!-- end product image -->
            <!-- start product footer -->
            <div class="product-footer text-center padding-25px-top xs-padding-10px-top">
                @if(Route::currentRouteName() == 'landing.product-list')
                    <a href="{{ route('landing.product-details', ['id' => $product->id])  }}" class="text-extra-dark-gray font-weight-500 d-inline-block">{{ $product->name }}</a>
                @else
                    @if(count($product->variants) > 0)
                        @if($product->variants[0]->type != 3)
                            <a href="{{ route('user.product-details', ['id' => $product->id]) }}" class="text-extra-dark-gray font-weight-500 d-inline-block">{{ $product->name }}</a>
                        @else
                            <a href="{{ route('user.redeem-product-details', ['id' => $product->id]) }}" class="text-extra-dark-gray font-weight-500 d-inline-block">{{ $product->name }}</a>
                        @endif
                    @else
                        <a href="{{ route('user.product-details', ['id' => $product->id]) }}" class="text-extra-dark-gray font-weight-500 d-inline-block">{{ $product->name }}</a>
                    @endif

                @endif

                @if(Route::currentRouteName() != 'landing.product-list' )
                    <div class="product-price text-medium">
                        @if(count($product->variants) > 0)
                            @if($product->variants[0]->type != 3)
                                {{ number_format($product->variants[0]->price) }} PV
                            @else
                                {{ number_format($product->variants[0]->vip_redeem_pv) }} PV
                            @endif
                        @else
                            0 PV
                        @endif

                    </div>
                @else
                    <div class="product-price text-medium">
                        @if(count($product->variants) > 0)
                            @if($product->variants[0]->type != 3)
                                {{ number_format($product->variants[0]->sales_price) }} PV
                            @else
                                {{ number_format($product->variants[0]->sales_price) }} PV
                            @endif
                        @else
                            0 PV
                        @endif

                    </div>
                @endif

            </div>
            <!-- end product footer -->
        </div>
    </li>
    <!-- end shop item -->
@endforeach
