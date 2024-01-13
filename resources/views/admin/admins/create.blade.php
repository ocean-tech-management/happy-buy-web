@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route("admin.admins.store") }}" enctype="multipart/form-data">
                        @csrf
                        <h4 class="card-title mb-3">{{ trans('global.create') }} {{ trans('cruds.admin.title_singular') }}</h4>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="required" for="name">{{ trans('cruds.admin.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.admin.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label class="required" for="password">{{ trans('cruds.admin.fields.password') }}</label>
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.admin.fields.password_helper') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">{{ trans('cruds.admin.fields.phone') }}</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.admin.fields.phone_helper') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label class="required" for="email">{{ trans('cruds.admin.fields.email') }}</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.admin.fields.email_helper') }}</span>
                            </div>
                            <div class="form-group col-6" hidden>
                                <label>{{ trans('cruds.admin.fields.status') }}</label>
                                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\Admin::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.admin.fields.status_helper') }}</span>
                            </div>

                            <div class="form-group col-6">
                                <label class="required" for="roles">{{ trans('cruds.admin.fields.roles') }}</label>
                                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" required>
                                    @foreach($roles as $id => $role)
                                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('roles'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('roles') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.admin.fields.roles_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="profile_photo">{{ trans('cruds.admin.fields.profile_photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('profile_photo') ? 'is-invalid' : '' }}" id="profile_photo-dropzone">
                        </div>
                        @if($errors->has('profile_photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('profile_photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.admin.fields.profile_photo_helper') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>

@endsection

@section('scripts')
<script>
    Dropzone.options.profilePhotoDropzone = {
    url: '{{ route('admin.admins.storeMedia') }}',
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
      $('form').find('input[name="profile_photo"]').remove()
      $('form').append('<input type="hidden" name="profile_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="profile_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($admin) && $admin->profile_photo)
      var file = {!! json_encode($admin->profile_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="profile_photo" value="' + file.file_name + '">')
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
