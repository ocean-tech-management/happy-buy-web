@extends('landing.app')

@section('content')
    @include('user.user-header')
    <div class="cover-background"
         style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">
        <section>
            <div class="container">
                @if ($errors->has('upgrade-account'))
                    <div class="row mb-2">
                        <div class="col-md-12 margin-5px-bottom">
                            <div class="alert alert-danger">
                                @foreach ($errors->getMessages() as $key => $error)
                                    {{ $error[0] }}
                                @endforeach
                            </div>
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
                <div class="row">
                    @component('user.components.left-aside-bar')
                    @endcomponent

                    <div
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom">
                        {{--                        @if(session('message'))--}}
                        {{--                            <div class="row mb-2">--}}
                        {{--                                <div class="col-lg-12">--}}
                        {{--                                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">

                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-7">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.personal information') }}</span>
                                    </div>
                                    <div class="col-5 text-right">
                                        @if(Auth::user()->roles[0]->id != 8)
                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px"
                                               href="{{ route('user.view-agreement') }}">
                                                {{ __('user-portal.view_agreement') }}
                                            </a>
                                        @else
                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px"
                                               href="{{ route('user.upgrade-account-executive-form') }}">
                                                {{ __('user-portal.upgrade_account') }}
                                            </a>
                                        @endif
                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                           style="padding: 3px 10px;min-width: 90px"
                                           href="{{ route('user.edit-profile') }}">
                                            {{ __('user-portal.edit') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <hr class="bg-white">
                            @if(Auth::user()->status == 2)
                                <div class="col-lg-12 padding-40px-lr">
                                    <div class="alert alert-danger" role="alert">{{ __('user-portal.your_account_is_not_verify_yet') }}</div>
                                </div>
                            @endif
                            <div class="col-12 padding-1-rem-top padding-40px-lr">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="margin-30px-bottom" style="display: grid">
                                            <span class="alt-font dark-gold text-medium">{{ __('user-portal.full_name') }}</span>
                                            <span class="alt-font text-extra-dark-gray text-extra-medium">{{ Auth::user()->name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="margin-30px-bottom" style="display: grid">
                                            <span class="alt-font dark-gold text-medium">{{ __('user-portal.birthday') }}</span>
                                            <span class="alt-font text-extra-dark-gray text-extra-medium">{{ Auth::user()->date_of_birth }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="margin-30px-bottom" style="display: grid">
                                            <span class="alt-font dark-gold text-medium">{{ __('user-portal.gender') }}</span>
                                            <span
                                                class="alt-font text-extra-dark-gray text-extra-medium">{{ Auth::user()->gender == 0 ? __('user-portal.male') : __('user-portal.female')  }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="margin-30px-bottom" style="display: grid">
                                            <span class="alt-font dark-gold text-medium">{{ __('user-portal.phone') }}</span>
                                            <span class="alt-font text-extra-dark-gray text-extra-medium">{{ Auth::user()->phone }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="margin-30px-bottom" style="display: grid">
                                            <span class="alt-font dark-gold text-medium">{{ __('user-portal.email') }}</span>
                                            <span class="alt-font text-extra-dark-gray text-extra-medium">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class=" col-6 margin-30px-bottom" style="display: grid">
                                                <span class="alt-font dark-gold text-medium">{{ __('user-portal.identity_card_passport') }}</span>
                                                @if(Auth::user()->ic_photo == NULL)
                                                    <span
                                                        class="alt-font text-extra-dark-gray text-red">{{__('user-portal.please_upload_your_ic_photo')}}</span>

                                                @elseif(Auth::user()->ic_photo != NULL && Auth::user()->account_verify == NULL)
                                                    <span
                                                        class="alt-font text-extra-dark-gray text-red">{{ __('user-portal.uploaded_but_not_verified') }}</span>
                                                @else
                                                    <span
                                                        class="alt-font text-extra-dark-gray text-success">{{ __('user-portal.verified') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <a class="{{ (Auth::user()->ic_photo != NULL )? "disabled" : "" }} text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                   style="padding: 3px 10px;min-width: 90px"
                                                   href="{{ route('user.edit-profile') }}">
                                                    {{ __('user-portal.upload') }}
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    @if(Auth::user()->roles[0]->id != 8)
                                        <div class="col-12">
                                            <div class="row">
                                                <div class=" col-6 margin-30px-bottom" style="display: grid">
                                                    <span class="alt-font dark-gold text-medium">{{ __('user-portal.ssm') }}</span>
                                                    {{--                                            <span class="alt-font {{ Auth::user()->ssm_verify == NULL ? 'text-red' : 'text-success'}}">{{ Auth::user()->ssm_verify == NULL ? __('user-portal.not_verified') : __('user-portal.verified') }}</span>--}}
                                                    @if(Auth::user()->ssm_photo == NULL)
                                                        <span
                                                            class="alt-font text-extra-dark-gray text-red">{{__('user-portal.please_upload_your_ssm')}}</span>

                                                    @elseif(Auth::user()->ssm_photo != NULL && Auth::user()->ssm_verify == NULL)
                                                        <span
                                                            class="alt-font text-extra-dark-gray text-red">{{ __('user-portal.uploaded_but_not_verified') }}</span>
                                                    @else
                                                        <span
                                                            class="alt-font text-extra-dark-gray text-success">{{ __('user-portal.verified') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <a class="{{ (Auth::user()->ssm_photo != NULL )? "disabled" : "" }} text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                       style="padding: 3px 10px;min-width: 90px"
                                                       href="{{ route('user.edit-profile') }}">
                                                        {{ __('user-portal.upload') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class=" col-6 margin-30px-bottom" style="display: grid">
                                                    <span class="alt-font dark-gold text-medium">{{ __('user-portal.shop_photo') }}</span>
                                                    {{--                                            <span class="alt-font {{ Auth::user()->ssm_verify == NULL ? 'text-red' : 'text-success'}}">{{ Auth::user()->ssm_verify == NULL ? __('user-portal.not_verified') : __('user-portal.verified') }}</span>--}}
                                                    @if(Auth::user()->shop_photo == NULL)
                                                        <span
                                                            class="alt-font text-extra-dark-gray text-red">{{__('user-portal.please_upload_your_shop_photo')}}</span>

                                                    @elseif(Auth::user()->shop_photo != NULL && Auth::user()->shop_verify == NULL)
                                                        <span
                                                            class="alt-font text-extra-dark-gray text-red">{{ __('user-portal.uploaded_but_not_verified') }}</span>
                                                    @else
                                                        <span
                                                            class="alt-font text-extra-dark-gray text-success">{{ __('user-portal.verified') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <a class="{{ (Auth::user()->shop_photo != NULL )? "disabled" : "" }} text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                       style="padding: 3px 10px;min-width: 90px"
                                                       href="{{ route('user.edit-profile') }}">
                                                        {{ __('user-portal.upload') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->roles[0]->id != 3 && Auth::user()->roles[0]->id != 8 )
                            <div
                                class="bg-white shadow wow animate__fadeIn border-radius-5px "
                                style="visibility: visible; animation-name: fadeIn;">
                                <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                    <div class="row  align-items-center margin-10px-bottom">
                                        <div class="col-8">
                                            <span class="dark-gold alt-font ">{{ __('user-portal.member_info') }}</span>
                                        </div>
                                        <div class="col-4 row justify-content-end">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12 padding-1-rem-top padding-40px-lr">
                                    <div class="row align-items-start padding-30px-bottom ">
                                        <div class="col-12 col-md-4">
                                            <span class="dark-gold alt-font text-medium margin-5px-bottom">{{ __('user-portal.your_referral_code') }}</span>
                                            <div class="input-group" style="height: 55px">
                                                <input
                                                    class="small-input form-control border-all border-radius-5px text-large alt-font font-weight-600"
                                                    value="{{ Auth::user()->personal_code }}"
                                                    style="padding: 13px 15px;height: auto"/>
                                                <button onclick="copyText('{{ Auth::user()->personal_code }}', '{{ __('user-portal.referral_code_is_copied') }}')"
                                                        class="input-group-addon btn btn-small bg-dark-gold align-items-center "
                                                        style="width:55px;padding: 12px 6px;border-bottom-right-radius: 5px;border-top-right-radius: 5px"><i
                                                        class="fa fa-copy"
                                                        style="font-size: 2rem;color: white;"> </i></button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 ">
                                        <span
                                            class="dark-gold alt-font text-medium margin-5px-bottom">{{ __('user-portal.share_link') }}</span>
                                            <div class="input-group" style="height: 55px">
                                                <input
                                                    class="small-input form-control border-all border-radius-5px text-large alt-font font-weight-600"
                                                    value="{{  __('user-portal.join_me_now', ['title' => route('register',["ref_code" => Auth::user()->personal_code])])  }}"
                                                    style="padding: 13px 15px;height: auto"/>
                                                <button class="input-group-addon btn btn-small bg-dark-gold align-items-center "
                                                        onclick=" copyText('{{  __('user-portal.join_me_now', ['title' => route('register',["ref_code" => Auth::user()->personal_code])])  }}', '{{ __('user-portal.share_link_is_copied') }}')"
                                                        style="width:55px;padding: 12px 6px;border-bottom-right-radius: 5px;border-top-right-radius: 5px"><i class="fa fa-copy"
                                                                                                                                                             style="font-size: 2rem;color: white;"> </i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        function copyText(text, message) {
            // Create a "hidden" input
            var aux = document.createElement("input");

            text = text.replace("&amp;", "&");
            aux.setAttribute('value', text);

            // Append it to the body
            document.body.appendChild(aux);

            // Highlight its content
            aux.select();

            // Copy the highlighted text
            document.execCommand("copy");
            var copyText = aux.value;
            // Remove it from the body
            document.body.removeChild(aux);

            /* Alert the copied text */
            alert(message + '\n\n"' + text + '"');
        }
    </script>
@endsection
