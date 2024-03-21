<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('general_info.head')

<body class="font-sans antialiased bg-gray-100 p-1">

<x-generalinfoMain>
    {{ $slot }}
</x-generalinfoMain>

</body>
</html>