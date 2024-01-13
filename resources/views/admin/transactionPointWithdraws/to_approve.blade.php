@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.approve') }} {{ trans('cruds.transactionPointWithdraw.title_singular') }}
    </div>

    <div class="card-body">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') ?? '-' }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <form method="POST" action="{{ route('admin.transaction-point-withdraws.confirm-approve', ['id' => $transactionPointWithdraw->id]) }}" enctype="multipart/form-data">
            @csrf
            <h4 class="card-title pb-3">{{ trans('cruds.user.fields.bank_information') }}</h4>
            <table class=" table table-bordered table-striped table-hover">
                <tr>
                    <td width="20%"><strong>{{ trans('cruds.user.fields.name') }}</strong></td>
                    <td>{{ $transactionPointWithdraw->user->name }}</td>
                    <td><strong>{{ trans('cruds.user.fields.bank_name') }}</strong></td>
                    <td>{{ $transactionPointWithdraw->bank_name }}</td>
                </tr>

                <tr>
                    <td><strong>{{ trans('cruds.user.fields.bank_account_name') }}</strong></td>
                    <td id="bank_account_name">{{ $transactionPointWithdraw->bank_account_name }}
                        <button type="button" class="btn btn-link copyButton"><i class="bx bx-copy"></i></button>
                        <input class="linkToCopy" value="{{ $transactionPointWithdraw->bank_account_name }}" style="position: absolute; z-index: -999; opacity: 0;" />
                    </td>
                    <td><strong>{{ trans('cruds.user.fields.bank_account_number') }}</strong></td>
                    <td>{{ $transactionPointWithdraw->bank_account_number }}
                        <button type="button" class="btn btn-link copyButton"><i class="bx bx-copy"></i></button>
                        <input class="linkToCopy" value="{{ $transactionPointWithdraw->bank_account_number }}" style="position: absolute; z-index: -999; opacity: 0;" /></td>
                    </td>
                </tr>
                <tr>
                    <td><strong>{{ trans('cruds.transactionPointWithdraw.fields.withdraw_amount') }}</strong></td>
                    <td colspan="3">{{ number_format($transactionPointWithdraw->amount) }}
                        <button type="button" class="btn btn-link copyButton"><i class="bx bx-copy"></i></button>
                        <input class="linkToCopy" value="{{ $transactionPointWithdraw->amount }}" style="position: absolute; z-index: -999; opacity: 0;" /></td>
                    </td>
                </tr>
            </table>
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
            <div class="form-group" hidden>
                <label>{{ trans('cruds.transactionPointWithdraw.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TransactionPointWithdraw::STATUS_SELECT as $key => $label)
                        @if($key == 2)
                            <option value="{{ $key }}" {{ old('status', '2') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endif
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
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.confirm') }}
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
    <script>
        $('button.copyButton').click(function(){
            $(this).siblings('input.linkToCopy').select();
            document.execCommand("copy");
        });

    </script>
@endsection
