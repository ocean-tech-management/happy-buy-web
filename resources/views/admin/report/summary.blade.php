@extends('layouts.admin')
@section('content')

    <div class="card-body">
        <div class="form-group">
            <div class="main-content" style="margin-left:0rem;">
                <div class="page-content" style="padding:0rem;" >
                    <div class="container-fluid">

                        <div class="row">


                            <div class="col-xl-12">

                                <div class="row">
                                    <div class="col-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium mb-2">{{ trans('cruds.report.fields.total_deposit') }}</p>
                                                        <h4 class="mb-0">{{ number_format($totalDeposit) }}</h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-package font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium mb-2">{{ trans('cruds.report.fields.total_joining_fee') }}</p>
                                                        <h4 class="mb-0">{{ number_format($totalFee) }}</h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-package font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium mb-2">{{ trans('cruds.report.fields.total_stock_credit_topup') }}</p>
                                                        <h4 class="mb-0">{{ number_format($totalTopup) }}</h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-package font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium mb-2">{{ trans('cruds.report.fields.total_shipping_topup') }}</p>
                                                        <h4 class="mb-0">{{ number_format($totalShippingTopup) }}</h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-package font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium mb-2">{{ trans('cruds.report.fields.total_upgrade_topup') }}</p>
                                                        <h4 class="mb-0">{{ number_format($totalUpgradeTopup) }}</h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-package font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium mb-2">{{ trans('cruds.report.fields.total_withdraw') }}</p>
                                                        <h4 class="mb-0">{{ number_format($totalWithdraw) }}</h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-package font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            @endsection

            @section('scripts')
                <script>
                    $(document).on("click", ".showAgreementDialog", function () {
                        var title = $(this).data('title');
                        var content = $(this).data('content');
                        var signature_name = $(this).data('signature-name');
                        var signature_ic = $(this).data('signature-ic');
                        var signature_at = $(this).data('signature-at');
                        console.log(title);
                        $("#agreementModalLabel").text( title );
                        $("#agreementModalContent").empty().append(content);
                        $("#agreementModalSignatureName").text(signature_name);
                        $("#agreementModalSignatureIc").text(signature_ic);
                        $("#agreementModalSignatureAt").text(signature_at);
                        // As pointed out in comments,
                        // it is unnecessary to have to manually call the modal.
                        // $('#addBookDialog').modal('show');
                    });
                </script>
@endsection
