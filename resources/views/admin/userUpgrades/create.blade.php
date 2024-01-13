@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userUpgrade.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-upgrades.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.userUpgrade.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="upgrade_role_id">{{ trans('cruds.userUpgrade.fields.upgrade_role') }}</label>
                <select class="form-control select2 {{ $errors->has('upgrade_role') ? 'is-invalid' : '' }}" name="upgrade_role_id" id="upgrade_role_id" required>
                    @foreach($upgrade_roles as $id => $entry)
                        <option value="{{ $id }}" {{ old('upgrade_role_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('upgrade_role'))
                    <div class="invalid-feedback">
                        {{ $errors->first('upgrade_role') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.upgrade_role_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.userUpgrade.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', '') }}" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="receipt">{{ trans('cruds.userUpgrade.fields.receipt') }}</label>
                <div class="needsclick dropzone {{ $errors->has('receipt') ? 'is-invalid' : '' }}" id="receipt-dropzone">
                </div>
                @if($errors->has('receipt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receipt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.receipt_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.userUpgrade.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\UserUpgrade::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_method_id">{{ trans('cruds.userUpgrade.fields.payment_method') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method_id" id="payment_method_id">
                    @foreach($payment_methods as $id => $entry)
                        <option value="{{ $id }}" {{ old('payment_method_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gateway_response">{{ trans('cruds.userUpgrade.fields.gateway_response') }}</label>
                <textarea class="form-control {{ $errors->has('gateway_response') ? 'is-invalid' : '' }}" name="gateway_response" id="gateway_response">{{ old('gateway_response') }}</textarea>
                @if($errors->has('gateway_response'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gateway_response') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.gateway_response_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.userUpgrade.fields.gateway_status') }}</label>
                <select class="form-control {{ $errors->has('gateway_status') ? 'is-invalid' : '' }}" name="gateway_status" id="gateway_status">
                    <option value disabled {{ old('gateway_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\UserUpgrade::GATEWAY_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gateway_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gateway_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gateway_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.gateway_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gateway_transaction">{{ trans('cruds.userUpgrade.fields.gateway_transaction') }}</label>
                <input class="form-control {{ $errors->has('gateway_transaction') ? 'is-invalid' : '' }}" type="text" name="gateway_transaction" id="gateway_transaction" value="{{ old('gateway_transaction', '') }}">
                @if($errors->has('gateway_transaction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gateway_transaction') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.gateway_transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="approve_at">{{ trans('cruds.userUpgrade.fields.approve_at') }}</label>
                <input class="form-control datetime {{ $errors->has('approve_at') ? 'is-invalid' : '' }}" type="text" name="approve_at" id="approve_at" value="{{ old('approve_at') }}">
                @if($errors->has('approve_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approve_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.approve_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="approved_by_user_id">{{ trans('cruds.userUpgrade.fields.approved_by_user') }}</label>
                <select class="form-control select2 {{ $errors->has('approved_by_user') ? 'is-invalid' : '' }}" name="approved_by_user_id" id="approved_by_user_id">
                    @foreach($approved_by_users as $id => $entry)
                        <option value="{{ $id }}" {{ old('approved_by_user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('approved_by_user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved_by_user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.approved_by_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="approved_by_admin_id">{{ trans('cruds.userUpgrade.fields.approved_by_admin') }}</label>
                <select class="form-control select2 {{ $errors->has('approved_by_admin') ? 'is-invalid' : '' }}" name="approved_by_admin_id" id="approved_by_admin_id">
                    @foreach($approved_by_admins as $id => $entry)
                        <option value="{{ $id }}" {{ old('approved_by_admin_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('approved_by_admin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved_by_admin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userUpgrade.fields.approved_by_admin_helper') }}</span>
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
    url: '{{ route('admin.user-upgrades.storeMedia') }}',
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
@if(isset($userUpgrade) && $userUpgrade->receipt)
      var file = {!! json_encode($userUpgrade->receipt) !!}
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
