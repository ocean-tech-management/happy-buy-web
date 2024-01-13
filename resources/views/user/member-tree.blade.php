@extends('landing.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('landing/css/Treant.css') }}">

    <style>
        .chart {
            height: 550px;
            margin: 5px;
        }

        .Treant > .node {
        }

        .Treant > p {
            font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            font-weight: bold;
            font-size: 12px;
        }

        .node-name {
            font-weight: bold;
        }

        .nodeExample1 {
            padding: 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            background-color: #ffffff;
            width: 260px;
            font-family: Lato, sans-serif;
            font-size: 12px;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important
        }

        p {
            margin: 0 0 5px !important;
        }

        .gray {
            background-color: #909090;
        }

        .light-gray {
            background-color: #D3D3C7;
        }

        .blue {
            background-color: #A2BDFD;
        }</style>
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
                            class="bg-white shadow wow animate__fadeIn border-radius-5px  padding-20px-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font ">Member Tree</span>
                                    </div>
                                    <div class="col-4 row justify-content-end">

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 col-lg-12 col-md-12 mx-auto">
                                <div class="chart" id="custom-colored"> --@--</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

{{--    create node for the members--}}
    <div class="" style="display: none;">
        <div class="node nodeExample1" id="my-upline" style=" ">
            <div class="row">
                <div class="col-3" style="padding-right: 0px">
                    <img class=" rounded-circle" style="margin-top:5px;height: 50px; width: 50px" src="{{ asset('landing/images/product-details04.png') }}">
                </div>
                <div class="col-9" style="display: grid;padding-left: 10px">
                    <span class="text-medium dark-gold">Mark Hill</span>
                    <span class="text-medium test-grey">AMVF6745</span>
                    <span class="text-medium test-grey">Merchant</span>
                    <div style="height: 1px;background-color: lightgray;margin-top: 5px;margin-bottom: 5px"> </div>
                    <div class="row">
                        <div class="col-8">
                            <span class="text-medium dark-gold">Downline</span>
                        </div>
                        <div class="col-4">
                            <div class=" ">
                                <span class="text-medium dark-gold">1111</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('landing/js/raphael.js') }}"></script>
    <script src="{{ asset('landing/js/Treant.js') }}"></script>

    <script>
        var config = {
                container: "#custom-colored",
                nodeAlign: "BOTTOM",
                connectors: {
                    type: 'step'
                },
                node: {
                    HTMLclass: 'nodeExample1'
                }
            },
            ceo = {
                innerHTML: "#my-upline",
                text: {
                    name: "Mark Hill",
                    title: "Chief executive officer",
                    contact: "Tel: 01 213 123 134",
                },
                image: "../headshots/2.jpg"
            },

            cto = {
                parent: ceo,
                HTMLclass: 'light-gray',
                text: {
                    name: "Joe Linux",
                    title: "Chief Technology Officer",
                },
                image: "../headshots/1.jpg"
            },
            cbo = {
                parent: ceo,
                childrenDropLevel: 2,
                HTMLclass: 'blue',
                text: {
                    name: "Linda May",
                    title: "Chief Business Officer",
                },
                image: "../headshots/5.jpg"
            },
            cdo = {
                parent: ceo,
                HTMLclass: 'gray',
                text: {
                    name: "John Green",
                    title: "Chief accounting officer",
                    contact: "Tel: 01 213 123 134",
                },
                image: "../headshots/6.jpg"
            },
            cio = {
                parent: cto,
                HTMLclass: 'light-gray',
                text: {
                    name: "Ron Blomquist",
                    title: "Chief Information Security Officer"
                },
                image: "../headshots/8.jpg"
            },
            ciso = {
                parent: cto,
                HTMLclass: 'light-gray',
                text: {
                    name: "Michael Rubin",
                    title: "Chief Innovation Officer",
                    contact: "we@aregreat.com"
                },
                image: "../headshots/9.jpg"
            },
            cio2 = {
                parent: cdo,
                HTMLclass: 'gray',
                text: {
                    name: "Erica Reel",
                    title: "Chief Customer Officer"
                },
                link: {
                    href: "http://www.google.com"
                },
                image: "../headshots/10.jpg"
            },
            ciso2 = {
                parent: cbo,
                HTMLclass: 'blue',
                text: {
                    name: "Alice Lopez",
                    title: "Chief Communications Officer"
                },
                image: "../headshots/7.jpg"
            },
            ciso3 = {
                parent: cbo,
                HTMLclass: 'blue',
                text: {
                    name: "Mary Johnson",
                    title: "Chief Brand Officer"
                },
                image: "../headshots/4.jpg"
            },
            ciso4 = {
                parent: cbo,
                HTMLclass: 'blue',
                text: {
                    name: "Kirk Douglas",
                    title: "Chief Business Development Officer"
                },
                image: "../headshots/11.jpg"
            },

            chart_config = [
                config,
                ceo, cto, cbo,
                cdo, cio, ciso,
                cio2, ciso2, ciso3, ciso4
            ];

        /* ALTERNATIVE tree_structure CONFIG, same result as above

            var tree_structure = {
                chart: {
                    container: "#OrganiseChart8",
                    levelSeparation:    70,
                    siblingSeparation:  60,
                    nodeAlign: "BOTTOM",
                    connectors: {
                        type: "step",
                        style: {
                            "stroke-width": 2,
                            "stroke": "#ccc",
                            "stroke-dasharray": "--",
                            "arrow-end": "classic-wide-long"
                        }
                    }
                },
                nodeStructure: {
                    innerHTML: "#first-post",
                    children: [
                        {
                            innerHTML: "#first-reply"
                        },
                        {
                            innerHTML: "#second-reply",
                            children: [
                                {
                                    innerHTML: "#second-reply-reply"
                                }
                            ]
                        }
                    ]
                }
            };

        */

        new Treant(chart_config);
    </script>
@endsection
