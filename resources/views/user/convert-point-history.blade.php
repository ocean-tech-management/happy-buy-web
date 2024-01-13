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
                                            <span class="dark-gold alt-font ">{{ __('user-portal.convert_history') }}</span>
                                        </div>
                                        <div class="col-4 text-right">

                                        </div>
                                    </div>
                                </div>
                                @if(count($convert_history) != 0)
                                    <hr class="d-none d-md-block">
                                    <div class="col-12 d-none d-md-block padding-40px-lr">
                                        <div class="row align-items-center">
                                            <div class="col-6 col-md-3 text-md-left ">
                                                <span class="alt-font text-medium font-weight-500">PV</span>
                                            </div>
                                            <div class="col-6 col-md-3 text-right text-md-left">
                                                <span class="alt-font text-medium font-weight-500">Incentive PV</span>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <span class="alt-font text-gray text-medium text-uppercase">Datetime</span>
                                            </div>
                                            <div class="col-6 col-md-2 text-right">
                                                <span class="alt-font text-medium font-weight-500 ">Status</span>
                                            </div>
                                        </div>
                                    </div>
                                @foreach($convert_history as $convert_history_item)
                                    <hr>
                                    <div class="col-12  padding-40px-lr">
                                        <div class="row align-items-center">
                                            {{--                                            <div class="col-6 col-md-3">--}}
                                            {{--                                                <span class="alt-font text-extra-dark-gray text-medium font-weight-500">{{ Auth::user()->name }}</span>--}}
                                            {{--                                            </div>--}}
                                            <div class="col-6 col-md-3 text-md-left ">
                                                <span class="alt-font text-medium font-weight-500 text-success">+ {{ number_format($convert_history_item->amount) }} PV</span>
                                            </div>
                                            <div class="col-6 col-md-3 text-right text-md-left">
                                                <span class="alt-font text-medium font-weight-500 text-red">- {{ number_format($convert_history_item->amount) }} Incentive PV</span>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <span class="alt-font text-gray text-medium text-uppercase">{{ $convert_history_item->created_at->format('d M Y H:i a') }}</span>
                                            </div>
                                            <div class="col-6 col-md-2 text-right">
                                                <span class="alt-font text-medium font-weight-500 text-success">Success</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <hr>
                                <div class="col-12 padding-40px-lr">
                                    {{ $convert_history->links() }}
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
