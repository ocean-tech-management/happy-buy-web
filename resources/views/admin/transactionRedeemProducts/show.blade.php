@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transactionRedeemProduct.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
{{--            <div class="form-group">--}}
{{--                <a class="btn btn-secondary" href="{{ route('admin.transaction-redeem-products.index') }}">--}}
{{--                    {{ trans('global.back_to_list') }}--}}
{{--                </a>--}}
{{--            </div>--}}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="card-title mb-5">{{ trans('cruds.transactionRedeemProduct.fields.status') }}</h4>
                            <div class="">
                                <ul class="verti-timeline list-unstyled">
                                    <li class="event-list ">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-right-arrow-circle @if($transactionRedeemProduct->status == 1) bx-fade-right @endif"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bx bx-code h4 text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ trans('global.pending') }}</a></h5>
                                                    <span class="text-primary"> {{ $transactionRedeemProduct->created_at ?? '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @if($transactionRedeemProduct->collect_type == 2)
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-right-arrow-circle @if($transactionRedeemProduct->status == 2) bx-fade-right @endif"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bx bx-code h4 text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ trans('global.shipped') }}</a></h5>
                                                    <span class="text-primary"> {{ $transactionRedeemProduct->shipout_at ?? '-' }}</span><br/>
                                                    <span class="text-primary"> {{ trans('cruds.transactionRedeemProduct.fields.shipped_by') }}: {{ $transactionRedeemProduct->shipped_by->name ?? '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($transactionRedeemProduct->collect_type == 1)
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-right-arrow-circle @if($transactionRedeemProduct->status == 2) bx-fade-right @endif"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bx bx-code h4 text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ trans('global.picked_up') }}</a></h5>
                                                    <span class="text-primary"> {{ $transactionRedeemProduct->pickup_at ?? '-' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($transactionRedeemProduct->refund_at == null)
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-right-arrow-circle @if($transactionRedeemProduct->status == 3) bx-fade-right @endif"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bx bx-code h4 text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ trans('global.completed') }}</a></h5>
                                                    @if($transactionRedeemProduct->completed_at != null)
                                                        <span class="text-primary"> {{ $transactionRedeemProduct->completed_at ?? '-' }}</span><br/>
                                                        <span class="text-primary"> {{ trans('cruds.transactionRedeemProduct.fields.completed_by') }}: {{ $transactionRedeemProduct->completed_by->name ?? '-' }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @else
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-right-arrow-circle @if($transactionRedeemProduct->status == 4) bx-fade-right @endif"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bx bx-code h4 text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ trans('global.cancelled') }}</a></h5>
                                                    <span class="text-primary"> {{ $transactionRedeemProduct->refund_at ?? '-' }}</span><br/>
                                                    <span class="text-primary"> {{ trans('cruds.transactionRedeemProduct.fields.refund_by') }}: {{ $transactionRedeemProduct->refund_by->name ?? '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-8">
                            <h4 class="card-title mb-4">{{ trans('cruds.transactionRedeemProduct.fields.basic_detail') }}</h4>
                            <div class="row pt-1">
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.transaction') }}</p>
                                    <h4 class="mb-0">{{ $transactionRedeemProduct->transaction }}</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.product_name') }}</p>
                                    <h4 class="mb-0">{{ $transactionRedeemProduct->product_name ?? '-' }}</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.product.fields.category') }}</p>
                                    <h4 class="mb-0">{{ $transactionRedeemProduct->product->category->name_en ?? '' }}</h4>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.user.fields.name') }}</p>
                                    <h4 class="mb-0">{{ $transactionRedeemProduct->user->name ?? '-' }}</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.user.fields.phone') }}</p>
                                    <h4 class="mb-0">{{ $transactionRedeemProduct->user->phone ?? '-' }}</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.user.fields.email') }}</p>
                                    <h4 class="mb-0">{{ $transactionRedeemProduct->user->email ?? '-' }}</h4>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.purchase_color') }}</p>
                                    <h4 class="mb-0">{{ $transactionRedeemProduct->purchase_color ?? '-' }}</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.purchase_size') }}</p>
                                    <h4 class="mb-0">{{ $transactionRedeemProduct->purchase_size ?? '-' }}</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.purchase_quantity') }}</p>
                                    <h4 class="mb-0">{{ number_format($transactionRedeemProduct->purchase_quantity) }}</h4>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.purchase_price') }}</p>
                                    <h4 class="mb-0">{{ number_format($transactionRedeemProduct->purchase_price) }}</h4>
                                </div>
                                <div class="col-4">

                                </div>
                                <div class="col-4">

                                </div>
                            </div>
                            <h4 class="card-title mb-4 pt-5">{{ trans('cruds.transactionRedeemProduct.fields.shipping_details') }}</h4>
                            <div class="row pt-1">
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.collect_type') }}</p>
                                    <h4 class="mb-0">{{ App\Models\TransactionRedeemProduct::COLLECT_TYPE_SELECT[$transactionRedeemProduct->collect_type] ?? '' }}</h4>
                                </div>
                                <div class="col-4">
                                    @if($transactionRedeemProduct->collect_type == 2)
                                        <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.shipping_company') }}</p>
                                        <h4 class="mb-0">{{ $transactionRedeemProduct->shipping_company->name ?? '-' }}</h4>
                                    @endif
                                </div>
                                <div class="col-4">
                                    @if($transactionRedeemProduct->collect_type == 2)
                                        <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.tracking_code') }}</p>
                                        <h4 class="mb-0">{{ $transactionRedeemProduct->tracking_code ?? '-'  }}</h4>
                                    @endif
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-12">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.address') }}</p>
                                    <h4 class="mb-0">{{ $transactionRedeemProduct->address->user ?? '-' }}</h4>
                                </div>

                            </div>
                            <h4 class="card-title mb-4 pt-5">{{ trans('cruds.transactionRedeemProduct.fields.point_status') }}</h4>
                            <div class="row pt-1">
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.pre_point_balance') }}</p>
                                    <h4 class="mb-0">{{ number_format($transactionRedeemProduct->pre_point_balance) }}</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted fw-medium mb-2">{{ trans('cruds.transactionRedeemProduct.fields.post_point_balance') }}</p>
                                    <h4 class="mb-0">{{ number_format($transactionRedeemProduct->post_point_balance) }}</h4>
                                </div>
                                <div class="col-4">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.transaction-redeem-products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
