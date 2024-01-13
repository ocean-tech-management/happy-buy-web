@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transactionAgentTopUp.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-agent-top-ups.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="transaction">{{ trans('cruds.transactionAgentTopUp.fields.transaction') }}</label>
                <input class="form-control {{ $errors->has('transaction') ? 'is-invalid' : '' }}" type="text" name="transaction" id="transaction" value="{{ old('transaction', '') }}">
                @if($errors->has('transaction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transaction') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.transactionAgentTopUp.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="merchant_id">{{ trans('cruds.transactionAgentTopUp.fields.merchant') }}</label>
                <select class="form-control select2 {{ $errors->has('merchant') ? 'is-invalid' : '' }}" name="merchant_id" id="merchant_id">
                    @foreach($merchants as $id => $entry)
                        <option value="{{ $id }}" {{ old('merchant_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('merchant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('merchant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.merchant_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.transactionAgentTopUp.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', '') }}">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="merchant_pre_balance">{{ trans('cruds.transactionAgentTopUp.fields.merchant_pre_balance') }}</label>
                <input class="form-control {{ $errors->has('merchant_pre_balance') ? 'is-invalid' : '' }}" type="text" name="merchant_pre_balance" id="merchant_pre_balance" value="{{ old('merchant_pre_balance', '') }}">
                @if($errors->has('merchant_pre_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('merchant_pre_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.merchant_pre_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="merchant_post_balance">{{ trans('cruds.transactionAgentTopUp.fields.merchant_post_balance') }}</label>
                <input class="form-control {{ $errors->has('merchant_post_balance') ? 'is-invalid' : '' }}" type="text" name="merchant_post_balance" id="merchant_post_balance" value="{{ old('merchant_post_balance', '') }}">
                @if($errors->has('merchant_post_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('merchant_post_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.merchant_post_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_pre_balance">{{ trans('cruds.transactionAgentTopUp.fields.user_pre_balance') }}</label>
                <input class="form-control {{ $errors->has('user_pre_balance') ? 'is-invalid' : '' }}" type="text" name="user_pre_balance" id="user_pre_balance" value="{{ old('user_pre_balance', '') }}">
                @if($errors->has('user_pre_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_pre_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.user_pre_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_post_balance">{{ trans('cruds.transactionAgentTopUp.fields.user_post_balance') }}</label>
                <input class="form-control {{ $errors->has('user_post_balance') ? 'is-invalid' : '' }}" type="text" name="user_post_balance" id="user_post_balance" value="{{ old('user_post_balance', '') }}">
                @if($errors->has('user_post_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_post_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.user_post_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.transactionAgentTopUp.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TransactionAgentTopUp::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receipt_photo">{{ trans('cruds.transactionAgentTopUp.fields.receipt_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('receipt_photo') ? 'is-invalid' : '' }}" id="receipt_photo-dropzone">
                </div>
                @if($errors->has('receipt_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receipt_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.receipt_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="approved_at">{{ trans('cruds.transactionAgentTopUp.fields.approved_at') }}</label>
                <input class="form-control datetime {{ $errors->has('approved_at') ? 'is-invalid' : '' }}" type="text" name="approved_at" id="approved_at" value="{{ old('approved_at') }}">
                @if($errors->has('approved_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.approved_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rejected_at">{{ trans('cruds.transactionAgentTopUp.fields.rejected_at') }}</label>
                <input class="form-control datetime {{ $errors->has('rejected_at') ? 'is-invalid' : '' }}" type="text" name="rejected_at" id="rejected_at" value="{{ old('rejected_at') }}">
                @if($errors->has('rejected_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rejected_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.rejected_at_helper') }}</span>
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
    Dropzone.options.receiptPhotoDropzone = {
    url: '{{ route('admin.transaction-agent-top-ups.storeMedia') }}',
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
      $('form').find('input[name="receipt_photo"]').remove()
      $('form').append('<input type="hidden" name="receipt_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="receipt_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($transactionAgentTopUp) && $transactionAgentTopUp->receipt_photo)
      var file = {!! json_encode($transactionAgentTopUp->receipt_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="receipt_photo" value="' + file.file_name + '">')
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