<!-- resources/views/layouts/summary.blade.php -->
<div {{ $attributes->merge(['class' => 'bg-white shadow-md rounded-lg overflow-hidden']) }}>
    <div class="p-5">
        <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
        @if(isset($description))
            <p class="mt-1 text-gray-600">{{ $description }}</p>
        @endif
    </div>
    <div class="px-5 py-3 bg-gray-100">
        <div class="text-sm text-gray-600">
            {{ $slot }}
        </div>
    </div>
</div>
