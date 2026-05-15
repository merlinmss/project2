<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ASG CCENTRAL') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/custom.css', 'resources/js/app.js'])
    @include('layouts.default.head')
</head>
<body>
    <div class="container-scroller">
        @include('layouts.default.header')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.default.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    {{ $slot }}
                </div>
                @include('layouts.default.footer')
            </div>
        </div>
    </div>
    @include('layouts.default.footer_script')
</body>
</html>
