@extends('landing.app')

@section('content')
    <section class="wow animate__fadeIn cover-background"
             style="background-image: url('{{asset('landing/images/product-details_banner.png')}}');visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row lg-padding-30px-lr md-padding-15px-lr sm-margin-40px-bottom justify-content-center " style="max-width: 475px;">
                    <h6 class="title-small alt-font font-weight-300 dark-gold">{{ __('landing.login') }}</h6>
                    <form method="POST" action="{{ route('login') }}" class=" bg-white padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-alls shadow">
                        @csrf
                        @if ($errors->any())
                            <div class=" margin-5px-bottom">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->getMessages() as $key => $error)
                                            <li>{{ $error[0] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if(session('message'))
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                                </div>
                            </div>
                        @endif
                        <label class="text-extra-medium text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.email') }}</label>
                        <input class="small-input bg-white margin-20px-bottom required" type="text" name="email" placeholder="{{ __('user-portal.enter_your' , ['title' => __('user-portal.email')]) }}"
                               autofocus value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom">{{ __('user-portal.password') }} <span class="required-error text-radical-red">*</span></label>
                        <input class="small-input bg-white margin-5px-bottom required" type="password" name="password" placeholder="{{ __('user-portal.enter_your' , ['title' => __('user-portal.password')]) }}" >
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <div class="margin-50px-bottom">
                            <a class="dark-gold text-decoration-underline text-extra-medium alt-font"
                            href="{{ route('password.request') }}"
                            > {{ __('user-portal.forgot_password') }} </a>
                        </div>
                        <button class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-white padding-1-half-rem-lr padding-1-rem-tb w-100" style="text-transform: none">
                            {{ __('landing.login') }}
                        </button>
                        <hr>
                        <div class="margin-5px-bottom row justify-content-center">
                            <span class="text-medium-gray text-small alt-font"> {{ __('user-portal.register_message_1') }} </span>
                        </div>
                        <a class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gray text-white padding-1-half-rem-lr padding-1-rem-tb w-100" style="text-transform: none"
                            href="{{ route('register') }}">
                            {{ __('user-portal.register_an_account') }}
                        </a>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
