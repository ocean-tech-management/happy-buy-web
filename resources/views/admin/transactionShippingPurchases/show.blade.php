@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ trans('cruds.transactionShippingPurchase.fields.order_information') }} #{{ $transactionShippingPurchase->transaction }}</h4>
                    <h6 class="mb-0"><i class="fas fa-shopping-bag fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ App\Models\TransactionShippingPurchase::STATUS_SELECT[$transactionShippingPurchase->status] ?? '' }}</h6>
                    <hr>
                    <table width="100%" cellspacing="5" cellpadding="10">
                        <th>{{ trans('cruds.transactionShippingPurchase.fields.item_descriptions') }}</th>
                        <th style="text-align: right">{{ trans('cruds.transactionShippingPurchase.fields.unit_amount') }}</th>
                        <th style="text-align: right">{{ trans('cruds.transactionShippingPurchase.fields.quantity') }}</th>
                        <th style="text-align: right">{{ trans('cruds.transactionShippingPurchase.fields.sub_total_amount') }}</th>
                        <tbody>
                        <tr>
                            <td width="65%">
                                {{ trans('cruds.transactionShippingPurchase.fields.shipping_package') }}: {{ $transactionShippingPurchase->shipping_package->price ?? '' }}
                                <br/>↳
                                {{ number_format($transactionShippingPurchase->point) }} {{trans('global.points')}}
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionShippingPurchase->price) }}
                            </td>
                            <td width="5%" style="text-align: right">
                                1
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionShippingPurchase->price) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row pb-5">
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                            <table width="100%" cellspacing="5" cellpadding="5" class="mt-2" style="text-align: right">
                                <tr>
                                    <td width="10%">
                                        <span class="text-muted">{{ trans('cruds.transactionShippingPurchase.fields.sub_total') }}</span>
                                    </td>
                                    <td width="10%">
                                        RM {{ number_format($transactionShippingPurchase->price)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom"></td>
                                    <td class="border-bottom"></td>
                                </tr>
                                <tr>
                                    <td width="10%">
                                        <span class="text-muted">{{ trans('cruds.transactionShippingPurchase.fields.paid_amount') }}</span>
                                    </td>
                                    <td width="10%">
                                        RM <strong>{{ number_format($transactionShippingPurchase->price) }} </strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionShippingPurchase.fields.order_was_created', ['value' => $transactionShippingPurchase->created_at]) }}</span>
                        </div>
                        <div class="ms-auto">
                            @can('transaction_shipping_purchase_to_reject')
                                @if($transactionShippingPurchase->status == 2)
                                    <form action="{{ route('admin.transaction-shipping-purchases.to-reject') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $transactionShippingPurchase->id }}">
                                        <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.reject') }}">
                                    </form>
                                @endif
                            @endcan
                        </div>

                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionShippingPurchase.fields.payment_method') }}: <strong>{{ $transactionShippingPurchase->payment_method->name ?? '' }}</strong></span>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionShippingPurchase.fields.payment_details') }}</span>
                        </div>
                        @if ($transactionShippingPurchase->status == 3 || $transactionShippingPurchase->status == 1)
                            <a class="ms-auto btn btn-sm btn-info show-payment">{{ trans('global.show') }}</a>
                            <a class="ms-auto btn btn-sm btn-info hide-payment" style="display: none">{{ trans('global.hide') }}</a>
                        @endif
                    </div>
                    <div class="row p-3" id="payment-detail" @if($transactionShippingPurchase->status == 2) @else style="display: none" @endif>

                        @if($transactionShippingPurchase->payment_method_id == 1)
                            <div class="form-group" style="padding-left: 45px;">
                                @if($transactionShippingPurchase->receipt)
                                    <a class="image-popup-vertical-fit" href="{{ $transactionShippingPurchase->receipt->getUrl() }}" style="display: inline-block">
                                        <img class="img-fluid" src="{{ $transactionShippingPurchase->receipt->getUrl('preview') }}">
                                    </a>
                                @endif
                            </div>
                        @elseif($transactionShippingPurchase->payment_method_id == 2 || $transactionShippingPurchase->payment_method_id == 3)
                            <div class="row" style="padding-left: 45px;">
                                <div class="form-group col-6">
                                    <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionShippingPurchase.fields.gateway_transaction') }}</h5>
                                    <p class="text-muted">{{ $transactionShippingPurchase->gateway_transaction ?? '-'}}</p>
                                </div>
                                <div class="form-group col-6">
                                    <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionShippingPurchase.fields.gateway_status') }}</h5>
                                    <p class="text-muted">{{ App\Models\TransactionShippingPurchase::GATEWAY_STATUS_SELECT[$transactionShippingPurchase->gateway_status] ?? '-' }}</p>
                                </div>
                                <div class="form-group col-6">
                                    <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionShippingPurchase.fields.gateway_response') }}</h5>
                                    <p class="text-muted">{{ $transactionShippingPurchase->gateway_response ?? '-'}}</p>
                                </div>
                            </div>
                        @endif
                        @can('transaction_shipping_purchase_to_verify')
                            @if($transactionShippingPurchase->status == 2)
                                <div class="border-top d-flex align-items-center pt-3">
                                    <div class="p-3">
                                    </div>
                                    <div class="ms-auto">
                                        <form action="{{ route('admin.transaction-shipping-purchases.to-verify') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $transactionShippingPurchase->id }}">
                                            <input type="submit" class="btn btn-sm btn-success" value="{{ trans('global.verify') }}">
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endcan
                    </div>
                    @if($transactionShippingPurchase->status == 1)
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                @if($transactionShippingPurchase->status == 1)
                                    <i class="fas fas fa-times fa-2x text-danger"></i>
                                    &nbsp;
                                    <span>{{ trans('cruds.transactionShippingPurchase.fields.order_was_rejected_by', ['value' => $transactionShippingPurchase->admin->name]) }}</span>
                                @elseif($transactionShippingPurchase->status == 2)
                                    <i class="fas fa-check fa-2x text-success"></i>
                                    &nbsp;
                                    <span>{{ trans('cruds.transactionShippingPurchase.fields.order_was_created', ['value' => $transactionShippingPurchase->created_at]) }}</span>
                                @else
                                    <i class="fas fa-check fa-2x text-success"></i>
                                    &nbsp;
                                    <span>{{ trans('cruds.transactionShippingPurchase.fields.order_was_completed') }}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if($transactionShippingPurchase->status == 3)
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.transactionShippingPurchase.fields.order_was_verified_at_by', ['value' => $transactionShippingPurchase->updated_at]) }}</span>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-3"></div>
        <div class="col-1"></div>
    </div>

@endsection

@section('scripts')
    <script>
        $('.show-payment').click(function() {
            $("#payment-detail").css("display", "block");
            $(".hide-payment").css("display", "block");
            $(".show-payment").css("display", "none");
        });
        $('.hide-payment').click(function() {
            $("#payment-detail").css("display", "none");
            $(".hide-payment").css("display", "none");
            $(".show-payment").css("display", "block");
        });
    </script>
@endsection
