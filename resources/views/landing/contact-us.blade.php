@extends('landing.app')

@section('content')
    <section class="overlap-height wow animate__fadeIn"
        style="background: linear-gradient(0deg, rgba(242,103,17,1) 28%, rgba(254,153,0,1) 81%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-8 col-lg-7 col-sm-8 text-center">
                    <span class="title-small alt-font dark-gold font-weight-300 d-block letter-spacing-3px"
                        style="color: white">{{ __('landing.contact_us') }}</span>
                </div>
                <div class="col-12 md-padding-15px-lr sm-margin-40px-bottom">
                    <form class="row padding-4-rem-all lg-margin-30px-top md-padding-2-half-rem-all justify-content-center">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="contact-us-section p-3">
                                <input class="small-input bg-white margin-30px-bottom required error rounded-input"
                                    type="text" name="name" placeholder="{{ __('landing.enter_your_name') }}">
                                <input class="small-input bg-white margin-30px-bottom required error rounded-input"
                                    type="text" name="contact" placeholder="{{ __('landing.enter_your_contact') }}">
                                <input class="small-input bg-white margin-30px-bottom required rounded-input" type="email"
                                    name="email" placeholder="{{ __('landing.enter_your_email_address') }}">
                                <textarea class="small-input bg-white margin-30px-bottom required rounded-input" rows="8" name="message"
                                    placeholder="{{ __('landing.type_in_your_message') }}"></textarea>
                                <button type="submit"
                                    class="text-medium alt-font font-weight-300 btn bg-white text-uppercase text-orange letter-spacing-2px padding-1-half-rem-lr rounded-pill">
                                    {{ __('landing.submit') }}
                                </button>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="p-3">
                                <div class="map-style-3 h-200px xs-h-200px">
                                    <iframe class="w-100 h-100"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.9764376445205!2d101.6738661755631!3d3.1009194968746803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4be981858437%3A0xe475e417fa8ef249!2sMXB%20TOWER-MXB%20International!5e0!3m2!1sen!2smy!4v1733990787914!5m2!1sen!2smy"
                                        width="500" height="350" style="border:0; border-radius: 20px"
                                        allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                <div class="py-3">
                                    <div class="d-flex align-items-start" style="color: white">
                                        <div class="me-3 px-2">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="px-3">
                                            <ul class="list-unstyled mb-0">
                                                <li>HappyBuy</li>
                                                <li>
                                                    <a href="{{ route('landing.contactUs') }}" style="color: white">
                                                        MXB TOWER
                                                        SOUTHBANK COMMERCIAL
                                                        UNIT SB/BO-02,BLOCK 2,
                                                        PUSAT KOMERSIAL TEBING SELATAN,
                                                        NO.179,JALAN KLANG LAMA,
                                                        58000 KUALA LUMPUR.
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <div class="d-flex align-items-start" style="color: white">
                                        <div class="me-3 px-2">
                                            <i class="fa fa-link"></i>
                                        </div>
                                        <div class="px-3">
                                            <span><a href="http://happybuy.asia" target="_blank"
                                                    style="color: white">http://happybuy.asia</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        @media (max-width: 767px) {
            .padding-4-rem-all {
                padding: 1.5rem !important;
            }

            .lg-margin-35px-top {
                margin-top: 1.5rem !important;
            }

            .md-padding-2-half-rem-all {
                padding: 1rem !important;
            }

            .small-input {
                width: 100% !important;
                margin-bottom: 1rem !important;
            }

            .btn {
                padding: 1rem 2rem !important;
            }

            .h-200px {
                height: 200px !important;
            }

            .w-100 {
                width: 100% !important;
            }

            .contact-us-section {
                text-align: center
            }
        }
    </style>
@endsection
