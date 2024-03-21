<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('general_info.head')

<x-generalinfoMain>
    {{ $slot }}
</x-generalinfoMain>

</html>