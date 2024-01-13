@extends('landing.app')

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
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom ">
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px  padding-20px-bottom margin-30px-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font ">Downline List</span>
                                    </div>
                                    <div class="col-4 row justify-content-end">

                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if(count($downlines) != 0)
                                @foreach($downlines as $downline)
                                    <div class="col-12 padding-50px-lr margin-20px-bottom">
                                        <div class="row align-items-center">
                                            <div class="col-3 col-md-2">
                                                <img class="rounded-circle" style="height: 60px;width:60px"
                                                     src="{{ $downline->profile_photo ? $downline->profile_photo->url : asset('landing/images/default_profile.png') }}"/>
                                            </div>
                                            <div class="col-9 col-md-3">
                                                <div class="row align-items-center">
                                                    <div class="pl-3">
                                                        <div class="line-height-16px">
                                                            <a href="{{ route('user.downline-downlines', ['id' => $downline->id]) }}">
                                                                <span class="alt-font text-extra-dark-gray text-small font-weight-700">{{ $downline->name }}</span>
                                                            </a>
                                                        </div>
                                                        <div class="line-height-16px">
                                                            <span class="alt-font text-gray text-small font-weight-300">{{ $downline->personal_code }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 d-block d-md-none">
                                            </div>
                                            <div class="col-9 col-md-3 d-block d-md-none">
                                                <div class="row pl-3" style="display: grid">
                                                    <div class="line-height-16px">
                                                        <span class="alt-font text-gray text-small font-weight-300">{{ $downline->email }}</span>
                                                    </div>
                                                    <div class="line-height-16px">
                                                        <span class="alt-font text-gray text-small font-weight-300">{{ $downline->phone }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 d-block d-md-none">
                                            </div>
                                            <div class="col-3 col-md-4 d-none d-sm-block">
                                                <div class="row pl-3 align-items-center">
                                                    <div class="line-height-16px">
                                                        <span class="alt-font text-gray text-small font-weight-300">{{ $downline->email }}</span>
                                                    </div>
                                                    <div class="line-height-16px">
                                                        <span class="alt-font text-gray text-small font-weight-300">{{ $downline->phone }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-9 col-md-3 text-left text-md-right">
                                                <div class="row pl-3 justify-content-md-end justify-content-start">
                                                    <div class="line-height-16px">
                                                        <span class="alt-font text-gray text-small font-weight-300">{{ $downline->roles[0]->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12  padding-40px-lr">
                                    <span class="alt-font text-gray text-medium text-uppercase">{{ __('global.no_results') }}</span>
                                </div>
                            @endif

                        </div>
                        @if(count($request_upgrades) != 0)
                            <div
                                class="bg-white shadow wow animate__fadeIn border-radius-5px  padding-20px-bottom"
                                style="visibility: visible; animation-name: fadeIn;">
                                <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                    <div class="row  align-items-center margin-10px-bottom">
                                        <div class="col-8">
                                            <span class="dark-gold alt-font ">Downline Upgrade List</span>
                                        </div>
                                        <div class="col-4 row justify-content-end">

                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @foreach($request_upgrades as $pending_upgrade_downline)
                                    <div class="col-12 padding-50px-lr margin-20px-bottom">
                                        <div class="row align-items-center">
                                            <div class="col-3 col-md-2">
                                                <img class="rounded-circle" style="height: 60px;width:60px"
                                                     src="{{ $downline->profile_photo ? $downline->profile_photo->url : asset('landing/images/default_profile.png') }}"/>
                                            </div>
                                            <div class="col-9 col-md-3">
                                                <div class="row align-items-center">
                                                    <div class="pl-3">
                                                        <div class="line-height-16px">
                                                            <span
                                                                class="alt-font text-extra-dark-gray text-small font-weight-700">{{ $pending_upgrade_downline->user->name }}</span>
                                                        </div>
                                                        <div class="line-height-16px">
                                                            <span class="alt-font text-gray text-small font-weight-300">{{ $pending_upgrade_downline->user->personal_code }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3 d-block d-md-none">
                                            </div>
                                            <div class="col-9 col-md-4">
                                                <div class="row pl-3 align-items-center">
                                                    <div class="col-12 line-height-16px">
                                                    <span class="alt-font text-gray text-small font-weight-300">
                                                    @if(($pending_upgrade_downline->status == 2 || $pending_upgrade_downline->status == 3))
                                                            {{ $pending_upgrade_downline->user->roles[0]->name }}
                                                        @else
                                                            {{ $pending_upgrade_downline->user->roles[0]->name }} -> {{ "Manager" }}
                                                        @endif

                                                    </span>
                                                    </div>
                                                    <div class="col-12 line-height-16px">
                                                        <span
                                                            class="alt-font text-gray text-small font-weight-300">{{ \App\Models\UserUpgrade::STATUS_SELECT[$pending_upgrade_downline->status] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 d-block d-md-none">
                                            </div>
                                            <div class="col-9 col-md-3 text-md-right">
                                                <div class="row pl-3 justify-content-md-end justify-content-start">
                                                    <div class="line-height-16px">
                                                    <span class="alt-font text-gray text-small font-weight-300 text-uppercase">
                                                        @if(($pending_upgrade_downline->status == 2 || $pending_upgrade_downline->status == 3))
                                                            <div
                                                                class="text-extra-small w-100 alt-font font-weight-500  {{($pending_upgrade_downline->status == 2) ?"text-success" : "text-red" }}  text-uppercase mr-1"
                                                                style="padding: 3px 10px;">

                                                                {{($pending_upgrade_downline->status == 2) ? __('user-portal.completed'): __('global.reject') }}<br>
                                                                <span class="text-medium-gray"> {{  $pending_upgrade_downline->updated_at}} </span>
                                                            </div>
                                                        @else
                                                            <a class="text-extra-small w-100 alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gray text-uppercase text-white mr-1"
                                                               style="padding: 3px 10px;"
                                                               href="{{ route('user.view-upgrade-account', ['id' => $pending_upgrade_downline->id]) }}">
                                                            {{ __('user-portal.view') }}
                                                        </a>

                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        @endif
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
