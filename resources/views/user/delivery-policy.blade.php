@extends('landing.app')


@section('content')
    <!-- start section -->
    <section class=" wow animate__fadeIn cover-background"
             style="background-image: url('{{asset('landing/images/product-details_banner.png')}}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row col-12  justify-content-center" style="max-width: 935px;">
                    <h6 class="title-small alt-font font-weight-300 dark-gold">{{ __('landing.delivery_policy') }}</h6>
                    <form class="bg-white padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-alls shadow">
                        <div class="row">

                            <div class="text-extra-medium">
                                {!!
                                "

 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam congue metus accumsan feugiat porttitor. Vivamus condimentum condimentum mi, nec sodales ex egestas ut. Maecenas ante orci, ultrices a gravida nec, pharetra eget lectus. Quisque laoreet leo vitae elementum commodo. Etiam pulvinar at tellus at imperdiet. Donec vitae metus nec eros rhoncus bibendum. Praesent imperdiet ipsum libero, sed blandit arcu posuere venenatis.

 Vivamus sit amet magna in nulla tristique dictum at non neque. Maecenas ut pretium quam. Nullam rhoncus purus enim, nec pharetra elit facilisis at. Proin turpis tellus, sagittis id mattis non, pulvinar et nisl. Nam sed quam massa. Maecenas aliquet tempor turpis ut luctus. Nullam sed dolor eu turpis pretium hendrerit vitae at lectus. Cras convallis dignissim lacus vitae tristique.

 Nunc iaculis dui vitae tristique sollicitudin. Nullam id consequat nulla. Suspendisse porttitor luctus diam vel volutpat. Donec blandit, felis ut consectetur bibendum, quam sapien eleifend elit, eu lobortis dolor augue sit amet lacus. Praesent vitae dapibus sem. Proin in dui ut ex tempor fermentum. In laoreet hendrerit magna viverra consequat.

 Phasellus lobortis tortor vulputate, bibendum purus quis, imperdiet odio. Aliquam arcu tellus, sagittis eu tempor vel, mollis in ipsum. Suspendisse eget bibendum neque, a vestibulum ipsum. In mattis sollicitudin massa. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec commodo urna eros, non vulputate risus pulvinar et. Pellentesque ut hendrerit velit. Maecenas dictum eget risus feugiat molestie. Donec ornare ante nisl, eu feugiat urna aliquam quis. Pellentesque elementum porta magna, vel cursus elit lobortis lacinia.

 Vivamus vel maximus sapien, ac auctor turpis. Maecenas imperdiet consequat nibh, eu condimentum ex iaculis ut. Nam venenatis justo vel ipsum bibendum pretium. Ut finibus, lacus eu sagittis iaculis, neque nulla lobortis nulla, in hendrerit ligula erat in purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec scelerisque gravida diam, vel pulvinar justo efficitur vel. Integer vitae vestibulum tellus, ac iaculis nisl. "
                            !!}
                            </div>
                            {{--                           <div class="col-12 margin-10px-bottom row justify-content-center">--}}
                            {{--                               <a href="#signing-form"--}}
                            {{--                                  class=" popup-with-form text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-2-half-rem-lr margin-2-half-rem-top ml-5">--}}
                            {{--                                   {{__('global.submit')}}--}}
                            {{--                               </a>--}}
                            {{--                           </div>--}}
                        </div>
                    </form>
                </div>

                {{--               <!-- start contact form -->--}}
                {{--               <form id="signing-form" action="{{ route('user.register-agreement-action') }}" method="post" class="white-popup-block col-xl-3 col-lg-7 col-sm-9  p-0 mx-auto mfp-hide">--}}
                {{--                   @csrf--}}
                {{--                   <input type="hidden" value="{{ $user_agreement->id }}" name="user_agreement_id" />--}}
                {{--                   <div class="padding-ten-all bg-white border-radius-6px xs-padding-six-all">--}}
                {{--                       <h6 class="text-extra-dark-gray alt-font font-weight-500 margin-35px-bottom xs-margin-15px-bottom">--}}
                {{--                           {{ __('user-portal.confirmation') }}--}}
                {{--                           <p  class="text-text-dark-gray alt-font text-extra-medium margin-35px-bottom xs-margin-15px-bottom line-height-18px"> {{ __('user-portal.confirmation_msg') }}</p>--}}
                {{--                       </h6>--}}
                {{--                       <div>--}}
                {{--                           <label class="text-extra-dark-gray alt-font margin-15px-bottom" for="birthday">{{ __('user-portal.full_name') }} <span--}}
                {{--                                   class="text-radical-red">*</span></label>--}}
                {{--                           <input class="medium-input margin-25px-bottom xs-margin-10px-bottom required" type="text" name="fullname" placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.full_name')]) }}" required>--}}
                {{--                           <label class="text-extra-dark-gray alt-font margin-15px-bottom" for="birthday">{{ __('user-portal.identity_card_passport_number') }} <span--}}
                {{--                                   class="text-radical-red">*</span></label>--}}
                {{--                           <input class="medium-input margin-25px-bottom xs-margin-10px-bottom required" type="text" name="identity_id" placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.identity_card_passport_number')]) }}" required>--}}

                {{--                           <button class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px margin-1-half-rem-top w-100" type="submit">--}}
                {{--                               {{__('global.submit')}}</button>--}}
                {{--                           <div class="form-results d-none"></div>--}}
                {{--                       </div>--}}
                {{--                   </div>--}}
                {{--               </form>--}}
                {{--               <!-- end contact form -->--}}

            </div>
        </div>
    </section>
    <!-- end section -->
@endsection
