@extends('layouts.auth')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">{{ trans('global.welcome_back') }}</h5>
                                <p> {{ trans('global.sign_in_to_continue') }}{{ trans('panel.site_title') }}.</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ asset('admin_assets/images/profile-img.png')}}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="auth-logo">
                        <a href="{{route('admin.home')}}" class="auth-logo-light">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{ asset('admin_assets/images/erya_logo.png')}}" alt="" class="rounded-circle" height="60">
                                </span>
                            </div>
                        </a>

                        <a href="{{route('admin.home')}}" class="auth-logo-dark">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{ asset('admin_assets/images/erya_logo.png')}}" alt="" class="rounded-circle" height="60">
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="p-2">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">{{ trans('global.login_username') }}</label>
                                <input id="name" name="name" type="text"  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus value="{{ old('name', null) }}">

                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ trans('global.login_password') }}</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required aria-label="Password" aria-describedby="password-addon">
                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                </div>
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember-check">
                                    {{ trans('global.remember_me') }}
                                </label>
                            </div>

                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">{{ trans('global.login') }}</button>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">

                <div>

                    <p>© <script>document.write(new Date().getFullYear())</script> {{ trans('panel.site_title') }}
                </div>
            </div>

        </div>
    </div>

{{--<div class="row justify-content-center">--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="card mx-4">--}}
{{--            <div class="card-body p-4">--}}
{{--                <h1>{{ trans('panel.site_title') }}</h1>--}}

{{--                <p class="text-muted">{{ trans('global.login') }}</p>--}}

{{--                @if(session('message'))--}}
{{--                    <div class="alert alert-info" role="alert">--}}
{{--                        {{ session('message') }}--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <form method="POST" action="{{ route('login') }}">--}}
{{--                    @csrf--}}

{{--                    <div class="input-group mb-3">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text">--}}
{{--                                <i class="fa fa-user"></i>--}}
{{--                            </span>--}}
{{--                        </div>--}}

{{--                        <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">--}}

{{--                        @if($errors->has('email'))--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                {{ $errors->first('email') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    <div class="input-group mb-3">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text"><i class="fa fa-lock"></i></span>--}}
{{--                        </div>--}}

{{--                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">--}}

{{--                        @if($errors->has('password'))--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                {{ $errors->first('password') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    <div class="input-group mb-4">--}}
{{--                        <div class="form-check checkbox">--}}
{{--                            <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />--}}
{{--                            <label class="form-check-label" for="remember" style="vertical-align: middle;">--}}
{{--                                {{ trans('global.remember_me') }}--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <button type="submit" class="btn btn-primary px-4">--}}
{{--                                {{ trans('global.login') }}--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 text-right">--}}
{{--                            @if(Route::has('password.request'))--}}
{{--                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">--}}
{{--                                    {{ trans('global.forgot_password') }}--}}
{{--                                </a><br>--}}
{{--                            @endif--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
