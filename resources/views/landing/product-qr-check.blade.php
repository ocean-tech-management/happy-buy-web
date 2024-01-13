@extends('landing.app')

@section('content')
    <section class="wow animate__fadeIn" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row lg-padding-30px-lr md-padding-15px-lr sm-margin-40px-bottom justify-content-center " style="max-width: 600px;">
                    <h6 class="title-small alt-font font-weight-300 dark-gold">{{ __('landing.product_qr_check') }}</h6>
                    <form class="row  padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-all justify-content-center"
                    method="post" action="{{ route('landing.productQRCheckAction') }}">
                        @csrf
{{--                         <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.country.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $country->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.name_helper') }}</span>
            </div>--}}
                        <label class="text-extra-medium text-extra-dark-gray  alt-font  margin-15px-bottom">{{ __('landing.product_code') }}</label>
                        <input class="small-input bg-white required {{ $errors->has('product_code') ? 'is-invalid' : '' }}" type="text" name="product_code"
                               placeholder="{{ __('landing.enter') }} {{ __('landing.product_code') }}" style="text-align:center"
                               value="{{ old('product_code') }}" >
                        @if($errors->has('product_code'))
                            <div class="invalid-feedback">
                                {{ __('landing.invalid_product_code') }}
                            </div>
                        @endif
                        <button class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px margin-50px-top padding-1-half-rem-lr">
                            {{ __('global.submit') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection
