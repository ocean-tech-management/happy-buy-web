@extends('landing.app')

@section('css')
    <style>
        .payment-item{
            background-color: #f8f8f8;
            border:1px solid #d8d8d8;
        }

        .payment-item.select{
            background-color: white!important;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
            border:none;
        }
    </style>
@endsection

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
                                <div class="col-12 padding-1-half-rem-top padding-40px-lr ">
                                    <div class="row  align-items-center margin-10px-bottom">
                                        <div class="col-8">
                                            @php
                                             if( str_contains(url()->current(), "manager")){
                                               $name = __('user-portal.manager_point');
                                                }   else if( str_contains(url()->current(), "executive")){
                                                     $name = __('user-portal.executive_point');
                                                }else{
                                                    $name = "";
                                                }
                                            @endphp
                                            <span class="dark-gold alt-font ">{{ __('user-portal.top_up_history') ." ". $name }}</span>
                                        </div>
                                        <div class="col-4 text-right">

                                        </div>
                                    </div>
                                </div>
                                @if(count($point_history) != 0)
                                @if(Auth::user()->roles[0]->id == 2)
                                    @foreach($point_history as $point_history_item)
                                        <hr>
                                        <div class="col-12  padding-40px-lr">
                                            <div class="row align-items-center">
                                                <div class="col-6 col-md-3">
                                                    <span class="alt-font text-extra-dark-gray text-medium font-weight-500">{{ $point_history_item->point_package->name . ' - ' .number_format($point_history_item->price == 0? $point_history_item->amount : $point_history_item->price) }} PV</span><br>
                                                </div>
                                                <div class="col-6 col-md-2  text-md-left text-right">
                                                    <span class="alt-font text-medium font-weight-500">{{  ' RM ' .number_format($point_history_item->price == 0? $point_history_item->amount : $point_history_item->price) }}</span>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <span class="alt-font text-gray text-medium text-uppercase">{{ $point_history_item->created_at->format('d M Y H:i a') }}</span>
                                                </div>
                                                <div class="col-6 col-md-3 text-right">
                                                    <span class="alt-font text-gray text-medium font-weight-500">{{ \App\Models\TransactionPointPurchase::STATUS_SELECT[$point_history_item->status]}}</span>
                                                    @if($point_history_item->status == 3)
                                                        <br>
                                                        <a target="_blank" href="{{ route('user.top-up-print-receipt', ['id'=>$point_history_item->id]) }}"><i class="fa fa-file-invoice"></i> Receipt </a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($point_history as $point_history_item)
                                    <hr>
                                    <div class="col-12  padding-40px-lr">
                                        <div class="row align-items-center">
                                            <div class="col-6 col-md-4">
                                                <span class="alt-font text-extra-dark-gray text-medium font-weight-500">{{ number_format($point_history_item->amount) }} PV</span><br>
                                                @if($point_history_item->receipt_photo)
                                                    <a class="modal-popup alt-font" href="#modal-popup"><i class="fa fa-receipt"></i> {{ __('user-portal.view_uploaded_receipt') }}</a>
                                                    <div id="modal-popup"
                                                         class="col-11 col-xl-6 col-lg-6 col-md-8 col-sm-9 mx-auto bg-white text-center modal-popup-main padding-2-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">
                                                        <img class="w-100 margin-1-half-rem-bottom" src="{{ $point_history_item->receipt_photo->url }}"/>
                                                        <a class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px popup-modal-dismiss"
                                                           href="#">{{ __('user-portal.dismiss') }}</a>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-6 col-md-4">
                                                <span class="alt-font text-gray text-medium text-uppercase">{{ $point_history_item->created_at->format('d M Y H:i a') }}</span>
                                            </div>
                                            <div class="col-6 col-md-4 text-right">
                                                <span class="alt-font text-gray text-medium font-weight-500">{{ \App\Models\TransactionAgentTopUp::STATUS_SELECT[$point_history_item->status]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
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

@section('js')
    <script>
        $( document ).ready(function() {
            $('.payment-item').on('click', function () {
                $('.payment-item').removeClass('select');
                $(this).addClass('select');
                $('#value').attr('value', $(this).attr('value'))
                $('.submit').attr('value', $(this).attr('value'))
            });

            $('.payment-item').first().addClass('select');
            $('#value').attr('value', $('.payment-item').attr('value'))
            $('.submit').attr('value', $('.payment-item').attr('value'))

            $('.submit').on('click', function(){
                var url = '{{ route('user.top-up.checkout', ':id') }}';
                url = url.replace(':id', $(this).attr('value'));
                window.location.href = url;
            });
        });
    </script>
@endsection
