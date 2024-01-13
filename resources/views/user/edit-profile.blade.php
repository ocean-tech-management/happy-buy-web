@extends('landing.app')

@section('css')
    <style>
        .dropzone-disabled {
            pointer-events: none;
            cursor: default;
        }
        .dropzone-disabled .dz-preview .dz-remove {
            display: none;
        }
    </style>
@endsection

@section('content')
    @include('user.user-header')
    <div class="cover-background"
         style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">
        <section>
            <div class="container">
                <div class="row">
                    @component('user.components.left-aside-bar')
                    @endcomponent
                    <div
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom">
                        <form method="POST" action="{{ route('user.update-profile') }}" enctype="multipart/form-data" id="update-profile-form"
                              class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom"
                              style="visibility: visible; animation-name: fadeIn;">
                            @csrf
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-7">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.personal information') }}</span>
                                    </div>
                                    <div class="col-5 text-right">
                                        <button class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                style="padding: 3px 10px;min-width: 90px" type="submit">
                                            {{ __('user-portal.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg-white">

                            <div
                                class="col-12 padding-1-rem-top padding-40px-lr">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="margin-30px-bottom" style="display: grid">
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <label class="alt-font dark-gold text-medium">{{ __('user-portal.profile_image') }}</label>
                                                    <div class="needsclick dropzone {{ $errors->has('profile_photo') ? 'is-invalid' : '' }}" id="profile_photo-dropzone">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="margin-10px-bottom" style="display: grid">
                                            <label class="alt-font dark-gold text-medium">{{ __('user-portal.full_name') }}</label>
                                            <input class="small-input border-all border-radius-5px" type="text" name="name"
                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.full_name')]) }}" value="{{ Auth::user()->name }}"
                                                   disabled required>

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="margin-10px-bottom" style="display: grid">
                                            <label class="alt-font dark-gold text-medium">{{ __('user-portal.birthday') }}</label>
                                            <input class="small-input border-all border-radius-5px" type="date" name="birthday" value="{{ Auth::user()->date_of_birth }}" disabled
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="margin-10px-bottom" style="display: grid">
                                            <label class="alt-font dark-gold text-medium">{{ __('user-portal.gender') }}</label>
                                            <select name="gender" id="gender" class="small-input border-all border-radius-5px" disabled>
                                                <option>{{ __('user-portal.select_' , ['title'=> __('user-portal.gender')]) }}</option>
                                                <option value="0" {{ Auth::user()->gender == 0 ? "selected" : "" }}>{{ __('user-portal.male') }}</option>
                                                <option value="1" {{ Auth::user()->gender == 1 ? "selected" : "" }}>{{ __('user-portal.female') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="margin-10px-bottom" style="display: grid">
                                            <label class="alt-font dark-gold text-medium">{{ __('user-portal.phone') }}</label>
                                            <input class="small-input border-all border-radius-5px" type="text" name="phone" disabled
                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.phone')]) }}" value="{{ Auth::user()->phone }}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="margin-10px-bottom" style="display: grid">
                                            <label class="alt-font dark-gold text-medium">{{ __('user-portal.email') }}</label>
                                            <input class="small-input border-all border-radius-5px" type="email" name="email" disabled
                                                   placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.email')]) }}" value="{{ Auth::user()->email }}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                    </div>
                                    <div class="col-12">
                                        <div class="margin-10px-bottom" style="display: grid">
                                            <div class="row">
                                                <div class="col-8 col-md-6">
                                                    <label class="alt-font dark-gold text-medium">{{ __('user-portal.identity_card_passport') }}</label>

                                                    <div class="{{ (Auth::user()->account_verify == null)? '' : 'dropzone-disabled'}} needsclick dropzone {{ $errors->has('ic_photo') ? 'is-invalid' : '' }}" id="ic_photo-dropzone">
                                                    </div>
                                                </div>
                                                <div class="col-4 col-md-6 flex align-items-stretch">
                                                    <button disabled class="btn btn-success align-self-center alt-font text-extra-dark-gray shadow
                                                        {{ Auth::user()->account_verify == NULL ? 'btn-danger' : 'btn-success'}}">{{ Auth::user()->account_verify == NULL ? __('user-portal.not_verified') : __('user-portal.verified') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(Auth::user()->roles[0]->id != 8)
                                    <div class="col-12">
                                        <div class="margin-30px-bottom" style="display: grid">
                                            <div class="row">
                                                <div class="col-8 col-md-6">
                                                    <label class="alt-font dark-gold text-medium">{{ __('user-portal.ssm') }}</label>
                                                    <div class="{{ (Auth::user()->ssm_verify == null)? '' : 'dropzone-disabled'}} needsclick dropzone {{ $errors->has('ssm_photo') ? 'is-invalid' : '' }}" id="ssm_photo-dropzone">
                                                    </div>
                                                </div>
                                                <div class="col-4 col-md-6 flex align-items-stretch">
                                                    <button disabled class="btn btn-success align-self-center alt-font text-extra-dark-gray shadow
                                                        {{ Auth::user()->ssm_verify == NULL ? 'btn-danger' : 'btn-success'}}">{{ Auth::user()->ssm_verify == NULL ? __('user-portal.not_verified') : __('user-portal.verified') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="margin-30px-bottom" style="display: grid">
                                            <div class="row">
                                                <div class="col-8 col-md-6">
                                                    <label class="alt-font dark-gold text-medium">{{ __('user-portal.shop_photo') }}</label>
                                                    <div class="{{ (Auth::user()->shop_verify == null)? '' : 'dropzone-disabled'}} needsclick dropzone {{ $errors->has('shop_photo') ? 'is-invalid' : '' }}" id="shop_photo-dropzone">
                                                    </div>
                                                </div>
                                                <div class="col-4 col-md-6 flex align-items-stretch">
                                                    <button disabled class="btn btn-success align-self-center alt-font text-extra-dark-gray shadow
                                                        {{ Auth::user()->shop_verify == NULL ? 'btn-danger' : 'btn-success'}}">{{ Auth::user()->shop_verify == NULL ? __('user-portal.not_verified') : __('user-portal.verified') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        Dropzone.options.profilePhotoDropzone = {
            url: '{{ route('user.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 10096,
                height: 10096
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
                this.on("maxfilesexceeded", function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
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
            url: '{{ route('user.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 10096,
                height: 10096
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
                this.on("maxfilesexceeded", function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
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
        Dropzone.options.icPhotoDropzone = {
            url: '{{ route('user.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 10096,
                height: 10096
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
                this.on("maxfilesexceeded", function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
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
        Dropzone.options.shopPhotoDropzone = {
            url: '{{ route('user.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 10096,
                height: 10096
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
                this.on("maxfilesexceeded", function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
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
