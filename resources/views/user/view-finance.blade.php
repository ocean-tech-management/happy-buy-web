@extends('landing.app')

@section('content')
    @include('user.user-header')
    <div class="cover-background"
         style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 ">
                        <!-- start tab navigation -->
                        <ul class="nav nav-pills nav nav-tabs text-uppercase justify-content-center text-center alt-font font-weight-500" id="pills-tab"
                            role="tablist">

                            <li class="nav-item ">
                                <a class="nav-link product-nav finance-nav" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                                   aria-controls="pills-home" aria-selected="true" value="pool">PV Pool</a>
                                <span class="tab-border bg-dark-gold"></span>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link product-nav finance-nav" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                                   aria-controls="pills-home" aria-selected="true" value="stock-credit">Actual Stock Credit</a>
                                <span class="tab-border bg-dark-gold"></span>
                            </li>
                        </ul>
                        <!-- end tab navigation -->
                    </div>
                    <div class="col-12 col-lg-4 col-md-4 sm-margin-30px-bottom">
                        <div
                            class="bg-white shadow padding-1-rem-top wow animate__fadeIn border-radius-5px"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="border-radius-5px ">
                                <ul class="col-12 list-style-07" style="line-height: 5px;">
                                    <li class=" border-bottom border-color-medium-dark-gray "
                                        style="margin-bottom: 4px ">
                                        <a class="margin-1-half-rem-lr text-extra-medium {{ Route::current()->getName() == "user.password.edit"? "dark-gold" : "text-gray" }} padding-1-rem-tb "
                                           style="width: 100%;" href="{{ route('user.password.edit') }}"> {{ __('user-portal.change_password') }}</a>
                                    </li>
                                    <li class=" " style="margin-bottom: 4px">
                                        <a class="margin-1-half-rem-lr text-extra-medium {{ Route::current()->getName() == "user.bank-setting"? "dark-gold" : "text-gray" }} padding-1-rem-tb "
                                           style="width: 100%" href="{{ route('user.bank-setting') }}"> {{ __('user-portal.bank_setting') }}</a>
                                    </li>
                                    {{--                                    <li class=" " style="margin-bottom: 4px">--}}
                                    {{--                                        <a class="margin-1-half-rem-lr text-extra-medium text-gray padding-1-rem-tb" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"--}}
                                    {{--                                           style="width: 100%"> {{__('global.logout')}} </a>--}}
                                    {{--                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom">
                        <form class="row" action="{{ route('user.finance.view') }}">
                            <div class="col-6">
                                <select name="year">
                                    @foreach($range as $ym)
                                        <option {{isset($_GET['year'])?  (($ym == $_GET['year'])? "selected" : "" ): "" }}> {{$ym}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <button class="btn bg-dark-gold text-white" type="submit"> Submit</button>
                            </div>
                        </form>
                        <div id="div-pool">
                            <h5>PV Pool</h5>
                            <table class="table table-bordered bg-white">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>Last Month Balance</strong></td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td class="text-right">{{ $last_month_balance }}</td>
                                </tr>
                                @foreach($point_histories as $point_history)
                                    <tr>
                                        <td>{{ $point_history->remark }}</td>
                                        <td>{{ $point_history->user->name }}</td>
                                        <td>{{ $point_history->created_at }}</td>
                                        <td class="text-right">{{ $point_history->amount }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td><strong>Latest Balance</strong></td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td class="text-right">{{ $latest_balance }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="div-stock-credit">
                            <h5> Actual Stock Credit</h5>
                            <table class="table table-bordered bg-white">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($point_histories2 as $point_history)
                                <tr>
                                    <td>{{ $point_history->remark }}</td>
                                    <td> {{ $point_history->user->name }} </td>
                                    <td>{{ $point_history->created_at }}</td>
                                    <td class="text-right">{{ $point_history->amount }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- start section -->
        <section class="pt-0 padding-five-lr xs-no-padding-lr">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 shopping-content">
                        <ul class="product-listing row grid grid-5col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large text-center"  id="finance-items">
                            {{--                        <li class="grid-sizer"></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.finance-nav').on('click', function () {

                // $('#product-items').addClass('grid-loading');
                var id = $(this).attr('value');

                if(id == 'pool'){

                    $('#div-pool').addClass('d-block');
                    $('#div-pool').removeClass('d-none');
                    $('#div-stock-credit').addClass('d-none');
                    $('#div-stock-credit').removeClass('d-block');
                }else{
                    $('#div-stock-credit').addClass('d-block');
                    $('#div-stock-credit').removeClass('d-none');
                    $('#div-pool').addClass('d-none');
                    $('#div-pool').removeClass('d-block');
                }
            });

            $('.finance-nav').first().click();
        });
    </script>
@endsection
