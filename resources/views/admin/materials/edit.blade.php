@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.material.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.materials.update", [$material->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="language_id">{{ trans('cruds.material.fields.language') }}</label>
                <select class="form-control select2 {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language_id" id="language_id">
                    @foreach($languages as $id => $entry)
                        <option value="{{ $id }}" {{ (old('language_id') ? old('language_id') : $material->language->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('language'))
                    <div class="invalid-feedback">
                        {{ $errors->first('language') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_title_1">{{ trans('cruds.material.fields.file_title_1') }}</label>
                <input class="form-control {{ $errors->has('file_title_1') ? 'is-invalid' : '' }}" type="text" name="file_title_1" id="file_title_1" value="{{ old('file_title_1', $material->file_title_1) }}">
                @if($errors->has('file_title_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_title_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_title_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_1">{{ trans('cruds.material.fields.file_1') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_1') ? 'is-invalid' : '' }}" id="file_1-dropzone">
                </div>
                @if($errors->has('file_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_title_2">{{ trans('cruds.material.fields.file_title_2') }}</label>
                <input class="form-control {{ $errors->has('file_title_2') ? 'is-invalid' : '' }}" type="text" name="file_title_2" id="file_title_2" value="{{ old('file_title_2', $material->file_title_2) }}">
                @if($errors->has('file_title_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_title_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_title_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_2">{{ trans('cruds.material.fields.file_2') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_2') ? 'is-invalid' : '' }}" id="file_2-dropzone">
                </div>
                @if($errors->has('file_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_title_3">{{ trans('cruds.material.fields.file_title_3') }}</label>
                <input class="form-control {{ $errors->has('file_title_3') ? 'is-invalid' : '' }}" type="text" name="file_title_3" id="file_title_3" value="{{ old('file_title_3', $material->file_title_3) }}">
                @if($errors->has('file_title_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_title_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_title_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_3">{{ trans('cruds.material.fields.file_3') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_3') ? 'is-invalid' : '' }}" id="file_3-dropzone">
                </div>
                @if($errors->has('file_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_title_4">{{ trans('cruds.material.fields.file_title_4') }}</label>
                <input class="form-control {{ $errors->has('file_title_4') ? 'is-invalid' : '' }}" type="text" name="file_title_4" id="file_title_4" value="{{ old('file_title_4', $material->file_title_4) }}">
                @if($errors->has('file_title_4'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_title_4') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_title_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_4">{{ trans('cruds.material.fields.file_4') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_4') ? 'is-invalid' : '' }}" id="file_4-dropzone">
                </div>
                @if($errors->has('file_4'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_4') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_title_5">{{ trans('cruds.material.fields.file_title_5') }}</label>
                <input class="form-control {{ $errors->has('file_title_5') ? 'is-invalid' : '' }}" type="text" name="file_title_5" id="file_title_5" value="{{ old('file_title_5', $material->file_title_5) }}">
                @if($errors->has('file_title_5'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_title_5') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_title_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_5">{{ trans('cruds.material.fields.file_5') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_5') ? 'is-invalid' : '' }}" id="file_5-dropzone">
                </div>
                @if($errors->has('file_5'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_5') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.file_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="publish_year">{{ trans('cruds.material.fields.publish_year') }}</label>
                <input class="form-control {{ $errors->has('publish_year') ? 'is-invalid' : '' }}" type="number" name="publish_year" id="publish_year" value="{{ old('publish_year', $material->publish_year) }}" step="1">
                @if($errors->has('publish_year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publish_year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.publish_year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="publish_month">{{ trans('cruds.material.fields.publish_month') }}</label>
                <input class="form-control {{ $errors->has('publish_month') ? 'is-invalid' : '' }}" type="number" name="publish_month" id="publish_month" value="{{ old('publish_month', $material->publish_month) }}" step="1">
                @if($errors->has('publish_month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publish_month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.publish_month_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.material.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Material::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $material->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="roles">{{ trans('cruds.material.fields.role') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $material->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.role_helper') }}</span>
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
    Dropzone.options.file1Dropzone = {
    url: '{{ route('admin.materials.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="file_1"]').remove()
      $('form').append('<input type="hidden" name="file_1" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_1"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($material) && $material->file_1)
      var file = {!! json_encode($material->file_1) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_1" value="' + file.file_name + '">')
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
    Dropzone.options.file2Dropzone = {
    url: '{{ route('admin.materials.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="file_2"]').remove()
      $('form').append('<input type="hidden" name="file_2" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_2"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($material) && $material->file_2)
      var file = {!! json_encode($material->file_2) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_2" value="' + file.file_name + '">')
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
    Dropzone.options.file3Dropzone = {
    url: '{{ route('admin.materials.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="file_3"]').remove()
      $('form').append('<input type="hidden" name="file_3" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_3"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($material) && $material->file_3)
      var file = {!! json_encode($material->file_3) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_3" value="' + file.file_name + '">')
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
    Dropzone.options.file4Dropzone = {
    url: '{{ route('admin.materials.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="file_4"]').remove()
      $('form').append('<input type="hidden" name="file_4" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_4"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($material) && $material->file_4)
      var file = {!! json_encode($material->file_4) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_4" value="' + file.file_name + '">')
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
    Dropzone.options.file5Dropzone = {
    url: '{{ route('admin.materials.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="file_5"]').remove()
      $('form').append('<input type="hidden" name="file_5" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_5"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($material) && $material->file_5)
      var file = {!! json_encode($material->file_5) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_5" value="' + file.file_name + '">')
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