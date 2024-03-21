{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('general_info.head')
<x-general-info-main>
    {{ $slot }}
</x-general-info-main>
</html>
