<?php
$footer = null;

if (isset($footer)) {
    $footer = $footer;
} else {
    $footer = '&copy; ' . date('Y') . ' ' . config('app.name');
}    
?>

{{-- resources/views/layouts/footer.blade.php --}}
<x-slot name="footer">
    <footer class="bg-gray-800 text-white text-center p-4 fixed inset-x-0 bottom-0">
        {{ __($footer) }}
    </footer>
</x-slot>