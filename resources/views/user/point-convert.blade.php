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
                            class="bg-white shadow wow animate__fadeIn border-radius-5px  margin-1-half-rem-bottom padding-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font "> {{ __('user-portal.point_convert') }}</span>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                           style="padding: 3px 10px;min-width: 90px"
                                           href="{{ route('user.point-convert-history') }}">
                                            {{ __('user-portal.convert_history') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('user.point-convert') }}" method="POST"
                                class="col-12 col-lg-10 col-md-10 mx-auto">
                                @csrf
                                @if ($errors->any())
                                    <div class="col-md-12 margin-5px-bottom">
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->getMessages() as $key => $error)
                                                    <li>{{ $error[0] }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="padding-4-rem-lr padding-4-rem-bottom lg-margin-35px-top md-padding-2-half-rem-alls row justify-content-center">
                                    <label class="col-12 text-extra-medium text-extra-dark-gray alt-font margin-15px-bottom text-center"> {{ __('user-portal.convert_amount') }}</label>
                                    <input class="small-input bg-white required text-center" type="text" id="amount" name="amount" placeholder="{{ __('user-portal.enter_', ['title'=> __('user-portal.convert_amount')]) }}">
                                    <div class="row">
                                        <div class="col-12 text-medium text-extra-dark-gray alt-font margin-15px-bottom text-center">{{__('user-portal.or_select_convert_amount')}}</div>
                                        <div class="col-12">
                                            <div class="row text-center">
                                                <div class="col-4 margin-1-half-rem-bottom">
{{--                                                    <div class="margin-1-half-rem-lf border-radius-5px payment-item" value="13500">--}}
{{--                                                        <div>--}}
{{--                                                            13500 PV--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                </div>
                                                <div class="col-4 margin-1-half-rem-bottom">
                                                    <div class="margin-1-half-rem-lf border-radius-5px payment-item" value="13500">
                                                        <div>
                                                            13500 PV
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 margin-1-half-rem-bottom">
{{--                                                    <div class="margin-1-half-rem-lf border-radius-5px payment-item" value="200">--}}
{{--                                                        <div>--}}
{{--                                                            200 PV--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                </div>
{{--                                                <div class="col-4 margin-1-half-rem-bottom">--}}
{{--                                                    <div class="margin-1-half-rem-lf border-radius-5px payment-item" value="500">--}}
{{--                                                        <div>--}}
{{--                                                            500 PV--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-4 margin-1-half-rem-bottom">--}}
{{--                                                    <div class="margin-1-half-rem-lf border-radius-5px payment-item" value="1000">--}}
{{--                                                        <div>--}}
{{--                                                            1000 PV--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-4 margin-1-half-rem-bottom">--}}
{{--                                                    <div class="margin-1-half-rem-lf border-radius-5px payment-item" value="1500">--}}
{{--                                                        <div>--}}
{{--                                                            1500 PV--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit"
                                                class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-1-half-rem-lr margin-3-half-rem-top">
                                            {{ __('user-portal.convert') }}
                                        </button>
                                    </div>


                                </div>
                            </form>
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
                $('#amount').val($(this).attr('value'));
            });

            $('.payment-item').first().addClass('select');
            $('#amount').attr('value', $('.payment-item').attr('value'));

        });
    </script>
@endsection
