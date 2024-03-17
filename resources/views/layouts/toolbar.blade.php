@props([
    'actions' => null
])

@if (isset($actions))
<div class="flex justify-around items-center bg-blue-900 text-white py-4">
    <div class="container mx-auto">
        {{ $actions }}
    </div>
    {{ isset($slot)?$slot: 'Toolbar content will be here.' }}   
</div>
@endif