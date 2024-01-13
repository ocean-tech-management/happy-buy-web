@extends('landing.app')


@section('content')

    <!-- start banner section -->
    <section class="d-flex flex-column justify-content-center cover-background"
             style="background-image: url('landing/images/space.png');height: 570px">
        <div class="container" style="max-width: 1400px ">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-xl-8 col-lg-7 col-sm-8 text-center">
                    <div>
                        <span
                            class="text-white text-extra-large alt-font line-height-20px z-index-9 position-relative d-inline-block letter-spacing-4px">{{ __('landing.get_in_touch') }}</span>
                    </div>
                    <span
                        class="text-white title-large alt-font font-weight-300 z-index-9 position-relative d-inline-block letter-spacing-4px">{{ __('landing.contact_us') }}</span>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner section -->
    <!-- start section -->
    <section class=" overlap-height wow animate__fadeIn">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-8 col-lg-7 col-sm-8 text-center ">
                    <span
                        class="text-large alt-font text-uppercase text-extra-medium-gray font-weight-300 d-block margin-15px-bottom letter-spacing-3px">{{ __('landing.fill_out_the_form_and_we_will_get_in_touch_soon!') }}</span>
                    <span
                        class="title-small alt-font dark-gold font-weight-300 d-block margin-50px-bottom letter-spacing-3px">{{ __('landing.how_can_we_help_you?') }}</span>
                </div>
                <div class="lg-padding-30px-lr md-padding-15px-lr sm-margin-40px-bottom ">
                    <form class="row padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-all justify-content-center">
{{--                          action="{{ route('landing.contactUs-action') }}" method="post">--}}
                        <div class="col-12 col-xl-6 col-lg-6 ">
                            <label class="text-extra-medium text-extra-dark-gray  alt-font  margin-15px-bottom">{{ __('landing.your_name') }}<span class="required-error text-radical-red">*</span></label>
                            <input class="small-input bg-white margin-30px-bottom required error" type="text" name="name" placeholder="{{ __('landing.enter_your_name') }}" >
                            <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom">{{ __('landing.email_address') }}<span class="required-error text-radical-red">*</span></label>
                            <input class="small-input bg-white margin-50px-bottom required" type="email" name="email" placeholder="{{ __('landing.enter_your_email_address') }}">
                        </div>
                        <div class="col-12 col-xl-6 col-lg-6  ">
                            <label class="text-extra-medium text-extra-dark-gray  alt-font  margin-15px-bottom">{{ __('landing.your_message') }}</label>
                            <textarea class="small-input bg-white margin-50px-bottom required" rows="8" name="password" placeholder="{{ __('landing.type_in_your_message') }}"></textarea>
                        </div>
                        <button type="submit" class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-1-half-rem-lr">
                        {{ __('landing.submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- start map section -->
    <section class="no-padding-tb wow animate__fadeIn" style="visibility: visible; animation-name: fadeIn;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-0">
                    <div class="map-style-3 h-500px xs-h-300px">
                        <iframe class="w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.749589750438!2d101.72092417537621!3d3.160567453081512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc37a11e1cdecf%3A0x8f5a81cdf3e9a2d7!2sG-Vestor%20Tower!5e0!3m2!1sen!2smy!4v1703069879964!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        {{-- <iframe class="w-100 h-100 " src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15949.074419833723!2d102.57813!3d2.0484721!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xffda4884727e5663!2sErya%20Phoenix%20Sdn%20Bhd!5e0!3m2!1sen!2smy!4v1631630232035!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> --}}
{{--                        <iframe class="w-100 h-100 filter-grayscale-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.843821917424!2d144.956054!3d-37.817127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1427947693651"></iframe>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end map section -->
@endsection
