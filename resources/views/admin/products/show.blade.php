@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('cruds.product.fields.product_detail') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">{{ trans('cruds.product.fields.product_detail') }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-5 col-sm-12">
                            <div class="product-detai-imgs">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12 pb-3" >
                                        <div class="tab-content" id="v-pills-tabContent" >
                                            <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                                @if($product->image_1)
                                                    <div>
                                                        <img src="{{ $product->image_1->getUrl('') }}" alt="" class="img-fluid mx-auto d-block" style="max-height: 350px; min-height: 200px; width: auto;object-fit: contain">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="product-2" role="tabpanel" aria-labelledby="product-2-tab">
                                                @if($product->image_2)
                                                    <div>
                                                        <img src="{{ $product->image_2->getUrl('') }}" alt="" class="img-fluid mx-auto d-block" style="max-height: 350px; min-height: 200px; width: auto;object-fit: contain">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="product-3" role="tabpanel" aria-labelledby="product-3-tab">
                                                @if($product->image_3)
                                                    <div>
                                                        <img src="{{ $product->image_3->getUrl('') }}" alt="" class="img-fluid mx-auto d-block" style="max-height: 350px; min-height: 200px; width: auto;object-fit: contain">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="product-4" role="tabpanel" aria-labelledby="product-4-tab">
                                                @if($product->image_4)
                                                    <div>
                                                        <img src="{{ $product->image_4->getUrl('') }}" alt="" class="img-fluid mx-auto d-block" style="max-height: 350px; min-height: 200px; width: auto;object-fit: contain">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="product-5" role="tabpanel" aria-labelledby="product-5-tab">
                                                @if($product->image_5)
                                                    <div>
                                                        <img src="{{ $product->image_5->getUrl('') }}" alt="" class="img-fluid mx-auto d-block" style="max-height: 350px; min-height: 200px; width: auto;object-fit: contain">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
{{--                                        <div class="text-center">--}}
{{--                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-2 me-1">--}}
{{--                                                <i class="bx bx-cart me-2"></i> Add to cart--}}
{{--                                            </button>--}}
{{--                                            <button type="button" class="btn btn-success waves-effect  mt-2 waves-light">--}}
{{--                                                <i class="bx bx-shopping-bag me-2"></i>Buy now--}}
{{--                                            </button>--}}
{{--                                        </div>--}}

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="nav flex-row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal" style="flex-wrap: nowrap;height: 50px;">

                                            @if($product->image_1)
                                                <a class="nav-link active" id="product-1-tab" data-bs-toggle="pill" href="#product-1" role="tab" aria-controls="product-1" aria-selected="true">
                                                    <img src="{{ $product->image_1->getUrl('') }}" alt="" class="img-fluid mx-auto d-block rounded" style="width: auto;height: 50px;object-fit: contain" >
                                                </a>
                                            @endif
                                            @if($product->image_2)
                                                <a class="nav-link" id="product-2-tab" data-bs-toggle="pill" href="#product-2" role="tab" aria-controls="product-2" aria-selected="false">
                                                    <img src="{{ $product->image_2->getUrl('') }}" alt="" class="img-fluid mx-auto d-block rounded" style="width: auto;height: 50px;object-fit: contain">
                                                </a>
                                            @endif
                                            @if($product->image_3)
                                                <a class="nav-link" id="product-3-tab" data-bs-toggle="pill" href="#product-3" role="tab" aria-controls="product-3" aria-selected="false">
                                                    <img src="{{ $product->image_3->getUrl('') }}" alt="" class="img-fluid mx-auto d-block rounded" style="width: auto;height: 50px;object-fit: contain">
                                                </a>
                                            @endif
                                            @if($product->image_4)
                                                <a class="nav-link" id="product-4-tab" data-bs-toggle="pill" href="#product-4" role="tab" aria-controls="product-4" aria-selected="false">
                                                    <img src="{{ $product->image_4->getUrl('') }}" alt="" class="img-fluid mx-auto d-block rounded" style="width: auto;height: 50px;object-fit: contain">
                                                </a>
                                            @endif
                                            @if($product->image_5)
                                                <a class="nav-link" id="product-5-tab" data-bs-toggle="pill" href="#product-5" role="tab" aria-controls="product-4" aria-selected="false">
                                                    <img src="{{ $product->image_5->getUrl('') }}" alt="" class="img-fluid mx-auto d-block rounded" style="width: auto;height: 50px;object-fit: contain">
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-7">
                            <div class="mt-4 mt-xl-3">
                                <a href="javascript: void(0);" class="text-primary">{{ $product->category->name_en ?? '' }}</a>
                                <h4 class="mt-1 mb-3">{{ $product->name_en }}</h4>
                                <h4 class="mt-1 mb-3">{{ $product->name_zh }}</h4>

                                <p class="text-muted mb-4">{{ $product->short_desc_en }}</p>
                                <p class="text-muted mb-4">{{ $product->short_desc_zh }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="product-color pt-5">
                        <h5 class="font-size-15 mb-4">{{ trans('cruds.productVariant.fields.available_variants') }}</h5>
                        <div class="row">
                            @forelse($variants as $variant)
                                <div class="col-xl-3 col-md-4 col-sm-12">
                                    <div class="card p-1 border shadow-none">
                                        <div class="p-3">
                                            <h5>{{ $variant->sku }}</h5>
                                            <p class="text-muted mb-2"><span>{{ trans('cruds.productVariant.fields.color') }}: {{ $variant->color->name }} &nbsp;&nbsp; {{ trans('cruds.productVariant.fields.size') }}: {{ $variant->size->name }}</span></p>
                                            <p class="text-muted mb-2">{{ trans('cruds.productVariant.fields.sales_price') }}: {{ number_format($variant->sales_price) ?? '-' }}</p>
                                            <p class="text-muted mb-2">{{ trans('cruds.productVariant.fields.merchant_president_price') }}: {{ number_format($variant->merchant_president_price) ?? '-' }}</p>
                                            <p class="text-muted mb-2">{{ trans('cruds.productVariant.fields.agent_director_price') }}: {{ number_format($variant->agent_director_price) ?? '-' }}</p>
                                            <p class="text-muted mb-2">{{ trans('cruds.productVariant.fields.agent_executive_price') }}: {{ number_format($variant->agent_executive_price) ?? '-' }}</p>
                                            <p class="text-muted mb-2">{{ trans('cruds.productVariant.fields.price_add_on') }}: {{ number_format($variant->price_add_on) ?? '-' }}</p>
                                        </div>

                                    </div>
                                </div>
                                {{--                                            <a href="javascript: void(0);" >--}}
                                {{--                                                <div class="product-color-item border rounded">--}}
                                {{--                                                    --}}{{--                                                <img src="assets/images/product/img-7.png" alt="" class="avatar-md">--}}

                                {{--                                                </div>--}}

                                {{--                                            </a>--}}
                            @empty
                            @endforelse
                        </div>


                        {{--                                    <a href="javascript: void(0);">--}}
                        {{--                                        <div class="product-color-item border rounded">--}}
                        {{--                                            <img src="assets/images/product/img-7.png" alt="" class="avatar-md">--}}
                        {{--                                        </div>--}}
                        {{--                                        <p>Blue</p>--}}
                        {{--                                    </a>--}}
                        {{--                                    <a href="javascript: void(0);">--}}
                        {{--                                        <div class="product-color-item border rounded">--}}
                        {{--                                            <img src="assets/images/product/img-7.png" alt="" class="avatar-md">--}}
                        {{--                                        </div>--}}
                        {{--                                        <p>Gray</p>--}}
                        {{--                                    </a>--}}
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#desc_en" role="tab">
                                    <span class="d-block d-sm-none">{{ trans('cruds.product.fields.desc_en') }}</span>
                                    <span class="d-none d-sm-block">{{ trans('cruds.product.fields.desc_en') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#desc_zh" role="tab">
                                    <span class="d-block d-sm-none">{{ trans('cruds.product.fields.desc_zh') }}</span>
                                    <span class="d-none d-sm-block">{{ trans('cruds.product.fields.desc_zh') }}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="desc_en" role="tabpanel">
                                        <h4 class="mb-0">{!! $product->desc_en !!}</h4>
                                    </div>
                                    <div class="tab-pane" id="desc_zh" role="tabpanel">
                                        <h4 class="mb-0">{!! $product->desc_zh !!}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
