@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pointPackage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.point-packages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label class="required" for="name_en">{{ trans('cruds.pointPackage.fields.name_en') }}</label>
                    <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}" required>
                    @if($errors->has('name_en'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name_en') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointPackage.fields.name_en_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label for="name_zh">{{ trans('cruds.pointPackage.fields.name_zh') }}</label>
                    <input class="form-control {{ $errors->has('name_zh') ? 'is-invalid' : '' }}" type="text" name="name_zh" id="name_zh" value="{{ old('name_zh', '') }}">
                    @if($errors->has('name_zh'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name_zh') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointPackage.fields.name_zh_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label for="point">{{ trans('cruds.pointPackage.fields.point') }}</label>
                    <input class="form-control {{ $errors->has('point') ? 'is-invalid' : '' }}" type="number" name="point" id="point" value="{{ old('point', '') }}" step="0.01">
                    @if($errors->has('point'))
                        <div class="invalid-feedback">
                            {{ $errors->first('point') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointPackage.fields.point_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label for="price">{{ trans('cruds.pointPackage.fields.price') }}</label>
                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                    @if($errors->has('price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointPackage.fields.price_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label for="deduct_point">{{ trans('cruds.pointPackage.fields.deduct_point') }}</label>
                    <input class="form-control {{ $errors->has('deduct_point') ? 'is-invalid' : '' }}" type="text" name="deduct_point" id="deduct_point" value="{{ old('deduct_point', '') }}">
                    @if($errors->has('deduct_point'))
                        <div class="invalid-feedback">
                            {{ $errors->first('deduct_point') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointPackage.fields.deduct_point_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label for="deduct_2_level_point">{{ trans('cruds.pointPackage.fields.deduct_2_level_point') }}</label>
                    <input class="form-control {{ $errors->has('deduct_2_level_point') ? 'is-invalid' : '' }}" type="text" name="deduct_2_level_point" id="deduct_2_level_point" value="{{ old('deduct_2_level_point', '') }}">
                    @if($errors->has('deduct_2_level_point'))
                        <div class="invalid-feedback">
                            {{ $errors->first('deduct_2_level_point') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointPackage.fields.deduct_2_level_point_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label for="roles">{{ trans('cruds.pointPackage.fields.role') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple>
                        @foreach($roles as $id => $role)
                            <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('roles'))
                        <div class="invalid-feedback">
                            {{ $errors->first('roles') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.pointPackage.fields.role_helper') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="package_photo">{{ trans('cruds.pointPackage.fields.package_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('package_photo') ? 'is-invalid' : '' }}" id="package_photo-dropzone">
                </div>
                @if($errors->has('package_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointPackage.fields.package_photo_helper') }}</span>
            </div>

            <div class="form-group" hidden>
                <label>{{ trans('cruds.pointPackage.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PointPackage::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointPackage.fields.status_helper') }}</span>
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
    Dropzone.options.packagePhotoDropzone = {
    url: '{{ route('admin.point-packages.storeMedia') }}',
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
      $('form').find('input[name="package_photo"]').remove()
      $('form').append('<input type="hidden" name="package_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="package_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pointPackage) && $pointPackage->package_photo)
      var file = {!! json_encode($pointPackage->package_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="package_photo" value="' + file.file_name + '">')
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
