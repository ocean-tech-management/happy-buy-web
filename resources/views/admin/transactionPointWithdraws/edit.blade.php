@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.transactionPointWithdraw.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-point-withdraws.update", [$transactionPointWithdraw->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="transaction">{{ trans('cruds.transactionPointWithdraw.fields.transaction') }}</label>
                <input class="form-control {{ $errors->has('transaction') ? 'is-invalid' : '' }}" type="text" name="transaction" id="transaction" value="{{ old('transaction', $transactionPointWithdraw->transaction) }}">
                @if($errors->has('transaction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transaction') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.transactionPointWithdraw.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $transactionPointWithdraw->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.transactionPointWithdraw.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $transactionPointWithdraw->amount) }}" step="0.01">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bank_name">{{ trans('cruds.transactionPointWithdraw.fields.bank_name') }}</label>
                <input class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $transactionPointWithdraw->bank_name) }}">
                @if($errors->has('bank_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bank_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.bank_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bank_account_name">{{ trans('cruds.transactionPointWithdraw.fields.bank_account_name') }}</label>
                <input class="form-control {{ $errors->has('bank_account_name') ? 'is-invalid' : '' }}" type="text" name="bank_account_name" id="bank_account_name" value="{{ old('bank_account_name', $transactionPointWithdraw->bank_account_name) }}">
                @if($errors->has('bank_account_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bank_account_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.bank_account_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bank_account_number">{{ trans('cruds.transactionPointWithdraw.fields.bank_account_number') }}</label>
                <input class="form-control {{ $errors->has('bank_account_number') ? 'is-invalid' : '' }}" type="text" name="bank_account_number" id="bank_account_number" value="{{ old('bank_account_number', $transactionPointWithdraw->bank_account_number) }}">
                @if($errors->has('bank_account_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bank_account_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.bank_account_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.transactionPointWithdraw.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TransactionPointWithdraw::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $transactionPointWithdraw->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="admin_id">{{ trans('cruds.transactionPointWithdraw.fields.admin') }}</label>
                <select class="form-control select2 {{ $errors->has('admin') ? 'is-invalid' : '' }}" name="admin_id" id="admin_id">
                    @foreach($admins as $id => $entry)
                        <option value="{{ $id }}" {{ (old('admin_id') ? old('admin_id') : $transactionPointWithdraw->admin->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('admin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('admin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.admin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receipt">{{ trans('cruds.transactionPointWithdraw.fields.receipt') }}</label>
                <div class="needsclick dropzone {{ $errors->has('receipt') ? 'is-invalid' : '' }}" id="receipt-dropzone">
                </div>
                @if($errors->has('receipt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receipt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.receipt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.transactionPointWithdraw.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark', $transactionPointWithdraw->remark) }}</textarea>
                @if($errors->has('remark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionPointWithdraw.fields.remark_helper') }}</span>
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
@endsection