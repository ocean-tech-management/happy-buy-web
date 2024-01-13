@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ trans('cruds.pointConvert.fields.transaction_information') }} #{{ $pointConvert->transaction }}</h4>
                    <h6 class="mb-0"><i class="fas fa-shopping-bag fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ trans('global.completed') }}</h6>
                    <hr>
                    <div class="d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.pointConvert.fields.transaction_was_created', ['value' => $pointConvert->created_at]) }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.pointConvert.fields.transaction_details') }}</span>
                        </div>
                    </div>
                    <div class="row p-3" id="payment-detail">
                        <div class="row" style="padding-left: 45px;">
                            <div class="form-group col-12">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.pointConvert.fields.amount') }}</h5>
                                <p class="text-muted">{{ $pointConvert->amount ? number_format($pointConvert->amount):'-'}}</p>
                            </div>
                            <div class="form-group col-6">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.pointConvert.fields.pre_cp_bonus_balance') }}</h5>
                                <p class="text-muted">{{ $pointConvert->pre_cp_bonus_balance ? number_format($pointConvert->pre_cp_bonus_balance):'-'}}</p>
                            </div>
                            <div class="form-group col-6">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.pointConvert.fields.post_cp_bonus_balance') }}</h5>
                                <p class="text-muted">{{ $pointConvert->post_cp_bonus_balance ? number_format($pointConvert->post_cp_bonus_balance):'-'}}</p>
                            </div>
                            <div class="form-group col-6">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.pointConvert.fields.pre_cp_balance') }}</h5>
                                <p class="text-muted">{{ $pointConvert->pre_cp_balance ? number_format($pointConvert->pre_cp_balance):'-'}}</p>
                            </div>
                            <div class="form-group col-6">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.pointConvert.fields.post_cp_balance') }}</h5>
                                <p class="text-muted">{{ $pointConvert->post_cp_balance ? number_format($pointConvert->post_cp_balance):'-'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ trans('global.customer') }}</h4>
                    <h6 class="mb-1">{{ $pointConvert->user->name ?? '-' }}</h6>
                    <h6 class="mb-1">{{ $pointConvert->user->phone ?? '-' }}</h6>
                    <h6 class="mb-4">{{ $pointConvert->user->email ?? '-' }}</h6>
                    {{--                    <hr>--}}
                    {{--                    <h4 class="card-title mb-3 mt-4">{{ trans('cruds.order.fields.shipping_details') }}</h4>--}}
                    {{--                    <h6 class="mb-1">{{ $order->receiver_name ?? '-' }}</h6>--}}
                    {{--                    <h6 class="mb-1">{{ $order->receiver_phone ?? '-' }}</h6>--}}
                    {{--                    <h6 class="mb-1">{{ $order->receiver_address_1 }} {{ $order->receiver_address_2 ?? '' }} {{ $order->receiver_postcode }}</h6>--}}
                    {{--                    <h6 class="mb-1">{{ $order->receiver_city }}</h6>--}}
                    {{--                    <h6 class="mb-3">{{ $order->receiver_state }}</h6>--}}
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>

@endsection
