<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icon.png') }}">
</head>
<body>
<div id="app">
    <header-component
        :is-logged-in="{{ json_encode(\Illuminate\Support\Facades\Auth::check()) }}"
        :csrf="{{ json_encode(csrf_token()) }}"></header-component>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
