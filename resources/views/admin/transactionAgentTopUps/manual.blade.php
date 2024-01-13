@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transactionAgentTopUp.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-agent-top-ups.manual-topup") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.transactionAgentTopUp.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $entry)
                        <option value="{{ $entry->id }}" {{ old('user_id') == $entry->id ? 'selected' : '' }}>{{ $entry->name }} - {{ $entry->personal_code }} - {{ $entry->email }}</option>
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
                <label for="wallet_id">To Wallet</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="wallet_id" id="wallet_id">
                    <option value="">Default</option>
                    <option value="1" >Executive</option>
                    <option value="2" >Manager</option>
                    <option value="3" >Millionaire</option>
                </select>
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
