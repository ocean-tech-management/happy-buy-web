<!-- start sidebar -->
<aside class="col-12 col-lg-4 col-md-4 sm-margin-30px-bottom" style=" {{ Route::getCurrentRoute()->getName() == "user.home" ? 'display:block!important' : '' }}">
    <div
        class="bg-white shadow padding-1-rem-top wow animate__fadeIn border-radius-5px  margin-1-half-rem-bottom"
        style="visibility: visible; animation-name: fadeIn;">
        <div class="col-12 padding-1-half-rem-tb padding-40px-lr">
            <div class="row">
                <div class="col-4">
                    <img class="rounded-circle h-70px w-70px {{ Auth::user()->profile_photo ? "cover-img" : ""}} bg-dark-gold"
                         src="{{ Auth::user()->profile_photo ? Auth::user()->profile_photo->url : asset('landing/images/default_profile.png') }}"/>
                </div>
                <div class="col-8 list-style-07  justify-content-center" style="line-height: 5px;">
                    <div class="text-extra-large text-extra-dark-gray" style="margin-bottom: 4px"> {{ Auth::user()->name }}</div>
                    <div class="row ">
                        <div class="col-6 {{ (Auth::user()->roles[0]->id == 3 || Auth::user()->roles[0]->id == 4)? "col-6" : "col-12"   }}">
                            @if(Auth::user()->roles[0]->id != 8)
                            <div class="text-extra-medium text-dark-gray" style="margin-bottom: 4px">{{ Auth::user()->personal_code }}
                            </div>
                            @endif
                            <div class="text-extra-medium text-dark-gray" style="margin-bottom: 4px">
                                {{ str_replace('Merchant-', '', str_replace('Agent-', '', Auth::user()->roles[0]->name))  }}
                                @if(Auth::user()->sub_user_type == 2)
                                    <br/>
                                    <strong><i>{{ __('user-portal.million_leader') }}</i></strong>
                                @endif

                            </div>
                        </div>
                        @if(Auth::user()->roles[0]->id == 3 || Auth::user()->roles[0]->id == 4)
                            <div class="col-6 my-auto">
{{--                                @if(Auth::guard('user')->user()->allow_order_status != 2)--}}
                                <a class="alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px w-90px"
                                   style="padding: 6px 0px; font-size: 12px" href="{{ route('user.upgrade-account-select') }}">
                                    {{ __('user-portal.upgrade') }}
                                </a>
{{--                                @endif--}}
                            </div>
                        @endif
{{--                        @if(Auth::user()->roles[0]->id == 2)--}}
{{--                            @if(getUserSignedQuitAgreement(Auth::user()->id) == 0)--}}
{{--                                <a class="alt-font font-weight-500 btn btn-very-small btn-shadow bg-danger text-uppercase text-white letter-spacing-2px w-90px"--}}
{{--                                   style="padding: 6px 0px; font-size: 12px" href="{{ route('user.quit-agreement-form') }}">--}}
{{--                                    {{ __('user-portal.quit') }}--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                        @endif--}}
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->first_payment != null || Auth::user()->roles[0]->id == 2)
            <div class="col-12 padding-1-rem-tb bg-dark-gold padding-40px-lr ">
                <div class="row align-items-center text-white">
                    @if(Auth::user()->first_payment != null)
                        @if(Auth::user()->roles[0]->id == 2)
                            <div class="col-5">
                                {{ __('user-portal.fee') }}
                                <a target="_blank" href="{{ route('user.join-fee-print-receipt') }}"><i class="fa fa-receipt text-white"></i></a>
                            </div>
                            <div class="col-7 text-right">
                                <span class="padding-1-half-rem-left alt-font font-weight-700 text-extra-large">RM {{ number_format(getUserJoiningFee(Auth::user()->id),2) }}</span>
                            </div>
                        @endif
                        <div class="col-5">
                            {{ __('user-portal.deposit') }}
                            @foreach(getUserDeposits(Auth::user()->id) as $user_entry)
                                <a target="_blank" href="{{ route('user.deposit-print-receipt', ['id' => $user_entry->id]) }}"><i class="fa fa-receipt text-white"></i></a>
                            @endforeach
                        </div>
                        <div class="col-7 text-right">
                            <span class="padding-1-half-rem-left alt-font font-weight-700 text-extra-large">RM {{ number_format(getUserDepositSum(Auth::user()->id),2) }}</span>
                        </div>
                    @endif
                    @if(Auth::user()->roles[0]->id == 2)
                        <div class="col-5">
                            {{ __('user-portal.voucher_point') }}
                        </div>
                        <div class="col-7 text-right">
                            @if(env('SHOW_PV') == 1)
                                @if(Auth::user()->created_at >= '2022-08-01 00:00:00')
                                    <span class="padding-1-half-rem-left alt-font font-weight-700"> {{ number_format(getUserVoucherBalance(Auth::user()->id)) }}/{{ number_format(18000 - getUserVoucherLog(Auth::user()->id)) }} PV</span>
                                @else
                                    <span class="padding-1-half-rem-left alt-font font-weight-700"> {{ number_format(getUserVoucherBalance(Auth::user()->id)) }}/{{ number_format(27000 - getUserVoucherLog(Auth::user()->id)) }} PV</span>
                                @endif
                            @else
                                <span class="padding-1-half-rem-left alt-font font-weight-700"> - PV</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endif
        @if(Auth::user()->roles[0]->id != 8)
            <div class="col-12 padding-1-half-rem-tb bg-light-yellow padding-40px-lr border-radius-5px">
                <div class="row align-items-center margin-10px-bottom">
                    <div class="col-6">
                        <span class="dark-gold">{{ __('user-portal.points') }}</span>
                        <div>
                            @if(env('SHOW_PV') == 1)
                                <span class="text-extra-dark-gray">
                            <span class="dark-gold">{{ number_format(getUserPointBalance(Auth::user()->id) + getUserManagerPointBalance(Auth::user()->id) + getUserExecutivePointBalance(Auth::user()->id)) }}</span> PV
                        </span>
                            @else
                                <span class="text-extra-dark-gray">
                            <span class="dark-gold">-</span> PV
                        </span>
                            @endif

                        </div>
                    </div>

                    <div class="col-6 text-right">
                        <a class=" alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-1px w-90px"
                           style="padding: 6px 0px;font-size: 12px;min-width: 100px"
                           href="{{ route('user.my-point') }}">
                            {{ __('user-portal.view') }}
                        </a>
                    </div>
                </div>
                @if(Auth::user()->roles[0]->id == 2)
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="dark-gold">{{ __('user-portal.bonus_points') }}</span>
                            <div>
                                @if(env('SHOW_PV') == 1)
                                    <span class="text-extra-dark-gray"><span class="dark-gold">{{  number_format(getUserPointBonusBalance(Auth::user()->id)) }}</span> PV</span>
                                @else
                                    <span class="text-extra-dark-gray"><span class="dark-gold"> - </span> PV</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6 text-right">
                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-1px margin-1-rem-bottom"
                               style="padding: 6px 5px;font-size: 12px; min-width: 100px"
                               href="{{ route('user.point-convert-show') }}">
                                {{ __('user-portal.convert') }}
                            </a>
                            <a class="alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-1px w-90px "
                               style="padding: 6px 0px; font-size: 12px;min-width: 100px"
                               href="{{ route('user.withdraw') }}">
                                {{ __('user-portal.withdraw') }}
                            </a>
                        </div>
                    </div>
                @endif
                <div class="row align-items-center margin-10px-bottom">
                    <div class="col-6">
                        <span class="dark-gold">{{ __('user-portal.shipping_points') }}</span>
                        <div>
                            @if(env('SHOW_PV') == 1)
                                <span class="text-extra-dark-gray"><span class="dark-gold">{{ number_format(getUserShippingBalance(Auth::user()->id),2) }}</span> PV</span>
                            @else
                                <span class="text-extra-dark-gray"><span class="dark-gold"> - </span> PV</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        @if(Auth::guard('user')->user()->allow_order_status != 2)
                        <a class=" alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-1px w-90px"
                           style="padding: 6px 0px;font-size: 12px;min-width: 100px"
                           href="{{ route('user.shipping') }}">
                            {{ __('user-portal.top_up') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="col-12 padding-1-half-rem-tb bg-light-yellow padding-40px-lr border-radius-5px">
                <div class="row align-items-center margin-10px-bottom">
                    <div class="col-8">
                        <span class="dark-gold">Point</span>
                        <div>
                            @if(env('SHOW_PV') == 1)
                                <span class="text-extra-dark-gray"><span
                                        class="dark-gold"> {{ getPvBalance(Auth::guard('user')->user()->id) }}</span> PV</span>
                            @else
                                <span class="text-extra-dark-gray"><span
                                        class="dark-gold"> - </span> PV</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row align-items-center margin-10px-bottom">
                    <div class="col-8">
                        <span class="dark-gold">Cash Voucher Point</span>
                        <div>
                            @if(env('SHOW_PV') == 1)
                            @else
                            @endif
{{--                        <span class="text-extra-dark-gray"><span--}}
{{--                                class="dark-gold"> {{ getCashVoucherBalance(Auth::guard('user')->user()->id) }} </span> PV</span>--}}
                        <span class="text-extra-dark-gray"><span
                                class="dark-gold"> - </span> PV</span>
                        </div>
                    </div>
                </div>

            </div>
        @endif

    </div>
    @if(Auth::user()->roles[0]->id != 8)
    <div
        class="bg-dark-gold shadow wow animate__fadeIn border-radius-5px  margin-1-half-rem-bottom"
        style="visibility: visible; animation-name: fadeIn;">
        <div class="col-12 padding-1-half-rem-top padding-40px-lr">
            <div class="row  align-items-center margin-10px-bottom">
                <div class="col-5">
                    <span class="text-white alt-font font-weight-300">{{ __('user-portal.members') }}</span>
                </div>
                <div class="col-7 text-right">
                    <div>
                        @if(Auth::user()->roles[0]->id != 3)
                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-light-yellow text-uppercase dark-gold  "
                               style="padding: 3px 10px;"
                               href="{{ route('user.downline') }}">
                                {{ __('user-portal.view_member_list') }}
                            </a>
                        @endif
{{--                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-light-yellow text-uppercase dark-gold  "--}}
{{--                            style="padding: 3px 10px;"--}}
{{--                            href="{{ route('user.registerVipForm') }}">--}}
{{--                            {{ __('user-portal.register_vip') }}--}}
{{--                            </a>--}}
                    </div>
                </div>
            </div>
        </div>
        <hr class="bg-white">
        <div class="col-12 padding-1-half-rem-bottom padding-40px-lr">
            <div class="row  align-items-center">
                <div class="col-6">
                    <span class="alt-font text-white">{{ str_replace('Merchant-', '', str_replace('Agent-', '', Auth::user()->upline_user->roles[0]->name))  }}</span>
                </div>

                <div class="col-6 text-right">
                    <span class="alt-font text-white">{{ Auth::user()->upline_user->name }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div
        class="bg-dark-gold shadow wow animate__fadeIn border-radius-5px"
        style="visibility: visible; animation-name: fadeIn;">
        <div class="col-12 padding-1-half-rem-top padding-40px-lr ">
            <div class="row  align-items-center ">
                <div class="col-5">
                    <span class="text-white alt-font font-weight-300">{{ __('user-portal.address_book') }}</span>
                </div>
                <div class="col-7 text-right">
                    <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-light-yellow text-uppercase dark-gold"
                       style="padding: 3px 10px;"
                       href="{{ route('user.my-address-book') }}">
                        {{ __('user-portal.view_all') }}
                    </a>
                </div>
            </div>
        </div>
        <hr class="bg-white">
        <div class="col-12 padding-1-half-rem-bottom padding-40px-lr">

            @php
                $address_book = getUserDefaultAddress(Auth::user()->id);
            @endphp
            <div class="">
                <span class="alt-font text-white">{{ $address_book->name }}</span>
            </div>

            <div class="">
                <span class="alt-font text-white">{{ $address_book->phone }}</span>
            </div>

            <div class="">
                <span class="alt-font text-white">{{$address_book->address_1 }}, {{$address_book->address_2 }}</span>
            </div>

            <div class="">
                <span class="alt-font text-white">{{$address_book->postcode }}, {{$address_book->city }}, {{$address_book->statepro }}</span>
            </div>

        </div>
    </div>

</aside>
<!-- end sidebar -->
