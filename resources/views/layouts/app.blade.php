<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/cne.png') }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('packages/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bootstrap-icons/font/bootstrap-icons.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        #sidebarMenu i {
            width: 25px !important;
        }
    </style>
    @stack('styles')
</head>

<body>
    @include('elements.header')
    <div class="container-fluid bg-gray-container">
        <div class="row">
            @include('elements.sidebar')
            @yield('content')
        </div>
    </div>
    @yield('modal')
    <script type="module" src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
