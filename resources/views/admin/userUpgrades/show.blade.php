@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ trans('cruds.transactionPointPurchase.fields.order_information') }} #{{ $transactionPointPurchase->transaction }}</h4>
                    <h6 class="mb-0"><i class="fas fa-shopping-bag fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ App\Models\TransactionPointPurchase::STATUS_SELECT[$transactionPointPurchase->status] ?? '' }}</h6>
                    <hr>
                    <table width="100%" cellspacing="5" cellpadding="10">
                        <th>{{ trans('cruds.transactionPointPurchase.fields.item_descriptions') }}</th>
                        <th style="text-align: right">{{ trans('cruds.transactionPointPurchase.fields.unit_amount') }}</th>
                        <th style="text-align: right">{{ trans('cruds.transactionPointPurchase.fields.quantity') }}</th>
                        <th style="text-align: right">{{ trans('cruds.transactionPointPurchase.fields.sub_total_amount') }}</th>
                        <tbody>
                        <tr>
                            <td width="65%">
                                {{ trans('cruds.transactionPointPurchase.fields.point_package') }}: {{ $transactionPointPurchase->point_package->name_en ?? '' }}
                                <br/>↳
                                {{ number_format($transactionPointPurchase->point) }} {{trans('global.points')}}
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionPointPurchase->price) }}
                            </td>
                            <td width="5%" style="text-align: right">
                                1
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionPointPurchase->price) }}
                            </td>
                        </tr>
                        <tr>
                            <td width="65%">
                                {{ trans('cruds.transactionPointPurchase.fields.deposit') }}
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionPointPurchase->deposit) }}
                            </td>
                            <td width="5%" style="text-align: right">
                                1
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionPointPurchase->deposit) }}
                            </td>
                        </tr>
                        <tr>
                            <td width="65%">
                                {{ trans('cruds.transactionPointPurchase.fields.admin_charges') }}
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionPointPurchase->fee) }}
                            </td>
                            <td width="5%" style="text-align: right">
                                1
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionPointPurchase->fee) }}
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
                                        <span class="text-muted">{{ trans('cruds.transactionPointPurchase.fields.sub_total') }}</span>
                                    </td>
                                    <td width="10%">
                                        RM {{ number_format($transactionPointPurchase->price+ $transactionPointPurchase->deposit + $transactionPointPurchase->fee)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom"></td>
                                    <td class="border-bottom"></td>
                                </tr>
                                <tr>
                                    <td width="10%">
                                        <span class="text-muted">{{ trans('cruds.transactionPointPurchase.fields.paid_amount') }}</span>
                                    </td>
                                    <td width="10%">
                                        RM <strong>{{ number_format($transactionPointPurchase->price+ $transactionPointPurchase->deposit + $transactionPointPurchase->fee) }} </strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionPointPurchase.fields.order_was_created', ['value' => $transactionPointPurchase->created_at]) }}</span>
                        </div>
                        <div class="ms-auto">
                            @can('transaction_point_purchase_to_reject')
                                @if($transactionPointPurchase->status == 2)
                                    <form action="{{ route('admin.transaction-point-purchases.to-reject') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $transactionPointPurchase->id }}">
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
                            <span>{{ trans('cruds.transactionPointPurchase.fields.payment_method') }}: <strong>{{ $transactionPointPurchase->payment_method->name ?? '' }}</strong></span>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionPointPurchase.fields.payment_details') }}</span>
                        </div>
                        @if ($transactionPointPurchase->status == 3 || $transactionPointPurchase->status == 1)
                            <a class="ms-auto btn btn-sm btn-info show-payment">{{ trans('global.show') }}</a>
                            <a class="ms-auto btn btn-sm btn-info hide-payment" style="display: none">{{ trans('global.hide') }}</a>
                        @endif
                    </div>
                    <div class="row p-3" id="payment-detail" @if($transactionPointPurchase->status == 2) @else style="display: none" @endif>

                        @if($transactionPointPurchase->payment_method_id == 1)
                            <div class="form-group" style="padding-left: 45px;">
                                @if($transactionPointPurchase->receipt)
                                    <a class="image-popup-vertical-fit" href="{{ $transactionPointPurchase->receipt->getUrl() }}" style="display: inline-block">
                                        <img class="img-fluid" src="{{ $transactionPointPurchase->receipt->getUrl('preview') }}">
                                    </a>
                                @endif
                            </div>
                        @elseif($transactionPointPurchase->payment_method_id == 2 || $transactionPointPurchase->payment_method_id == 3)
                            <div class="row" style="padding-left: 45px;">
                                <div class="form-group col-6">
                                    <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionPointPurchase.fields.gateway_transaction') }}</h5>
                                    <p class="text-muted">{{ $transactionPointPurchase->gateway_transaction ?? '-'}}</p>
                                </div>
                                <div class="form-group col-6">
                                    <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionPointPurchase.fields.gateway_status') }}</h5>
                                    <p class="text-muted">{{ App\Models\TransactionPointPurchase::GATEWAY_STATUS_SELECT[$transactionPointPurchase->gateway_status] ?? '-' }}</p>
                                </div>
                                <div class="form-group col-6">
                                    <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionPointPurchase.fields.gateway_response') }}</h5>
                                    <p class="text-muted">{{ $transactionPointPurchase->gateway_response ?? '-'}}</p>
                                </div>
                            </div>
                        @endif
                        @can('transaction_point_purchase_to_verify')
                            @if($transactionPointPurchase->status == 2)
                                <div class="border-top d-flex align-items-center pt-3">
                                    <div class="p-3">
                                    </div>
                                    <div class="ms-auto">
                                        <form action="{{ route('admin.transaction-point-purchases.user-upgrade-verify') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $transactionPointPurchase->id }}">
                                            <input type="submit" class="btn btn-sm btn-success" value="{{ trans('global.verify') }}">
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endcan
                    </div>

                    @if($transactionPointPurchase->status == 1)
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                @if($transactionPointPurchase->status == 1)
                                    <i class="fas fas fa-times fa-2x text-danger"></i>
                                    &nbsp;
                                    <span>{{ trans('cruds.transactionPointPurchase.fields.order_was_rejected_at', ['value' => $transactionPointPurchase->updated_at]) }}</span>
                                @elseif($transactionPointPurchase->status == 2)
                                    <i class="fas fa-check fa-2x text-success"></i>
                                    &nbsp;
                                    <span>{{ trans('cruds.transactionPointPurchase.fields.order_was_created', ['value' => $transactionPointPurchase->created_at]) }}</span>
                                @else
                                    <i class="fas fa-check fa-2x text-success"></i>
                                    &nbsp;
                                    <span>{{ trans('cruds.transactionPointPurchase.fields.order_was_completed') }}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if($transactionPointPurchase->status == 3)
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.transactionPointPurchase.fields.order_was_verified_at_by', ['value' => $transactionPointPurchase->payment_verified_at, 'value2' => $transactionPointPurchase->admin->name]) }}</span>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ trans('global.customer') }}</h4>
                    <h6 class="mb-1">{{ $transactionPointPurchase->user->name ?? '-' }}</h6>
                    <h6 class="mb-1">{{ $transactionPointPurchase->user->phone ?? '-' }}</h6>
                    <h6 class="mb-1">{{ $transactionPointPurchase->user->email ?? '-' }}</h6>
                </div>
            </div>
        </div>
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
