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
                        class="col-12 col-lg-8 col-md-8 padding-30px-left md-padding-15px-left sm-margin-30px-bottom ">
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom padding-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-5">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.point_history') }}</span>
                                    </div>
                                    <div class="col-7 row justify-content-end">

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
                                            <div class="col-6 col-md-4 text-right">
                                                <span
                                                    class="alt-font text-gray text-medium font-weight-500 line-height-20px text-uppercase">
                                                    <div> {{ $point_history_item->remark }}</div>
                                                    <div class="{{ $point_history_item->status == 1 ? "text-success" : 'text-red' }}"> {{ \App\Models\PointBalance::STATUS_SELECT[$point_history_item->status]}}</div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                                    <div class="col-12 padding-40px-lr">
                                    {{ $point_history->links() }}
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
