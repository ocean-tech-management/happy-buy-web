@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-1"></div>
    <div class="col-7">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">{{ trans('cruds.transactionPointWithdraw.fields.withdraw_information') }} #{{ $transactionPointWithdraw->transaction }}</h4>
                <h6 class="mb-0"><i class="fas fa-shopping-bag fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ App\Models\TransactionPointWithdraw::STATUS_SELECT[$transactionPointWithdraw->status] ?? '' }}</h6>
                <hr>
                <div class="pt-3" style="padding-left: 45px;">
                    <div class="row">
                        <div class="form-group col-6">
                            <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionPointWithdraw.fields.request_amount') }}</h5>
                            <p class="text-muted">
                                RM {{ number_format($transactionPointWithdraw->amount) }}
                                <button type="button" class="btn btn-link copyButton"><i class="bx bx-copy"></i></button>
                                <input class="linkToCopy" value="{{ $transactionPointWithdraw->amount }}" style="position: absolute; z-index: -999; opacity: 0;" />
                            </p>
                        </div>
                        <div class="form-group col-6">
                            <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionPointWithdraw.fields.bank_name') }}</h5>
                            <p class="text-muted">
                                {{ $transactionPointWithdraw->bank_name }}
                                <button type="button" class="btn btn-link copyButton"><i class="bx bx-copy"></i></button>
                                <input class="linkToCopy" value="{{ $transactionPointWithdraw->bank_name }}" style="position: absolute; z-index: -999; opacity: 0;" />
                            </p>
                        </div>
                        <div class="form-group col-6">
                            <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionPointWithdraw.fields.bank_account_name') }}</h5>
                            <p class="text-muted">
                                {{ $transactionPointWithdraw->bank_account_name }}
                                <button type="button" class="btn btn-link copyButton"><i class="bx bx-copy"></i></button>
                                <input class="linkToCopy" value="{{ $transactionPointWithdraw->bank_account_name }}" style="position: absolute; z-index: -999; opacity: 0;" />
                            </p>

                        </div>
                        <div class="form-group col-6">
                            <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionPointWithdraw.fields.bank_account_number') }}</h5>
                            <p class="text-muted">
                                {{ $transactionPointWithdraw->bank_account_number }}
                                <button type="button" class="btn btn-link copyButton"><i class="bx bx-copy"></i></button>
                                <input class="linkToCopy" value="{{ $transactionPointWithdraw->bank_account_number }}" style="position: absolute; z-index: -999; opacity: 0;" />
                            </p>
                        </div>
                    </div>
                </div>

                <div class="border-top d-flex align-items-center">
                    <div class="p-3">
                        <i class="fas fa-check fa-2x text-success"></i>
                        &nbsp;
                        <span>{{ trans('cruds.transactionPointWithdraw.fields.withdraw_was_created', ['value' => $transactionPointWithdraw->created_at]) }}</span>
                    </div>
                    <div class="ms-auto">
                        @if($transactionPointWithdraw->status == 1)
                            @can('transaction_point_withdraw_to_reject')
                                <a class="ms-auto btn btn-sm btn-danger show-reject">{{ trans('global.reject') }}</a>
                            @endcan
                            @can('transaction_point_withdraw_to_approve')
                                @if($errors->has('receipt'))
                                        <a class="ms-auto btn btn-sm btn-success show-approve" style="display: none">{{ trans('global.approve') }}</a>
                                @else
                                    <a class="ms-auto btn btn-sm btn-success show-approve">{{ trans('global.approve') }}</a>
                                @endif
                            @endcan
                        @endif
                    </div>
                </div>
                @can('transaction_point_withdraw_to_reject')
                    <div class="row p-3" id="reject-withdraw" style="display: none">
                        <form action="{{ route('admin.transaction-point-withdraws.confirm-reject') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <div class="form-group">
                                <label class="required" for="remark">{{ trans('cruds.transactionPointWithdraw.fields.reject_reason') }}</label>
                                <textarea class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" name="reason" id="reason" required>{{ old('reason') }}</textarea>
                                @if($errors->has('reason'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('reason') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.remark_helper') }}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $transactionPointWithdraw->id }}">
                            <div style="text-align: right">
                                <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.reject') }}">
                                <a class="ms-auto btn btn-sm btn-info hide-reject">{{ trans('global.cancel') }}</a>
                            </div>

                        </form>
                    </div>
                @endcan
                @can('transaction_point_withdraw_to_approve')
                    <div class="row p-3" id="approve-withdraw" @if($errors->has('receipt')) @else style="display: none" @endif>
                        <form action="{{ route('admin.transaction-point-withdraws.confirm-approve', ['id' => $transactionPointWithdraw->id]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <div class="form-group" >
                                <label class="required" for="receipt">{{ trans('cruds.transactionPointWithdraw.fields.receipt') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('receipt') ? 'is-invalid' : '' }}" id="receipt-dropzone">
                                </div>
                                @if($errors->has('receipt'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('receipt') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.receipt_helper') }}</span>
                            </div>
                            <div class="form-group" >
                                <label for="remark">{{ trans('cruds.transactionPointWithdraw.fields.remark') }}</label>
                                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark') }}</textarea>
                                @if($errors->has('remark'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('remark') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.remark_helper') }}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="status" value="{{ $transactionPointWithdraw->status }}">
                            <div style="text-align: right">
                                <input type="submit" class="btn btn-sm btn-success" value="{{ trans('global.approve') }}">
                                <a class="ms-auto btn btn-sm btn-info hide-approve">{{ trans('global.cancel') }}</a>
                            </div>
                        </form>
                    </div>
                @endcan
                @if($transactionPointWithdraw->status == 3)
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-times fa-2x text-danger"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionPointWithdraw.fields.withdraw_was_rejected', ['value' => $transactionPointWithdraw->admin->name]) }}</span>
                        </div>
                    </div>
                    <div class="form-group" style="padding-left: 45px;">
                        <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionPointWithdraw.fields.reject_reason') }}</h5>
                        <p class="text-muted">{{ $transactionPointWithdraw->remark ?? '-' }}</p>
                    </div>
                @endif
                @if($transactionPointWithdraw->status == 2)
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionPointWithdraw.fields.withdraw_was_approved', ['value' => $transactionPointWithdraw->admin->name]) }}</span>
                        </div>
                        <a class="ms-auto btn btn-sm btn-info show-payment">{{ trans('global.show') }}</a>
                        <a class="ms-auto btn btn-sm btn-info hide-payment" style="display: none">{{ trans('global.hide') }}</a>
                    </div>
                    <div class="row p-3" id="payment-detail" style="display: none;">
                        <div class="form-group" style="padding-left: 45px;">
                            @if($transactionPointWithdraw->receipt)
                                <a class="image-popup-vertical-fit" href="{{ $transactionPointWithdraw->receipt->getUrl() }}" style="display: inline-block">
                                    <img src="{{ $transactionPointWithdraw->receipt->getUrl('preview') }}">
                                </a>
                            @endif
                        </div>
                        <div class="form-group pt-2" style="padding-left: 45px;">
                            <h5 class="text-truncate font-size-15">{{ trans('cruds.transactionPointWithdraw.fields.remark') }}</h5>
                            <p class="text-muted">{{ $transactionPointWithdraw->remark ?? '-' }}</p>
                        </div>
                    </div>
                @endif
                @if($transactionPointWithdraw->status == 4)
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-question fa-2x text-warning"></i>
                            &nbsp;
                            <span>{{ trans('cruds.transactionPointWithdraw.fields.withdraw_completed', ['value' => $transactionPointWithdraw]) }}</span>
                        </div>
                        <div class="ms-auto">
                            <form action="{{ route('admin.transaction-point-withdraws.confirm-approve', ['id' => $transactionPointWithdraw->id]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="status" value="{{ $transactionPointWithdraw->status }}">
                                <div style="text-align: right">
                                    <input type="submit" class="btn btn-sm btn-success" value="{{ trans('global.approve') }}">
                                </div>
                            </form>
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
                <h6 class="mb-1">{{ $transactionPointWithdraw->user->name ?? '-' }}</h6>
                <h6 class="mb-1">{{ $transactionPointWithdraw->user->phone ?? '-' }}</h6>
                <h6 class="mb-4">{{ $transactionPointWithdraw->user->email ?? '-' }}</h6>
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

@section('scripts')
    <script>
        Dropzone.options.receiptDropzone = {
            url: '{{ route('admin.transaction-point-withdraws.storeMedia') }}',
            maxFilesize: 5, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="receipt"]').remove()
                $('form').append('<input type="hidden" name="receipt" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="receipt"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($transactionPointWithdraw) && $transactionPointWithdraw->receipt)
                var file = {!! json_encode($transactionPointWithdraw->receipt) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="receipt" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        $('.show-reject').click(function() {
            $("#reject-withdraw").css("display", "block");
            $("#approve-withdraw").css("display", "none");
            // $(".hide-reject").css("display", "block");
            $(".show-reject").css("display", "none");
            $(".show-approve").css("display", "inline");
        });
        $('.hide-reject').click(function() {
            $("#reject-withdraw").css("display", "none");
            // $(".hide-reject").css("display", "none");
            $(".show-reject").css("display", "inline");
            $(".show-approve").css("display", "inline");
        });
        $('.show-approve').click(function() {
            $("#reject-withdraw").css("display", "none");
            $("#approve-withdraw").css("display", "block");
            // $(".hide-reject").css("display", "block");
            $(".show-reject").css("display", "block");
            $(".show-approve").css("display", "none");
        });
        $('.hide-approve').click(function() {
            $("#approve-withdraw").css("display", "none");
            // $(".hide-reject").css("display", "none");
            $(".show-reject").css("display", "inline");
            $(".show-approve").css("display", "inline");
        });

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
    <script>
        $('button.copyButton').click(function(){
            $(this).siblings('input.linkToCopy').select();
            document.execCommand("copy");
        });

    </script>
@endsection
