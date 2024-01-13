@extends('landing.app')
@section('css')
    <style>
        .progress, .progress .progress-bar {
            border: 0;
            height: 1rem;
            border-radius: 20px;
        }

        .progress::-webkit-progress-bar {
            border: 0;
            height: 1rem;
            border-radius: 20px;
        }

        .progress::-webkit-progress-value {
            border: 0;
            height: 1rem;
            border-radius: 20px;
        }

        .progress::-moz-progress-bar {
            border: 0;
            height: 1rem;
            border-radius: 20px;
        }

        .progress {
            background-color: darkgray;
        }

        /* Set a fixed scrollable wrapper */
        .tableWrap {
            height: 500px;

            overflow: auto;
        }

        /* Set header to stick to the top of the container. */
        thead tr th {
            position: sticky;
            top: 0;
        }

        /* If we use border,
        we must use table-collapse to avoid
        a slight movement of the header row */
        table {
            border-collapse: collapse;
        }

        /* Because we must set sticky on th,
         we have to apply background styles here
         rather than on thead */
        th {
            padding: 16px;
            padding-left: 15px;
            background: #ffffff;
            text-align: left;

        }

        /* Basic Demo styling */
        table {
            width: 100%;

        }

        table td {
            padding: 16px;
        }

        thead {
            font-weight: 500;
            color: rgba(0, 0, 0, 0.85);
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
                        <div class="row padding-1-half-rem-bottom">
                            <div class="col-6">
                                <span class="dark-gold alt-font ">My Bonus Points</span>

                            </div>
                            <div class="col-6 text-right">
                                <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gray text-uppercase text-white"
                                   style="padding: 3px 10px;min-width: 90px"
                                   href="{{ route('user.bonus-history') }}">
                                    {{ __('user-portal.view_history') }}
                                </a>
                                <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                   style="padding: 3px 10px;min-width: 90px"
                                   href="{{ route('user.point-convert-show') }}">
                                    {{ __('user-portal.point_convert') }}
                                </a>
                            </div>

                        </div>
                        <div class="row padding-1-half-rem-bottom">
                            <div class="col-12 col-md-4 padding-20px-bottom">
                                <div class="shadow" style="background-color: #F6EDE5;border-radius:10px">
                                    <div class="padding-15px-lr padding-15px-top">
                                        <div class="text-extra-dark-gray text-extra-medium alt-font line-height-15px">
                                            Car <br>Bonus
                                        </div>
                                        <div class="text-large dark-gold alt-font padding-10px-tb">
                                            {{ (getAccumulatedBonusTeamCarAndHouse(Auth::user()->id))[2] }} / {{ number_format((getAccumulatedBonusTeamCarAndHouse(Auth::user()->id))[1]) }} PV
                                        </div>
{{--                                        <div class="progress align-items-center text-right padding-5px-right">--}}
{{--                                            <div class="progress-bar text-right padding-5px-right bg-dark-gold" role="progressbar"--}}
{{--                                                 style="width:{{ (getAccumulatedBonusTeamCarAndHouse(Auth::user()->id))[2] }} / {{ (getAccumulatedBonusTeamCarAndHouse(Auth::user()->id))[1] }} %">--}}
{{--                                                {{ (getAccumulatedBonusTeamCarAndHouse(Auth::user()->id))[2] }} / {{ (getAccumulatedBonusTeamCarAndHouse(Auth::user()->id))[1] }}%--}}
{{--                                            </div>--}}
{{--                                            <span class="text-white" style="flex:1;">0.5%</span>--}}
{{--                                        </div>--}}
                                        <div class="row">
{{--                                            <div class="col-6 text-extra-dark-gray text-small">--}}
{{--                                                {{ $agreement->created_at->format('d.m.Y')}}--}}
{{--                                            </div>--}}
{{--                                            <div class="col-6 text-extra-dark-gray text-right text-small">--}}
{{--                                                {{ $agreement->created_at->add('1 year')->format('d.m.Y')}}--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
{{--                                    @if(getPersonalAnnualClaimedBonus(Auth::user()->id) > 0)--}}
{{--                                        <hr class="bg-black margin-10px-tb">--}}
{{--                                        <div class="padding-15px-lr ">--}}
{{--                                            <div class="row line-height-10px">--}}
{{--                                                <div class="col-7 text-extra-dark-gray">--}}
{{--                                                    Points Claimed--}}
{{--                                                </div>--}}
{{--                                                <div class="col-5 text-extra-dark-gray text-right">--}}
{{--                                                    {{ getPersonalAnnualClaimedBonus(Auth::user()->id) }}--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-8 text-extra-dark-gray">--}}
{{--                                                    Points Unclaimed--}}
{{--                                                </div>--}}
{{--                                                <div class="col-4 text-extra-dark-gray text-right">--}}
{{--                                                    {{ getPersonalAnnualBonus(Auth::user()->id) }}--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
                                </div>
                            </div>
                            <div class="col-12 col-md-4 padding-20px-bottom">
                                <div class=" shadow" style="background-color: #ECD7C5;border-radius:10px">
                                    <div class="padding-15px-lr padding-15px-top">
                                        <div class="text-extra-dark-gray text-extra-medium alt-font line-height-15px">
                                            House <br>Bonus
                                        </div>
                                        <div class="text-large dark-gold alt-font padding-10px-tb">
                                            {{ (getAccumulatedBonusTeamCarAndHouse(Auth::user()->id))[4] }} / {{ number_format((getAccumulatedBonusTeamCarAndHouse(Auth::user()->id))[3]) }} PV
                                        </div>
{{--                                        <div class="progress align-items-center text-right padding-5px-right">--}}
{{--                                            <div class="progress-bar text-right padding-5px-right bg-dark-gold" role="progressbar"--}}
{{--                                                 style="width:{{ getPersonalAnnualBonus(Auth::user()->id) }} / {{ $bonus_personal->point }} %">--}}
{{--                                                1%--}}
{{--                                            </div>--}}
{{--                                            <span class="text-white" style="flex:1;">0.5%</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-6 text-extra-dark-gray text-small">--}}
{{--                                                {{ $agreement->created_at->format('d.m.Y')}}--}}
{{--                                            </div>--}}
{{--                                            <div class="col-6 text-extra-dark-gray text-right text-small">--}}
{{--                                                {{ $agreement->created_at->add('1 year')->format('d.m.Y')}}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    @if(getGroupAnnualClaimedBonus(Auth::user()->id))
                                    <hr class="bg-black margin-10px-tb">
                                    <div class="padding-15px-lr ">
                                        <div class="row line-height-10px">
                                            <div class="col-7 text-extra-dark-gray">
                                                Points Claimed
                                            </div>
                                            <div class="col-5 text-extra-dark-gray text-right">
                                                {{ getPersonalAnnualBonus(Auth::user()->id) }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 text-extra-dark-gray">
                                                Points Unclaimed
                                            </div>
                                            <div class="col-4 text-extra-dark-gray text-right">
                                                {{ getPersonalAnnualBonus(Auth::user()->id) }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-4 padding-20px-bottom">
                                <div class=" shadow" style="background-color: #F0E0D2;border-radius:10px">
                                    <div class="padding-15px-lr padding-15px-top">
                                        <div class="text-extra-dark-gray text-extra-medium alt-font line-height-15px">
                                            Personal Top Up <br>Bonus
                                        </div>
                                        <div class="text-large dark-gold alt-font padding-10px-tb">
                                            {{ number_format(getPersonalTopupBonus(Auth::user()->id)) }} PV
                                        </div>
                                        <div class="invisible progress align-items-center text-right padding-5px-right">
                                            <div class="progress-bar text-right padding-5px-right bg-dark-gold" role="progressbar"
                                                 style="width:{{ getPersonalAnnualBonus(Auth::user()->id) }} / {{ $bonus_personal->point }} %">
                                                2%
                                            </div>
                                            <span class="text-white" style="flex:1;">0.5%</span>
                                        </div>
                                        <div class=" row">
                                            <div class="col-6 text-extra-dark-gray text-small" style="padding-right:0px">
                                                Settlement Date
                                            </div>
                                            <div class="col-6 text-extra-dark-gray text-right text-small" style="padding-left:0px">
                                                {{ $agreement->created_at->add('1 year')->format('d.m.Y')}}
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="hidden bg-black margin-10px-tb">
                                    <div class=" hidden padding-15px-lr ">
                                        <div class="row line-height-10px">
                                            <div class="col-7 text-extra-dark-gray">
                                                Points Claimed
                                            </div>
                                            <div class="col-5 text-extra-dark-gray text-right">
                                                {{ getPersonalAnnualBonus(Auth::user()->id) }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 text-extra-dark-gray">
                                                Points Unclaimed
                                            </div>
                                            <div class="col-4 text-extra-dark-gray text-right">
                                                {{ getPersonalAnnualBonus(Auth::user()->id) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom padding-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.merchant_performance') }}</span>
                                    </div>
                                    <div class="col-4 text-right">
                                        {{--                                        <a class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"--}}
                                        {{--                                           style="padding: 3px 10px;min-width: 90px"--}}
                                        {{--                                           href="{{ route('user.bonus-history') }}">--}}
                                        {{--                                            View Point History--}}
                                        {{--                                        </a>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 " style="padding-left: 0px; padding-right: 0px">
                                <!-- start tab navigation -->
                                <ul class="nav nav-pills nav nav-tabs text-uppercase justify-content-center text-center alt-font font-weight-500 bg-light-gray" id="pills-tab"
                                    role="tablist">
                                    @foreach([1 => "A", 2 => "B", 3 => "C"] as $key=> $name)
                                        <li class="nav-item">
                                            <a class="nav-link product-nav bonus-millionaire-nav" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                                               aria-controls="pills-home" aria-selected="true" value="{{ $key }}">{{ $name }}</a>
                                            <span class="tab-border bg-dark-gold"></span>
                                        </li>
                                    @endforeach

                                </ul>
                                <!-- end tab navigation -->
                            </div>

                            <div class="col-12 tableWrap">
                                <table class="table">
                                    <thead>
                                    <tr class="d-md-table-row d-none">
                                        <th style="width: 40%">Name</th>
                                        <th>Phone</th>
                                        <th>Date Joined</th>
                                        <th class="alt-font text-center">Top-Up PV</th>
                                        <th class="alt-font text-center">Annual Top-Up PV</th>
                                    </tr>
                                    </thead>
                                    <tbody id="product-items">

                                    </tbody>

                                </table>
                            </div>

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
            $('.bonus-millionaire-nav').on('click', function () {

                $('#product-items').addClass('grid-loading');
                var id = $(this).attr('value');

                var type = "POST";
                var ajaxurl = '{{ route('user.bonus-member-list', ['level' => ':level'])}}';
                ajaxurl = ajaxurl.replace('%3Alevel', id);
                ajaxurl = ajaxurl.replace(':level', id);
                var formData = {
                    "_token": "{{ csrf_token() }}",
                    category_id: id,
                };
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (data) {
                        console.log(data);
                        $('#product-items').empty();
                        $('#product-items').removeClass('grid-loading');
                        $('#product-items').append(data);

                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            $('.bonus-millionaire-nav').first().click();
        });
    </script>
@endsection
