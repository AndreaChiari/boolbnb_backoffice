<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="icon" href="@yield('icon', asset())" type="image/png"> --}}

    <title>{{ config('app.name', 'BoolBnb') }} | @yield('title') </title>

    {{-- FONTAWESOME --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css'
        integrity='sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=='
        crossorigin='anonymous' />

    @yield('cdns')

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        @include('includes.navbar')
        @include('includes.validation')



        <main class="">
            @include('includes.confirmation_delete')
            @yield('content')
        </main>
    </div>
    @yield('scripts')

</body>

</html>
