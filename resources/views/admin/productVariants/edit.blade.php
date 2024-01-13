@extends('layouts.admin')
@section('content')

    <form method="POST" action="{{ route("admin.product-variants.update", [$productVariant->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') ?? '-' }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-1"></div>
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                            <h4 class="card-title mb-3">{{ trans('cruds.productVariant.fields.variant_details') }}</h4>
                            <div class="row">
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="color_id">{{ trans('cruds.productVariant.fields.color') }}</label>&nbsp;<small><a href="{{route('admin.product-colors.create')}}">{{ trans('global.create') }} {{ trans('cruds.productVariant.fields.color') }}</a></small>
                                    <select class="form-control select2 {{ $errors->has('color') ? 'is-invalid' : '' }}" name="color_id" id="color_id" required>
                                        @foreach($colors as $id => $entry)
                                            <option value="{{ $id }}" {{ (old('color_id') ? old('color_id') : $productVariant->color->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('color'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('color') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.color_helper') }}</span>
                                </div>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="type">{{ trans('cruds.productVariant.fields.type') }}</label>
                                    <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                                        @foreach($types as $id => $entry)
                                            <option value="{{ $id }}" {{ (old('type') ? old('type') : $productVariant->type ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('type') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.color_helper') }}</span>
                                </div>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="size_id">{{ trans('cruds.productVariant.fields.size') }}</label>&nbsp;<small><a href="{{route('admin.product-sizes.create')}}">{{ trans('global.create') }} {{ trans('cruds.productVariant.fields.size') }}</a></small>
                                    <select class="form-control select2 {{ $errors->has('size') ? 'is-invalid' : '' }}" name="size_id" id="size_id" required>
                                        @foreach($sizes as $id => $entry)
                                            <option value="{{ $id }}" {{ (old('size_id') ? old('size_id') : $productVariant->size->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('size'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('size') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.size_helper') }}</span>
                                </div>
        {{--                            <div class="form-group col-xl-3 col-sm-4">--}}
        {{--                                <label class="required" for="quantity">{{ trans('cruds.productVariant.fields.stock') }}</label>--}}
        {{--                                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" type="number" name="stock" id="stock" value="{{ old('stock', $productVariant->stock) }}" step="1" required>--}}
        {{--                                @if($errors->has('stock'))--}}
        {{--                                    <div class="invalid-feedback">--}}
        {{--                                        {{ $errors->first('stock') }}--}}
        {{--                                    </div>--}}
        {{--                                @endif--}}
        {{--                                <span class="help-block">{{ trans('cruds.productVariant.fields.stock_helper') }}</span>--}}
        {{--                            </div>--}}
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="sku">{{ trans('cruds.productVariant.fields.sku') }}</label>
                                    <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', $productVariant->sku) }}" required>
                                    @if($errors->has('sku'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('sku') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.sku_helper') }}</span>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title mb-3">{{ trans('cruds.productVariant.fields.variant_prices') }}</h4>
                            <div class="row">
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="sales_price">{{ trans('cruds.productVariant.fields.sales_price') }}</label>
                                    <input class="form-control {{ $errors->has('sales_price') ? 'is-invalid' : '' }}" type="text" name="sales_price" id="sales_price" value="{{ old('sales_price', $productVariant->sales_price) }}" required>
                                    @if($errors->has('sales_price'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('sales_price') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.sales_price_helper') }}</span>
                                </div>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="merchant_president_price">{{ trans('cruds.productVariant.fields.merchant_president_price') }}</label>
                                    <input class="form-control {{ $errors->has('merchant_president_price') ? 'is-invalid' : '' }}" type="text" name="merchant_president_price" id="merchant_president_price" value="{{ old('merchant_president_price', $productVariant->merchant_president_price) }}" required>
                                    @if($errors->has('merchant_president_price'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('merchant_president_price') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.merchant_president_price_helper') }}</span>
                                </div>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="agent_director_price">{{ trans('cruds.productVariant.fields.agent_director_price') }}</label>
                                    <input class="form-control {{ $errors->has('agent_director_price') ? 'is-invalid' : '' }}" type="text" name="agent_director_price" id="agent_director_price" value="{{ old('agent_director_price', $productVariant->agent_director_price) }}" required>
                                    @if($errors->has('agent_director_price'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('agent_director_price') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.agent_director_price_helper') }}</span>
                                </div>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="agent_executive_price">{{ trans('cruds.productVariant.fields.agent_executive_price') }}</label>
                                    <input class="form-control {{ $errors->has('agent_executive_price') ? 'is-invalid' : '' }}" type="text" name="agent_executive_price" id="agent_executive_price" value="{{ old('agent_executive_price', $productVariant->agent_executive_price) }}" required>
                                    @if($errors->has('agent_executive_price'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('agent_executive_price') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.agent_executive_price_helper') }}</span>
                                </div>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="vip_redeem_pv">{{ trans('cruds.productVariant.fields.vip_price') }}</label>
                                    <input class="form-control {{ $errors->has('vip_redeem_pv') ? 'is-invalid' : '' }}" type="text" name="vip_redeem_pv" id="vip_redeem_pv" value="{{ old('vip_redeem_pv', $productVariant->vip_redeem_pv) }}" required>
                                    @if($errors->has('vip_redeem_pv'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('vip_redeem_pv') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.vip_price_helper') }}</span>
                                </div>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="required" for="price_add_on">{{ trans('cruds.productVariant.fields.price_add_on') }}</label>
                                    <input class="form-control {{ $errors->has('price_add_on') ? 'is-invalid' : '' }}" type="text" name="price_add_on" id="price_add_on" value="{{ old('price_add_on', $productVariant->price_add_on) }}" required>
                                    @if($errors->has('price_add_on'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('price_add_on') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.price_add_on_helper') }}</span>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title mb-3">{{ trans('cruds.productVariant.fields.variant_qr') }}</h4>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="required" for="qr_quantity">{{ trans('cruds.productVariant.fields.qr_quantity') }}</label>
                                    <input class="form-control {{ $errors->has('qr_quantity') ? 'is-invalid' : '' }}" type="number" name="qr_quantity" id="qr_quantity" value="{{ old('qr_quantity', $productVariant->qr_quantity) }}" step="1" required>
                                    @if($errors->has('qr_quantity'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('qr_quantity') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.productVariant.fields.qr_quantity_helper') }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">{{ trans('cruds.productVariant.fields.product_details') }}</h4>
                        <h6 class="mb-1"><a href="{{ route('admin.products.edit', $product->id) }}">{{ $product->name_en ?? ''}}</a></h6>
                        <h6 class="mb-1"><a href="{{ route('admin.products.edit', $product->id) }}">{{ $product->name_zh ?? ''}}</a></h6>
                        <h6 class="mb-1">{{ $product->category->name_en }} ({{ $product->category->name_zh }})</h6>
                        <hr>
                        <h4 class="card-title mb-3">{{ trans('cruds.productVariant.fields.variant_photo') }}</h4>
                        <div class="form-group">
                            <label class="required" for="photo">{{ trans('cruds.productVariant.fields.photo') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                            </div>
                            @if($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productVariant.fields.photo_helper') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.product-variants.storeMedia') }}',
            maxFilesize: 5, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5,
                width: 10000,
                height: 10000
            },
            success: function (file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($productVariant) && $productVariant->photo)
                var file = {!! json_encode($productVariant->photo) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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
