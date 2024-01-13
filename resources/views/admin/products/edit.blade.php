@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }}
            @if(Route::is('admin.products.package-edit'))
                {{ trans('cruds.product.fields.product_package') }}
            @else
                {{ trans('cruds.product.title_singular') }}
            @endif

        </div>
    </div>

    <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
        <div class="col-xl-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="required" for="name_en">{{ trans('cruds.product.fields.name_en') }}</label>
                            <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', $product->name_en) }}" required>
                            @if($errors->has('name_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name_en') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.name_en_helper') }}</span>
                        </div>
                        <div class="form-group col-6">
                            <label for="name_zh">{{ trans('cruds.product.fields.name_zh') }}</label>
                            <input class="form-control {{ $errors->has('name_zh') ? 'is-invalid' : '' }}" type="text" name="name_zh" id="name_zh" value="{{ old('name_zh', $product->name_zh) }}">
                            @if($errors->has('name_zh'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name_zh') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.name_zh_helper') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="required" for="short_desc_en">{{ trans('cruds.product.fields.short_desc_en') }}</label>
                            <textarea class="form-control {{ $errors->has('short_desc_en') ? 'is-invalid' : '' }}" name="short_desc_en" id="short_desc_en" required>{{ old('short_desc_en', $product->short_desc_en) }}</textarea>
                            @if($errors->has('short_desc_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('short_desc_en') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.short_desc_en_helper') }}</span>
                        </div>
                        <div class="form-group col-6">
                            <label for="short_desc_zh">{{ trans('cruds.product.fields.short_desc_zh') }}</label>
                            <textarea class="form-control {{ $errors->has('short_desc_zh') ? 'is-invalid' : '' }}" name="short_desc_zh" id="short_desc_zh">{{ old('short_desc_zh', $product->short_desc_zh) }}</textarea>
                            @if($errors->has('short_desc_zh'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('short_desc_zh') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.short_desc_zh_helper') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <a class="hide-en-editor"><input type="button" class="btn btn-sm btn-warning" value="{{ trans('global.hide_editor') }}"><br/></a>
                            <a class="show-en-editor"><input type="button" class="btn btn-sm btn-success" value="{{ trans('global.show_editor') }}"><br/></a>
                            <label class="mt-3" for="desc_en">{{ trans('cruds.product.fields.desc_en') }}</label>
                            <textarea class="form-control" name="desc_en_2" id="desc_en_2" readonly>{!! old('desc_en', $product->desc_en) !!}</textarea>
                            <div class="div-desc-en">
                                <textarea class="form-control ckeditor {{ $errors->has('desc_en') ? 'is-invalid' : '' }}" name="desc_en" id="desc_en">{!! old('desc_en', $product->desc_en) !!}</textarea>
                                @if($errors->has('desc_en'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('desc_en') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.desc_en_helper') }}</span>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <a class="hide-zh-editor"><input type="button" class="btn btn-sm btn-warning" value="{{ trans('global.hide_editor') }}"><br/></a>
                            <a class="show-zh-editor"><input type="button" class="btn btn-sm btn-success" value="{{ trans('global.show_editor') }}"><br/></a>
                            <label class="mt-3" for="desc_zh">{{ trans('cruds.product.fields.desc_zh') }}</label>
                            <textarea class="form-control" name="desc_zh_2" id="desc_zh_2" readonly>{!! old('desc_zh', $product->desc_zh) !!}</textarea>
                            <div class="div-desc-zh">
                                <textarea class="form-control ckeditor {{ $errors->has('desc_zh') ? 'is-invalid' : '' }}" name="desc_zh" id="desc_zh">{!! old('desc_zh', $product->desc_zh) !!}</textarea>
                                @if($errors->has('desc_zh'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('desc_zh') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.desc_zh_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    @if(Route::is('admin.products.package-edit'))
                        <div class="row">
                            <input class="form-control" type="hidden" name="type" id="type" value="2">
                            <div class="form-group col-6">
                                <div class="type_select" style="display: none;">
                                    <label for="product_variant_quantity">{{ trans('cruds.product.fields.product_variant_quantity') }}</label>
                                    <input class="form-control {{ $errors->has('product_variant_quantity') ? 'is-invalid' : '' }}" type="text" name="product_variant_quantity" id="product_variant_quantity" value="{{ old('product_variant_quantity', $product->product_variant_quantity) }}">
                                    @if($errors->has('product_variant_quantity'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('product_variant_quantity') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.product.fields.product_variant_quantity_helper') }}</span>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <div class="type_select" style="display: none;">
                                    <label for="product_variant_item_quantity">{{ trans('cruds.product.fields.product_variant_item_quantity') }}</label>
                                    <input class="form-control {{ $errors->has('product_variant_item_quantity') ? 'is-invalid' : '' }}" type="text" name="product_variant_item_quantity" id="product_variant_item_quantity" value="{{ old('product_variant_item_quantity', $product->product_variant_item_quantity) }}">
                                    @if($errors->has('product_variant_item_quantity'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('product_variant_item_quantity') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.product.fields.product_variant_item_quantity_helper') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6" >
                                <label class="required" for="product_list">Product Parent ID</label>
                                <select class="form-control product_list {{ $errors->has('product_list') ? 'is-invalid' : '' }}" name="parent_id" id="parent_id">
                                    @foreach($product_lists as $id => $item)
                                        <option value="{{ $id }}" {{ (old('parent_id') ? old('parent_id') : $product->parent_id ?? '') == $id ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('product_list'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('product_list') }}
                                    </div>
                                @endif
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group col-6">
                                <label class="required" for="product_list">{{ trans('cruds.product.title_singular') }}</label>
                                <select class="form-control select2 {{ $errors->has('product_list') ? 'is-invalid' : '' }}" name="product_list[]" id="product_list" multiple>
                                    @foreach($product_lists as $id => $item)
                                        <option value="{{ $id }}" {{ (in_array($id, old('product_list', [])) || $product->product_list->contains($id)) ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('product_list'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('product_list') }}
                                    </div>
                                @endif
                                <span class="help-block"></span>
                            </div>
                        </div>
                    @else
                        <input class="form-control" type="hidden" name="type" id="type" value="1">
                        <input class="form-control" type="hidden" name="product_variant_quantity" id="product_variant_quantity" value="0">
                        <input class="form-control" type="hidden" name="product_variant_item_quantity" id="product_variant_item_quantity" value="0">
                        <input class="form-control" type="hidden" name="parent_id" id="parent_id" value="">
                        <input class="form-control" type="hidden" name="product_list[]" id="product_list" value="">
                    @endif

                    @if(!Route::is('admin.products.package-edit'))
                        @can('product_variant_access')
                            <div class="form-group">
                                <div class="d-flex align-items-center pt-3">
                                    <label>{{ trans('cruds.productVariant.title') }}</label>
                                    @can('product_variant_create')
                                        <a class="ms-auto btn btn-sm btn-success" href="{{ route('admin.product-variants.create', $product->id) }}">{{ trans('global.add') }} {{ trans('cruds.productVariant.title') }}</a>
                                    @endcan
                                </div>
                                <div class="pt-3">
                                    <table class=" table table-bordered table-striped table-hover">
                                        <th>{{ trans('cruds.productVariant.fields.variant_photo') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.sku') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.color') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.type') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.size') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.stock') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.sales_price') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.merchant_president_price') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.agent_director_price') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.agent_executive_price') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.vip_price') }}</th>
                                        <th>{{ trans('cruds.productVariant.fields.price_add_on') }}</th>
                                        <th>&nbsp;</th>
                                        @forelse($product->variant as $variant)
                                            <tr>
                                                <td>
                                                    @if($variant->photo)
                                                        <img src="{{ $variant->photo->getUrl('preview') }}" style="width: 50px; height: auto;">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $variant->sku }}
                                                </td>
                                                <td>
                                                    {{ $variant->color->name }}
                                                </td>
                                                <td>
                                                    {{ $variant->type }}
                                                </td>
                                                <td>
                                                    {{ $variant->size->name }}
                                                </td>
                                                <td>
                                                    {{ number_format(getProductVariantStock($variant->id)) }}
                                                </td>
                                                <td>
                                                    {{ number_format($variant->sales_price) }}
                                                </td>
                                                <td>
                                                    {{ number_format($variant->merchant_president_price) }}
                                                </td>
                                                <td>
                                                    {{ number_format($variant->agent_director_price) }}
                                                </td>
                                                <td>
                                                    {{ number_format($variant->agent_executive_price) }}
                                                </td>
                                                <td>
                                                    {{ number_format($variant->vip_redeem_pv) }}
                                                </td>
                                                <td>
                                                    {{ number_format($variant->price_add_on) }}
                                                </td>
                                                <td>
                                                    @can('product_variant_edit')
                                                        <form action="{{route('admin.product-variants.status-change')}}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="id" value="{{ $variant->id }}" >
                                                            <input type="hidden" name="status" value="{{ $variant->status ?? '2' }}">&nbsp;
                                                        </form>
                                                        <form class="form-status-change" action="{{route('admin.product-variants.status-change')}}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="id" value="{{ $variant->id }}" >
                                                            <input type="hidden" name="status" value="{{ $variant->status ?? '2' }}">&nbsp;
                                                        </form>
                                                        @if($variant->status == 1)
                                                            <a onclick="$(this).siblings('.form-status-change').submit();" class="btn btn-sm btn-danger">{{ trans('global.deactivate') }}</a>
                                                        @else
                                                            <a onclick="$(this).siblings('.form-status-change').submit();" class="btn btn-sm btn-success">{{ trans('global.activate') }}</a>
                                                        @endif

                                                    @endcan
                                                    @can('product_variant_edit')
                                                        <a class="btn btn-sm btn-info" href="{{ route('admin.product-variants.edit', $variant->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        @endcan
                    @endif

                    <div class="form-group" hidden>
                        <label>{{ trans('cruds.product.fields.status') }}</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\Product::STATUS_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('status', $product->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('status'))
                            <div class="invalid-feedback">
                                {{ $errors->first('status') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.status_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="required" for="category_id">{{ trans('cruds.product.fields.category') }}</label>&nbsp;&nbsp;<small><a href="{{route('admin.product-categories.create')}}">{{ trans('global.create') }} {{ trans('cruds.product.fields.category') }}</a></small>
                        <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                            @foreach($categories as $id => $entry)
                                <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $product->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category'))
                            <div class="invalid-feedback">
                                {{ $errors->first('category') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="image_1">{{ trans('cruds.product.fields.image_1') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('image_1') ? 'is-invalid' : '' }}" id="image_1-dropzone">
                        </div>
                        @if($errors->has('image_1'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image_1') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.image_1_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="image_2">{{ trans('cruds.product.fields.image_2') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('image_2') ? 'is-invalid' : '' }}" id="image_2-dropzone">
                        </div>
                        @if($errors->has('image_2'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image_2') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.image_2_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="image_3">{{ trans('cruds.product.fields.image_3') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('image_3') ? 'is-invalid' : '' }}" id="image_3-dropzone">
                        </div>
                        @if($errors->has('image_3'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image_3') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.image_3_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="image_4">{{ trans('cruds.product.fields.image_4') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('image_4') ? 'is-invalid' : '' }}" id="image_4-dropzone">
                        </div>
                        @if($errors->has('image_4'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image_4') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.image_4_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="image_5">{{ trans('cruds.product.fields.image_5') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('image_5') ? 'is-invalid' : '' }}" id="image_5-dropzone">
                        </div>
                        @if($errors->has('image_5'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image_5') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.image_5_helper') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {

        var typeVal = $('#type').val();
        if (typeVal == 2) {
            $(".type_select").show();
            $(".type_select2").removeClass("d-none").addClass("d-block");
        } else {
            $(".type_select").hide();
            $(".type_select2").removeClass("d-block").addClass("d-none");
            $('#parent_id').val(null);
        }

        $("#type").change(function() {
            value = this.value;
            console.log(value);
            console.log($('#parent_id').val());
            if (value == 2) {
                $(".type_select").show();
                $(".type_select2").removeClass("d-none").addClass("d-block");
            } else {
                $("#type_select").trigger("change");
                $(".type_select").hide();
                $(".type_select2").removeClass("d-block").addClass("d-none");
                $('#product_variant_quantity').val(null);
                $('#product_variant_item_quantity').val(null);
                $('#parent_id').val(null);
                $('#product_list').val([]);
                $('#product_list').trigger('change');
            }
        });

  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.products.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $product->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.image1Dropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').find('input[name="image_1"]').remove()
      $('form').append('<input type="hidden" name="image_1" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image_1"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->image_1)
      var file = {!! json_encode($product->image_1) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image_1" value="' + file.file_name + '">')
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
    Dropzone.options.image2Dropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').find('input[name="image_2"]').remove()
      $('form').append('<input type="hidden" name="image_2" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image_2"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->image_2)
      var file = {!! json_encode($product->image_2) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image_2" value="' + file.file_name + '">')
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
    Dropzone.options.image3Dropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').find('input[name="image_3"]').remove()
      $('form').append('<input type="hidden" name="image_3" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image_3"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->image_3)
      var file = {!! json_encode($product->image_3) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image_3" value="' + file.file_name + '">')
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
    Dropzone.options.image4Dropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').find('input[name="image_4"]').remove()
      $('form').append('<input type="hidden" name="image_4" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image_4"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->image_4)
      var file = {!! json_encode($product->image_4) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image_4" value="' + file.file_name + '">')
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
    Dropzone.options.image5Dropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').find('input[name="image_5"]').remove()
      $('form').append('<input type="hidden" name="image_5" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image_5"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->image_5)
      var file = {!! json_encode($product->image_5) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image_5" value="' + file.file_name + '">')
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
        $( document ).ready(function() {

            $(".div-desc-en").css("display", "none");
            $(".hide-en-editor").css("display", "none");

            $(".div-desc-zh").css("display", "none");
            $(".hide-zh-editor").css("display", "none");
        });

        $('.hide-en-editor').click(function() {
            $(".div-desc-en").css("display", "none");
            $(".hide-en-editor").css("display", "none");
            $(".show-en-editor").css("display", "block");
            $("#desc_en_2").css("display", "block");
        });

        $('.show-en-editor').click(function() {
            $(".div-desc-en").css("display", "block");
            $(".show-en-editor").css("display", "none");
            $(".hide-en-editor").css("display", "block");
            $("#desc_en_2").css("display", "none");
        });

        $('.hide-zh-editor').click(function() {
            $(".div-desc-zh").css("display", "none");
            $(".hide-zh-editor").css("display", "none");
            $(".show-zh-editor").css("display", "block");
            $("#desc_zh_2").css("display", "block");
        });

        $('.show-zh-editor').click(function() {
            $(".div-desc-zh").css("display", "block");
            $(".show-zh-editor").css("display", "none");
            $(".hide-zh-editor").css("display", "block");
            $("#desc_zh_2").css("display", "none");
        });
    </script>
@endsection
