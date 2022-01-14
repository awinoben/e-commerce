<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="SHIFTECH AFRICA">
    <title>{{ config('app.name', 'Fusion Cube') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/bundle.css') }}" type="text/css">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet">

    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" type="text/css">

    <!-- Daterangepicker -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}" type="text/css">

    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}" type="text/css">

    <!-- App css -->
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/prism.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    @trixassets
    @livewireStyles

</head>

<body>
<!-- Preloader -->
<div class="preloader">
    <img class="logo" src="{{ asset('img/logo.png') }}" alt="logo" width="100">
    <img class="dark-logo" src="{{ asset('img/logo.png') }}" alt="logo dark" width="100">
    <div class="preloader-icon"></div>
</div>
<!-- ./ Preloader -->

@livewire('admin.inc.setting')

<!-- Layout wrapper -->
<div class="layout-wrapper">
    @livewire('admin.inc.header')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        @livewire('admin.inc.navigation')

        {{ $slot }}
    </div>
    <!-- ./ Content wrapper -->
</div>
<!-- ./ Layout wrapper -->

<!-- Main scripts -->
<script src="{{ asset('js/bundle.js') }}"></script>

<!-- Apex chart -->
<script src="{{ asset('js/irregular-data-series.js') }}"></script>
<script src="{{ asset('js/apexcharts.min.js') }}"></script>

<!-- Daterangepicker -->
<script src="{{ asset('js/daterangepicker.js') }}"></script>

<!-- DataTable -->
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/prism.js') }}"></script>

<!-- Dashboard scripts -->
<script src="{{ asset('js/ecommerce-dashboard.js') }}"></script>
<!-- App scripts -->
<script src="{{ asset('js/app.min.js') }}"></script>

<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
@livewireScripts
<script src="{{ asset('js/sweetalert.js') }}"></script>
<x-livewire-alert::scripts/>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $('textarea').ckeditor();
    // $("#data_sheet").change(function() {
    //     $('textarea').ckeditor();
    // });

</script>
<script>
    $('#myTab a').click(function (e) {
        console.log('Clicked Me');
        e.preventDefault();
        $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');

</script>
<!-- ./ Content wrapper -->
<!-- ./ Layout wrapper -->

<!-- Main scripts -->
<script src="{{ asset('js/bundle.js') }}"></script>

<!-- Apex chart -->
<script src="{{ asset('js/irregular-data-series.js') }}"></script>
<script src="{{ asset('js/apexcharts.min.js') }}"></script>

<!-- Daterangepicker -->
<script src="{{ asset('js/daterangepicker.js') }}"></script>

<!-- DataTable -->
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/prism.js') }}"></script>

<!-- Dashboard scripts -->
<script src="{{ asset('js/ecommerce-dashboard.js') }}"></script>
<!-- App scripts -->
<script src="{{ asset('js/app.min.js') }}"></script>

<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
@livewireScripts
<script src="{{ asset('js/sweetalert.js') }}"></script>
<x-livewire-alert::scripts />
</body>

</html>
