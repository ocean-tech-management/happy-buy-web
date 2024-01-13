@extends('layouts.admin')
@section('content')

    @if(Route::is('admin.users.merchants.create'))
    <form method="POST" action="{{ route("admin.users.merchants.store") }}" enctype="multipart/form-data">
    @elseif(Route::is('admin.users.agents.create'))
    <form method="POST" action="{{ route("admin.users.agents.store") }}" enctype="multipart/form-data">
    @elseif(Route::is('admin.users.vips.create'))
    <form method="POST" action="{{ route("admin.users.vips.store") }}" enctype="multipart/form-data">
    @else
    <form method="POST" action="{{ route("admin.users.merchants.store") }}" enctype="multipart/form-data">
    @endif
        @csrf
        <div class="row">
            <div class="col-1"></div>
            <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                            @if(Route::is('admin.users.merchants.create'))
                                <h4 class="card-title mb-3">{{ trans('global.create') }} {{ trans('cruds.user.fields.merchant') }}</h4>
                            @elseif(Route::is('admin.users.agents.create'))
                                <h4 class="card-title mb-3">{{ trans('global.create') }} {{ trans('cruds.user.fields.agent') }}</h4>
                            @elseif(Route::is('admin.users.vips.create'))
                                <h4 class="card-title mb-3">{{ trans('global.create') }} {{ trans('cruds.user.fields.vip') }}</h4>
                            @else
                                <h4 class="card-title mb-3">{{ trans('global.create') }} {{ trans('cruds.user.fields.merchant') }}</h4>
                            @endif
                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label>{{ trans('cruds.user.fields.identity_type') }}</label>
                                    <select class="form-control {{ $errors->has('identity_type') ? 'is-invalid' : '' }}" name="identity_type" id="identity_type">
                                        <option value disabled {{ old('identity_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\User::IDENTITY_TYPE_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('identity_type', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('identity_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('identity_type') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.identity_type_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label for="identity_no">{{ trans('cruds.user.fields.identity_no') }}</label>
                                    <input class="form-control {{ $errors->has('identity_no') ? 'is-invalid' : '' }}" type="text" name="identity_no" id="identity_no" value="{{ old('identity_no', '') }}">
                                    @if($errors->has('identity_no'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('identity_no') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.identity_no_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label for="date_of_birth">{{ trans('cruds.user.fields.date_of_birth') }}</label>
                                    <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                                    @if($errors->has('date_of_birth'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('date_of_birth') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.date_of_birth_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label>{{ trans('cruds.user.fields.gender') }}</label>
                                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\User::GENDER_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('gender', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('gender'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('gender') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
                                </div>
                            </div>
                            <hr>

                            @if(Route::is('admin.users.vips.create'))
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="required" for="address_1">{{ trans('cruds.user.fields.address_1') }}</label>
                                    <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', '') }}" required>
                                    @if($errors->has('address_1'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address_1') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.address_1_helper') }}</span>
                                </div>
                                <div class="form-group col-12">
                                    <label class="required" for="address_2">{{ trans('cruds.user.fields.address_2') }}</label>
                                    <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}" required>
                                    @if($errors->has('address_2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address_2') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.address_2_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label class="required" for="country">{{ trans('cruds.user.fields.country') }}</label>
                                    <select class="form-control select2 {{ $errors->has('bank_list') ? 'is-invalid' : '' }}" name="country" id="country"  required>
                                        @foreach($countries as $id => $country)
                                            <option value="{{ $id }}" {{ old('country') == $id ? 'selected' : '' }}>{{ $country }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('country'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('country') }}
                                    </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label class="required" for="state">{{ trans('cruds.user.fields.state') }}</label>
                                    <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state" id="state"  required>
                                        <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>
                                    </select>                                    
                                    @if($errors->has('state'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('state') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.state_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label class="required" for="postcode">{{ trans('cruds.user.fields.postcode') }}</label>
                                    <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="text" name="postcode" id="postcode" value="{{ old('postcode', '') }}" required>
                                    @if($errors->has('postcode'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('postcode') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.state_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label class="required" for="city">{{ trans('cruds.user.fields.city') }}</label>
                                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                                    @if($errors->has('city'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('city') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                                </div>
                            </div>
                            <hr>
                            @endif

                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="required" for="bank_list_id">{{ trans('cruds.user.fields.bank_list') }}</label>
                                    <select class="form-control select2 {{ $errors->has('bank_list') ? 'is-invalid' : '' }}" name="bank_list_id" id="bank_list_id" required>
                                        @foreach($bank_lists as $id => $entry)
                                            <option value="{{ $id }}" {{ old('bank_list_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('bank_list'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bank_list') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.bank_list_helper') }}</span>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="bank_name">{{ trans('cruds.user.fields.bank_name') }}</label>
                                    <input class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', '') }}">
                                    @if($errors->has('bank_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bank_name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.bank_name_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label class="required" for="bank_account_name">{{ trans('cruds.user.fields.bank_account_name') }}</label>
                                    <input class="form-control {{ $errors->has('bank_account_name') ? 'is-invalid' : '' }}" type="text" name="bank_account_name" id="bank_account_name" value="{{ old('bank_account_name', '') }}" required>
                                    @if($errors->has('bank_account_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bank_account_name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.bank_account_name_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label class="required" for="bank_account_number">{{ trans('cruds.user.fields.bank_account_number') }}</label>
                                    <input class="form-control {{ $errors->has('bank_account_number') ? 'is-invalid' : '' }}" type="text" name="bank_account_number" id="bank_account_number" value="{{ old('bank_account_number', '') }}" required>
                                    @if($errors->has('bank_account_number'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bank_account_number') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.bank_account_number_helper') }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="required">{{ trans('cruds.user.fields.user_type') }}</label>
                                    <select class="form-control {{ $errors->has('user_type') ? 'is-invalid' : '' }}" name="user_type" id="user_type" required>
                                        <option value disabled {{ old('user_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\User::USER_TYPE_SELECT as $key => $label)
                                            @if(Route::is('admin.users.merchants.create'))
                                                @if($key == 3)
                                                    <option value="{{ $key }}" {{ old('user_type', '3') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endif
                                            @elseif(Route::is('admin.users.agents.create'))
                                                @if($key == 1 || $key == 2)
                                                    <option value="{{ $key }}" {{ old('user_type', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endif
                                            @elseif(Route::is('admin.users.vips.create'))
                                                @if($key == 4)
                                                    <option value="{{ $key }}" {{ old('user_type', '4') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endif
                                            @else
                                                @if($key == 3)
                                                    <option value="{{ $key }}" {{ old('user_type', '3') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                    @if($errors->has('user_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('user_type') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.user_type_helper') }}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label for="upline_user_id">{{ trans('cruds.user.fields.upline_user') }}</label>
                                    <select class="form-control select2 {{ $errors->has('direct_upline_id') ? 'is-invalid' : '' }}" name="direct_upline_id" id="direct_upline_id">
                                        @foreach($upline_users as $id => $entry)
                                            <option value="{{ $id }}" {{ old('upline_user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('direct_upline_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('direct_upline_id') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.upline_user_helper') }}</span>
                                </div>
                                <div class="form-group" hidden>
                                    <label>{{ trans('cruds.user.fields.status') }}</label>
                                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\User::STATUS_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('status', '2') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('status'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.status_helper') }}</span>
                                </div>
                                <div class="form-group" hidden>
                                    <label>{{ trans('cruds.user.fields.account_verify') }}</label>
                                    <select class="form-control {{ $errors->has('account_verify') ? 'is-invalid' : '' }}" name="account_verify" id="account_verify">
                                        <option value disabled {{ old('account_verify', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\User::ACCOUNT_VERIFY_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('account_verify', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('account_verify'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('account_verify') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.account_verify_helper') }}</span>
                                </div>
                                <div class="form-group" hidden>
                                    <label>{{ trans('cruds.user.fields.ssm_verify') }}</label>
                                    <select class="form-control {{ $errors->has('ssm_verify') ? 'is-invalid' : '' }}" name="ssm_verify" id="ssm_verify">
                                        <option value disabled {{ old('ssm_verify', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\User::SSM_VERIFY_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('ssm_verify', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('ssm_verify'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('ssm_verify') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.ssm_verify_helper') }}</span>
                                </div>
                                <div class="form-group" hidden>
                                    <label>{{ trans('cruds.user.fields.first_payment') }}</label>
                                    <select class="form-control {{ $errors->has('first_payment') ? 'is-invalid' : '' }}" name="first_payment" id="first_payment">
                                        <option value disabled {{ old('first_payment', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\User::FIRST_PAYMENT_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('first_payment', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('first_payment'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('first_payment') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.first_payment_helper') }}</span>
                                </div>
                            </div>
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
                            <div class="form-group">
                                <label for="profile_photo">{{ trans('cruds.user.fields.profile_photo') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('profile_photo') ? 'is-invalid' : '' }}" id="profile_photo-dropzone">
                                </div>
                                @if($errors->has('profile_photo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('profile_photo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.profile_photo_helper') }}</span>
                            </div>
                            @if(Route::is('admin.users.merchants.create') || Route::is('admin.users.agents.create'))
                            <div class="form-group">
                                <label for="ssm_photo">{{ trans('cruds.user.fields.ssm_photo') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('ssm_photo') ? 'is-invalid' : '' }}" id="ssm_photo-dropzone">
                                </div>
                                @if($errors->has('ssm_photo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('ssm_photo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.ssm_photo_helper') }}</span>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="ic_photo">{{ trans('cruds.user.fields.ic_photo') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('ic_photo') ? 'is-invalid' : '' }}" id="ic_photo-dropzone">
                                </div>
                                @if($errors->has('ic_photo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('ic_photo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.ic_photo_helper') }}</span>
                            </div>
                            @if(Route::is('admin.users.merchants.create') || Route::is('admin.users.agents.create'))
                            <div class="form-group">
                                <label for="first_payment_receipt_photo">{{ trans('cruds.user.fields.first_payment_receipt_photo') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('first_payment_receipt_photo') ? 'is-invalid' : '' }}" id="first_payment_receipt_photo-dropzone">
                                </div>
                                @if($errors->has('first_payment_receipt_photo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('first_payment_receipt_photo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.first_payment_receipt_photo_helper') }}</span>
                            </div>
                            @endif

                            @if(Route::is('admin.users.merchants.create') || Route::is('admin.users.agents.create'))
                            <div class="form-group">
                                <label for="shop_photo">{{ trans('cruds.user.fields.shop_photo') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('shop_photo') ? 'is-invalid' : '' }}" id="shop_photo-dropzone">
                                </div>
                                @if($errors->has('shop_photo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('shop_photo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.shop_photo_helper') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            <div class="col-1"></div>
        </div>
    </form>

@endsection

@section('scripts')
<script>
    Dropzone.options.profilePhotoDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
@if(isset($user) && $user->profile_photo)
      var file = {!! json_encode($user->profile_photo) !!}
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
<script>
    Dropzone.options.ssmPhotoDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
      $('form').find('input[name="ssm_photo"]').remove()
      $('form').append('<input type="hidden" name="ssm_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="ssm_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->ssm_photo)
      var file = {!! json_encode($user->ssm_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="ssm_photo" value="' + file.file_name + '">')
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
    $('#country').change(function () {
        if ($(this).val() !== "") {
            var country_id = $(this).val()
            var formData = {
                "_token": "{{ csrf_token() }}",
                'country_id': country_id,
            };
            var type = "POST";
            $.ajax({
                type: type,
                url: "{{ route('admin.users.fetch.state')}}",
                data: formData,
                success: function (data) {
                    var decoded = JSON.parse(data);
                    if (decoded.success) {
                        var htmlcode = "";
                        htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>';
                        $.each(decoded.states, function (key, value) {
                            htmlcode = htmlcode + ' <option value=' + value.id + '>' + value.name + '</option>';
                        });
                        $('#state').html(htmlcode)
                    }
                },
                error: function (data) {
                    console.log("Error");
                }
            });
        }
    });

    Dropzone.options.icPhotoDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
      $('form').find('input[name="ic_photo"]').remove()
      $('form').append('<input type="hidden" name="ic_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="ic_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->ic_photo)
      var file = {!! json_encode($user->ic_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="ic_photo" value="' + file.file_name + '">')
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
    Dropzone.options.firstPaymentReceiptPhotoDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
      $('form').find('input[name="first_payment_receipt_photo"]').remove()
      $('form').append('<input type="hidden" name="first_payment_receipt_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="first_payment_receipt_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->first_payment_receipt_photo)
      var file = {!! json_encode($user->first_payment_receipt_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="first_payment_receipt_photo" value="' + file.file_name + '">')
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
                Dropzone.options.shopPhotoDropzone = {
                    url: '{{ route('admin.users.storeMedia') }}',
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
                        $('form').find('input[name="shop_photo"]').remove()
                        $('form').append('<input type="hidden" name="shop_photo" value="' + response.name + '">')
                    },
                    removedfile: function (file) {
                        file.previewElement.remove()
                        if (file.status !== 'error') {
                            $('form').find('input[name="shop_photo"]').remove()
                            this.options.maxFiles = this.options.maxFiles + 1
                        }
                    },
                    init: function () {
                        @if(isset($user) && $user->shop_photo)
                        var file = {!! json_encode($user->shop_photo) !!}
                            this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.preview)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="shop_photo" value="' + file.file_name + '">')
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
