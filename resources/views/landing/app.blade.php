<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>HappyBuy</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="ThemeZaa">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="description" content="HappyBuy - Your ultimate E-Commerce destination">
{{--    <!-- favicon icon -->--}}
{{--    <link rel="shortcut icon" href="landing/images/favicon.png">--}}
{{--    <link rel="apple-touch-icon" href="landing/images/apple-touch-icon-57x57.png">--}}
{{--    <link rel="apple-touch-icon" sizes="72x72" href="landing/images/apple-touch-icon-72x72.png">--}}
{{--    <link rel="apple-touch-icon" sizes="114x114" href="landing/images/apple-touch-icon-114x114.png">--}}
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{asset('landing/images/favicon/apple-touch-icon.png')}}"> --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('landing/images/favicon/favicon-32x32.png')}}">
    {{-- <link rel="icon" type="image/png" sizes="16x16" href="{{asset('landing/images/favicon/favicon-16x16.png')}}"> --}}
    <link rel="manifest" href="{{asset('landing/images/favicon/site.webmanifest')}}">
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/font-icons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/theme-vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/responsive.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

    <style>
        .body-bg-img{
            /* background-image: url('{{asset('landing/images/parallax_bg.png')}}'); */
            /* Set a specific height */
            min-height: 500px;
            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }

        .section-bg-image-blur {
            /* The image used */
            background-image: url('{{asset('landing/images/joinus001.png')}}');

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .nav-tabs.user-nav-tabs{
            display: block;
            overflow-x: scroll;
            white-space: nowrap;

            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .nav-tabs.user-nav-tabs::-webkit-scrollbar {
            display: none;
        }
        .nav-tabs.user-nav-tabs > li{
            width: auto;
            display: inline-block;
        }

        @media (max-width: 778px) {
            aside {
                display: none!important;
            }
        }
        aside {
            display: block;
        }

        .alert-count {
            position: absolute;
            top:  2px;
            right: -10px;
            width: 16px;
            height: 16px;
            text-align: center;
            font-size: 9px;
            line-height: 16px;
            border-radius: 100%;
        }

        /*---------------------- loader ----------------------*/
        #overlay{
            position:fixed;
            z-index:9999;
            top:0;
            left:0;
            bottom:0;
            right:0;
            background:rgba(0,0,0,0.3);
            transition: 1s 0.4s;
        }
        .loader {
            position: absolute;
            /*top: 50%;*/
            /*left: 50%;*/
            transform: translate(-50%, -50%);
            transform: -webkit-translate(-50%, -50%);
            transform: -moz-translate(-50%, -50%);
            transform: -ms-translate(-50%, -50%);
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #877a61;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }


    </style>
    @yield('css')
    @livewireStyles
</head>

<body data-mobile-nav-style="classic">
<div class="flex justify-content-center items-center" id="overlay">
    <div class="loader "></div>
</div>
@include('landing.header')

<div class="body-bg-img">
    @yield('content')
</div>


@include('landing.footer')

@if(Auth::guard('user')->check())
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
@endif
<!-- start scroll to top -->
<a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up"></i></a>
<!-- end scroll to top -->
<!-- javascript -->
<script type="text/javascript" src="{{asset('landing/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('landing/js/theme-vendors.min.js')}}"></script>
<script type="text/javascript" src="{{asset('landing/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    $(document).ready(function(){
        $('#overlay').fadeOut();
    });
</script>
<script>
    $(document).ajaxStart(function(){
        // Show image container
        $("#overlay").show();
    });
    $(document).ajaxComplete(function(){
        // Hide image container
        $("#overlay").hide();
    });
</script>
@yield('js')
@livewireScripts
</body>
</html>
