@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ trans('cruds.transactionAgentTopUp.fields.topup_information') }} #{{ $transactionAgentTopUp->transaction }}</h4>
                    <h6 class="mb-0"><i class="fas fa-shopping-bag fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ App\Models\TransactionAgentTopUp::STATUS_SELECT[$transactionAgentTopUp->status] ?? '' }}</h6>
                    <hr>
                    <table width="100%" cellspacing="5" cellpadding="10">
                        <th>{{ trans('cruds.transactionPointPurchase.fields.item_descriptions') }}</th>
                        <th style="text-align: right">{{ trans('cruds.transactionPointPurchase.fields.unit_amount') }}</th>
                        <th style="text-align: right">{{ trans('cruds.transactionPointPurchase.fields.quantity') }}</th>
                        <th style="text-align: right">{{ trans('cruds.transactionPointPurchase.fields.sub_total_amount') }}</th>
                        <tbody>
                            <tr>
                            <td width="65%">
                                @if($transactionAgentTopUp->type == 1)
                                    {{ trans('cruds.transactionAgentTopUp.fields.topup') }}
                                @else
                                    {{ trans('cruds.transactionPointPurchase.fields.upgrade') }}
                                @endif
                                <br/>↳
                                    {{ trans('cruds.transactionPointPurchase.fields.point_package') }}: {{ $transactionAgentTopUp->point_package->name_en ?? '' }} ({{ number_format($transactionAgentTopUp->amount) }} {{trans('global.points')}})
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionAgentTopUp->amount) }}
                            </td>
                            <td width="5%" style="text-align: right">
                                1
                            </td>
                            <td style="text-align: right">
                                RM {{ number_format($transactionAgentTopUp->amount) }}
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
                                        RM {{ number_format($transactionAgentTopUp->amount)}}
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
                                        RM <strong>{{ number_format($transactionAgentTopUp->amount) }} </strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionAgentTopUp.fields.topup_was_created_at', ['value' => $transactionAgentTopUp->created_at]) }}</span>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionPointPurchase.fields.payment_method') }}: {{ trans('cruds.transactionAgentTopUp.fields.bank_transfer') }}</strong></span>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            @if ($transactionAgentTopUp->status == 1)
                                <i class="fas fa-question  fa-2x text-success"></i>
                            @elseif ($transactionAgentTopUp->status == 3)
                                <i class="fas fa-question fa-2x text-warning"></i>
                            @else
                                <i class="fas fa-check fa-2x text-success"></i>
                            @endif
                                &nbsp;
                                <span>{{ trans('cruds.transactionPointPurchase.fields.payment_details') }}</span>
                        </div>
{{--                        @if ($transactionAgentTopUp->status == 3 || $transactionAgentTopUp->status == 1)--}}
                            <a class="ms-auto btn btn-sm btn-info show-payment">{{ trans('global.show') }}</a>
                            <a class="ms-auto btn btn-sm btn-info hide-payment" style="display: none">{{ trans('global.hide') }}</a>
{{--                        @endif--}}
                    </div>
                    <div class="row p-3" id="payment-detail" style="display: none">
                        <div class="form-group" style="padding-left: 45px;">
                            @if($transactionAgentTopUp->receipt_photo)
                                <a class="image-popup-vertical-fit" href="{{ $transactionAgentTopUp->receipt_photo->getUrl() }}" style="display: inline-block">
                                    <img class="img-fluid" src="{{ $transactionAgentTopUp->receipt_photo->getUrl('preview') }}">
                                </a>
                            @endif
                        </div>

                    </div>
                    @if($transactionAgentTopUp->status == 2)
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.transactionAgentTopUp.fields.topup_was_approved_at_by', ['value' => $transactionAgentTopUp->approved_at, 'value2' => $transactionAgentTopUp->merchant->name]) }}</span>
                            </div>

                        </div>
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.transactionAgentTopUp.fields.transfer_from_wallet_to_wallet', ['value' => $transactionAgentTopUp->merchant->name, 'value2' => App\Models\TransactionAgentTopUp::FROM_WALLET_SELECT[$transactionAgentTopUp->from_wallet], 'value3' => $transactionAgentTopUp->user->name, 'value4' => App\Models\TransactionAgentTopUp::TO_WALLET_SELECT[$transactionAgentTopUp->to_wallet]]) }}</span>
                            </div>

                        </div>
                    @endif
                    @if($transactionAgentTopUp->status == 3)
                        <div class="border-top d-flex align-items-center">
                            <div class="p-3">
                                <i class="fas fa-times fa-2x text-danger"></i>
                                &nbsp;
                                <span>{{ trans('cruds.transactionAgentTopUp.fields.topup_was_rejected_at_by', ['value' => $transactionAgentTopUp->rejected_at, 'value2' => $transactionAgentTopUp->merchant->name]) }}</span>
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
                    <h6 class="mb-2">{{ $transactionAgentTopUp->user->name ?? '-' }}</h6>
                    <h6 class="mb-2">{{ $transactionAgentTopUp->user->phone ?? '-' }}</h6>
                    <h6 class="mb-2">{{ $transactionAgentTopUp->user->email ?? '-' }}</h6>
                    <hr/>
                    <h4 class="card-title mb-3">{{ trans('cruds.transactionAgentTopUp.fields.upline') }}</h4>
                    <h6 class="mb-2">{{ $transactionAgentTopUp->merchant->name ?? '-' }}</h6>
                    <h6 class="mb-2">{{ $transactionAgentTopUp->merchant->phone ?? '-' }}</h6>
                    <h6 class="mb-2">{{ $transactionAgentTopUp->merchant->email ?? '-' }}</h6>
                    <hr/>
                    <h4 class="card-title mb-3">{{ trans('cruds.transactionAgentTopUp.fields.deposit_bank') }}</h4>
                    <h6 class="mb-2">{{ trans('cruds.user.fields.bank_name') }}: {{ $transactionAgentTopUp->deposit_bank ?? '-' }}</h6>
                    <h6 class="mb-2">{{ trans('cruds.user.fields.bank_account_name') }}: {{ $transactionAgentTopUp->deposit_bank_account_name ?? '-' }}</h6>
                    <h6 class="mb-2">{{ trans('cruds.user.fields.bank_account_number') }}: {{ $transactionAgentTopUp->deposit_bank_account_number ?? '-' }}</h6>
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
