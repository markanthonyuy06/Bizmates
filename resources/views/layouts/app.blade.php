<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div>

        <main class="py-4" id="app">
            <div class="container">
                @yield('content')
            </div>
        </main>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </div>
</body>
</html>
