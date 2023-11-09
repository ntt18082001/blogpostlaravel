<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $title = $attributes['title'] ?? 'Quản lý Blog';
@endphp
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/preview_img.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{ $header ?? '' }}
</head>
<body>
<!-- Begin page -->
<div id="layout-wrapper">
    @include ('Admin.includes.header')
    @include ('Admin.includes.navbar')
    <div class="main-content overflow-hidden">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="h3">{{ $title }}</h3>
                        @include ('Admin.includes.alertMessage')
                    </div>
                    <div class="card-body">
                        {{ $slot }}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    @include ('Admin.includes.footer')
</div>
@include ('Admin.includes.backToTop')
@include ('Admin.includes.preLoader')
<!-- END layout-wrapper -->
<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>

<script src="{{ asset('js/active_navbar.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
{{ $script ?? '' }}
<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
