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
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom">
                        <div class="row padding-1-half-rem-bottom">
                            <div class="col-5">
                                <span class="dark-gold alt-font ">{{ __('user-portal.my_points') }}</span>
                            </div>
                            <div class="col-7 text-right">

                            </div>
                        </div>

                        <div class="row padding-1-half-rem-bottom">
                            @if ($errors->any())
                                <div class="col-md-12 margin-5px-bottom ">
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(Auth::user()->roles[0]->id == 3)
                                <div class="col-12 col-md-12 padding-1-rem-bottom">
                                    <div class="padding-1-rem-tb padding-40px-lr shadow"
                                         style="background-color: #F6EDE5;border-radius:10px">
                                        <div class="row">
                                            <div class="col-3 text-extra-medium-gray text-extra-medium alt-font text-left">
                                                {{ __('user-portal.executive_point') }}
                                            </div>
                                            <div class="col-5 text-extra-large2 dark-gold alt-font text-left">
                                                @if(env('SHOW_PV') == 1)
                                                    {{  number_format(getUserExecutivePointBalance(Auth::user()->id) )}}
                                                @else
                                                    -
                                                @endif

                                            </div>
                                            <div class="col-4 text-extra-large2 dark-gold alt-font  text-right">
                                                @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                   style="padding: 3px 10px;min-width: 90px"
                                                   href="{{ route('user.top-up-executive' ) }}">
                                                    {{ __('user-portal.top_up') }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @endif
                            @if(Auth::user()->roles[0]->id == 4)
                                @if(getUserExecutivePointBalance(Auth::user()->id) != 0)
                                    <div class="col-12 col-md-6">
                                        <div class="padding-2-rem-tb padding-2-rem-lr shadow"
                                             style="background-color: #F0E0D2;border-radius:10px">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="text-extra-large2 dark-gold alt-font ">
                                                        @if(env('SHOW_PV') == 1)
                                                            {{  number_format( getUserExecutivePointBalance(Auth::user()->id)) }}
                                                        @else
                                                            -
                                                        @endif

                                                    </div>
                                                    <div class="text-extra-medium-gray text-extra-medium alt-font ">
                                                        {{ __('user-portal.executive_point') }}
                                                    </div>
                                                </div>
                                                <div class="col-6 text-right" style="align-self: center;">
                                                    <div class="">
                                                        @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                        @if(getUserExecutivePointBalance(Auth::user()->id) % 110 !=0)
                                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white "
                                                               style="padding: 3px 10px;min-width: 90px"
                                                               href="{{ route('user.top-up-executive' ) }}">
                                                                {{ __('user-portal.top_up') }}
                                                            </a>
                                                        @endif
                                                        @endif
                                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                           style="padding: 3px 10px;min-width: 90px"
                                                           href="{{ route('user.my-point.point-history-executive')}}">
                                                            {{ __('user-portal.view_point_history') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="padding-2-rem-tb padding-2-rem-lr shadow"
                                             style="background-color: #F0E0D2;border-radius:10px">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="text-extra-large2 dark-gold alt-font ">
                                                        @if(env('SHOW_PV') == 1)
                                                            {{   number_format(getUserManagerPointBalance(Auth::user()->id)) }}
                                                        @else
                                                            -
                                                        @endif

                                                    </div>
                                                    <div class="text-extra-medium-gray text-extra-medium alt-font ">
                                                        {{ __('user-portal.manager_point') }}
                                                    </div>
                                                </div>
                                                <div class="col-6 text-right" style="align-self: center;">
                                                    <div class="">
                                                        @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white "
                                                           style="padding: 3px 10px;min-width: 90px"
                                                           href="{{ route('user.top-up-manager' ) }}">
                                                            {{ __('user-portal.top_up') }}
                                                        </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(getUserExecutivePointBalance(Auth::user()->id) == 0)
                                    <div class="col-12 col-md-12 padding-1-rem-bottom">
                                        <div class="padding-1-rem-tb padding-40px-lr shadow"
                                             style="background-color: #F6EDE5;border-radius:10px">
                                            <div class="row">
                                                <div class="col-3 text-extra-medium-gray text-extra-medium alt-font text-left">
                                                    {{ __('user-portal.manager_point') }}
                                                </div>
                                                <div class="col-5 text-extra-large2 dark-gold alt-font text-left">
                                                    @if(env('SHOW_PV') == 1)
                                                        {{  number_format(getUserManagerPointBalance(Auth::user()->id))}}
                                                    @else
                                                        {{  number_format(getUserManagerPointBalance(Auth::user()->id))}}
                                                    @endif

                                                </div>
                                                <div class="col-4 text-extra-large2 dark-gold alt-font  text-right">
                                                    @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                    <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                       style="padding: 3px 10px;min-width: 90px"
                                                       href="{{ route('user.top-up-manager') }}">
                                                        {{ __('user-portal.top_up') }}
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif

                            @endif
                            @if(Auth::user()->roles[0]->id == 2)
                                @if(getUserManagerPointBalance(Auth::user()->id) == 0 && getUserExecutivePointBalance(Auth::user()->id) == 0)
                                    <div class="col-12 col-md-12 padding-1-rem-bottom">
                                        <div class="padding-1-rem-tb padding-40px-lr shadow"
                                             style="background-color: #F6EDE5;border-radius:10px">
                                            <div class="row">
                                                <div class="col-3 text-extra-medium-gray text-extra-medium alt-font text-left">
                                                    {{ __('user-portal.point') }}
                                                </div>
                                                <div class="col-5 text-extra-large2 dark-gold alt-font text-left">
                                                    @if(env('SHOW_PV') == 1)
                                                        {{ number_format(getUserPointBalance(Auth::user()->id))}}
                                                    @else
                                                        -
                                                    @endif

                                                </div>
                                                <div class="col-4 text-extra-large2 dark-gold alt-font  text-right">
                                                    @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                    <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                       style="padding: 3px 10px;min-width: 90px"
                                                       href="{{ route('user.top-up-millionaire') }}">
                                                        {{ __('user-portal.top_up') }}
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @elseif( getUserManagerPointBalance(Auth::user()->id) != 0 || getUserExecutivePointBalance(Auth::user()->id) != 0)
                                    @if(getUserManagerPointBalance(Auth::user()->id) != 0 && getUserExecutivePointBalance(Auth::user()->id) == 0)
                                        <div class="col-12 col-md-6">
                                            <div class="padding-2-rem-tb padding-2-rem-lr shadow"
                                                 style="background-color: #F0E0D2;border-radius:10px">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="text-extra-large2 dark-gold alt-font ">
                                                            @if(env('SHOW_PV') == 1)
                                                                {{  number_format( getUserManagerPointBalance(Auth::user()->id)) }}
                                                            @else
                                                                -
                                                            @endif

                                                        </div>
                                                        <div class="text-extra-medium-gray text-extra-medium alt-font ">
                                                            {{ __('user-portal.manager_point') }}
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-right" style="align-self: center;">
                                                        <div class="">
                                                            @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                            @if(getUserManagerPointBalance(Auth::user()->id) % 100 !=0)
                                                                <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white "
                                                                   style="padding: 3px 10px;min-width: 90px"
                                                                   href="{{ route('user.top-up-manager' ) }}">
                                                                    {{ __('user-portal.top_up') }}
                                                                </a>
                                                            @endif
                                                            @endif
                                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                               style="padding: 3px 10px;min-width: 90px"
                                                               href="{{ route('user.my-point.point-history-manager')}}">
                                                                {{ __('user-portal.view_point_history') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="padding-2-rem-tb padding-2-rem-lr shadow"
                                                 style="background-color: #F0E0D2;border-radius:10px">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="text-extra-large2 dark-gold alt-font ">
                                                            @if(env('SHOW_PV') == 1)
                                                                {{   number_format(getUserPointBalance(Auth::user()->id)) }}
                                                            @else
                                                                -
                                                            @endif

                                                        </div>
                                                        <div class="text-extra-medium-gray text-extra-medium alt-font ">
                                                            {{ __('user-portal.point') }}
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-right" style="align-self: center;">
                                                        <div class="">
                                                            @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white "
                                                               style="padding: 3px 10px;min-width: 90px"
                                                               href="{{ route('user.top-up-millionaire' ) }}">
                                                                {{ __('user-portal.top_up') }}
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(getUserManagerPointBalance(Auth::user()->id) == 0 && getUserExecutivePointBalance(Auth::user()->id) != 0)
                                        <div class="col-12 col-md-6">
                                            <div class="padding-2-rem-tb padding-2-rem-lr shadow"
                                                 style="background-color: #F0E0D2;border-radius:10px">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="text-extra-large2 dark-gold alt-font ">
                                                            @if(env('SHOW_PV') == 1)
                                                                {{  number_format( getUserExecutivePointBalance(Auth::user()->id)) }}
                                                            @else
                                                                -
                                                            @endif

                                                        </div>
                                                        <div class="text-extra-medium-gray text-extra-medium alt-font ">
                                                            {{ __('user-portal.executive_point') }}
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-right" style="align-self: center;">
                                                        <div class="">
                                                            @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                            @if(getUserExecutivePointBalance(Auth::user()->id) % 110 !=0)
                                                                <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white "
                                                                   style="padding: 3px 10px;min-width: 90px"
                                                                   href="{{ route('user.top-up-executive' ) }}">
                                                                    {{ __('user-portal.top_up') }}
                                                                </a>
                                                            @endif
                                                            @endif
                                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                               style="padding: 3px 10px;min-width: 90px"
                                                               href="{{ route('user.my-point.point-history-executive')}}">
                                                                {{ __('user-portal.view_point_history') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="padding-2-rem-tb padding-2-rem-lr shadow"
                                                 style="background-color: #F0E0D2;border-radius:10px">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="text-extra-large2 dark-gold alt-font ">
                                                            @if(env('SHOW_PV') == 1)
                                                                {{   number_format(getUserPointBalance(Auth::user()->id)) }}
                                                            @else
                                                                -
                                                            @endif

                                                        </div>
                                                        <div class="text-extra-medium-gray text-extra-medium alt-font ">
                                                            {{ __('user-portal.point') }}
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-right" style="align-self: center;">
                                                        <div class="">
                                                            @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white "
                                                               style="padding: 3px 10px;min-width: 90px"
                                                               href="{{ route('user.top-up-millionaire' ) }}">
                                                                {{ __('user-portal.top_up') }}
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(getUserManagerPointBalance(Auth::user()->id) != 0 && getUserExecutivePointBalance(Auth::user()->id) != 0)
                                        <div class="col-12 col-md-4">
                                            <div class="padding-2-rem-tb shadow"
                                                 style="background-color: #ECD7C5;border-radius:10px">
                                                <div class="text-extra-large2 dark-gold alt-font text-center">
                                                    @if(env('SHOW_PV') == 1)
                                                        {{   number_format(getUserExecutivePointBalance(Auth::user()->id)) }}
                                                    @else
                                                        -
                                                    @endif

                                                </div>
                                                <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                                    {{ __('user-portal.executive_point') }}
                                                </div>
                                                @if(getUserExecutivePointBalance(Auth::user()->id) % 110 !=0)
                                                    <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                                        @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white margin-20px-top"
                                                           style="padding: 3px 10px;min-width: 90px"
                                                           href="{{ route('user.top-up-executive') }}">
                                                            {{ __('user-portal.top_up') }}
                                                        </a>
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                                    <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                       style="padding: 3px 10px;min-width: 90px"
                                                       href="{{ route('user.my-point.point-history-executive')}}">
                                                        {{ __('user-portal.view_point_history') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="padding-2-rem-tb shadow"
                                                 style="background-color: #ECD7C5;border-radius:10px">
                                                <div class="text-extra-large2 dark-gold alt-font text-center">
                                                    @if(env('SHOW_PV') == 1)
                                                        {{  number_format( getUserManagerPointBalance(Auth::user()->id)) }}
                                                    @else
                                                        -
                                                    @endif

                                                </div>
                                                <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                                    {{ __('user-portal.manager_point') }}
                                                </div>
                                                @if(getUserManagerPointBalance(Auth::user()->id) % 100 !=0)
                                                    <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                                        @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white margin-20px-top"
                                                           style="padding: 3px 10px;min-width: 90px"
                                                           href="{{ route('user.top-up-manager') }}">
                                                            {{ __('user-portal.top_up') }}
                                                        </a>
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                                    <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                       style="padding: 3px 10px;min-width: 90px"
                                                       href="{{ route('user.my-point.point-history-manager')}}">
                                                        {{ __('user-portal.view_point_history') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="padding-2-rem-tb shadow"
                                                 style="background-color: #ECD7C5;border-radius:10px">
                                                <div class="text-extra-large2 dark-gold alt-font text-center">
                                                    @if(env('SHOW_PV') == 1)
                                                        {{   number_format(getUserPointBalance(Auth::user()->id)) }}
                                                    @else
                                                        -
                                                    @endif

                                                </div>
                                                <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                                    {{ __('user-portal.point') }}
                                                </div>

                                                <div class="text-extra-medium-gray text-extra-medium alt-font text-center">
                                                    @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                    <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white margin-20px-top"
                                                       style="padding: 3px 10px;min-width: 90px"
                                                       href="{{ route('user.top-up-millionaire') }}">
                                                        {{ __('user-portal.top_up') }}
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @else
                                    <div class="col-12 col-md-12 padding-1-rem-bottom">
                                        <div class="padding-1-rem-tb padding-40px-lr shadow"
                                             style="background-color: #F6EDE5;border-radius:10px">
                                            <div class="row">
                                                <div class="col-3 text-extra-medium-gray text-extra-medium alt-font text-left">
                                                    {{ __('user-portal.point') }}
                                                </div>
                                                <div class="col-5 text-extra-large2 dark-gold alt-font text-left">
                                                    @if(env('SHOW_PV') == 1)
                                                        {{  number_format(getUserPointBalance(Auth::user()->id))}}
                                                    @else
                                                        -
                                                    @endif

                                                </div>
                                                <div class="col-4 text-extra-large2 dark-gold alt-font  text-right">
                                                    @if(Auth::guard('user')->user()->allow_order_status != 2)
                                                    <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                       style="padding: 3px 10px;min-width: 90px"
                                                       href="{{ route('user.top-up-millionaire') }}">
                                                        {{ __('user-portal.top_up') }}
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            @endif
                        </div>
                        @if(session('message'))
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                                </div>
                            </div>
                        @endif
                        @if(Auth::user()->roles[0]->id == '2' || Auth::user()->roles[0]->id == '4')
                            <div
                                class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom padding-1-half-rem-bottom"
                                style="visibility: visible; animation-name: fadeIn;">
                                <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                    <div class="row  align-items-center margin-10px-bottom">
                                        <div class="col-5">
                                            <span class="dark-gold alt-font ">{{ __('user-portal.point_request') }}</span>
                                        </div>
                                        <div class="col-7 text-right">
                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px"
                                               href="{{ route('user.point-requests') }}">
                                                {{ __('user-portal.view_all_request') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                @if(count($point_requests) != 0)
                                    @foreach($point_requests as $point_request)
                                        <div class="col-12  padding-40px-lr">
                                            <div class="row align-items-center">
                                                <div class="col-6 col-md-3">
                                                    <span class="alt-font text-extra-dark-gray text-medium font-weight-500">{{ $point_request->user->name }}</span><br>
                                                    @if($point_request->status != 1 && $point_request->receipt_photo)
                                                        <a class="modal-popup alt-font" href="#modal-popup"><i class="fa fa-receipt"></i> View Receipt</a>
                                                        <div id="modal-popup"
                                                             class="col-11 col-xl-6 col-lg-6 col-md-8 col-sm-9 mx-auto bg-white text-center modal-popup-main padding-2-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">
                                                            <img class="w-100 margin-1-half-rem-bottom" src="{{ $point_request->receipt_photo->url }}"/>
                                                            <a class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px popup-modal-dismiss"
                                                               href="#">{{ __('user-portal.dismiss') }}</a>
                                                        </div>
                                                    @else
                                                        No Receipt found
                                                    @endif
                                                </div>
                                                <div class="col-6 col-md-2   text-md-left text-right">
                                                    <span class="alt-font text-extra-dark-gray text-medium font-weight-500">{{ number_format($point_request->amount) }} PV</span>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <span class="alt-font text-gray text-medium text-uppercase"> {{ $point_request->created_at->format('d M Y H:i a') }}</span>
                                                </div>
                                                <div class="col-6 col-md-3  text-right">
                                                    @if($point_request->status == 1)
                                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gray text-uppercase text-white"
                                                           style="padding: 3px 10px;min-width: 90px"
                                                           href="{{ route('user.proceed-point-request',['id'=>$point_request->id ]) }}">
                                                            {{ __('user-portal.proceed') }}
                                                        </a>

                                                    @else
                                                        <span
                                                            class="alt-font text-extra-dark-gray text-medium font-weight-500 {{ $point_request->status == 2 ? 'text-success' : 'text-red' }}">{{ \App\Models\TransactionAgentTopUp::STATUS_SELECT[$point_request->status] }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                    @endforeach
                                @else
                                    <div class="col-12  padding-40px-lr">
                                        <span class="alt-font text-gray text-medium text-uppercase">{{ __('global.no_results') }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom padding-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr ">
                                <div class="row align-items-center margin-10px-bottom">
                                    <div class="col-6">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.point_history') }}</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        @if(Auth::user()->roles[0]->id == 3)

                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px"
                                               href="{{ route('user.my-point.point-history-executive')}}">
                                                {{ __('user-portal.view_point_history') }}
                                            </a>
                                        @elseif(Auth::user()->roles[0]->id == 4)
                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px"
                                               href="{{ route('user.my-point.point-history-manager') }}">
                                                {{ __('user-portal.view_point_history') }}
                                            </a>
                                        @else
                                            <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px"
                                               href="{{ route('user.my-point.point-history') }}">
                                                {{ __('user-portal.view_point_history') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if(count($point_history) != 0)
                                @foreach($point_history as $point_history_item)
                                    <div class="col-12  padding-40px-lr">
                                        <div class="row align-items-center">
                                            <div class="col-6 col-md-3">
                                                <span class="alt-font text-extra-dark-gray text-medium font-weight-500">{{ Auth::user()->name }}</span>
                                            </div>
                                            <div class="col-6 col-md-2  text-md-left text-right">
                                                <span class="alt-font  text-medium font-weight-500 {{ ($point_history_item->amount) < 0 ? "text-red" : "text-success" }}">{{ number_format($point_history_item->amount) }} PV</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span class="alt-font text-gray text-medium text-uppercase line-height-20px">
                                                   <div>{{ $point_history_item->created_at->format('d M Y') }}</div>
                                                   <div>{{ $point_history_item->created_at->format('H:i a') }}</div>
                                                </span>
                                            </div>
                                            <div class="col-6 col-md-4 text-right text-uppercase">
                                                <span
                                                    class="alt-font text-gray text-medium font-weight-500 line-height-20px">
                                                    <div> {{ $point_history_item->remark }}</div>
                                                    <div
                                                        class="{{ $point_history_item->status == 1 ? "text-success" : 'text-red' }}"> {{ \App\Models\PointBalance::STATUS_SELECT[$point_history_item->status]}}</div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            @else
                                <div class="col-12  padding-40px-lr">
                                    <span class="alt-font text-gray text-medium text-uppercase">{{ __('global.no_results') }}</span>
                                </div>
                            @endif
                            {{--                            <hr>--}}
                            {{--                            <div class="col-12  padding-40px-lr">--}}
                            {{--                                <div class="row align-items-center">--}}
                            {{--                                    <div class="col-6 col-md-3">--}}
                            {{--                                        <span class="alt-font text-extra-dark-gray text-medium font-weight-500">Gloria Huey Juin</span>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-6 col-md-2   text-md-left text-right">--}}
                            {{--                                        <span class="alt-font text-success text-medium font-weight-500"> 300 PTS</span>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-6 col-md-4">--}}
                            {{--                                        <span class="alt-font text-gray text-medium">12 JUN 2021 18:00 PM</span>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-6 col-md-3  text-right">--}}
                            {{--                                        <span class="alt-font text-gray text-medium font-weight-500">Complete</span>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <hr>--}}
                            {{--                            <div class="col-12 padding-1-rem-bottom padding-40px-lr">--}}
                            {{--                                <div class="row align-items-center">--}}
                            {{--                                    <div class="col-6 col-md-3">--}}
                            {{--                                        <span class="alt-font text-extra-dark-gray text-medium font-weight-500">Gloria Huey Juin</span>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-6 col-md-2   text-md-left text-right">--}}
                            {{--                                        <span class="alt-font text-success text-medium font-weight-500"> 300 PTS</span>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-6 col-md-4">--}}
                            {{--                                        <span class="alt-font text-gray text-medium">12 JUN 2021 18:00 PM</span>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-6 col-md-3  text-right">--}}
                            {{--                                        <span class="alt-font text-gray text-medium font-weight-500">Complete</span>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                        </div>

                    </div>


                </div>
            </div>
        </section>
    </div>
@endsection
