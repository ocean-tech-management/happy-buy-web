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
                                            <span class="dark-gold alt-font ">{{ __('user-portal.bonus_point_history') }}</span>
                                        </div>
                                        <div class="col-4 text-right">

                                        </div>
                                    </div>
                                </div>
                                @if(count($point_history) != 0)

                                        @foreach($point_history as $point_history_item)
                                            <hr>
                                            <div class="col-12  padding-40px-lr">
                                                <div class="row align-items-center">
                                                    <div class="col-6 col-md-3">
                                                        <span class="alt-font text-extra-dark-gray text-medium font-weight-500">{{ Auth::user()->name  }}</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 text-md-left text-right">
                                                        <span class="alt-font text-medium font-weight-500 {{ ($point_history_item->amount > 0 ) ? "text-success" : "text-red" }}">{{ number_format($point_history_item->amount) }} PV</span>
                                                    </div>
                                                    <div class="col-6 col-md-4">
                                                        <span class="alt-font text-gray text-medium">{{  $point_history_item->created_at->format('d M Y H:i a') }}</span>
                                                    </div>
                                                    <div class="col-6 col-md-2 text-right">
                                                        <span class="alt-font text-gray text-medium font-weight-500">{{  \App\Models\PointBonusBalance::STATUS_SELECT[$point_history_item->status] }}</span>
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
