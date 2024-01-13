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
                        class="col-12 col-lg-8 col-md-8 padding-30px-left md-padding-15px-left sm-margin-30px-bottom">
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-7">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.address_book') }}</span>
                                    </div>
                                    <div class="col-5 text-right">
                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                           style="padding: 3px 10px;min-width: 90px"
                                           href="{{ route('user.add-address') }}">
                                            {{ __('user-portal.add_address') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            @if(session('message'))
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                                    </div>
                                </div>
                            @endif

                            @foreach ($address_books as $address_book)
                                <div class="col-12 padding-40px-lr">
                                    <div class="row align-items-center">
                                        <div class="col-6 col-md-3">
                                            <div class="line-height-16px">
                                            <span
                                                class="alt-font text-extra-dark-gray text-small font-weight-700">{{ $address_book->name }}</span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3 sm-margin-10px-top" style="padding-top: 0px">
                                            <div class="line-height-16px">
                                                <span class="alt-font text-gray text-small font-weight-300 text-uppercase">{{ $address_book->phone }}</span>
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-3 sm-margin-10px-top" style="padding-top: 0px">
                                            <div class="line-height-16px">
                                                <span class="alt-font text-gray text-small font-weight-300 text-uppercase">{{ $address_book->address_1 }}, <br>{{ $address_book->state->name }} - {{ $address_book->city }} - {{ $address_book->postcode }}</span>
                                            </div>

                                        </div>
                                        <div class="col-3 col-md-3 text-right d-none d-md-block">
                                            <div class="text-right align-items-start">
                                                <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white margin-1-rem-bottom"
                                                   style="padding: 3px 10px;min-width: 90px"
                                                   href="{{ route('user.edit-address', ['id' => $address_book->id]) }}">
                                                    {{__('user-portal.edit_address')}}
                                                </a>
                                                @if($address_book->set_default == 2)
                                                    <form method="post" action="{{ route('user.set-default-address', ['id' => $address_book->id]) }}">
                                                        @csrf
                                                        <button class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                           style="padding: 3px 10px;min-width: 90px">
                                                            {{__('user-portal.set_as_default')}}
                                                        </button>
                                                    </form>

                                                @else
                                                    <br>
                                                    {{ __('user-portal.default_address') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach

                            {{ $address_books->links() }}
                        </div>
                    </div>

                </div>
        </section>
    </div>
