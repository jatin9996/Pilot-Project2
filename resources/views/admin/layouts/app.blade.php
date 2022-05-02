<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Test') }} | @yield('title') </title>

    <!-- Global stylesheets -->
    <link rel="icon" href="{{ asset('assets/images/logo_light.png') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/js/plugins/toast/build/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /core JS files -->

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/toast/build/toastr.min.js') }}"></script>
    @include('admin.layouts.flash')
    @stack('scripts')
</head>

<body>

@include('admin.layouts.header')

<!-- Page content -->
<div class="page-content">
    @include('admin.layouts.sidebar-menu')

<!-- Main content -->
    <div class="content-wrapper">
        @yield('content')

        @include('admin.layouts.footer')
    </div>
    <!-- /main content -->
</div>
<!-- /page content -->
</body>
</html>
