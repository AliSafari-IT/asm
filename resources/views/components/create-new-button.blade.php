@props(['route', 'text', 'type' => 'primary', 'target' => '_self', 'title' => ''])
@php
// Define button type to color mappings
$buttonTypeToBgColor = [
    'primary' => 'bg-blue-500 hover:bg-blue-700',
    'secondary' => 'bg-gray-500 hover:bg-gray-700',
    'warning' => 'bg-yellow-500 hover:bg-yellow-700',
    'danger' => 'bg-red-500 hover:bg-red-700',
    'success' => 'bg-green-500 hover:bg-green-700',
    'info' => 'bg-teal-500 hover:bg-teal-700',
    'light' => 'bg-gray-100 hover:bg-gray-200 text-gray-800',
    'dark' => 'bg-gray-800 hover:bg-gray-900',
];

$buttonTypeToTextColor = [
    'primary' => 'text-white',
    'secondary' => 'text-white',
    'warning' => 'text-black',
    'danger' => 'text-white',
    'success' => 'text-white',
    'info' => 'text-white',
    'light' => 'text-gray-800',
    'dark' => 'text-white',
];

// Default to primary if type is not defined
$bgColorClasses = $buttonTypeToBgColor[$type] ?? $buttonTypeToBgColor['primary'];
$textColorClasses = $buttonTypeToTextColor[$type] ?? $buttonTypeToTextColor['primary'];
@endphp

<div class="inline-block mx-2 mb-2">
    <a href="{{ route($route) }}"
       class="{{ $bgColorClasses }} {{ $textColorClasses }} font-bold py-2 px-4 rounded"
       title="{{ $title }}"
       target="{{ $target }}">
        {{ __($text) }}
    </a>
</div>
