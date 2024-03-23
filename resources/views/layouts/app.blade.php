{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('general_info.head')

<body class="font-sans antialiased bg-gray-100 mb-12 min-w-full">
    <!-- // add header -->
    @php
    if(!isset($header)) {
    $header = null;
    }
    if(!isset($slot)) {
    $slot = 'No content to display here!';
    }
    if(!isset($actions)) {
    $actions = null;
    }
    if(!isset($sidebar)) {
    $sidebar = null;
    }
    if(!isset($toolbar)) {
    $toolbar = null;
    }
    if(!isset($footer)) {
    $footer = null;
    }
    @endphp
    <x-generalinfoMain :header="$header" :actions="$actions" :sidebar="$sidebar" :toolbar="$toolbar" :footer="$footer">
        {{ $slot }}
    </x-generalinfoMain>
</body>

</html>