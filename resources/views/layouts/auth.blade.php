<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>{{ trans('panel.site_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Erya Phoenix Admin Portal" name="description" />
    <meta content="Erya Phoenix" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/erya_logo.png')}}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin_assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin_assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    @yield('styles')
</head>

<body>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        @yield("content")
    </div>
</div>
<!-- end account-pages -->

<!-- JAVASCRIPT -->
<script src="{{ asset('admin_assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('admin_assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{ asset('admin_assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('admin_assets/libs/node-waves/waves.min.js')}}"></script>

<!-- App js -->
<script src="{{ asset('admin_assets/js/app.js')}}"></script>
@yield('scripts')
</body>
</html>
