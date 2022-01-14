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

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}

    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ config('app.name') }}"/>
    <meta property="og:image" content="{{ asset('img/logo.png') }}"/>
    <meta property="og:description"
          content="Computer parts and accessories store."/>
    @livewireStyles
</head>
<body>
@if(!request()->is('/'))
    @if(request()->is('category-shop/*') || request()->is('sub-category-shop/*') )
        @livewire('inc.category-header')
    @else
        @livewire('inc.header')
    @endif
@endif

{{ $slot }}

@if(!request()->is('/'))
    @livewire('inc.footer')
@endif

<!-- Use the minified version files listed below for better performance and remove the files listed above -->
<script src="{{ asset('assets/js/vendor/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/plugins.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
    $(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();

            var controlForm = $('.controls form:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="fa fa-minus"></span>');
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
</script>
@livewireScripts
<script src="{{ asset('js/sweetalert.js') }}"></script>
<x-livewire-alert::scripts />
</body>
</html>
