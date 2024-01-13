@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        @if(Route::is("admin.transaction-point-purchases.user-upgrade-create"))
            {{ trans('global.create') }} {{ trans('cruds.userUpgrade.title_singular') }}
        @else
            {{ trans('global.create') }} {{ trans('cruds.transactionPointPurchase.title_singular') }}
        @endif
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-point-purchases.store") }}" enctype="multipart/form-data">
            @csrf
            @if(Route::is("admin.transaction-point-purchases.user-upgrade-create"))
                <input type="hidden" name="type" value="2">
            @else
                <input type="hidden" name="type" value="1">
            @endif

            <div class="form-group" hidden>
                <label for="transaction">{{ trans('cruds.transactionPointPurchase.fields.transaction') }}</label>
                <input class="form-control {{ $errors->has('transaction') ? 'is-invalid' : '' }}" type="text" name="transaction" id="transaction" value="{{ old('transaction', '') }}">
                @if($errors->has('transaction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transaction') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.transactionPointPurchase.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="point_package_id">{{ trans('cruds.transactionPointPurchase.fields.point_package') }}</label>
                <select class="form-control select2 {{ $errors->has('point_package') ? 'is-invalid' : '' }}" name="point_package_id" id="point_package_id" required>
                    @foreach($point_packages as $entry)
                        <option value="{{ $entry->id }}" {{ old('point_package_id') == $entry->id ? 'selected' : '' }}>{{ $entry->name_en }} - {{ trans('cruds.transactionPointPurchase.fields.price') }}: {{ number_format($entry->price) }}</option>
                    @endforeach
                </select>
                @if($errors->has('point_package'))
                    <div class="invalid-feedback">
                        {{ $errors->first('point_package') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.point_package_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="point">{{ trans('cruds.transactionPointPurchase.fields.point') }}</label>
                <input class="form-control {{ $errors->has('point') ? 'is-invalid' : '' }}" type="number" name="point" id="point" value="{{ old('point', '') }}" step="0.01">
                @if($errors->has('point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.point_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="price">{{ trans('cruds.transactionPointPurchase.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payment_method_id">{{ trans('cruds.transactionPointPurchase.fields.payment_method') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method_id" id="payment_method_id" required>
                    @foreach($payment_methods as $id => $entry)
                        @if($id == 1)
                        <option value="{{ $id }}" {{ old('payment_method_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endif
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label>{{ trans('cruds.transactionPointPurchase.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TransactionPointPurchase::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '2') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="receipt">{{ trans('cruds.transactionPointPurchase.fields.receipt') }}</label>
                <div class="needsclick dropzone {{ $errors->has('receipt') ? 'is-invalid' : '' }}" id="receipt-dropzone" required>
                </div>
                @if($errors->has('receipt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receipt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.receipt_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="payment_verified_at">{{ trans('cruds.transactionPointPurchase.fields.payment_verified_at') }}</label>
                <input class="form-control datetime {{ $errors->has('payment_verified_at') ? 'is-invalid' : '' }}" type="text" name="payment_verified_at" id="payment_verified_at" value="{{ old('payment_verified_at') }}">
                @if($errors->has('payment_verified_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_verified_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.payment_verified_at_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="admin_id">{{ trans('cruds.transactionPointPurchase.fields.admin') }}</label>
                <select class="form-control select2 {{ $errors->has('admin') ? 'is-invalid' : '' }}" name="admin_id" id="admin_id">
                    @foreach($admins as $id => $entry)
                        <option value="{{ $id }}" {{ old('admin_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('admin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('admin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.admin_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="gateway_response">{{ trans('cruds.transactionPointPurchase.fields.gateway_response') }}</label>
                <textarea class="form-control {{ $errors->has('gateway_response') ? 'is-invalid' : '' }}" name="gateway_response" id="gateway_response">{{ old('gateway_response') }}</textarea>
                @if($errors->has('gateway_response'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gateway_response') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.gateway_response_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label>{{ trans('cruds.transactionPointPurchase.fields.gateway_status') }}</label>
                <select class="form-control {{ $errors->has('gateway_status') ? 'is-invalid' : '' }}" name="gateway_status" id="gateway_status">
                    <option value disabled {{ old('gateway_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TransactionPointPurchase::GATEWAY_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gateway_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gateway_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gateway_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.gateway_status_helper') }}</span>
            </div>
            <div class="form-group" hidden>
                <label for="gateway_transaction">{{ trans('cruds.transactionPointPurchase.fields.gateway_transaction') }}</label>
                <input class="form-control {{ $errors->has('gateway_transaction') ? 'is-invalid' : '' }}" type="text" name="gateway_transaction" id="gateway_transaction" value="{{ old('gateway_transaction', '') }}">
                @if($errors->has('gateway_transaction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gateway_transaction') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointPurchase.fields.gateway_transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.receiptDropzone = {
    url: '{{ route('admin.transaction-point-purchases.storeMedia') }}',
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
@if(isset($transactionPointPurchase) && $transactionPointPurchase->receipt)
      var file = {!! json_encode($transactionPointPurchase->receipt) !!}
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
@endsection
