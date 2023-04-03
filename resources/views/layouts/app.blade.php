<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="icon" href="@yield('icon', asset())" type="image/png"> --}}

    <title>{{ config('app.name', 'BoolBnb') }} | @yield('title') </title>

    @yield('cdns')

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        @include('includes.navbar')



        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
