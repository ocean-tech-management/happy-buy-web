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
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom padding-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-5">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.point_request') }}</span>
                                    </div>
                                    <div class="col-7 row justify-content-end">

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
                                <div class="col-12 padding-40px-lr">
                                    {{ $point_requests->links() }}
                                </div>
                            @else
                                <div class="col-12  padding-40px-lr">
                                    <span class="alt-font text-gray text-medium text-uppercase">{{ __('global.no_results') }}</span>
                                </div>
                            @endif
                        </div>


                    </div>


                </div>
            </div>
        </section>
    </div>
@endsection
