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
                                        <span class="dark-gold alt-font ">Shipping Point History</span>
                                    </div>
                                    <div class="col-4 row justify-content-end">

                                    </div>
                                </div>
                            </div>
                            @if(count($point_history) != 0)
                            @foreach($point_history as $point_history_item)
                                <hr>
                                <div class="col-12  padding-40px-lr">
                                    <div class="row align-items-center">
                                        <div class="col-6 col-md-3">
                                            <span class="alt-font text-extra-dark-gray text-medium font-weight-500">{{  'Package ' .number_format($point_history_item->point) }} PV</span><br>
                                        </div>
                                        <div class="col-6 col-md-2  text-md-left text-right">
                                            <span class="alt-font text-medium font-weight-500">{{  ' RM ' .number_format($point_history_item->price) }}</span>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <span class="alt-font text-gray text-medium text-uppercase">{{ $point_history_item->created_at->format('d M Y H:i a') }}</span>
                                        </div>
                                        <div class="col-6 col-md-3 text-right">
                                            <span class="alt-font text-gray text-medium font-weight-500">{{ \App\Models\TransactionShippingPurchase::STATUS_SELECT[$point_history_item->status]}}</span>
                                            @if($point_history_item->status == 3)
                                                <br>
                                                <a target="_blank" href="{{ route('user.shipping-print-receipt', ['id'=>$point_history_item->id]) }}"><i class="fa fa-file-invoice"></i> Invoice </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <hr>
                                <div class="col-12 padding-40px-lr">
                                    {{ $point_history->links() }}
                                </div>
                            @else
                                <hr>
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
