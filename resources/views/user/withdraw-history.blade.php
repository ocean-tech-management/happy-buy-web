@extends('landing.app')

@section('css')
    <style>
        .payment-item {
            padding: 10px;
            background-color: #EAD3BF;
            border-radius: 10px;
        }

        .payment-item.select {
            background-color: #877A61 !important;
            border: none;
            color: white !important;
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
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom ">


                            <div
                                class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom padding-1-half-rem-bottom"
                                style="visibility: visible; animation-name: fadeIn;">
                                <div class="col-12 padding-1-half-rem-top padding-40px-lr ">
                                    <div class="row  align-items-center margin-10px-bottom">
                                        <div class="col-8">
                                            <span class="dark-gold alt-font ">{{ __('user-portal.withdraw_history') }}</span>
                                        </div>
                                        <div class="col-4 text-right">

                                        </div>
                                    </div>
                                </div>
                                @if(count($withdraw_history) != 0)
                                @foreach($withdraw_history as $withdraw_history_item)
                                    <hr>
                                    <div class="col-12  padding-40px-lr">
                                        <div class="row align-items-center">
                                            {{--                                            <div class="col-6 col-md-3">--}}
                                            {{--                                                <span class="alt-font text-extra-dark-gray text-medium font-weight-500">{{ Auth::user()->name }}</span>--}}
                                            {{--                                            </div>--}}
                                            <div class="col-6 col-md-3 text-md-left text-right">
                                                <span class="alt-font text-medium font-weight-500">RM {{ number_format($withdraw_history_item->amount,2) }}</span>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <span class="alt-font text-gray text-medium text-uppercase">{{ $withdraw_history_item->created_at->format('d M Y H:i a') }}</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                @if($withdraw_history_item->receipt != null)
                                                    <a class="modal-popup" href="#modal-popup"><img class="w-50px h-auto" src="{{ $withdraw_history_item->receipt->url }}"/></a>
                                                    <div id="modal-popup"
                                                         class="col-11 col-xl-6 col-lg-6 col-md-8 col-sm-9 mx-auto bg-white text-center modal-popup-main padding-2-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">
                                                        <img class="w-80 margin-1-half-rem-bottom" src="{{ $withdraw_history_item->receipt->url }}"/>
                                                        <br>
                                                        <a class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px popup-modal-dismiss"
                                                           href="#">{{ __('user-portal.dismiss') }}</a>
                                                    </div>
                                                @endif
                                                @if($withdraw_history_item->remark != null)
                                                    <a class="modal-popup" href="#modal-popup2">{{__('user-portal.remark')}}</a>
                                                    <div id="modal-popup2"
                                                         class="col-11 col-xl-3 col-lg-3 col-md-8 col-sm-9 mx-auto bg-white text-center modal-popup-main padding-2-half-rem-all border-radius-6px sm-padding-2-half-rem-lr mfp-hide">
                                                        <h5> {{__('user-portal.remark')}}</h5>
                                                        <div> {{ $withdraw_history_item->remark }}</div>
                                                        <br>
                                                        <a class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white padding-1-half-rem-lr letter-spacing-2px popup-modal-dismiss"
                                                           href="#">{{ __('user-portal.dismiss') }}</a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-6 col-md-2 text-right">
                                                <span class="alt-font text-medium font-weight-500 {{ $withdraw_history_item->status == 2 ? "text-success": "text-red"}}">{{ \App\Models\TransactionPointWithdraw::STATUS_SELECT[$withdraw_history_item->status]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <hr>
                                <div class="col-12 padding-40px-lr">
                                    {{ $withdraw_history->links() }}
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
        $(document).ready(function () {
            $('.payment-item').on('click', function () {
                $('.payment-item').removeClass('select');
                $(this).addClass('select');
                $('#amount').attr('value', $(this).attr('value'))

            });

            $('.payment-item').first().addClass('select');
            $('#amount').attr('value', $('.payment-item').attr('value'))

            $('.submit').on('click', function () {
                var url = '{{ route('user.withdraw.confirmation', [ 'amount' => ':amount']) }}';
                // url = url.replace(':amount', $('#amount').attr('value'));
                url = url.replace('%3Aamount', $('#amount').attr('value'));
                window.location.href = url;
            });
        });
    </script>
@endsection
