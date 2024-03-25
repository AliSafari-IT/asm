@props([
    'field', // Field name
    'options' // Array containing type, label, and value
])

{{-- Determine field type and render appropriately --}}
@php
$type = $options['type'] ?? 'text';
$value = $options['value'] ?? '';
$label = $options['label'] ?? ucfirst($field);
@endphp

{{-- Field Wrapper --}}
<div class="mb-4">
    <label for="{{ $field }}" class="block text-gray-700 text-sm font-bold mb-2">
        {{ $label }}
    </label>

    {{-- Text Input --}}
    @if ($type === 'text' || $type === 'number' || $type === 'email' || $type === 'datetime-local')
        <input
            type="{{ $type }}"
            id="{{ $field }}"
            name="{{ $field }}"
            value="{{ $value }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        >

    {{-- Textarea --}}
    @elseif ($type === 'textarea')
        <textarea
            id="{{ $field }}"
            name="{{ $field }}"
            rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >{{ $value }}</textarea>

    {{-- Checkbox --}}
    @elseif ($type === 'checkbox')
        <input
            type="checkbox"
            id="{{ $field }}"
            name="{{ $field }}"
            class="form-checkbox h-5 w-5 text-gray-600"
            {{ $value ? 'checked' : '' }}            
        >

    {{-- Fallback for unrecognized types --}}
    @else
        <span>Unsupported field type: {{ $type }}</span>
    @endif
</div>
