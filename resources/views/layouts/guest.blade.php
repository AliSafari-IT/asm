<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen  flex flex-col sm:flex-row">
    <div class="pt-6 sm:pt-0 bg-gray-100 m-auto sm:w-8/12">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500 m-auto" />
        <x-top-menu-container>
            <x-breadcrumb />
        </x-top-menu-container>
        <div class="w-full shadow-md rounded px-8 pt-6 pb-8 mb-4">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
